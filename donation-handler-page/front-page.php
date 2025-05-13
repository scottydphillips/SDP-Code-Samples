<section id="hero" style="background-image: url('<?php the_field('hero_background_image'); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 order-md-2">
                <div class="hero-content">
                    <?php the_field('hero_content'); ?>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div id="donate-frame">
                    <section data-donation-widget data-submit-url="/widget" data-counter data-count id='donate' class="donate">
                        <div class="donate-header">
                            <h3 class="donate-title"><?php the_field('widget_title'); ?></h3>
                        </div>
                        <section id="donate-stepper" class="donate-stepper">
                            <button id="donate-step-down" class="donate-step-down">
                                <svg baseProfile="tiny" xmlns="http://w3.org/2000/svg" width="19.011" height="19.549" viewBox="0 0 19.011 19.549">
                                    <path fill d="M2.465 8.004h14.082v3.58H2.465z"></path>
                                </svg>
                            </button>
                            <div class="donate-count">
                            <input id="donate-count" type="number" name="donate-count" value="1" disabled>
                            <label class="donate-count-label" for="donate-count"></label>
                            </div>
                            <button id="donate-step-up" class="donate-step-up">
                                <svg baseProfile="tiny" xlmns="http://www.w3.org/2000/svg" width="19.011" height="19.549" viewBox="0 0 19.011 19.549">
                                    <path fill d="M19.01 11.583h-7.735v7.966H7.697v-7.967H0v-3.58h7.697V0h3.578v8.004h7.736"></path>
                                </svg>
                            </button>
                        </section>
                        <section id="donate-footer" class="donate-footer">
                            <div class="donate-duration">
                            <div class="donate-once">
                                <input type="radio" id="duration-once" name="duration" value="ONCE">
                                <label class="donate-duration-once checked" for="duration-once">Give Once</label>
                            </div>
                            <div class="donate-monthly">
                                <input type="radio" id="duration-monthly" name="duration" value="MONTHLY">
                                <label class="donate-duration-monthly" for="duration-monthly">Monthly</label>
                            </div>
                            </div>
                            <div class="donate-amount">
                            <div class="donate-amount-heading">Total Donation</div>
                            <div class="donate-amount-total">
                                <span id="currency-symbol">$</span>
                                <input type="text" id="amount-total" name="amount" placeholder="$10" value="10" disabled><small id="currency-type">USD</small>
                                <label class="amount-total-label" for="amount-total"></label>
                            </div>
                            <div class="donate-change-currency-container">
                                <select id="donate-change-currency" class="donate-change-currency">
                                <option id="AUD" value="AUD">Austrailian Dollar</option>
                                <option id="CAD" value="CAD">Canadian Dollar</option>
                                <option id="CNY" value="CNY">Chinese Yuan</option>
                                <option id="EUR" value="EUR">Euro</option>
                                <option id="MYR" value="MYR">Malaysian Ringgit</option>
                                <option id="MXN" value="MXN">Mexican Peso</option>
                                <option id="RUB" value="RUB">Russian Ruble</option>
                                <option id="KRW" value="KRW">South Korean Won</option>
                                <option id="USD" value="USD" selected="selected">US Dollar</option>
                                </select>
                            </div>
                            <button id="donate-donate" class="donate-donate">
                                <label id="donate-label" for="donate-donate">
                                Donate Once
                                </label>
                            </button>
                            </div>
                        </section>
                        <form id="donate-cc-form" action="../index.php" method="post" class="donate-form" style="display: none;">
                            <div class="donate-card">
                                <div class="card-inputs">
                                    <input id='donate-name' type='text' pattern="[a-zA-Z\s]+" name='donate-name' placeholder="Name" required>
                                    <input id="donate-cc" type="text" pattern="\d*" maxlength="16" name="donate-cc" placeholder="Card Number" required>
                                    <label class="donate-cc-label" for="donate-cc"></label>
                                    <select id="donate-card-exp-month" class="donate-card-exp-month">
                                        <option id="Jan" value="01" selected="selected">January</option>
                                        <option id="Feb" value="02">February</option>
                                        <option id="Mar" value="03">March</option>
                                        <option id="Apr" value="04">April</option>
                                        <option id="May" value="05">May</option>
                                        <option id="Jun" value="06">June</option>
                                        <option id="Jul" value="07">July</option>
                                        <option id="Aug" value="08">August</option>
                                        <option id="Sep" value="09">September</option>
                                        <option id="Oct" value="10">October</option>
                                        <option id="Nov" value="11">November</option>
                                        <option id="Dec" value="12">December</option>
                                    </select>
                                    <select id="donate-card-exp-year" class="donate-card-exp-year">
                                    </select>
                                    <label class="donate-card-exp-label" for="donate-card-exp"></label>
                                </div>
                                <div class="email-input">
                                    <input id="donate-email" type="email" name="donate-email" placeholder="Email address" required>
                                    <label class="donate-email-label" for="donate-email"></label>
                                </div>
                                <div class="org-input">
                                    <input id="donate-org" type="text" name="donate-org" placeholder="Optional: Organization or Upline">
                                    <label class="donate-org-label" for="donate-org"></label>
                                </div>
                            </div>
                            <div class="donate-button">
                                <button form='donate-cc-form' type='submit' formaction="../index.php" id="donate-donate-final" class="donate-donate-final">Donate!</button>
                            </div>
                        </form>
                        <div id='donate-overlay' class="donate__overlay" style='display: none;'>
                            <div class="spinner">
                                <div class="ldr">
                                    <div class="ldr-blk first"></div>
                                    <div class="ldr-blk second"></div>
                                    <div class="ldr-blk fourth"></div>
                                    <div class="ldr-blk third"></div>
                                </div>
                            </div>
                        </div>
                        <div id="success-message" class="donate__thank-you" style='display: none;'>
                            <h2>Thank you for your donation!</h2>
                            <p>Please look for a donation email receipt from OPPORTUNITY INTERNATIONAL INC. (Amway Power of 5 Campaign).</p>
                        </div>
                        <div id="failure-message" class='donate__thank-you' style='display: none;'>
                            <h4>There was an error with your donation.</h4>
                            <p id='failure-response'></p>
                            <button type='button' id='back-button'>Go Back</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if( have_rows('content_rows') ):
    $component_i = 1;
    while ( have_rows('content_rows') ) : the_row(); ?>    
        <section class="content-row">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 <?php if($component_i%2==0) echo 'order-md-2'; ?>">
                        <img src="<?php echo get_sub_field('image')['sizes']['large']; ?>" alt="<?php echo get_sub_field('image')['alt']; ?>"/>
                    </div>
                    <div class="col-md-6">
                        <?php the_sub_field('content'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php $component_i++; ?>
    <?php endwhile; 
endif; ?>
<section id="fact-columns">
    <div class="container">
        <div class="row">
            <?php foreach(get_field('fact_columns') as $fact_column) { ?>
                <div class="col-md-4">
                    <div class="fact-column">
                        <div class="column-header" style="background-image:url('<?php echo $fact_column['header_bg']; ?>');">
                            <h3><?php echo $fact_column['number']; ?></h3>
                            <sub><?php echo $fact_column['subheader']; ?></sub>
                        </div>
                        <p><?php echo $fact_column['copy']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>