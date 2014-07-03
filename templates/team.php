<?php
/**
 * Template Name: Section Team
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */

?>


<!-- BEGIN TEAM -->
<section id="team">
	<div class="lady"></div>
	<div class="confetti"></div>
	<div class="confettiOne"></div>

	<div class="container">
	<!-- about desc -->
		<div class="about">
			<div class="row">
				<div class="col-md-4"><h3><?php the_title(); ?></h3></div>
				<div class="col-md-8"><?php the_content(); ?></div>
			</div>
		</div>
	<!-- person car.-->
		<div class="persons">

			<div class="bx-persons">
			  <div class="person">
			  	<div class="img">
			  		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionTeam/person1.png" alt="">
					<span></span>
			  	</div>
			  	<div class="info">
					<h4>ANNA NOWAK</h4>
					<span>WEBDESIGNER</span>
					<div class="social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div>
				</div>
			  </div>

			  <div class="person">
			  	<div class="img">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionTeam/person2.png" alt="">
					<span></span>
			  	</div>
				<div class="info">
					<h4>Jan NOWAK</h4>
					<span>WEBDEVENLOPMEN</span>
					<div class="social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div>
				</div>
			  </div>

			  <div class="person">
			  	<div class="img">
			  		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionTeam/person3.png" alt="">
					<span></span>
			  	</div>
			  	<div class="info">
					<h4>Marek NOWAK</h4>
					<span>SEO</span>
					<div class="social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div>
				</div>
			  </div>

			</div>

		</div>
	</div>

</section>
<!-- END TEAM -->