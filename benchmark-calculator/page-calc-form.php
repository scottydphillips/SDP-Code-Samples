<?php
/* 
Template Name: Calculator Form
*/
get_header(); ?>
<form id='calc-form' name='calc-form' class='container-fluid' action='./page-calc-results.php'>
  <div id='company-size-question-div' class='container'>
    <div class='row'>
      <h5 class='col-12' id='company-size-text'>Choose your company enterprise size:</h5>
      <div id='0-1k-div' class='size-div col-md-4 col-sm-6'>
        <button id='0-1k-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-0-1k' type='hidden' form='calc-form' value='0-1000'>
          <label for='company-size-0-1k'><strong>0-1000</strong> employees</label>
        </button>
      </div>
      <div id='1k-5k-div' class='size-div col-md-4 col-sm-6'>
        <button id='1k-5k-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-1k-5k' type='hidden' form='calc-form' value='1001-5000'>
          <label for='company-size-1k-5k'><strong>1001-5000</strong> employees</label>
        </button>
      </div>
      <div id='5k-10k-div' class='size-div col-md-4 col-sm-6'>
        <button id='5k-10k-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-5k-10k' type='hidden' form='calc-form' value='5001-10,000'>
          <label for='company-size-5k-10k'><strong>5001-10,000</strong> employees</label>
        </button>
      </div>
      <div id='10k-50k-div' class='size-div col-md-4 col-sm-6'>
      <button id='10k-50k-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-10k-50k' type='hidden' form='calc-form' value='10,001-50,000'>
          <label id='company-size-10k-50k'><strong>10,001-50,000</strong> employees</label>
        </button>
      </div>
      <div id='50k-100k-div' class='size-div col-md-4 col-sm-6'>
        <button id='50k-100k-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-50k-100k' type='hidden' form='calc-form' value='50,001-100,000'>
          <label for='company-size-50k-100k'><strong>50,001-100,000</strong> employees</label>
        </button>
      </div>
      <div id='100k-plus-div' class='size-div col-md-4 col-sm-6'>
        <button id='100k-plus-button' type='button' class='size-button'>
          <input name='company-size-input' class='company-size-input' id='company-size-100k-plus' type='hidden' form='form' value='100,000+'>
          <label for='company-size-100k-plus'><strong>100,000+</strong> employes</label>
        </button>
      </div>
    </div>
    <div class='break'></div>
    <div class='row'>
      <div id='continue-1-div' class='button-div'>
        <button id='continue-1-button' type='button' class='continue-button' disabled>Continue</button>
      </div>
      <div id='back-1-div' class='button-div'>
        <a href='/industry-report-benchmarking-tool/'>
          <button id='back-1-button' type='button' class='back-button'><span class='arrow'>&larr;</span> Back</button>
        </a>
      </div>
    </div>
  </div>
  <div id='company-industry-question-div' class='container' style='display: none;'>
    <div class='row'>
      <h5 class='col-12' id='company-industry-text'>Choose your industry:</h5>
      <div id='business-services-div' class='industry-div col-md-3 col-sm-6'>
        <button id='business-services-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-business-services' value='Business Services' form='calc-form'>
          <label for='industry-business-services'>Business Services</label>
        </button>
      </div>
      <div id='consumer-health-services-div' class='industry-div col-md-3 col-sm-6'>
        <button id='consumer-health-services-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-consumer-health-services' value='Consumer & Health Services' form='calc-form'>
          <label for='industry-consumer-health-services'>Consumer & Health Services</label>
        </button>
      </div>
      <div id='finance-insurance-real-estate-div' class='industry-div col-md-3 col-sm-6'>
        <button id='finance-insurance-real-estate-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-finance-insurance-real-estate' value='Finance, Insurance & Real Estate' form='calc-form'>
          <label for='industry-finance-insurance-real-estate'>Finance, Insurance & Real Estate</label>
        </button>
      </div>
      <div id='manufacturing-div' class='industry-div col-md-3 col-sm-6'>
        <button id='manufacturing-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-manufacturing' value='Manufacturing' form='calc-form'>
          <label for='industry-manufacturing'>Manufacturing</label>
        </button>
      </div>
      <div id='mining-construction-div' class='industry-div col-md-3 col-sm-6'>
        <button id='mining-construction-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-mining-construction' value='Mining & Construction' form='calc-form'>
          <label for='industry-mining-construction'>Mining & Construction</label>
        </button>
      </div>
      <div id='np-div' class='industry-div col-md-3 col-sm-6'>
        <button id='np-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-nonprofit' value='Nonprofit' form='calc-form'>
          <label for='industry-nonprofit'>Nonprofit</label>
        </button>
      </div>
      <div id='retail-wholesale-div' class='industry-div col-md-3 col-sm-6'>
        <button id='retail-wholesale-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-retail-wholesale' value='Retail & Wholesale Trade' form='calc-form'>
          <label for='industry-retail-wholesale'>Retail & Wholesale Trade</label>
        </button>
      </div>
      <div id='transportation-comms-utilities-div' class='industry-div col-md-3 col-sm-6'>
        <button id='transporation-button' type='button' class='industry-button'>
          <input type='hidden' class='industry-options' id='industry-transportation-comms-utilities' value='Transportation, Communications & Utilities' form='calc-form'>
          <label for='industry-transportation-comms-utilities'>Transportation, Communications & Utilities</label>
        </button>
      </div>
    </div>
    <div class='break'></div>
    <div class='row'>
      <div id='continue-2-div' class='button-div'>
        <button id='continue-2-button' type='button' class='continue-button' disabled>Continue</button>
      </div>
      <div id='back-2-div' class='button-div'>
        <a href='/industry-report-benchmarking-tool/calculator/'>
          <button id='back-2-button' type='button' class='back-button'><span class='arrow'>&larr;</span> Back</button>    
        </a>
      </div>
    </div>
  </div>
  <div id='company-engagement-rates-div' class='container' style='display: none;'>
    <div class='row'>
      <h5 id='company-engagement-text'>Input your company's giving and/or volunteering engagement rate:</h5>
      <div class='col-md-1'></div>
      <div id='giving-rate-div' class='col-md-4'>
        <h5 id='giving-rate-text'>Giving engagement rate:</h5>
        <label for='company-giving-rate'>Giving engagement rate:</label>
        <div id='give-rate-text-input-div'>
          <input name='company-giving-rate' id='company-giving-rate-text' type='text' min='0' max='100' pattern='^[1-9]\d*(\.\d+)?$' form='calc-form'><span> %</span>
        </div>
        <div id='give-rate-range-input-div'>
          <input name='company-giving-rate' id='company-giving-rate-range' type='range' min='0' max='100' list='giving-rate' form='calc-form'>
          <datalist id='giving-rate'>
            <option value='0'>0</option>
            <option value='100'>100</option>
          </datalist>
        </div>
      </div>
      <div class='col-md-2'></div>
      <div id='volunteering-rate-div' class='col-md-4'>
        <h5 id='volunteering-rate-text'>Volunteering engagement rate:</h5>
        <label for='company-volunteering-rate'>Volunteering engagement rate:</label>
        <div id='vol-rate-text-input-div'>
          <input name='company-volunteering-rate' id='company-volunteering-rate-text' type='text' min='0' max='100' pattern='^[1-9]\d*(\.\d+)?$' form='calc-form'><span> %</span>
        </div>
        <div id='vol-rate-range-input-div'>
          <input name='company-volunteering-rate' id='company-volunteering-rate-range' type='range' min='0' max='100' list='vol-rate' form='calc-form'>
          <datalist id='vol-rate'>
            <option value='0'>0</option>
            <option value='100'>100</option>
          </datalist>
        </div>
      </div>
      <div class='col-md-1'></div>
    </div>
    <div class='row'>
      <div id='continue-3-div' class='button-div col-12'>
        <button id='continue-3-button' type='button' class='continue-button' disabled>Continue</button>
      </div>
      <div id='back-3-div' class='button-div col-12'>
        <a href='/industry-report-benchmarking-tool/calculator/'>
          <button id='back-3-button' type='button' class='back-button'><span class='arrow'>&larr;</span> Back</button>      
        </a>
      </div>
    </div>
  </div>
  <div id='contact-info-div' class='container' style='display: none;'>
    <div class='row'>
      <div id='aligner-div' class='col-md-6'>
        <div class='row'>
          <h4>Nice Work, you're all set!</h4>
          <h5>Fill out form below to access your custom-tailored results.</h5>
          <script src="//app-sj07.marketo.com/js/forms2/js/forms2.js"></script>
            <div id="formPlaceholder"></div>
            <form id="mktoForm"></form>
            <script>
              // STRIPPED OUT MARKETO FORM SCRIPT DETAILS
            </script>
        </div>
        <div class='row'>
          <button id='cancel-button' type='button'>
            <a href='/industry-report-benchmarking-tool'>Cancel</a>
          </button>
        </div>
        <div id='home-link-row' class='row'>
          <a id='home-link' href='/'>Return to website &rarr;</a>
        </div>
      </div>
      <div id='photo-div' class='col-md-6'>
        <img src='<?php if (get_field('closing_image')) echo get_field('closing_image')['url']; ?>' alt='<?php echo get_field('closing_image')['alt']; ?>'>
      </div>
    </div>
  </div>
</form>
<?php get_footer(); ?>