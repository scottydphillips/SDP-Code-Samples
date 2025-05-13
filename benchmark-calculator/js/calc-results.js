async function getBenchmarkData() {
  let data = await fetch(/* JSON DATA */);
  let res = await data.json();
  processData(res);
}

getBenchmarkData()

// Half the results come through Marketo, the other half doesn't
const results = JSON.parse(localStorage.getItem('results')); // Not Marketo
const formResults = JSON.parse(localStorage.getItem('formResults')); // Marketo

// Cleaning form results for usage
results.givingRate = parseFloat(results.givingRate);
results.volunteerRate = parseFloat(results.volunteerRate);
let resultsIndustry = results.industry;

// Setting up DOM manipulation based on results
const givingResults = document.getElementById('giving-results');
const givingResultsFooter = document.getElementById('giving-results-footer');
const volunteeringResults = document.getElementById('volunteering-results');
const volunteeringResultsFooter = document.getElementById('volunteering-results-footer');
const givingEngagementBenchmark = document.getElementById('giving-engagement-benchmark');
const volunteeringEngagementBenchmark = document.getElementById('volunteering-engagement-benchmark');

// Top Inserts
const belowGivingMedianInsert = `
<p>Your organization falls below the ${resultsIndustry} industry average for giving participation. There are many resources that CLIENT provides to help you improve your participation! We’ve rounded up a few that can give your volunteering strategy a boost: </p>
<ul class='tip-list'>
  <li class='tips'>Check out our <a href='CLIENT URL'>online Employee Giving Guide</a> - packed with ideas to help you boost engagement in giving through special campaigns, voting, fundraising and more!</li>
  <li class='tips'>Get the word out about your current giving programs! <a href='CLIENT URL'>Our Toolkit</a> can help.</li>
  <li class='tips'>Rally your employees around a common cause with help from our <a href='CLIENT URL'>campaign planning checklist.</a></li>
</ul>
`;

const aboveGivingMedianInsert = `
<p>Congratulations on a job well done! You fall above the ${resultsIndustry} industry average for giving engagement. Did you know that CLIENT clients receive the benefit of benchmarking numerous KPIs against their peers, including average employee donation, company match, volunteer hours per employee, and more? Our experts can partner with you to take your impact even further.</p>
<a href='/* CLIENT URL */'>Take a deeper look.</a>
`;

const belowVolunteeringInsert = `
<p>Your organization falls below the ${resultsIndustry} industry average for volunteering engagement. There are many resources that CLIENT provides to help you improve your participation! We’ve rounded up a few that can give your volunteering strategy a boost: </p>
<ul class='tip-list'>
  <li class='tips'><a href='CLIENT URL'>Online Employee Volunteer Program Guide</a> - dive into ideas for boosting engagement, launching incentives, and evaluating your programs!</li>
  <li class='tips'>Tap into skills-based volunteering to get employees involved! <a href='CLIENT URL'>Watch an on-demand webinar!</a></li>
  <li class='tips'><a href='CLIENT URL'>Read a case study</a> about how one CLIENT client experienced a 33% increase in volunteer hours!</li>
</ul>
`;

const aboveVolunteeringInsert = `
<p>Congratulations on a job well done!! You fall above the ${resultsIndustry} industry average for volunteering participation. Did you know that CLIENT clients receive the benefit of benchmarking numerous KPIs against their peers, including average employee donation, company match, and volunteer hours per employee? Our experts can partner with you to take your impact even further.</p>
<a href='CLIENT URL>Take a deeper look.</a>
`;

// Utility Functions
displayAboveGivingRate = () => {
  givingResults.textContent = 'Above the YourCause average for giving engagement.';
  givingResults.classList.add('above-benchmark');
  givingResultsFooter.innerHTML = aboveGivingMedianInsert;
}

displayEqualGivingRate = () => {
  givingResults.textContent = 'Equal to the YourCause average for giving engagement.';
  givingResults.classList.add('below-benchmark');
}

displayBelowGivingRate = () => {
  givingResults.textContent = 'Below the YourCause average for giving engagement';
  givingResults.classList.add('below-benchmark');
  givingResultsFooter.innerHTML = belowGivingMedianInsert;
}

displayAboveVolunteerRate = () => {
  volunteeringResults.textContent = 'Above the YourCause average for volunteering engagement';
  volunteeringResults.classList.add('above-benchmark');
  volunteeringResultsFooter.innerHTML = aboveVolunteeringInsert;
}

displayEqualVolunteerRate = () => {
  volunteeringResults.textContent = 'Equal to the YourCause average for volunteering engagement.';
  volunteeringResults.classList.add('below-benchmark');
}

displayBelowVolunteerRate = () => {
  volunteeringResults.textContent = 'Below the YourCause average for volunteer engagement';
  volunteeringResults.classList.add('below-benchmark');
  volunteeringResultsFooter.innerHTML = belowVolunteeringInsert;
}
volunteerRateProcessing = (results, benchmark) => {
  if (results > benchmark) {
    displayAboveVolunteerRate();
    volunteeringEngagementBenchmark.textContent = benchmark;
  } else if (results === benchmark) {
    displayEqualVolunteerRate();
    volunteeringEngagementBenchmark.textContent = benchmark;
  } else {
    displayBelowVolunteerRate();
    volunteeringEngagementBenchmark.textContent = benchmark;
  }
}

// Setting the text of the results
document.getElementById('head-name-span').textContent = formResults.FirstName + " " + formResults.LastName;
document.getElementById('company-name').textContent = formResults.Company;
document.getElementById('industry-insert').textContent = resultsIndustry;
document.getElementById('size-insert').textContent = results.companySize;
document.getElementById('giving-engagement-insert').textContent = results.givingRate;
document.getElementById('volunteering-engagement-insert').textContent = results.volunteerRate;

// Here's the logic
function processData(data) {
  for (let input of data) {
    // Cleaning strings from JSON into floats
    if (input.Giving || input.Volunteering) {
      input.Giving = parseFloat(input.Giving.replace('%', ''));
      input.Volunteering = parseFloat(input.Volunteering.replace('%', ''));
    }  
    const benchmarkSize = input.Size;
    const benchmarkIndustry = input.Industry;
    const benchmarkGiving = input.Giving;
    const benchmarkVolunteering = input.Volunteering;
    // Comparing benchmark data with results
    if (results.companySize === benchmarkSize) {
      if (results.industry === benchmarkIndustry) {
        // Giving Rate
        if (results.givingRate > input.Giving) {
          displayAboveGivingRate();
          givingEngagementBenchmark.textContent = benchmarkGiving;
          volunteerRateProcessing(results.volunteerRate, benchmarkVolunteering);
          break;
        } else if (results.givingRate === benchmarkGiving) {
          displayEqualGivingRate();
          givingEngagementBenchmark.textContent = benchmarkGiving;
          volunteerRateProcessing(results.volunteerRate, benchmarkVolunteering);
          break;
        } else {
          displayBelowGivingRate();
          givingEngagementBenchmark.textContent = benchmarkGiving;
          volunteerRateProcessing(results.volunteerRate, benchmarkVolunteering);
          break;
        }
      }
    }
  }
  // Removes data from localStorage. We don't need it anymore
  localStorage.removeItem('results');
  localStorage.removeItem('formResults');
}