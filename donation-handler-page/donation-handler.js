const po5DonateStepDown = document.getElementById('po5-donate-step-down');
const po5DonateStepUp = document.getElementById('po5-donate-step-up');
const po5DonateCount = document.getElementById('po5-donate-count');
const po5DurationOnce = document.getElementById('po5-duration-once');
const po5DurationMonthly = document.getElementById('po5-duration-monthly');
const po5AmountTotal = document.getElementById('po5-amount-total');
const po5CurrencyDropdown = document.getElementById('po5-donate-change-currency');
const po5DonateButton = document.getElementById('po5-donate-donate');
const po5DonateCC = document.getElementById('po5-donate-cc');
const po5DonateExpMonth = document.getElementById('po5-donate-card-exp-month');
const po5DonateExpYear = document.getElementById('po5-donate-card-exp-year');
const po5DonateLabel = document.getElementById('po5-donate-label');
const po5DonateEmail = document.getElementById('po5-donate-email');
const po5DonateOrg = document.getElementById('po5-donate-org');
const po5DonateFinal = document.getElementById('po5-donate-donate-final');
const currencySymbol = document.getElementById('currency-symbol');
const po5Form = document.getElementById('po5-donate-cc-form');
const po5DonateName = document.getElementById('po5-donate-name');
let po5Duration = 'ONCE'; 
let po5SelectedCurrency = 'USD';
let CCNumber;
const now = new Date();
let CCExpMonth = now.getMonth() + 1;
let CCExpYear = now.getFullYear();
let po5DonateExpYearArray = [];
let donateCount = 1;
let amountTotal = 0;
let defaultValue = 10;

po5DonateStepDown.addEventListener('click', () => {
  if (po5DonateCount.value <= 2) {
    po5DonateStepDown.removeAttribute('style');
  }
  if (po5DonateCount.value > 1) {
    po5DonateCount.value--;
    donateCount = po5DonateCount.value ?? 1;
    if (po5AmountTotal.value) {
      po5AmountTotal.value = defaultValue * donateCount;
    }
  }
});

po5DonateStepUp.addEventListener('click', () => {
  po5DonateCount.value++;
  donateCount = po5DonateCount.value ?? 1;
  if (po5AmountTotal.value) {
    po5AmountTotal.value = defaultValue * donateCount;
  }
  if (po5DonateCount.value > 1) {
    po5DonateStepDown.setAttribute('style', 'opacity: 1;');
  }
});

po5DurationOnce.addEventListener('click', () => {
  if (!po5DurationOnce.hasAttribute('checked')) {
    po5DurationOnce.setAttribute('checked', 'checked');
    document.querySelector('.po5-donate-duration-once').classList.add('checked');
    po5DurationMonthly.removeAttribute('checked');
    document.querySelector('.po5-donate-duration-monthly').classList.remove('checked');
    po5Duration = po5DurationOnce.value;
    po5DonateLabel.textContent = 'Donate Once';
  }
});

po5DurationMonthly.addEventListener('click', () => {
  if (!po5DurationMonthly.hasAttribute('checked')) {
    po5DurationMonthly.setAttribute('checked', 'checked');
    document.querySelector('.po5-donate-duration-monthly').classList.add('checked');
    po5DurationOnce.removeAttribute('checked');
    document.querySelector('.po5-donate-duration-once').classList.remove('checked');
    po5Duration = po5DurationMonthly.value;
    po5DonateLabel.textContent = 'Donate Monthly';
  }
});

po5AmountTotal.addEventListener('change', (e) => {
  po5AmountTotal.value = e.target.value;
  console.log('po5AmountTotal.value', po5AmountTotal.value);
  po5SelectedCurrency !== 'KRW' ? amountTotal = e.target.value * 100 : amountTotal = e.target.value; 
})

po5CurrencyDropdown.addEventListener('change', (e) => {
  po5SelectedCurrency = e.target.value ?? 'USD';
  document.getElementById('currency-type').textContent = e.target.value;
  switch (!!po5SelectedCurrency) {
    case (po5SelectedCurrency === 'AUD'):
      defaultValue = 12;
      po5AmountTotal.setAttribute('placeholder','12');
      po5AmountTotal.setAttribute('value', 12 * donateCount);
      po5AmountTotal.value = 12 * donateCount;
      currencySymbol.textContent = '$';
      break;
    case (po5SelectedCurrency === 'CAD'):
      defaultValue = 12;
      po5AmountTotal.setAttribute('placeholder', '12');
      po5AmountTotal.setAttribute('value', 12 * donateCount);
      po5AmountTotal.value = 12 * donateCount;
      currencySymbol.textContent = '$';
      break;
    case (po5SelectedCurrency === 'CNY'):
      defaultValue = 70;
      po5AmountTotal.setAttribute('placeholder', '70');
      po5AmountTotal.setAttribute('value', 70 * donateCount);
      po5AmountTotal.value = 70 * donateCount;
      currencySymbol.textContent = '¥';
      break;
    case (po5SelectedCurrency === 'EUR'):
      defaultValue = 9;
      po5AmountTotal.setAttribute('placeholder', '9');
      po5AmountTotal.setAttribute('value', 9 * donateCount);
      po5AmountTotal.value = 9 * donateCount;
      currencySymbol.textContent = '€';
      break;
    case (po5SelectedCurrency === 'MYR'):
      defaultValue = 40;
      po5AmountTotal.setAttribute('placeholder', '40');
      po5AmountTotal.setAttribute('value', 40 * donateCount);
      po5AmountTotal.value = 40 * donateCount;
      currencySymbol.textContent = 'RM';
      break;
    case (po5SelectedCurrency === 'MXN'):
      defaultValue = 175;
      po5AmountTotal.setAttribute('placeholder', '175');
      po5AmountTotal.setAttribute('value', 175 * donateCount);
      po5AmountTotal.value = 175 * donateCount;
      currencySymbol.textContent = '$';
      break;
    case (po5SelectedCurrency === 'RUB'):
      defaultValue = 600;
      po5AmountTotal.setAttribute('placeholder', '600');
      po5AmountTotal.setAttribute('value', 600 * donateCount);
      po5AmountTotal.value = 600 * donateCount;
      currencySymbol.textContent = '₽';
      break;
    case (po5SelectedCurrency === 'KRW'):
      defaultValue = 11500;
      po5AmountTotal.setAttribute('placeholder', '11500');
      po5AmountTotal.setAttribute('value', 11500 * donateCount);
      po5AmountTotal.value = 11500 * donateCount;
      currencySymbol.textContent = '₩';
      break;
    case (po5SelectedCurrency === 'USD'):
      defaultValue = 10;
      po5AmountTotal.setAttribute('placeholder', '10');
      po5AmountTotal.setAttribute('value', 10 * donateCount);
      po5AmountTotal.value = 10 * donateCount;
      currencySymbol.textContent = '$';
      break;
    default:
      defaultValue = 10;
      po5AmountTotal.setAttribute('placeholder', '10');
      po5AmountTotal.setAttribute('value', 10 * donateCount);
      po5AmountTotal.value = 10 * donateCount;
  }
});

