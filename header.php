<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */ ?>

<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<!-- http://www.kylejlarson.com/blog/2012/iphone-5-web-design/ -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta content="width=device-width, initial-scale=1" name="viewport">

	<!-- BEGIN PACE PLUGIN FILES -->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/assets/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css">
	<!-- END PACE PLUGIN FILES -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,400italic,700,500italic,500,700italic,300|Roboto+Condensed:400italic,700italic,400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" rel="stylesheet" type="text/css">


	<!-- Theme color -->
  	<link href="<?php echo get_template_directory_uri(); ?>/assets/css/themes/turquoise.css" rel="stylesheet" id="style-color">

    <!-- BEGIN bxslider -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet">
	<!-- END bxslider -->

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>


	<!-- JavaScript at bottom except for Modernizr -->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/modernizr.custom.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body <?php body_class(); ?>>

<!-- BEGIN NAVBAR -->
<nav class="navbar navbar-default-top navbar-fixed-top header-nav" role="navigation">
  <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">MENU</span>
          <span class="glyphicon glyphicon-align-justify"></span>
        </button>
        <div class="topbar">you have any questions? call <span class="responsive"><i class="fa fa-tablet"></i> <span>+12 3456 78 910</span></span></div>
      </div>
		<?php
			wp_nav_menu( array(
			    'menu'              => 'Menu',
			    'theme_location'    => 'primary',
			    'depth'             => 2,
			    'container'         => 'div',
			    'container_class'   => 'collapse navbar-collapse',
			    'container_id'      => '',
			    'menu_class'        => 'nav navbar-nav navbar-right',
			    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			    'walker'            => new wp_bootstrap_navwalker())
			);
		?>
    </div>
</nav>
<!-- END NAVBAR -->