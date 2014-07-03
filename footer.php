<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */ ?>




	<!-- BEGIN COPYRIGHT -->
	<div class="container">
		<section id="copyright">
			<h6 class="hidden">Copyright</h6>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-5 space-mobile">
					<a href="#" class="social"><i class="fa fa-facebook"></i></a>
					<a href="#" class="social"><i class="fa fa-twitter"></i></a>
					<a href="#" class="social"><i class="fa fa-pinterest"></i></a>
					<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
					<a href="#" class="social"><i class="fa fa-instagram"></i></a>
					<a href="#" class="social"><i class="fa fa-github"></i></a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-7 text-right">
				Copyright &copy; 2014 by media theme - wszelkie prawa zastrzeżone<br>
				Realizacja:  <a href="#">KUL STUDIO</a>
				</div>
			</div>
		</section>
	</div>
	<!-- END COPYRIGHT -->

</footer>
<!-- END FOOTER -->




<?php
// Important WordPress Hook - DO NOT DELETE!
wp_footer(); ?>

<!-- BEGIN JAVASCRIPTS -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/respond.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery-ui-1.10.4/js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery.scrollTo.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery.parallax-1.1.3.js" type="text/javascript"></script>

<!-- BEGIN MAPS PLUGIN FILES -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/gmaps/gmaps.js"></script>
</script>
<!-- END MAPS PLUGIN FILES -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
	(function($) { "use strict";
		Layout.init();
	})(jQuery);
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->


<!-- BEGIN bxslider -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/bxslider/jquery.bxslider.js"></script>
<script>
(function($) { "use strict";
  $('.bx-offer').bxSlider({
    slideWidth: 250,
	pager : false,
    minSlides: 1,
    maxSlides: 4,
    moveSlides: 1,
    slideMargin: 10
  });
  $('.bx-persons').bxSlider({
    slideWidth: 200,
	pager : false,
    minSlides: 1,
    maxSlides: 4,
    moveSlides: 1,
    slideMargin: 10
  });
})(jQuery);
</script>
<!-- END bxslider -->

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>