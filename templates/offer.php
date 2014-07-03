<?php
/**
 * Template Name: Section Offer
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */

?>

<!-- BEGIN OFFER -->
<section id="offer">
	<div class="bgBall"></div>
	<div class="phone"></div>
	<div class="smallBall"></div>
	<div class="ball"></div>

	<div class="container">

		<div class="content">
			<h2><?php the_title(); ?></h2>
			<div class="offerText">
				<div class="info">
					<h3>RESPONSIVE DESIGN</h3>
					<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</p>
					<a href="#" class="more">more information</a>
				</div>
			</div>
		</div>

		<?php the_content(); ?>
		<!-- bx offer -->
		<div class="bx-offer">
			<!-- item -->
			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionOffer/icon1.png" alt="">
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
			</div>
			<!-- ./end item -->
			<!-- item -->
			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionOffer/icon2.png" alt="">
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
			</div>
			<!-- ./end item -->
			<!-- item -->
			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionOffer/icon3.png" alt="">
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
			</div>
			<!-- ./end item -->
			<!-- item -->
			<div class="offer">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sectionOffer/icon4.png" alt="">
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
			</div>
			<!-- ./end item -->
		</div>
		<!-- bx offer -->

	</div>

</section>
<!-- END OFFER -->