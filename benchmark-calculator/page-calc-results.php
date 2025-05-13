<?php
/*
Template Name: Calculator Results
*/
get_header(); ?>
<div id='calc-results-container' class='container-fluid'>
  <div class='row'>
    <div class='container'>
      <div id='head-text-div' class='row'>
        <h1 id='head-text' class='col-12'><span id='head-name-span'></span>, it looks like based on your results you fall...</h1>
      </div><!--head-text-div-->
      <section id='results-section' class='container'>
        <div class='row'>
          <div id='giving-results-div' class='col-md-6'>
            <h2 id='giving-results'></h2>
            <div id='giving-results-footer'></div>
          </div><!--giving-results-->
          <div id='volunteering-results-div' class='col-md-6'>
            <h2 id='volunteering-results'></h2>
            <div id='volunteering-results-footer'></div>
          </div><!--volunteering-results-->
        </div><!--row-->
      </section><!--results-section-->
      <section id='results-table-section' class='container'>
        <div class='row'>
          <h3 id='results-table-header'>Take a look at how your organization, <span id='company-name'></span>, stacks up in your industry:</h3>
          <div id='table-container' class='table-responsive'>
            <table id='results-table' class='table'>
              <thead>
                <tr id='table-headers' class='table-headers'>
                  <th scope='col'></th>
                  <th scope='col'><p>Your Organization</p></th>
                  <th scope='col'>
                    <p id='table-industry'><span id='industry-insert'></span> Industry</p>
                    <p id='table-size'><span id='size-insert'></span> Employees</p>
                  </th>
                </tr><!--table-headers-->
              </thead>
              <tbody>
                <tr id='giving-row'>
                  <th scope='row'>Giving Engagement Rate</th>
                  <td data-label="Your Giving Rate"><span id='giving-engagement-insert'></span>%</td>
                  <td data-label='Giving Benchmark'><span id='giving-engagement-benchmark'></span>%</td>
                </tr><!--giving-row-->
                <tr id='volunteering-row'>
                  <th scope='row'>Volunteering Engagement Rate</th>
                  <td data-label="Your Volunteering Rate"><span id='volunteering-engagement-insert'></span>%</td>
                  <td data-label='Volunteering Benchmark'><span id='volunteering-engagement-benchmark'></span>%</td>
                </tr><!--volunteering-row-->
              </tbody>
            </table><!--results-table-->
          </div><!--table-container-->
        </div><!--row-->
      </section><!--results-table-section-->
    </div><!--container-->
  </div><!--row-->
</div><!--calc-results-container-->

<?php get_footer();