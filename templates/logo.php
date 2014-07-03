<?php
/**
 * Template Name: Section Logo
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */

?>

<!-- BEGIN SECTION LOGO -->
<section id="sectionLogo">
	<div class="sectionLogoOrigamiBall"></div>
	<div class="sectionLogoOrigamiBird"></div>
	<div class="sectionLogoOrigamiBox"></div>

	<div class="container">

		<div class="info">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>

		<div class="logo">
			<a href="<?php home_url() ?>" id="logo"></a>
		</div>
	</div>
</section>
<!-- END SECTION LOGO -->