po5DonateButton.addEventListener('click', () => {
  if (!!po5AmountTotal.value) {
    if (po5SelectedCurrency !== 'KRW') {
      amountTotal = po5AmountTotal.value * 100
    } else {
      amountTotal = po5AmountTotal.value;
    }
    document.querySelector('.po5-donate-header').setAttribute('style', 'display: none;');
    document.getElementById('po5-donate-cc-form').setAttribute('style', 'display: block;');
    document.getElementById('po5-donate-stepper').setAttribute('style', 'display: none;');
    po5DonateButton.setAttribute('style', 'display: none;');
  }
});

po5DonateExpMonth.addEventListener('change', (e) => {
  CCExpMonth = e.target.value ?? new Date.getMonth() + 1 /* Months are 0-indexed */;
});

for (let i = 0; i < 15; i++) {
  po5DonateExpYearArray.push(CCExpYear + i);
}

po5DonateExpYear.innerHTML = po5DonateExpYearArray.map((year) => {
  return `<option id=${year} value=${year}>${year}</option>`
}).join('');

po5DonateCC.addEventListener('keyup', (e) => {
  CCNumber = e.target.value;
})

po5DonateExpYear.addEventListener('change', (e) => {
  CCExpYear = e.target.value ?? new Date.getFullYear();
})

po5Form.addEventListener('submit', (e) => {
  e.preventDefault();
  if (amountTotal !== po5AmountTotal.value) {
    if (po5SelectedCurrency !== 'KRW') {
      amountTotal = po5AmountTotal.value * 100
    } else {
      amountTotal = po5AmountTotal.value;
    }
  }
  var creditCardInfo = {
    ccNum     : CCNumber,
    ccExpMon  : CCExpMonth,
    ccExpYr : CCExpYear
  }
  document.getElementById('po5-donate-overlay').setAttribute('style', 'display: block;')
  submissionHandler(po5SelectedCurrency, amountTotal, po5Duration, po5DonateEmail.value, creditCardInfo, po5DonateName.value);
});

async function submissionHandler(currency, amount, duration, email, ccInfo, name) {
  var cardData = {
    'currency': currency,
    'total': amount,
    'CCdetails': {
      'card_number': ccInfo.ccNum,
      'exp_month': ccInfo.ccExpMon,
      'exp_year': ccInfo.ccExpYr,
    },
    'duration': duration,
    'email': email,
    'name': name,
  }
  var ajaxData = {
    'cardData' : cardData,
    'action': 'send_to_stripe'
  };

  request = jQuery.ajax({
    url: ajax_handler_object.ajax_url,
    type: "post",
    data: ajaxData
  });

  request.done(function(response, textStatus, jqXHR) {
    console.log(response);
    if (response ===  `{"message":"charge successfully submitted"}` || response === `{"message":"subscription successfully submitted"}`) {
      displaySuccessMessage();
    } else {
      response = JSON.stringify(response)
      console.log('response', response);
      response = response.replace('"', '').replace('"', '');
      console.log('spliced', response);
      displayFailureMessage(response);
    }
  });

  request.fail(function(jqXHR, textStatus, errorThrown) {
    console.log('Submission failed');
    displayFailureMessage();
  });
}

displaySuccessMessage = () => {
  document.querySelector('.po5-donate-header').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-cc-form').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-stepper').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-footer').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-overlay').setAttribute('style', 'display: none;')
  document.getElementById('success-message').setAttribute('style', 'display: block;');
}

displayFailureMessage = (response) => {
  document.querySelector('.po5-donate-header').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-cc-form').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-stepper').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-footer').setAttribute('style', 'display: none;');
  document.getElementById('po5-donate-overlay').setAttribute('style', 'display: none;');
  document.getElementById('failure-message').setAttribute('style', 'display: block;');
  document.getElementById('failure-response').textContent = response;  
}

backToCardForm = () => {
  document.getElementById('po5-donate-footer').setAttribute('style', 'display: block;');
  document.getElementById('po5-donate-cc-form').setAttribute('style', 'display: block;');
  document.getElementById('failure-message').setAttribute('style', 'display: none;');
}

document.getElementById('back-button').addEventListener('click', (e) => {
  e.preventDefault();
  backToCardForm();
});
