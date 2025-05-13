<?php
require_once(STYLESHEETPATH . '/inc/stripe-php-9.6.0/init.php');

add_action('wp_ajax_send_to_stripe', 'send_to_stripe');
add_action('wp_ajax_nopriv_send_to_stripe', 'send_to_stripe');

function validate_CCdetails($CCdetails) {
  if (!$CCdetails) echo 'No credit card info provided';
  $last_day_of_month = '31';
  if ($CCdetails['exp_month'] === '04' || $CCdetails['exp_month'] === '06' || $CCdetails['exp_month'] === '09' || $CCdetails['exp_month'] === '11') {
    $last_day_of_month = '30';
  }
  if ($CCdetails['exp_month'] === '02') {
    if ($CCdetails['exp_year'] % 4 === 0) {
      $last_day_of_month = '29';
    } else {
      $last_day_of_month = '28';
    }
  }
  
  $end_of_current_month = date('Y-m-t');
  $card_exp_date = date($CCdetails['exp_year'] . '-' . $CCdetails['exp_month'] . '-' . $last_day_of_month);
  
  function check_cc($cc, $extra_check = true){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);

    function validatecard($cardnumber) {
      $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  # strip any non-digits
      $cardlength=strlen($cardnumber);
      $parity=$cardlength % 2;
      $sum=0;
      for ($i=0; $i<$cardlength; $i++) {
        $digit=$cardnumber[$i];
        if ($i%2==$parity) $digit=$digit*2;
        if ($digit>9) $digit=$digit-9;
        $sum=$sum+$digit;
      }
      $valid=($sum%10==0);
      return $valid;
    }

    if($extra_check && $result > 0){
        $result = (validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
  }

  if (!check_cc($CCdetails['card_number'])) {
    echo 'Invalid card number';
    exit;
  }
    
  function validate_date($date, $format) {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

  if (!validate_date($card_exp_date, 'Y-m-d')) {
    echo 'Invalid expiration date';
    exit;
  }

  $date_interval = date_diff(date_create($end_of_current_month), date_create($card_exp_date));
  if (str_contains($date_interval->format('%R%a'), '-')) {
    echo 'Card has expired';
    exit;
  }
}

function validate_email($email) {
  $reg = "#^(((([a-z\d][\.\-\+_]?)*)[a-z0-9])+)\@(((([a-z\d][\.\-_]?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$#i";
  return preg_match($reg, $email);   
}

function send_to_stripe() {
    $data = $_POST['cardData'];
    $stripe = new Stripe\StripeClient("sk_test_51LX6SnI6ZErZ8GvOBqyQVukXhvYKenLoLVtwzspYjwq5vFZ07gAUc85FT0ZegsvsOMYb1u0J0taQNgXIaG44hPp100B4D5IhZG"); //Live key in use on prod
    $returnable = new stdClass();
    $returnable->message = "Default";

    //Validate Duration
    if ($data['duration']) {
      if (!$data['duration'] === 'ONCE' || !$data['duration'] === 'MONTHLY') {
        $returnable->message = 'Invalid donation frequency';
        exit;
      }
    } else {
      $returnable->message = 'No donation frequency provided';
    }

    //Validate Total
    if ($data['total']) {
      if (is_nan($data['total'])) {
        $returnable->message = 'Invalid amount';
        exit;
      }
    } else {
      $returnable->message = 'No donation amount provided';
      exit;
    }

    //Validate Name
    if ($data['name']) {
      if (!preg_match('/^[a-z\s]*$/i', $data['name'])) {
        $returnable->message = 'Invalid name.';
        exit;
      }
    } else {
      $returnable->message = 'No name provided';
      exit;
    }

    //Validate Credit Card Details
    if ($data['CCdetails']) {
      validate_CCdetails($data['CCdetails']);
    } else {
      $returnable->message = 'Invalid credit card.';
      exit;
    }

    //Validate Email Address
    if ($data['email']) {
      validate_email($data['email']);
    } else {
      $returnable->message = 'Invalid email.';
      exit;
    }

    //Validate Currency
    if ($data['currency']) {
      $accepted_currency = ['AUD', 'CAD', 'CNY', 'EUR', 'MYR', 'MXN', 'RUB', 'KRW', 'USD'];
      if (!array_search($data['currency'], $accepted_currency)) {
        $returnable->message = 'This currency is not currently accepted';
      }
    } else {
      $returnable->message = 'No currency provided';
      exit;
    }

    $token = $stripe->tokens->create([
      'card' => [
        'number' => $data['CCdetails']['card_number'],
        'exp_month' => $data['CCdetails']['exp_month'],
        'exp_year' => $data['CCdetails']['exp_year'],
      ],
    ]);

    $customer = $stripe->customers->create([
      'source' => $token['id'],
      'name' => $data['name'],
      'email' => $data['email'],
    ]);

    //submit our data based on duration
    if ($data['duration'] === 'ONCE') {
      $product = $stripe->products->create([
        'name' => 'Power of Five Donation',
        'description' => 'One time donation to Power of Five',
      ]);
      if(!$product) {
        $returnable->message = 'product not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }

      $price = $stripe->prices->create([
        'unit_amount' => $data['total'],
        'currency' => $data['currency'],
        'product' => $product['id'],
      ]);
      if(!$price) {
        $returnable->message = 'price not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }

      $charge = $stripe->charges->create([
        'amount' => $data['total'],
        'currency' => $data['currency'],
        'source' => $token['card']['id'],
        'customer' => $customer['id'],
        'receipt_email' => $data['email'],
        'description' => 'Power of Five One Time Donation'
      ]);
      if(!$charge) {
        $returnable->message = 'charge not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      } else {
        //SUCCESS FOR SINGLE CHARGE
        $returnable->message = 'charge successfully submitted';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }
    } elseif ($data['duration'] === 'MONTHLY') {
      $product = $stripe->products->create([
        'name' => 'Power of Five Recurring Monthly Donation',
        'description' => 'Monthly Donation to Power of Five',
      ]);
      if(!$product) {
        $returnable->message = 'product not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }

      $price = $stripe->prices->create([
        'unit_amount' => $data['total'],
        'currency' => $data['currency'],
        'product' => $product['id'],
        'recurring' => [
          'interval' => 'month',
        ],
      ]);
      if(!$price) {
        $returnable->message = 'price not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }

      $subscription = $stripe->subscriptions->create([
        'collection_method' => 'charge_automatically',
        'customer' => $customer['id'],
        'default_payment_method' => $token['card']['id'],
        'items' => [
          ['price' => $price['id']],
        ],
        'description' => 'Power of Five Recurring Monthly Donation',
      ]);
      if(!$subscription) {
        $returnable->message = 'subscription not created.';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      } else {   
        //SUCCESSFULLY SET UP MONTHLY RECURRING DONATION
        $returnable->message = 'subscription successfully submitted';
        $returnable = json_encode($returnable);
        echo $returnable;
        exit;
      }
    } else {
      $returnable->message = 'could not create stripe object due to duration error';
      $returnable = json_encode($returnable);
      echo $returnable;
      exit;
    }
    
    $returnable->message = 'fatal error; should not get here.';
    $returnable = json_encode($returnable);
    echo $returnable;
    exit;
}