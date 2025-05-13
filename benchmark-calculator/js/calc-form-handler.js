async function getBenchmarkData() {
  let data = await fetch(/* JSON FORM */);
  let res = await data.json();
  processData(res);
}

getBenchmarkData();

const companySizeButtons = document.querySelectorAll('.size-button');
const companyIndustryButtons = document.querySelectorAll('.industry-button');
const companyGivingRateText = document.getElementById('company-giving-rate-text');
const companyVolunteerRateText = document.getElementById('company-volunteering-rate-text');
const continue1Button = document.getElementById('continue-1-button');
const continue2Button = document.getElementById('continue-2-button');
const continue3Button = document.getElementById('continue-3-button');
const back2Button = document.getElementById('back-2-button');
const back3Button = document.getElementById('back-3-button');
const firstName = document.getElementById('FirstName');
const lastName = document.getElementById('LastName');
const companySizeQuestionDiv = document.getElementById('company-size-question-div');
const companyIndustryQuestionDiv = document.getElementById('company-industry-question-div');
const companyEngagementRatesDiv = document.getElementById('company-engagement-rates-div');
const contactInfoDiv = document.getElementById('contact-info-div');
let companySize = '';
let industry = '';
let givingBenchmark = '';
let volunteerBenchmark = '';

continue1Button.addEventListener('click', () => {
  companySizeQuestionDiv.setAttribute('style', 'display: none;');
  companyIndustryQuestionDiv.setAttribute('style', 'display: flex;');
  companyEngagementRatesDiv.setAttribute('style', 'display: none;');
  contactInfoDiv.setAttribute('style', 'display: none;');
});

continue2Button.addEventListener('click', () => {
  companySizeQuestionDiv.setAttribute('style', 'display: none;');
  companyIndustryQuestionDiv.setAttribute('style', 'display: none;');
  companyEngagementRatesDiv.setAttribute('style', 'display: block;');
  contactInfoDiv.setAttribute('style', 'display: none;');
});

continue3Button.addEventListener('click', () => {
  companySizeQuestionDiv.setAttribute('style', 'display: none');
  companyIndustryQuestionDiv.setAttribute('style', 'display: none');
  companyEngagementRatesDiv.setAttribute('style', 'display: none');
  contactInfoDiv.setAttribute('style', 'display: block;');
  document.querySelector("input[name='Notes__c']").value = `
    companySize: ${companySize}, 
    industry: ${industry}, 
    givingRate: ${companyGivingRateText.value},
    givingBenchmark: ${givingBenchmark},
    volunteerRate: ${companyVolunteerRateText.value},
    volunteerBenchmark: ${volunteerBenchmark}
  `;
  localStorage.setItem('results', JSON.stringify({
    companySize: companySize,
    industry: industry,
    givingRate: companyGivingRateText.value,
    volunteerRate: companyVolunteerRateText.value,
  }));
});

companySizeButtons.forEach((sizeButton) => {
  sizeButton.classList.remove('active');
  sizeButton.addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelectorAll('.active').forEach((active) => {
      active.classList.remove('active');
    });
    if (!sizeButton.firstElementChild.checked) {
      companySize = sizeButton.firstElementChild.value;
      sizeButton.classList.add('active');
      continue1Button.removeAttribute('disabled');
      continue1Button.classList.add('enabled');
    } else {
      continue1Button.setAttribute('disabled');
    }
  });
});

companyIndustryButtons.forEach((industryButton) => {
  industryButton.addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelectorAll('.active').forEach((active) => {
      active.classList.remove('active');
    });
    if (!industryButton.firstElementChild.checked) {
      industryButton.setAttribute('checked', 'checked');
      industryButton.classList.add('active');
      industry = industryButton.firstElementChild.value;
      continue2Button.removeAttribute('disabled');
      continue2Button.classList.add('enabled');
    } else {
      industryButton.removeAttribute('checked', 'checked');
      industryButton.classList.remove('active');
      continue2Button.setAttribute('disabled');
    }
  });
});

enableContinue3Button = () => {
  continue3Button.removeAttribute('disabled');
  continue3Button.classList.add('enabled');
}


jQuery('#company-giving-rate-range').on('input', () => {
  jQuery('#company-giving-rate-text').val(jQuery('#company-giving-rate-range').val());
  if (companyVolunteerRateText.value) {
    enableContinue3Button();
  }
});

jQuery('#company-giving-rate-text').on('input', () => {
  jQuery('#company-giving-rate-range').val(jQuery('#company-giving-rate-text').val());
  enableContinue3Button();
  if (companyVolunteerRateText.value) {
    enableContinue3Button();
  }
});

jQuery('#company-volunteering-rate-range').on('input', () => {
  jQuery('#company-volunteering-rate-text').val(jQuery('#company-volunteering-rate-range').val());
  if (companyGivingRateText.value) {
    enableContinue3Button();
  }
});

jQuery('#company-volunteering-rate-text').on('input', () => {
  jQuery('#company-volunteering-rate-range').val(jQuery('#company-volunteering-rate-text').val());
  if (companyGivingRateText.value) {
    enableContinue3Button();
  }
});

function processData(data) {
  // Giving Rate
  companyGivingRateText.addEventListener('change', (e) => {
    for (let input of data) {
      // Cleaning benchmark data
      if (input.Giving) {
        input.Giving = parseFloat(input.Giving.replace('%', ''));
      }  
      const benchmarkSize = input.Size; 
      const benchmarkIndustry = input.Industry;
      const benchmarkGiving = input.Giving;
  
      // Comparing benchmark data with results
      if (companySize === benchmarkSize) {
        if (industry === benchmarkIndustry) {
          // Giving Rate
          if (e.target.value > benchmarkGiving) {
            givingBenchmark = 'above';
            break;
          } else if (e.target.value === benchmarkGiving) {
            givingBenchmark = 'equal to';
          } else {
            givingBenchmark = 'below';
          }
        }
      }
    }
  });
  // Volunteer Rate
  companyVolunteerRateText.addEventListener('change', (e) => {
    for (let input of data) {
      // Cleaning benchmark data
      if (input.Volunteering) {
        input.Volunteering = parseFloat(input.Volunteering.replace('%', '').replace(/(?:\\[r]|[\r]+)+/g,''));
      }  
      const benchmarkSize = input.Size;
      const benchmarkIndustry = input.Industry;
      const benchmarkVolunteering = input.Volunteering;
      
      // Comparing benchmark data with results
      if (companySize === benchmarkSize) {
        if (industry === benchmarkIndustry) {
          // Volunteering Rate
          if (e.target.value > benchmarkVolunteering) {
            volunteerBenchmark = 'above';
            break;
          } else if (e.target.value === benchmarkVolunteering) {
            volunteerBenchmark = 'equal to';
            break;
          } else {
            volunteerBenchmark = 'below';
            break;
          }
        }
      }
    }
  });
}
