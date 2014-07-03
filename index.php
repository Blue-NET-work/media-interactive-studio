<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */


// Get header
get_header(); ?>



<?php
    $args = array(
        'post_type' => 'parallax',
        'order'     => 'ASC',
        'orderby'   => 'menu_order'
    );
    $parallax = new WP_Query($args);
        while($parallax->have_posts()) : $parallax->the_post();

        	$theme = get_post_custom_values('theme');

        	if(file_exists(TEMPLATEPATH ."/templates/{$theme[0]}.php")){
				include_once(TEMPLATEPATH . "/templates/{$theme[0]}.php");
        	}

            else{
	            $parallaxImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	            $breakUrl = str_replace(home_url(), '', $parallaxImage[0]); ?>

	            <section class="parallax" id="section_<?php echo the_ID(); ?>" style="background: url('../<?php echo $breakUrl; ?>') fixed;"></section>

	            <div class="container">
	                <h2><?php the_title(); ?></h2>
	                <div class="page-content">
	                    <?php the_content(); ?>
	                </div>
	            </div>
        <?php

            }
        endwhile;
    wp_reset_postdata();
?>




<!-- BEGIN FOOTER -->
<footer id="sectionFooter">

	<!-- BEGIN FOOTER -->
	<div class="container">
		<section id="footer">
			<div class="row" id="contact">
				<div class="col-md-8 col-sm-7 space-mobile">
					<form role="form" style="width:90%;" class="m-t-50">
						<div class="row">
							<div class="col-md-6">
							<!-- form block -->
								<div class="input-group m-b-20">
								  <span class="input-group-addon"><i class="fa fa-users"></i></span>
								  <input type="text" class="form-control" placeholder="NAME/SURNAME">
								</div>

								<div class="input-group m-b-20">
								  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
								  <input type="text" class="form-control" placeholder="PHONE NUMBER">
								</div>
							<!-- form block -->
							</div>
							<div class="col-md-6">
							<!-- form block -->
								<div class="input-group m-b-20">
								  <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
								  <input type="text" class="form-control" placeholder="SUBJECT">
								</div>

								<div class="input-group m-b-20">
								  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								  <input type="text" class="form-control" placeholder="E-MAIL ADDRESS">
								</div>
							<!-- form block -->
							</div>
						</div>
						<textarea placeholder="MESSAGE" class="form-control m-b-20" rows="8"></textarea>

						<button type="submit" class="btn btn-default"><i class="fa fa-2x fa-envelope"></i></button>
					</form>
				</div>
				<div class="col-md-4 col-sm-5 contactData">
					<h3 class="titleTag m-t-0">Contact<br>Details</h3>
					<p class="m-b-40">Have any questions?  Looking for help?  Contact us</p>
					<p class="contactlocation">washington, St 475 / 745</p>
					<p class="contactphone">+12 3456 78 910,   +12 3456 78 910</p>
					<p class="contactmail">office@mediatheme.pl</p>
					<hr>
				</div>
			</div>
		</section>
	</div>
	<!-- END FOOTER -->


	<!-- BEGIN MAPS -->
	<section id="maps">
		<h6 class="hidden">Location</h6>
		<div id="map"></div>
	</section>
	<!-- END MAPS -->


<?php
// Get site footer
get_footer(); ?>