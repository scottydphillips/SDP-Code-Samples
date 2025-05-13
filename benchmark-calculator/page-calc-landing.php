<?php
/*
Template Name: Calculator Landing Page
*/
get_header(); ?>

<div id='calc-landing-page-container'>
  <section id='hero-container' style='background-image: url(<?php if (get_field('hero_image')) echo get_field('hero_image')['url']; ?>)' class='container'>
    <div id='hero-row' class='row'>    
      <div id='hero-text' class='col-md-6'>
        <h1><?php if (get_field('hero_text')) echo get_field('hero_text'); ?></h1>
      </div><!--hero-text-->
    </div>
  </section><!--hero-container-->
  <main id='copy-container' class='container'>
    <div id='copy-row' class='row'>
      <div id='copy-left-side' class='col-md-7'>
        <?php if (get_field('copy_left_side_top')) echo get_field('copy_left_side_top'); ?>
        <a href='/industry-report-benchmarking-tool/calculator'><button id='open-form-button'>Get Started</button></a>
        <div id='copy-left-side-under'>
          <?php if (get_field('copy_left_side_under')) echo get_field('copy_left_side_under'); ?>
        </div>
      </div><!--copy-left-side-->
      <div id='copy-right-side' class='col-md-5'>
        <div id='right-side-img'>
          <img src='<?php if (get_field('copy_right_side_image')) echo get_field('copy_right_side_image')['url']; ?>' alt='<?php echo get_field('copy_right_side_image')['alt']; ?>'>
        </div>
      </div><!--copy-right-side-->
    </div>
  </main>
  <section id='infographic-container' class='container'>
    <div id='infographic-header-row' class='row'>
      <div id='infographic-header-div' class='col-12'>
        <h2 class='text-center'><?php if (get_field('infographic_header')) echo get_field('infographic_header'); ?></h2>
      </div>
    </div><!--infographic-header-row-->
    <div id='infographic-content-row' class='row'>
      <div id='infographic-left-side' class='col-md-6 col-sm-12 col-xs-12' style="background-image: url('<?php if (get_field('infographic_left_side_image')) echo get_field('infographic_left_side_image')['url']; ?>")'>
        <div id='infographic-left-side-text-div' class='row'>
          <span id='infographic-left-side-span' class='col-md-6 col-sm-12 col-xs-12'><?php if (get_field('infographic_left_side_text')); echo get_field('infographic_left_side_text'); ?></span>
        </div>
      </div><!--infographic-left-side-->
      <div id='infographic-right-side' class='col-md-6 col-sm-12 col-xs-12'>
        <div id='repeater-container' class='container-fluid'>
          <div id='repeater-row' class='row'>
            <div id='repeater-container-wrapper'>
              <?php if (have_rows('infographic_repeater')) {
                $i = 0;
                while (have_rows('infographic_repeater')) { the_row();
                  $i % 2 === 0 ? $classTackOn = 'a' : $classTackOn = 'b'; ?>
                  <div class='repeater-columns-wrapper col-md-6 col-xs-12'>
                    <div class='repeater-columns'>                
                      <img src='<?php if (get_sub_field('repeater_image')) echo get_sub_field('repeater_image')['url']; ?>' alt='<?php echo get_sub_field('repeater_image')['alt']; ?>'>
                      <?php if (get_sub_field('repeater_text')) echo get_sub_field('repeater_text'); ?>
                    </div><!--repeater-columns-->
                  </div><!--repeater-columns-wrapper-->
                <?php $i++; }
              } ?>
            </div><!--repeater-container-wrapper-->
          </div><!--repeater-row-->
        </div><!--repeater-container-->
      </div><!--infographic-right-side-->
    </div><!--infographic-content-row-->
  </section><!--infographic-container-->
</div><!--calc-landing-page-container-->
<?php get_footer();