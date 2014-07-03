<?php
/**
 * Admin Panel Options
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
}

if ( !class_exists( "WPBN_Redux_Framework_Config" ) ) {

	class WPBN_Redux_Framework_Config {

		/**
			Public Vars
		**/
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		/**
			Constructor
		**/
		public function __construct( ) {

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			// No errors please
			if ( !isset( $this->args['opt_name'] ) ) {
				return;
			}

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

			// Loads a custom.css file to tweak the admin design for WP 3.8
			add_action('redux-enqueue-wpbn_options', array( $this, 'redux_custom_css' ) ) ;

		} // End Construct

		/**
		Return Sections
		**/
		public function getReduxSections() {
			return $this->sections;
		}

		/**
			Custom Admin Design
		**/
		public function redux_custom_css() {
			global $wp_version;
			if ( $wp_version >= 3.8 ) {
				wp_register_style( 'redux-custom-css', WPBN_CSS_DIR_UIR .'redux-custom.css', array( 'redux-css' ), '', 'all' );
				wp_enqueue_style('redux-custom-css');
			}
		}

		/**
			Set Sections
		**/
		public function setSections() {

			// Array of dashicons
			$wpbn_dashicons = array('admin-appearance','admin-collapse','admin-comments','admin-generic','admin-home','admin-media','admin-network','admin-page','admin-plugins','admin-settings','admin-site','admin-tools','admin-users','align-center','align-left','align-none','align-right','analytics','arrow-down','arrow-down-alt','arrow-down-alt2','arrow-left','arrow-left-alt','arrow-left-alt2','arrow-right','arrow-right-alt','arrow-right-alt2','arrow-up','arrow-up-alt','arrow-up-alt2','art','awards','backup','book','book-alt','businessman','calendar','camera','cart','category','chart-area','chart-bar','chart-line','chart-pie','clock','cloud','dashboard','desktop','dismiss','download','edit','editor-aligncenter','editor-alignleft','editor-alignright','editor-bold','editor-customchar','editor-distractionfree','editor-help','editor-indent','editor-insertmore','editor-italic','editor-justify','editor-kitchensink','editor-ol','editor-outdent','editor-paste-text','editor-paste-word','editor-quote','editor-removeformatting','editor-rtl','editor-spellcheck','editor-strikethrough','editor-textcolor','editor-ul','editor-underline','editor-unlink','editor-video','email','email-alt','exerpt-view','facebook','facebook-alt','feedback','flag','format-aside','format-audio','format-chat','format-gallery','format-image','format-links','format-quote','format-standard','format-status','format-video','forms','googleplus','groups','hammer','id','id-alt','image-crop','image-flip-horizontal','image-flip-vertical','image-rotate-left','image-rotate-right','images-alt','images-alt2','info','leftright','lightbulb','list-view','location','location-alt','lock','marker','menu','migrate','minus','networking','no','no-alt','performance','plus','portfolio','post-status','pressthis','products','redo','rss','screenoptions','search','share','share-alt','share-alt2','share1','shield','shield-alt','slides','smartphone','smiley','sort','sos','star-empty','star-filled','star-half','tablet','tag','testimonial','translation','trash','twitter','undo','update','upload','vault','video-alt','video-alt2','video-alt3','visibility','welcome-add-page','welcome-comments','welcome-edit-page','welcome-learn-more','welcome-view-site','welcome-widgets-menus','wordpress','wordpress-alt','yes');
			$wpbn_dashicons = array_combine($wpbn_dashicons,$wpbn_dashicons);

			// Array of social options
			$social_options = array(
				'twitter'		=> 'Twitter',
				'facebook'		=> 'Facebook',
				'vk'			=> 'Vk',
				'google-plus'	=> 'Google Plus',
				'instagram'		=> 'instagram',
				'linkedin'		=> 'LinkedIn',
				'tumblr'		=> 'Tumblr',
				'pinterest'		=> 'Pinterest',
				'github-alt'	=> 'Github',
				'dribbble'		=> 'Dribbble',
				'flickr'		=> 'Flickr',
				'skype'			=> 'Skype',
				'youtube'		=> 'Youtube',
				'vimeo-square'	=> 'Vimeo',
				'rss'			=> 'RSS',
			);
			$social_options = apply_filters ( 'wpbn_social_options', $social_options );

			// Visibility options array
			$visibility = array(
				"always-visible"	=> __("Always Visible", "wpbn"),
				"hidden-phone"		=> __("Hidden on Phones", "wpbn"),
				"hidden-tablet"		=> __("Hidden on Tablets", "wpbn"),
				"hidden-desktop"	=> __("Hidden on Desktop", "wpbn"),
				"visible-desktop"	=> __("Visible on Desktop Only", "wpbn"),
				"visible-phone"		=> __("Visible on Phones Only", "wpbn"),
				"visible-tablet"	=> __("Visible on Tablets Only", "wpbn"),
			);

			// Built-in background pattern options
			$bg_patterns_url = get_template_directory_uri() .'/images/patterns/';
			$bg_patterns = array(
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'dark_wood.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'diagmonds.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'grilled.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'lined_paper.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'old_wall.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'ricepaper2.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'tree_bark.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'triangular.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'white_plaster.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'wild_flowers.png' ),
				array( 'alt'=> "",'img'	=> $bg_patterns_url .'wood_pattern.png' ),
			);

			// Animation styles
			$image_hovers = array (
				''				=> __('None','vcex'),
				'grow'			=> __('Grow','vcex'),
				'shrink'		=>__('Shrink','vcex'),
				'fade-out'		=>__('Fade Out','vcex'),
				'fade-in'		=>__('Fade In','vcex'),
			);

			/**
				General
			**/
			$this->sections[] = array(
				'title'			=> __( 'General', 'wpbn' ),
				'header'		=> __( 'Welcome to the Simple Options Framework Demo', 'wpbn' ),
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-cog',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'theme_branding',
						'url'		=> true,
						'type'		=> 'text',
						'title'		=> __( 'Theme Branding', 'wpbn' ),
						'default'	=> 'Media Interactive Studio',
						'subtitle'	=> __( 'Enter your custom name to re brand your theme. This string is used in situations such as the custom widget titles.', 'wpbn' ),
					),

					array(
						'id'		=> 'custom_logo',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Logo', 'wpbn' ),
						'read-only'	=> false,
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo.png' ),
						'subtitle'	=> __( 'Upload your custom site logo.', 'wpbn' ),
					),

					array(
						'id'		=> 'retina_logo',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Retina Logo', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo/logo-retina.png' ),
						'subtitle'	=> __( 'Upload your retina logo (optional).', 'wpbn' ),
					),

					array(
						'id'		=> 'retina_logo_height',
						'type'		=> 'text',
						'default'	=> '40px',
						'title'		=> __( 'Standard Logo Height', 'wpbn' ),
						'subtitle'	=> __( 'Enter your standard logo height. Used for retina logo.', 'wpbn' ),
					),

					array(
						'id'		=> 'retina_logo_width',
						'type'		=> 'text',
						'default'	=> '90px',
						'title'		=> __( 'Standard Logo Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your standard logo width. Used for retina logo.', 'wpbn' ),
					),

					array(
						'id'	=> 'favicon',
						'url'			=> true,
						'type'		=> 'media',
						'title'		=> __( 'Favicon', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/favicon.png' ),
						'subtitle'	=> __( 'Upload your custom site favicon.', 'wpbn' ),
					),

					array(
						'id'		=> 'iphone_icon',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Apple iPhone Icon ', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/apple-touch-icon.png' ),
						'subtitle'	=> __( 'Upload your custom iPhone icon (57px by 57px).', 'wpbn' ),
					),

					array(
						'id'		=> 'iphone_icon_retina',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Apple iPhone Retina Icon ', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/apple-touch-icon-114x114.png' ),
						'subtitle'	=> __( 'Upload your custom iPhone retina icon (114px by 114px).', 'wpbn' ),
					),

					array(
						'id'		=> 'ipad_icon',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Apple iPad Icon ', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/apple-touch-icon-72x72.png' ),
						'subtitle'	=> __( 'Upload your custom iPad icon (72px by 72px).', 'wpbn' ),
					),

					array(
						'id'		=> 'ipad_icon_retina',
						'url'		=> true,
						'type'		=> 'media',
						'title'		=> __( 'Apple iPad Retina Icon ', 'wpbn' ),
						'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/favicons/apple-touch-icon-114x114.png' ),
						'subtitle'	=> __( 'Upload your custom iPad retina icon (144px by 144px).', 'wpbn' ),
					),

					array(
						'id'		=> 'tracking',
						'type'		=> 'textarea',
						'title'		=> __( 'Tracking Code', 'wpbn' ),
						'subtitle'	=> __( 'Paste your Google Analytics javascript or other tracking code here. This code will be added before the closing <head> tag.', 'wpbn' ),
						'default'	=> ""
					),
				),
			);


			/**
				Layout
			**/
			$this->sections[] = array(
				'title'			=> __( 'Layout', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-website',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'main_layout_style',
						'type'		=> 'select',
						'title'		=> __( 'Layout Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your website layout style.', 'wpbn' ),
						'options'	=> array(
							'full-width'	=> __( 'Full Width','wpbn' ),
							'boxed'			=> __( 'Boxed','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'boxed_dropdshadow',
						'type'		=> 'switch',
						'title'		=> __( 'Boxed Layout Drop-Shadow', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the drop-shadow on or off in the boxed layout.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
						'required'	=> array( 'main_layout_style', 'equals', 'boxed' ),
					),

					array(
						'id'		=> 'main_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Main Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom main container width in pixels.', 'wpbn' ),
						'default'	=> '980px',
						'class'		=> 'small-text'
					),

					array(
						'id'		=> 'left_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Left Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your left container.', 'wpbn' ),
						'default'	=> '680px',
						'class'		=> 'small-text'
					),

					array(
						'id'		=> 'sidebar_width',
						'type'		=> 'text',
						'title'		=> __( 'Sidebar Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your sidebar.', 'wpbn' ),
						'default'	=> '250px',
						'class'		=> 'small-text'
					),
				),
			);


			/**
				Responsive
			**/
			$this->sections[] = array(
				'title'			=> __( 'Responsive', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-resize-small',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'responsive',
						'type'		=> 'switch',
						'title'		=> __( 'Responsive', 'wpbn' ),
						'subtitle'	=> __( 'Enable this option to make your theme compatible with smart phones and tablets.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),
					// Tablet Landscape
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Tablet Landscape & Small Desktops (960px - 1280px)', 'wpbn' ),
					),

					array(
						'id'		=> 'tablet_landscape_main_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Main Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom main container width in pixels. Keep in mind the iPad tablet width is only 1024px.', 'wpbn' ),
						'default'	=> '980px',
					),

					array(
						'id'		=> 'tablet_landscape_left_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Left Content Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your left container.', 'wpbn' ),
						'default'	=> '680px',
					),

					array(
						'id'		=> 'tablet_landscape_sidebar_width',
						'type'		=> 'text',
						'title'		=> __( 'Sidebar Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your sidebar.', 'wpbn' ),
						'default'	=> '250px',
					),


					// Tablet Portrait
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Tablet Portrait (768px - 959px)', 'wpbn' ),
					),

					array(
						'id'		=> 'tablet_main_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Main Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom main container width in pixels.', 'wpbn' ),
						'default'	=> '700px',
					),

					array(
						'id'		=> 'tablet_left_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Left Content Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your left container.', 'wpbn' ),
						'default'	=> '440px',
					),

					array(
						'id'		=> 'tablet_sidebar_width',
						'type'		=> 'text',
						'title'		=> __( 'Sidebar Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your width in pixels or percentage for your sidebar.', 'wpbn' ),
						'default'	=> '220px',
					),

					// Mobile
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Phone Size (0 - 767px)', 'wpbn' ),
					),

					array(
						'id'		=> 'mobile_landscape_main_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Landscape: Main Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom main container width in pixels.', 'wpbn' ),
						'default'	=> "480px",
					),

					array(
						'id'		=> 'mobile_portrait_main_container_width',
						'type'		=> 'text',
						'title'		=> __( 'Portrait: Main Container Width', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom main container width in pixels.', 'wpbn' ),
						'default'	=> '90%',
					),
				),
			);


			/**
				Background
			**/
			$this->sections[] = array(
				'title'			=> __( 'Background', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-picture',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'			=> 'background_color',
						'transparent'	=> false,
						'type'			=> 'color',
						'title'			=> __( 'Background Color', 'wpbn' ),
						'default'		=> '',
						'subtitle'		=> __( 'Select your custom background color.', 'wpbn' ),
					),

					array(
						'id'		=> 'background_image_toggle',
						'type'		=> 'switch',
						'title'		=> __( 'Background Image', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the custom background image option on/off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'background_image',
						'url'		=> true,
						'type'		=> 'media',
						'required'	=> array( 'background_image_toggle', 'equals', '1' ),
						'title'		=> __( 'Custom Background Image', 'wpbn' ),
						'default'	=> '',
						'subtitle'	=> __( 'Upload a custom background for your site.', 'wpbn' ),
					),

					array(
						'id'		=> 'background_style',
						'type'		=> 'select',
						'title'		=> __( 'Background Image Style', 'wpbn' ),
						'required'	=> array('background_image_toggle','equals','1'),
						'subtitle'	=> __( 'Select your preferred background style.', 'wpbn' ),
						'options'	=> array(
							'stretched'	=> __( 'Stretched','wpbn' ),
							'repeat'	=> __( 'Repeat','wpbn' ),
							'fixed'		=> __( 'Center Fixed','wpbn' )
						),
						'default'	=> 'stretched'
					),

					array(
						'id'		=> 'background_pattern_toggle',
						'type'		=> 'switch',
						'title'		=> __( 'Background Pattern', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the background pattern option on/off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'background_pattern',
						'type'		=> 'image_select',
						'tiles'		=> true,
						'required'	=> array('background_pattern_toggle','equals','1'),
						'title'		=> __( 'Pattern', 'wpbn' ),
						'subtitle'	=> __( 'Select a background pattern. Best used with the "boxed" layout.', 'wpbn' ),
						'default'	=> '',
						'options'	=> $bg_patterns,
					),
				),
			);


			/**
			 Typography
			**/
			$this->sections[] = array(
				'title'			=> __( 'Typography', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-font',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'	=> 'body_font',
						'type'	=> 'typography',
						'title'	=> __( 'Body', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google'=>true,
						'font-backup'=>false,
						'font-style'=>true,
						'subsets'=>true,
						'font-size'=>true,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>true,
						'preview'=>true,
						'units'=> 'px',
						'all_styles'	=> true,
						'subtitle'=> __( 'Select your custom font options for your main body font.', 'wpbn' ),
						'default'=> array(
							'font-family'	=> 'Open Sans',
							'font-size'	=> '',
							'font-weight'	=> '',
						),
					),

					array(
						'id'	=> 'headings_font',
						'type'	=> 'typography',
						'title'	=> __( 'Headings', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google'=>true,
						'font-backup'=>false,
						'font-style'=>false,
						'subsets'=>true,
						'font-size'=>false,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>false,
						'preview'=>true,
						'all_styles'	=> true,
						'units'=> 'px',
						'subtitle'=> __( 'Select your custom font options for your headings. h1, h2, h3, h4', 'wpbn' ),
						'default'=> array(
							'font-family'	=> '',
							'font-weight'	=> '',
							),
					),

					array(
						'id'	=> 'logo_font',
						'type'	=> 'typography',
						'title'	=> __( 'Logo', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google' =>true,
						'font-backup' =>false,
						'font-style' =>false,
						'subsets' =>true,
						'font-size'=>true,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>true,
						'preview'=>true,
						'units'=> 'px',
						'all_styles'	=> true,
						'subtitle'=> __( 'Select your custom font options for your logo.', 'wpbn' ),
						'default'=> array(
							'font-family'	=> '',
							'font-size'	=> '',
							'font-weight'	=> '',
						),
					),

					array(
						'id'	=> 'menu_font',
						'type'	=> 'typography',
						'title'	=> __( 'Menu', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google'=>true,
						'font-backup'=>false,
						'font-style'=>false,
						'subsets'=>true,
						'font-size'=>true,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>false,
						'preview'=>true,
						'all_styles'	=> true,
						'units'=> 'px',
						'subtitle'=> __( 'Select your custom font options for your main navigation menu.', 'wpbn' ),
						'default'=> array(
							'font-family'	=> '',
							'font-size'	=> '',
							'font-weight'	=> '',
						)
					),

					array(
						'id'	=> 'menu_dropdown_font',
						'type'	=> 'typography',
						'title'	=> __( 'Menu Dropdowns', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google'=>true,
						'font-backup'=>false,
						'font-style'=>false,
						'subsets'=>true,
						'font-size'=>true,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>false,
						'preview'=>true,
						'all_styles'	=> true,
						'units'=> 'px',
						'subtitle'=> __( 'Select your custom font options for your main navigation menu drop-downs.', 'wpbn' ),
						'default'=> array(
							'font-family'	=> '',
							'font-size'	=> '',
							'font-weight'	=> '',
						)
					),

					array(
						'id'	=> 'page_header_font',
						'type'	=> 'typography',
						'title'	=> __( 'Page Title', 'wpbn' ),
						'compiler'=>false,
						'output'	=> false,
						'google'=>true,
						'font-backup'=>false,
						'font-style'=>false,
						'subsets'=>true,
						'font-size'=>true,
						'line-height'=>false,
						'word-spacing'=>false,
						'letter-spacing'=>false,
						'text-align'	=> false,
						'color'=>true,
						'preview'=>true,
						'all_styles'	=> true,
						'units'=> 'px',
						'subtitle'=> __( 'Select your custom font options for your page/post titles.', 'wpbn' ),
						'default'=> array(
							'font-family'	=> '',
							'font-size'	=> '',
							'font-weight'	=> '',
						)
					),
				),
			);


			/**
				Styling
			**/
			$this->sections[] = array(
				'id'			=> 'styling',
				'icon'			=> 'el-icon-brush',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Styling', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					/**
						Custom Styling Toggle
					**/
					array(
						'id'		=> 'custom_styling',
						'type'		=> 'switch',
						'title'		=> __( 'Custom Styling', 'wpbn' ),
						'subtitle'	=> __( 'Use this option to toggle the custom styling options below on or off. Great for testing purposes.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					/**
						Styling => Site Header
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Site Header', 'wpbn' ),
					),

					array(
						'id'					=> 'header_background',
						'type'					=> 'color',
						'title'					=> __( 'Header Background Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> '',
						'transparent'			=> false,
						'target_element'		=> '#site-header, #searchform-header-replace',
						'target_style'			=> 'background-color',
						'theme_customizer'		=> true,

					),

					array(
						'id'				=> 'logo_color',
						'type'				=> 'color',
						'title'				=> __( 'Logo Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-logo a',
						'target_style'		=> 'color',
					),

					array(
						'id'					=> 'shop_button_background',
						'type'					=> 'color_gradient',
						'title'					=> __( 'Shop Button Background', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> '',
						'default'				=> array(
							'from'	=> '',
							'to'	=> ''
						),
						'transparent'			=> false,
						'target_element'		=> '.header-one .dropdown-menu .wcmenucart, .header-one .dropdown-menu .wcmenucart:hover, .header-one .dropdown-menu .wcmenucart:active',
						'theme_customizer'		=> false,
					),

					array(
						'id'					=> 'shop_button_color',
						'type'					=> 'color',
						'title'					=> __( 'Shop Button Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> '',
						'transparent'			=> false,
						'target_element'		=> '.header-one .dropdown-menu .wcmenucart, .header-one .dropdown-menu .wcmenucart:hover, .header-one .dropdown-menu .wcmenucart:active',
						'target_style'			=> 'color',
						'theme_customizer'		=> false,
					),

					array(
						'id'					=> 'search_button_background',
						'type'					=> 'color_gradient',
						'title'					=> __( 'Search Button Background', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> '',
						'default'				=> array(
							'from'	=> '',
							'to'	=> ''
						),
						'transparent'			=> false,
						'target_element'		=> '.site-search-toggle, .site-search-toggle:hover, .site-search-toggle:active',
						'theme_customizer'		=> true,
					),

					array(
						'id'				=> 'search_button_color',
						'type'				=> 'color',
						'title'				=> __( 'Search Button Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.site-search-toggle, .site-search-toggle:hover, .site-search-toggle:active',
						'target_style'		=> 'color',
						'theme_customizer'	=> false,
					),

					/**
						Styling => Page Header
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Page Header', 'wpbn' ),
					),

					array(
						'id'				=> 'page_header_background',
						'type'				=> 'color',
						'title'				=> __( 'Page Header Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.page-header',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'page_header_title_color',
						'type'				=> 'color',
						'title'				=> __( 'Page Header Title Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.page-header-title',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'page_header_top_border',
						'type'				=> 'color',
						'title'				=> __( 'Page Header Top Border Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.page-header',
						'target_style'		=> 'border-top-color',
					),

					array(
						'id'				=> 'page_header_bottom_border',
						'type'				=> 'color',
						'title'				=> __( 'Page Header Bottom Border Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.page-header',
						'target_style'		=> 'border-bottom-color',
					),

					array(
						'id'				=> 'breadcrumbs_text_color',
						'type'				=> 'color',
						'title'				=> __( 'Breadcrumbs Text Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.site-breadcrumbs',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'breadcrumbs_seperator_color',
						'type'				=> 'color',
						'title'				=> __( 'Breadcrumbs Seperator Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '.site-breadcrumbs .sep',
						'target_style'		=> 'color',
					),

					array(
						'id'					=> 'breadcrumbs_link_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Breadcrumbs Link Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '.site-breadcrumbs a',
						'target_element_hover'	=> '.site-breadcrumbs a:hover',
						'target_element_active'	=> '.site-breadcrumbs a:active',
						'target_style'			=> 'color',
					),

					/**
						Styling => Navigation
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Navigation', 'wpbn' ),
					),

					array(
						'id'				=> 'menu_background',
						'type'				=> 'color',
						'title'				=> __( 'Menu Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation-wrap',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'menu_borders',
						'type'				=> 'color',
						'title'				=> __( 'Menu Borders', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation li, #site-navigation a, #site-navigation ul, #site-navigation-wrap',
						'target_style'		=> 'border-color',
					),

					array(
						'id'					=> 'menu_link_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Menu Link Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#site-navigation .dropdown-menu > li > a',
						'target_element_hover'	=> '#site-navigation .dropdown-menu > li > a:hover, #site-navigation .dropdown-menu > li.sfHover > a',
						'target_element_active'	=> '#site-navigation .dropdown-menu > .current-menu-item > a, #site-navigation .dropdown-menu > .current-menu-item > a:hover',
						'target_style'			=> 'color',
					),

					array(
						'id'				=> 'menu_link_hover_background',
						'type'				=> 'color',
						'title'				=> __( 'Menu Link Hover Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation .dropdown-menu > li > a:hover, #site-navigation .dropdown-menu > li.sfHover > a',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'menu_link_active_background',
						'type'				=> 'color',
						'title'				=> __( 'Active Menu Link Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation .dropdown-menu > .current-menu-item > a',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'dropdown_menu_background',
						'type'				=> 'color',
						'title'				=> __( 'Menu Dropdown Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation .dropdown-menu ul',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'dropdown_menu_borders',
						'type'				=> 'color',
						'title'				=> __( 'Menu Dropdown Borders', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#site-navigation .dropdown-menu ul, #site-navigation .dropdown-menu ul li, #site-navigation .dropdown-menu ul li a',
						'target_style'		=> 'border-color',
					),

					array(
						'id'					=> 'dropdown_menu_link_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Dropdown Menu Link Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#site-navigation .dropdown-menu ul > li > a',
						'target_element_hover'	=> '#site-navigation .dropdown-menu ul > li > a:hover',
						'target_element_active'	=> '#site-navigation .dropdown-menu ul > .current-menu-item > a',
						'target_style'			=> 'color',
					),

					array(
						'id'				=> 'dropdown_menu_link_hover_bg',
						'type'				=> 'color_gradient',
						'title'				=> __( 'Menu Dropdown Link Hover Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> array(
							'from'	=> '',
							'to'	=> ''
						),
						'transparent'		=> false,
						'target_element'	=> '#site-navigation .dropdown-menu ul > li > a:hover'

					),

					/**
						Styling => Mobile Menu
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Mobile Menu', 'wpbn' ),
					),

					array(
						'id'					=> 'mobile_menu_icon_background',
						'type'					=> 'link_color',
						'title'					=> __( 'Mobile Menu Icon Background', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#mobile-menu a',
						'target_element_hover'	=> '#mobile-menu a:hover',
						'target_element_active'	=> '#mobile-menu a:active',
						'target_style'			=> 'background',
					),

					array(
						'id'					=> 'mobile_menu_icon_border',
						'type'					=> 'link_color',
						'title'					=> __( 'Mobile Menu Icon Border', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#mobile-menu a',
						'target_element_hover'	=> '#mobile-menu a:hover',
						'target_element_active'	=> '#mobile-menu a:active',
						'target_style'			=> 'border-color',
					),

					array(
						'id'					=> 'mobile_menu_icon_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Mobile Menu Icon Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#mobile-menu a',
						'target_element_hover'	=> '#mobile-menu a:hover',
						'target_element_active'	=> '#mobile-menu a:active',
						'target_style'			=> 'color',
					),

					array(
						'id'		=> 'mobile_menu_icon_size',
						'type'		=> 'text',
						'title'		=> __( 'Mobile Menu Icon Size', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom font size in pixels or em for your mobile menu icons.', 'wpbn' ),
						'default'	=> '',
					),

					array(
						'id'				=> 'mobile_menu_sidr_background',
						'type'				=> 'color',
						'title'				=> __( 'Mobile Menu Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#sidr-main',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'mobile_menu_sidr_borders',
						'type'				=> 'color',
						'title'				=> __( 'Mobile Menu Borders', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#sidr-main li, #sidr-main ul',
						'target_style'		=> 'border-color',
					),

					array(
						'id'					=> 'mobile_menu_links',
						'type'					=> 'link_color',
						'title'					=> __( 'Mobile Menu Links', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#sidr-main li a, .sidr-class-dropdown-toggle',
						'target_element_hover'	=> '#sidr-main li a:hover',
						'target_element_active'	=> '#sidr-main li a:active, .sidr-class-dropdown-toggle.active',
						'target_style'			=> 'color',
					),

					/**
						Styling => Sidebar
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Sidebar', 'wpbn' ),
					),

					array(
						'id'				=> 'sidebar_background',
						'type'				=> 'color',
						'title'				=> __( 'Sidebar Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#sidebar',
						'target_style'		=> 'background-color',
					),

					array(
						'id'		=> 'sidebar_padding',
						'type'		=> 'spacing',
						'output'	=> false,
						'mode'		=> 'padding',
						'units'		=> 'px',
						'title'		=> __( 'Sidebar Padding', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom sidebar padding', 'wpbn' ),
						'default'	=> array(
							'padding-top'		=> '',
							'padding-right'		=> '',
							'padding-bottom'	=> '',
							'padding-left'		=> ''
						),
					),

					array(
						'id'			=> 'sidebar_border',
						'type'			=> 'border',
						'title'			=> __( 'Sidebar border', 'wpbn' ),
						'subtitle'		=> __( 'Select your border style.', 'wpbn' ),
						'default'		=> '',
						'transparent'	=> false,
						'all'			=> false,
						'output'		=> false,
						'default'		=> array(
							'border-color'	=> '',
							'border-style'	=> 'solid',
							'border-top'	=> '',
							'border-right'	=> '',
							'border-bottom'	=> '',
							'border-left'	=> ''
						),
					),

					array(
						'id'			=> 'sidebar_link_color',
						'type'			=> 'link_color',
						'title'			=> __( 'Sidebar Link Color', 'wpbn' ),
						'subtitle'		=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'		=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#sidebar a',
						'target_element_hover'	=> '#sidebar a:hover',
						'target_element_active'	=> '#sidebar a:active',
						'target_style'			=> 'color',
					),

					/**
						Styling => Footer
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Footer', 'wpbn' ),
					),

					array(
						'id'				=> 'footer_background',
						'type'				=> 'color',
						'title'				=> __( 'Footer Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer',
						'target_style'		=> 'background-color',
					),

					array(
						'id'			=> 'footer_border',
						'type'			=> 'border',
						'title'			=> __( 'Footer border', 'wpbn' ),
						'subtitle'		=> __( 'Select your border style.', 'wpbn' ),
						'default'		=> '',
						'transparent'	=> false,
						'all'			=> false,
						'output'		=> false,
					),

					array(
						'id'				=> 'footer_color',
						'type'				=> 'color',
						'title'				=> __( 'Footer Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer, #footer p',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'footer_headings_color',
						'type'				=> 'color',
						'title'				=> __( 'Footer Headings Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer .widget-title',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'footer_borders',
						'type'				=> 'color',
						'title'				=> __( 'Footer Borders', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer li, #footer #wp-calendar thead th, #footer #wp-calendar tbody td',
						'target_style'		=> 'border-color',
					),

					array(
						'id'			=> 'footer_link_color',
						'type'			=> 'link_color',
						'title'			=> __( 'Footer Link Color', 'wpbn' ),
						'subtitle'		=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'		=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#footer a',
						'target_element_hover'	=> '#footer a:hover',
						'target_element_active'	=> '#footer a:active',
						'target_style'			=> 'color',
					),

					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Bottom Footer', 'wpbn' ),
					),

					array(
						'id'				=> 'bottom_footer_background',
						'type'				=> 'color',
						'title'				=> __( 'Bottom Footer Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer-bottom',
						'target_style'		=> 'background-color',
					),

					array(
						'id'			=> 'bottom_footer_border',
						'type'			=> 'border',
						'title'			=> __( 'Bottom Footer Border', 'wpbn' ),
						'subtitle'		=> __( 'Select your border style.', 'wpbn' ),
						'default'		=> '',
						'transparent'	=> false,
						'all'			=> false,
						'output'		=> false,
					),

					array(
						'id'				=> 'bottom_footer_color',
						'type'				=> 'color',
						'title'				=> __( 'Bottom Footer Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer-bottom, #footer-bottom p',
						'target_style'		=> 'color',
					),

					array(
						'id'			=> 'bottom_footer_link_color',
						'type'			=> 'link_color',
						'title'			=> __( 'Bottom Footer Link Color', 'wpbn' ),
						'subtitle'		=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'		=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '#footer-bottom a',
						'target_element_hover'	=> '#footer-bottom a:hover',
						'target_element_active'	=> '#footer-bottom a:active',
						'target_style'			=> 'color',
					),

					/**
						Styling => Buttons & Links
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Buttons & Links', 'wpbn' ),
					),

					array(
						'id'				=> 'link_color',
						'type'				=> 'color',
						'title'				=> __( 'Links Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=>false,
						'target_element'	=> 'body a, h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'theme_button_bg',
						'type'				=> 'color_gradient',
						'title'				=> __( 'Theme Button Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '.edit-post-link a, #commentform #submit, .wpcf7 .wpcf7-submit, .theme-minimal-graphical #comments .comment-reply-link, .theme-button, .readmore-link, #current-shop-items .buttons a, .woocommerce .button, .vcex-filter-links li a:hover, .vcex-filter-links li.active a, .page-numbers a:hover, .page-numbers.current, .page-numbers.current:hover, input[type="submit"], button, .vcex-filter-links li.active a',
						'default'			=> array(
							'from'	=> '',
							'to'	=> ''
						),
					),

					array(
						'id'				=> 'theme_button_color',
						'type'				=> 'color',
						'title'				=> __( 'Theme Button Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'theme_customizer'	=> false,
						'target_element'	=> '.edit-post-link a, #commentform #submit, .wpcf7 .wpcf7-submit, .theme-minimal-graphical #comments .comment-reply-link, .theme-button, .readmore-link, #current-shop-items .buttons a, .woocommerce .button, input[type="submit"], button, .vcex-filter-links li.active a',
					),

					array(
						'id'				=> 'theme_button_hover_bg',
						'type'				=> 'color_gradient',
						'title'				=> __( 'Theme Button Hover Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '.edit-post-link a:hover, #commentform #submit:hover, .wpcf7 .wpcf7-submit:hover, .theme-minimal-graphical #comments .comment-reply-link:hover, .theme-button:hover, .readmore-link:hover, #current-shop-items .buttons a:hover, .woocommerce .button:hover, input[type="submit"]:hover, button:hover, .vcex-filter-links a:hover',
						'default'			=> array(
							'from'	=> '',
							'to'	=> ''
						),
					),

					array(
						'id'				=> 'theme_button_hover_color',
						'type'				=> 'color',
						'title'				=> __( 'Theme Button Hover Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'theme_customizer'	=> false,
						'target_element'	=> '.edit-post-link a:hover, #commentform #submit:hover, .wpcf7 .wpcf7-submit:hover, #comments .comment-reply-link:hover, .theme-button:hover, .readmore-link:hover, #current-shop-items .buttons a:hover, .woocommerce .button:hover, input[type="submit"]:hover, button:hover, .vcex-filter-links a:hover',
						'target_style'		=> 'color',
					),
				)
			);

			/**
				Slidding Bar
			**/
			$this->sections[] = array(
				'id'			=> 'toggle_bar',
				'title'			=> __( 'Toggle Bar', 'wpbn' ),
				'icon_class'	=> 'el-icon-plus-sign',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'toggle_bar',
						'type'		=> 'switch',
						'title'		=> __( 'Toggle Bar', 'wpbn' ),
						'subtitle'	=> __( 'Set your toggle bar on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'toggle_bar_page',
						'type'		=> 'select',
						'data'		=> 'pages',
						'title'		=> __( 'Toggle Bar Content', 'wpbn' ),
						'subtitle'	=> __( 'Select a page to grab the content from for your toggle bar.', 'wpbn' ),
						'default'	=> '',
					),

					/**
						Slidding Bar => Styling
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Styling', 'wpbn' ),
					),

					array(
						'id'				=> 'toggle_bar_btn_bg',
						'type'				=> 'color',
						'title'				=> __( 'Toggle Bar Button Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '.toggle-bar-btn',
						'target_style'		=> array( 'border-top-color', 'border-right-color' ),
					),

					array(
						'id'				=> 'toggle_bar_btn_color',
						'type'				=> 'color',
						'title'				=> __( 'Toggle Bar Button Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '.toggle-bar-btn span.fa',
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'toggle_bar_bg',
						'type'				=> 'color',
						'title'				=> __( 'Toggle Bar Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '#toggle-bar-btn',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'toggle_bar_color',
						'type'				=> 'color',
						'title'				=> __( 'Toggle Bar Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=> false,
						'target_element'	=> '#toggle-bar-wrap, #toggle-bar-wrap strong',
						'target_style'		=> 'color',
					),

				)

			);

			/**
				Top Bar
			**/
			$this->sections[] = array(
				'title'			=> __( 'Top Bar', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-arrow-up',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'top_bar',
						'type'		=> 'switch',
						'title'		=> __( 'Top Bar', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the top bar above the site on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'top_bar_style',
						'type'		=> 'select',
						'title'		=> __( 'Top Bar Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred top bar style.', 'wpbn' ),
						'options'	=> array(
							'one'	=> __( 'Left Content & Right Social', 'wpbn' ),
							'two'	=> __( 'Left Social & Right Content', 'wpbn' ),
							'three'	=> __( 'Centered Content & Social', 'wpbn' ),
						),
						'default'	=> 'one',
						'required'	=> array('top_bar','equals','1'),
					),

					array(
						'id'		=> 'top_bar_visibility',
						'type'		=> 'select',
						'title'		=> __( 'Top Bar Visibility', 'wpbn' ),
						'subtitle'	=> __( 'Select your top bar visibility.', 'wpbn' ),
						'options'	=> $visibility,
						'default'	=> 'always-visible',
						'required'	=> array('top_bar','equals','1'),
					),

					array(
						'id'				=> 'top_bar_content',
						'type'				=> 'editor',
						'title'				=> __( 'Top Bar: Content', 'wpbn' ),
						'subtitle'			=> __( 'Enter your custom content for your top bar. Shortcodes are Allowed.', 'wpbn' ),
						'default'			=> '<strong>Phone:</strong> 1-800-987-654 - <strong>Email:</strong> dmin@totalwptheme.com',
						'required'			=> array('top_bar','equals','1'),
						'editor_options'	=> '',
					),

					/**
						Top Bar => Social
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Top Bar Social', 'wpbn' ),
					),

					array(
						'id'		=> 'top_bar_social',
						'type'		=> 'switch',
						'title'		=> __( 'Top Bar Social', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the top bar social links on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'				=> 'top_bar_social_alt',
						'type'				=> 'editor',
						'title'				=> __( 'Social Alternative', 'wpbn' ),
						'subtitle'			=> __( 'Add some alternative text, code, shortcodes where your Social icons would normally go.', 'wpbn' ),
						'default'			=> '',
						'required'			=> array('top_bar','equals','1'),
						'editor_options'	=> '',
						'required'			=> array( 'top_bar_social', '!=','1' ),
					),

					array(
						'id'		=> 'top_bar_social_target',
						'type'		=> 'select',
						'title'		=> __( 'Top Bar Social Link Target', 'wpbn' ),
						'subtitle'	=> __( 'Select to open the social links in a new or the same window.', 'wpbn' ),
						'options'	=> array(
							'blank'	=> __( 'New Window', 'wpbn' ),
							'self'	=> __( 'Same Window', 'wpbn' )
						),
						'default'	=> 'blank',
						'required'	=> array('top_bar_social','equals','1'),
					),

					array(
						'id'		=> 'top_bar_social_style',
						'type'		=> 'select',
						'title'		=> __( 'Top Bar Social Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred social link style.', 'wpbn' ),
						'options'	=> array(
							'font_icons'	=> __( 'Font Icons', 'wpbn' ),
							'colored-icons'	=> __( 'Colored Image Icons', 'wpbn' )
						),
						'default'	=> 'font_icons',
						'required'	=> array('top_bar_social','equals','1'),
					),

					array(
						'id'		=> 'top_bar_social_options',
						'type'		=> 'sortable',
						'title'		=> __( 'Top Bar Social Options', 'wpbn' ),
						'subtitle'	=> __( 'Define and reorder your social icons in the top bar. Clear the input field for any social icon you do not wish to display.', 'wpbn' ),
						'desc'		=> '',
						'label'		=> true,
						'required'	=> array('top_bar_social','equals','1'),
						'options'	=> $social_options,
					),

					/**
						Top Bar => Styling
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Top Bar Styling', 'wpbn' ),
					),

					array(
						'id'				=> 'top_bar_bg',
						'type'				=> 'color',
						'title'				=> __( 'Top Bar Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#top-bar-wrap',
						'target_style'		=> 'background-color',
					),

					array(
						'id'				=> 'top_bar_border',
						'type'				=> 'color',
						'title'				=> __( 'Top Bar Bottom Border', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#top-bar-wrap',
						'target_style'		=> 'border-color',
					),

					array(
						'id'	=> 'top_bar_text',
						'type'	=> 'color',
						'title'	=> __( 'Top Bar Text Color', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'	=> '',
						'transparent'	=> false,
						'target_element'	=> '#top-bar-wrap, #top-bar-content strong',
						'target_style'	=> 'color',
					),

					array(
						'id'	=> 'top_bar_social_color',
						'type'	=> 'color',
						'title'	=> __( 'Top Bar Social Links Color', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'	=> '',
						'transparent'	=> false,
						'target_element'	=> '#top-bar-social a',
						'target_style'	=> 'color',
					),

					array(
						'id'	=> 'top_bar_social_hover_color',
						'type'	=> 'color',
						'title'	=> __( 'Top Bar Social Links Hover Color', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'	=> '',
						'transparent'	=> false,
						'target_element'	=> '#top-bar-social a:hover',
						'target_style'	=> 'color',
					),
				),
			);


			/**
				Header
			**/
			$this->sections[] = array(
				'title'			=> __( 'Header', 'wpbn' ),
				'header'		=> '',
				'desc'			=> '',
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-screen',
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'header_style',
						'type'		=> 'select',
						'title'		=> __( 'Header Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your default header style.', 'wpbn' ),
						'options'	=> array(
							'one'	=> __( 'One','wpbn' ),
							'two'	=> __( 'Two','wpbn' ),
							'three'	=> __( 'Three','wpbn' )
						),
						'default'	=> 'one',
					),

					array(
						'id'		=> 'header_height',
						'type'		=> 'text',
						'title'		=> __( 'Custom Header Height', 'wpbn' ),
						'subtitle'	=> __( 'Use this setting to define a fixed header height. Use this option ONLY if your want the navigation drop-downs to fall right under the header. Remove the default height or set to "auto" if you want the header to auto expand depending on your logo height.', 'wpbn' ),
						"default"	=> '90px',
						'required'	=> array( 'header_style', 'equals', array( 'one' ) ),
					),

					array(
						'id'		=> 'fixed_header',
						'type'		=> 'switch',
						'title'		=> __( 'Fixed Header on Scroll', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the fixed header when the user scrolls down the site on or off. Please note that for certain header (two and three) styles only the navigation will become fixed.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'fixed_header_opacity',
						'type'		=> 'text',
						'title'		=> __( 'Fixed Header Opacity', 'wpbn' ),
						'subtitle'	=> __( 'Enter an opacity for the fixed header. Default is 0.95.', 'wpbn' ),
						"default"	=> '0.95',
						'required'	=> array( 'fixed_header', 'equals', array( '1' ) ),
					),

					array(
						'id'		=> 'main_search',
						'type'		=> 'switch',
						'title'		=> __( 'Header Search', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the search function in the header on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'main_search_toggle_style',
						'type'		=> 'select',
						'title'		=> __( 'Header Search Toggle Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your default header search style.', 'wpbn' ),
						'options'	=> array(
							'drop_down'			=> __( 'Drop Down','wpbn' ),
							'overlay'			=> __( 'Site Overlay','wpbn' ),
							'header_replace'	=> __( 'Header Replace','wpbn' )
						),
						'default'	=> 'drop_down',
						'required'	=> array( 'main_search', 'equals', array('1') ),
					),

					array(
						'id'		=> 'main_search_overlay_top_margin',
						'type'		=> 'text',
						'title'		=> __( 'Header Search Overlay Top Margin', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom top margin for the search overlay. The default is 120px.', 'wpbn' ),
						'default'	=> '',
						'required'	=> array('main_search_toggle_style','equals','overlay'),
					),

					array(
						'id'		=> 'header_top_padding',
						'type'		=> 'text',
						'title'		=> __( 'Header Top Padding', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom header top padding in pixels.', 'wpbn' ),
						'default'	=> '30px',
					),

					array(
						'id'		=> 'header_bottom_padding',
						'type'		=> 'text',
						'title'		=> __( 'Header Bottom Padding', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom header top padding in pixels.', 'wpbn' ),
						'default'	=> '30px',
					),

					array(
						'id'		=> 'logo_top_margin',
						'type'		=> 'text',
						'title'		=> __( 'Logo Top Margin', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom logo top margin.', 'wpbn' ),
						'default'	=> '0px',
					),

					array(
						'id'		=> 'logo_bottom_margin',
						'type'		=> 'text',
						'title'		=> __( 'Logo Bottom Margin', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom logo top margin.', 'wpbn' ),
						'default'	=> '0px',
					),

					array(
						'id'				=> 'header_aside',
						'type'				=> 'editor',
						'title'				=> __( 'Header Aside Content', 'wpbn' ),
						'subtitle'			=> __( 'Enter your custom header aside content for header style 2.', 'wpbn' ),
						'default'			=> '30% OFF All Store!',
						'required'			=> array('header_style', 'equals', array( 'two' ) ),
						'editor_options'	=> '',
					),

					/**
						Header => Menu
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Header: Menu', 'wpbn' ),
					),


					array(
						'id'		=> 'menu_arrow_down',
						'type'		=> 'switch',
						'title'		=> __( 'Top Level Dropdown Icon', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the top menu dropdown icon indicator on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'menu_arrow_side',
						'type'		=> 'switch',
						'title'		=> __( 'Second+ Level Dropdown Icon', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the sub-menu item dropdown icon indicator on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'menu_dropdown_top_border',
						'type'		=> 'switch',
						'title'		=> __( 'Dropdown Top Border', 'wpbn' ),
						'subtitle'	=> __( 'Set this option to "on" if you want to have a thick colorfull border at the top of your drop-down menu.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'				=> 'menu_dropdown_top_border_color',
						'type'				=> 'color',
						'title'				=> __( 'Dropdown Top Border Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> 'body #site-navigation-wrap.nav-dropdown-top-border .dropdown-menu > li > ul',
						'target_style'		=> 'border-top-color',
						'required'			=> array( 'menu_dropdown_top_border', 'equals', '1' ),
					),


					/**
						Header => Other
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Header: Other', 'wpbn' ),
					),

					array(
						'id'		=> 'page_header_style',
						'type'		=> 'select',
						'title'		=> __( 'Page Header Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your default page header style. This can be altered alter on a per-post basis.', 'wpbn' ),
						'options'	=> array(
							'default'			=> __( 'Default','wpbn' ),
							'centered'			=> __( 'Centered', 'wpbn' ),
							'centered-minimal'	=> __( 'Centered Minimal', 'wpbn' ),
						),
						'default'	=> 'default',
					),

				),
			);

        if ( class_exists('Portfolio') ) {

			/**
				Portfolio
			**/

			$this->sections[] = array(
				'icon'			=> 'el-icon-briefcase',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Portfolio', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'portfolio_enable',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio Post Type', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the portfolio custom post type on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_page',
						'type'		=> 'select',
						'data'		=> 'pages',
						'title'		=> __( 'Portfolio Page', 'wpbn' ),
						'subtitle'	=> __( 'Select your main portfolio page. This is used for your breadcrumbs.', 'wpbn' ),
						'default'	=> '',
					),

					/**
						Portfolio => Archives
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Portfolio: Archives', 'wpbn' ),
					),


					array(
						'id'		=> 'portfolio_archive_layout',
						'type'		=> 'select',
						'title'		=> __( 'Portfolio Archives Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'portfolio_entry_columns',
						'type'		=> 'select',
						'title'		=> __( 'Portfolio Archive Columns', 'wpbn' ),
						'subtitle'	=> __( 'Select your default column structure for your category and tag archives.', 'wpbn' ),
						'options'	=> array(
							'1'	=> '1',
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4'
						),
						'default'	=> '4',
					),

					array(
						'id'		=> 'portfolio_archive_posts_per_page',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Archives Posts Per Page', 'wpbn' ),
						'subtitle'	=> __( 'How many posts do you wish to display on your archives before pagination?', 'wpbn' ),
						"default"	=> '12',
					),

					array(
						'id'		=> 'portfolio_entry_details',
						'type'		=> 'switch',
						'title'		=> __( 'Detailed Entries', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the portfolio entry title/excerpts from your category and tag archives.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_entry_excerpt_length',
						'type'		=> 'text',
						'title'		=> __( 'Entry Excerpt Length', 'wpbn' ),
						'subtitle'	=> __( 'How many words do you want to show for your entry excerpts?', 'wpbn' ),
						"default"	=> '20',
						'required'	=> array( 'portfolio_entry_details', 'equals', '1' ),
					),

					/**
						Portfolio => Single
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Portfolio: Single Post', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_single_layout',
						'type'		=> 'select',
						'title'		=> __( 'Portfolio Single Post Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'		=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'		=> __( 'Left Sidebar','wpbn' ),
							'full-width'		=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'portfolio_single_media',
						'type'		=> 'switch',
						'title'		=> __( 'Auto Portfolio Post Media', 'wpbn' ),
						'subtitle'	=> __( 'Set this option to "on" if you want to automatically display your portfolio featured image or featured video at the top of posts.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_comments',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio Comments', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the comments on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_next_prev',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio Next/Prev Links', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the next and previous pagination on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_related',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio Related', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the related portfolio items on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_related_count',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Related Count', 'wpbn' ),
						'subtitle'	=> __( 'Enter the number of related portfolio items to display on your single posts.', 'wpbn' ),
						'default'	=> '',
						'required'	=> array( 'portfolio_related', 'equals', '1' ),
					),

					array(
						'id'		=> 'portfolio_related_title',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Related Title', 'wpbn' ),
						'subtitle'	=> __( 'Enter a custom string for your related portfolio items title.', 'wpbn' ),
						'default'	=> '',
						'required'	=> array( 'portfolio_related', 'equals', '1' ),
					),


					/**
						Portfolio => Branding
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Portfolio: Branding', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_admin_icon',
						'type'		=> 'select',
						'title'		=> __( 'Portfolio Admin Icon', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom Dashicon for this post type.', 'wpbn' ). '<br /><br /><a href="http://melchoyce.github.io/dashicons/" target="_blank">'. __( 'Learn More','wpbn' ) .' &rarr;</a>',
						'options'	=> $wpbn_dashicons,
						'default'	=> 'portfolio',
					),

					array(
						'id'		=> 'portfolio_labels',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Labels', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to rename your portfolio custom post type.', 'wpbn' ),
						'default'	=> 'Portfolio',
					),

					array(
						'id'		=> 'portfolio_slug',
						'type'		=> 'text',
						'title'		=> __( 'Custom Portfolio Slug', 'wpbn' ),
						'subtitle'	=> __( 'Changes the default slug for this post type. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'portfolio-item',
					),

					array(
						'id'		=> 'portfolio_cat_slug',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Category Slug', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to alter the default slug for this taxonomy. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'portfolio-category',
					),

					array(
						'id'		=> 'portfolio_tag_slug',
						'type'		=> 'text',
						'title'		=> __( 'Portfolio Tag Slug', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to alter the default slug for this taxonomy. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'portfolio-tag',
					),

					/**
					Portfolio => Other
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Portfolio: Other', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_custom_sidebar',
						'type'		=> 'switch',
						'title'		=> __( 'Custom Portfolio Sidebar', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the built-in custom Portfolio post type sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'breadcrumbs_portfolio_cat',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio Category In Breadcrumbs', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of the category in breadcrumbs on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'portfolio_search',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio in Search?', 'wpbn' ),
						'subtitle'	=> __( 'Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

				),
			);

		}

        if ( class_exists('Staff') ) {

			/**
				Staff
			**/
			$this->sections[] = array(
				'icon'			=> 'el-icon-user',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Staff', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'staff_enable',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Post Type', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the staff custom post type on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_page',
						'type'		=> 'select',
						'data'		=> 'pages',
						'title'		=> __( 'Staff Page', 'wpbn' ),
						'subtitle'	=> __( 'Select your main staff page. This is used for your breadcrumbs.', 'wpbn' ),
						'default'	=> '',
					),

					/**
						Staff => Archives
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Staff: Archives', 'wpbn' ),
					),


					array(
						'id'		=> 'staff_archive_layout',
						'type'		=> 'select',
						'title'		=> __( 'Staff Archives Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'staff_entry_columns',
						'type'		=> 'select',
						'title'		=> __( 'Staff Archive Columns', 'wpbn' ),
						'subtitle'	=> __( 'Select your default column structure for your category and tag archives.', 'wpbn' ),
						'options'	=> array(
							'1'	=> '1',
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4'
						),
						'default'	=> '4',
					),

					array(
						'id'		=> 'staff_archive_posts_per_page',
						'type'		=> 'text',
						'title'		=> __( 'Staff Archives Posts Per Page', 'wpbn' ),
						'subtitle'	=> __( 'How many posts do you wish to display on your archives before pagination?', 'wpbn' ),
						"default"	=> '12',
					),

					array(
						'id'		=> 'staff_entry_details',
						'type'		=> 'switch',
						'title'		=> __( 'Detailed Entries', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the staff entry title/excerpts from your category and tag archives.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_entry_excerpt_length',
						'type'		=> 'text',
						'title'		=> __( 'Entry Excerpt Length', 'wpbn' ),
						'subtitle'	=> __( 'How many words do you want to show for your entry excerpts?', 'wpbn' ),
						"default"	=> '20',
						'required'	=> array( 'staff_entry_details', 'equals', '1' ),
					),

					array(
						'id'		=> 'staff_entry_social',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Entry: Social Links', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social links display on staff entries on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					/**
						Staff => Single Post
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Staff: Single Post', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_single_layout',
						'type'		=> 'select',
						'title'		=> __( 'Staff Single Post Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'right-sidebar',
					),

					array(
						'id'		=> 'staff_comments',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Comments', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the comments on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_next_prev',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Next/Prev Links', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the next and previous pagination on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_related',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Related', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the related staff items on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_related_count',
						'type'		=> 'text',
						'title'		=> __( 'Staff Related Count', 'wpbn' ),
						'subtitle'	=> __( 'Enter the number of related staff items to display on your single posts.', 'wpbn' ),
						'default'	=> '4',
					),

					array(
						'id'		=> 'staff_related_title',
						'type'		=> 'text',
						'title'		=> __( 'Staff Related Title', 'wpbn' ),
						'subtitle'	=> __( 'Enter a custom string for your related staff items title.', 'wpbn' ),
						'default'	=> '',
					),

					/**
						Staff => Branding
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Staff: Branding', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_admin_icon',
						'type'		=> 'select',
						'title'		=> __( 'Staff Admin Icon', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom Dashicon for this post type.', 'wpbn' ). '<br /><br /><a href="http://melchoyce.github.io/dashicons/" target="_blank">'. __( 'Learn More','wpbn' ) .' &rarr;</a>',
						'options'	=> $wpbn_dashicons,
						'default'	=> 'groups',
					),

					array(
						'id'		=> 'staff_labels',
						'type'		=> 'text',
						'title'		=> __( 'Staff Labels', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to rename your staff custom post type.', 'wpbn' ),
						'default'	=> 'Staff',
					),

					array(
						'id'		=> 'staff_slug',
						'type'		=> 'text',
						'title'		=> __( 'Staff Slug', 'wpbn' ),
						'subtitle'	=> __( 'Changes the default slug for this post type. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'staff-item',
					),

					array(
						'id'		=> 'staff_cat_slug',
						'type'		=> 'text',
						'title'		=> __( 'Staff Category Slug', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to alter the default slug for this taxonomy. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'staff-category',
					),

					array(
						'id'		=> 'staff_tag_slug',
						'type'		=> 'text',
						'title'		=> __( 'Staff Tag Slug', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to alter the default slug for this taxonomy. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'staff-tag',
					),

					/**
						Staff => Other
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Staff: Other', 'wpbn' ),
					),

					array(
						'id'		=> 'staff_custom_sidebar',
						'type'		=> 'switch',
						'title'		=> __( 'Custom Staff Sidebar', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the built-in custom Staff post type sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),



					array(
						'id'		=> 'breadcrumbs_staff_cat',
						'type'		=> 'switch',
						'title'		=> __( 'Staff Category In Breadcrumbs', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of the category in breadcrumbs on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
						'required'	=> array( 'staff_enable', 'equals', '1' ),
					),

					array(
						'id'		=> 'staff_search',
						'type'		=> 'switch',
						'title'		=> __( 'Staff in Search?', 'wpbn' ),
						'subtitle'	=> __( 'Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

				)
			);
		}

        if ( class_exists('Testimonials') ) {
			/**
				Testimonials
			**/
			$this->sections[] = array(
				'icon'			=> 'el-icon-quotes',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Testimonials', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'testimonials_enable',
						'type'		=> 'switch',
						'title'		=> __( 'Testimonials Post Type', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the testimonials custom post type on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'testimonials_page',
						'type'		=> 'select',
						'data'		=> 'pages',
						'title'		=> __( 'Testimonials Page', 'wpbn' ),
						'subtitle'	=> __( 'Select your main testimonials page. This is used for your breadcrumbs.', 'wpbn' ),
						'default'	=> '',
					),

					/**
						Testimonials => Archives
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Testimonials: Archives', 'wpbn' ),
					),


					array(
						'id'		=> 'testimonials_archive_layout',
						'type'		=> 'select',
						'title'		=> __( 'Testimonials Archives Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'testimonials_entry_columns',
						'type'		=> 'select',
						'title'		=> __( 'Testimonials Archive Columns', 'wpbn' ),
						'subtitle'	=> __( 'Select your default column structure for your category and tag archives.', 'wpbn' ),
						'options'	=> array(
							'1'	=> '1',
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4'
						),
						'default'	=> '3',
					),

					array(
						'id'		=> 'testimonials_archive_posts_per_page',
						'type'		=> 'text',
						'title'		=> __( 'Testimonials Archives Posts Per Page', 'wpbn' ),
						'subtitle'	=> __( 'How many posts do you wish to display on your archives before pagination?', 'wpbn' ),
						"default"	=> '12',
					),

					/**
						Testimonials => Single Post
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Testimonials: Single Post', 'wpbn' ),
					),

					array(
						'id'		=> 'testimonial_post_style',
						'type'		=> 'select',
						'title'		=> __( 'Testimonial Post Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your style for the singular testimonial post.', 'wpbn' ),
						'default'	=> 'blockquote',
						'options'	=> array (
							'blockquote'	=> __( 'Blockquote', 'wpbn' ),
							'standard'		=> __( 'Standard', 'wpbn' ),
						)
					),

					array(
						'id'		=> 'testimonials_single_layout',
						'type'		=> 'select',
						'title'		=> __( 'Testimonials Single Post Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'full-width',
					),

					array(
						'id'		=> 'testimonials_comments',
						'type'		=> 'switch',
						'title'		=> __( 'Testimonials Comments', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the comments on posts on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),


					/**
						Testimonials => Branding
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Testimonials: Branding', 'wpbn' ),
					),

					array(
						'id'		=> 'testimonials_admin_icon',
						'type'		=> 'select',
						'title'		=> __( 'Testimonials Admin Icon', 'wpbn' ),
						'subtitle'	=> __( 'Select your custom dashicon for this post type.', 'wpbn' ). '<br /><br /><a href="http://melchoyce.github.io/dashicons/" target="_blank">'. __( 'Learn More','wpbn' ) .' &rarr;</a>',
						'options'	=> $wpbn_dashicons,
						'default'	=> 'format-status',
					),

					array(
						'id'		=> 'testimonials_labels',
						'type'		=> 'text',
						'title'		=> __( 'Testimonials Labels', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to rename your testimonials custom post type.', 'wpbn' ),
						'default'	=> 'Testimonials',
					),

					array(
						'id'		=> 'testimonials_slug',
						'type'		=> 'text',
						'title'		=> __( 'Testimonials Slug', 'wpbn' ),
						'subtitle'	=> __( 'Changes the default slug for this post type. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'testimonials-item',
					),

					array(
						'id'		=> 'testimonials_cat_slug',
						'type'		=> 'text',
						'title'		=> __( 'Testimonials Category Slug', 'wpbn' ),
						'subtitle'	=> __( 'Use this field to alter the default slug for this taxonomy. After changing this field go to "Settings->Permalinks" and resave your settings to prevent 404 errors.', 'wpbn' ),
						'default'	=> 'testimonials-category',
					),


					/**
						Testimonials => Other
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Testimonials: Other', 'wpbn' ),
					),

					array(
						'id'		=> 'testimonials_search',
						'type'		=> 'switch',
						'title'		=> __( 'Testimonials in Search?', 'wpbn' ),
						'subtitle'	=> __( 'Toggle whether items from this post type should display in search results on or off. Enabling this option will also cause items to not display in the category & tag archives, so use wisely!', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'testimonial_custom_sidebar',
						'type'		=> 'switch',
						'title'		=> __( 'Custom Testimonials Sidebar', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the built-in custom Testimonials post type sidebar on or off. If disabled it will display the "Main" sidebar as a fallback.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'breadcrumbs_testimonials_cat',
						'type'		=> 'switch',
						'title'		=> __( 'Testimonials Category In Breadcrumbs', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of the category in breadcrumbs on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

				),

			);
		}

			/**
				WooCommerce
			**/

			if ( class_exists('Woocommerce') ) {

				$this->sections[] = array(
					'icon'			=> 'el-icon-shopping-cart',
					'icon_class'	=> 'el-icon-large',
					'title'			=> __( 'WooCommerce', 'wpbn' ),
					'submenu'		=> true,
					'fields'		=> array(
						array(
							'id'		=> 'woo_menu_icon',
							'type'		=> 'switch',
							'title'		=> __( 'Menu Cart', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the menu shopping cart on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_menu_icon_amount',
							'type'		=> 'switch',
							'title'		=> __( 'Menu Cart: Amount', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the display of your cart "amount" in the menu shopping cart on or off.', 'wpbn' ),
							"default"	=> '0',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
							'required'	=> array('woo_menu_icon','equals','1'),
						),

						array(
							'id'		=> 'woo_menu_icon_style',
							'type'		=> 'select',
							'title'		=> __( 'Menu Cart: Style', 'wpbn' ),
							'subtitle'	=> __( 'Select your default WooCommerce menu icon style.', 'wpbn' ),
							'desc'		=> '',
							'options'	=> array(
								'overlay'	=> __( 'Open Cart Overlay','wpbn' ),
								'drop-down'	=> __( 'Drop-Down','wpbn' ),
								'store'		=> __( 'Go To Store','wpbn' ),
								'custom-link'	=> __( 'Custom Link','wpbn' ),
							),
							'default'	=> 'drop-down',
							'required'	=> array('woo_menu_icon','equals','1'),
						),

						array(
							'id'		=> 'woo_menu_icon_custom_link',
							'type'		=> 'text',
							'title'		=> __( 'Menu Cart: Custom Link', 'wpbn' ),
							'subtitle'	=> __( 'Enter your custom link for the menu cart icon.', 'wpbn' ),
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
							'required'	=> array('woo_menu_icon_style','equals','custom-link'),
						),

						array(
							'id'		=> 'woo_shop_overlay_top_margin',
							'type'		=> 'text',
							'title'		=> __( 'Cart Overlay Top Margin', 'wpbn' ),
							'subtitle'	=> __( 'Enter your custom top margin for the WooCommerce cart overlay. The default is 120px.', 'wpbn' ),
							'default'	=> "",
							'required'	=> array('woo_menu_icon_style','equals','overlay'),
						),

						array(
							'id'		=> 'woo_custom_sidebar',
							'type'		=> 'switch',
							'title'		=> __( 'Custom WooCommerce Sidebar', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the built-in custom WooCommerce sidebar on or off. If disabled it will display the "Main" sidebar as a fall-back.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						/**
							WooCommerce => Archives
						**/
						array(
							'id'	=> 'multi-info',
							'type'	=> 'info',
							'title'	=> false,
							'desc'	=> __( 'WooCommerce: Archives', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_shop_slider',
							'type'		=> 'text',
							'title'		=> __( 'Shop Slider', 'wpbn' ),
							'desc'		=> '',
							'subtitle'	=> __( 'Insert your slider shortcode for your products archive.', 'wpbn' ),
							'default'	=> '',
						),

						array(
							'id'		=> 'woo_shop_posts_per_page',
							'type'		=> 'text',
							'title'		=> __( 'Shop Posts Per Page', 'wpbn' ),
							'desc'		=> '',
							'subtitle'	=> __( 'How many items to display per page on your main shop archive and product category archives.', 'wpbn' ),
							'default'	=> '12',
						),

						array(
							'id'		=> 'woo_shop_layout',
							'type'		=> 'select',
							'title'		=> __( 'Shop Layout', 'wpbn' ),
							'subtitle'	=> __( 'Select your preferred layout for your WooCommmerce Shop.', 'wpbn' ),
							'desc'		=> '',
							'options'	=> array(
								'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
								'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
								'full-width'	=> __( 'Full Width','wpbn' )
							),
							'default'	=> 'full-width',
						),

						array(
							'id'		=> 'woocommerce_shop_columns',
							'type'		=> 'select',
							'title'		=> __( 'Shop Columns', 'wpbn' ),
							'subtitle'	=> __( 'Select how many columns you want for the main WooCommerce shop.', 'wpbn' ),
							'options'	=> array(
								'2'	=> '2',
								'3'	=> '3',
								'4'	=> '4'
							),
							'default'	=> '4',
						),


						array(
							'id'		=> 'woo_shop_title',
							'type'		=> 'switch',
							'title'		=> __( 'Shop Title', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the main shop page title on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_shop_sort',
							'type'		=> 'switch',
							'title'		=> __( 'Shop Sort', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the main shop "sortby" function on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_shop_result_count',
							'type'		=> 'switch',
							'title'		=> __( 'Shop Result Count', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the main shop result count function on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_entry_style',
							'type'		=> 'select',
							'title'		=> __( 'Product Entry Style', 'wpbn' ),
							'subtitle'	=> __( 'Select your preferred style for your WooCommmerce product entries.', 'wpbn' ),
							'desc'		=> '',
							'options'	=> array(
								'one'		=> __( 'Style 1','wpbn' ),
								'two'		=> __( 'Style 2','wpbn' ),
							),
							'default'	=> 'two',
						),

						array(
							'id'		=> 'woo_product_entry_style',
							'type'		=> 'select',
							'title'		=> __( 'Product Entry Media', 'wpbn' ),
							'subtitle'	=> __( 'Select your preferred style for your WooCommmerce product entry media.', 'wpbn' ),
							'desc'		=> '',
							'options'	=> array(
								'featured-image'	=> __( 'Featured Image','wpbn' ),
								'image-swap'		=> __( 'Image Swap','wpbn' ),
								'gallery-slider'	=> __( 'Gallery Slider','wpbn' ),
							),
							'default'	=> 'image-swap',
						),

						/**
							WooCommerce => Single Product
						**/
						array(
							'id'	=> 'multi-info',
							'type'	=> 'info',
							'title'	=> false,
							'desc'	=> __( 'WooCommerce: Single Product', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_shop_single_title',
							'type'		=> 'text',
							'title'		=> __( 'Single Product Shop Title', 'wpbn' ),
							'desc'		=> '',
							'subtitle'	=> __( 'Enter your custom shop title for single products.', 'wpbn' ),
							'default'	=> __( 'Products', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_product_layout',
							'type'		=> 'select',
							'title'		=> __( 'Product Post Layout', 'wpbn' ),
							'subtitle'	=> __( 'Select your preferred layout for your WooCommmerce products.', 'wpbn' ),
							'desc'		=> '',
							'options'	=> array(
								'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
								'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
								'full-width'	=> __( 'Full Width','wpbn' )
							),
							'default'	=> 'left-sidebar'
						),

						array(
							'id'		=> 'woocommerce_upsells_count',
							'type'		=> 'text',
							'title'		=> __( 'Up-Sells Count', 'wpbn' ),
							'subtitle'	=> __( 'Enter the ammount of up-sell items to display on product pages.', 'wpbn' ),
							'default'	=> '0',
						),

						array(
							'id'		=> 'woocommerce_upsells_columns',
							'type'		=> 'select',
							'title'		=> __( 'Up-Sells Columns', 'wpbn' ),
							'subtitle'	=> __( 'Select how many columns you want for the up-sells section.', 'wpbn' ),
							'options'	=> array(
								'2'	=> '2',
								'3'	=> '3',
								'4'	=> '4'
							),
							'default'	=> '3',
						),

						array(
							'id'		=> 'woocommerce_related_count',
							'type'		=> 'text',
							'title'		=> __( 'Related Items Count', 'wpbn' ),
							'subtitle'	=> __( 'Enter the ammount of related items to display on product pages. Enter "0" to disable.', 'wpbn' ),
							'default'	=> '3',
						),

						array(
							'id'		=> 'woocommerce_related_columns',
							'type'		=> 'select',
							'title'		=> __( 'Related Products Columns', 'wpbn' ),
							'subtitle'	=> __( 'Select how many columns you want for the related products section.', 'wpbn' ),
							'options'	=> array(
								'2'	=> '2',
								'3'	=> '3',
								'4'	=> '4'
							),
							'default'	=> '3',
						),

						array(
							'id'		=> 'woo_product_meta',
							'type'		=> 'switch',
							'title'		=> __( 'Product Meta', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the product meta (Categories/Tags) on product posts on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_product_tabs_headings',
							'type'		=> 'switch',
							'title'		=> __( 'Product Tabs: Headings', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the headings at the top of the product tabs on or off.', 'wpbn' ),
							"default"	=> '0',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						array(
							'id'		=> 'woo_next_prev',
							'type'		=> 'switch',
							'title'		=> __( 'Products Next/Prev Links', 'wpbn' ),
							'subtitle'	=> __( 'Toggle the next and previous pagination on product posts on or off.', 'wpbn' ),
							"default"	=> '1',
							'on'		=> __( 'On', 'wpbn' ),
							'off'		=> __( 'Off', 'wpbn' ),
						),

						/**
							WooCommerce => Styling
						**/
						array(
							'id'	=> 'multi-info',
							'type'	=> 'info',
							'title'	=> false,
							'desc'	=> __( 'WooCommerce: Styling', 'wpbn' ),
						),

						array(
							'id'				=> 'onsale_bg',
							'type'				=> 'color_gradient',
							'title'				=> __( 'On Sale Background', 'wpbn' ),
							'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
							'transparent'		=> false,
							'target_element'	=> 'ul.products li.product .onsale, .single-product .onsale',
							'default'			=> array(
								'from'	=> '',
								'to'	=> ''
							),
						),

						array(
							'id'					=> 'woo_product_title_link_color',
							'type'					=> 'link_color',
							'title'					=> __( 'Product Entry Title Color', 'wpbn' ),
							'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
							'default'				=> array(
								'regular'	=> '',
								'hover'		=> '',
								'active'	=> '',
							),
							'target_element'		=> 'body .product-entry .product-entry-title a',
							'target_element_hover'	=> 'body .product-entry .product-entry-title a:hover',
							'target_element_active'	=> 'body .product-entry .product-entry-title a:active',
							'target_style'			=> 'color',
						),

						array(
							'id'				=> 'woo_single_price_color',
							'type'				=> 'color',
							'title'				=> __( 'Single Product Price Color', 'wpbn' ),
							'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
							'transparent'		=> false,
							'target_element'	=> 'div.product p.price ins span.amount',
							'target_style'		=> 'color',
							'default'			=> ''
						),

						array(
							'id'				=> 'woo_stars_color',
							'type'				=> 'color',
							'title'				=> __( 'Star Ratings Color', 'wpbn' ),
							'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
							'transparent'		=> false,
							'target_element'	=> '.star-rating span',
							'target_style'		=> 'color',
							'default'			=> ''
						),

						array(
							'id'				=> 'woo_single_tabs_active_border_color',
							'type'				=> 'color',
							'title'				=> __( 'Product Tabs Active Border Color', 'wpbn' ),
							'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
							'transparent'		=> false,
							'target_element'	=> 'div.product .woocommerce-tabs ul.tabs li.active a',
							'target_style'		=> 'border-color',
							'default'			=> ''
						),

					),
				);

			}


			/**
				Blog
			**/
			$this->sections[] = array(
				'id'			=> 'blog',
				'icon'			=> 'el-icon-edit',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Blog', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'blog_page',
						'type'		=> 'select',
						'data'		=> 'pages',
						'title'		=> __( 'Blog Page', 'wpbn' ),
						'subtitle'	=> __( 'Select your main blog page. This is used for your breadcrumbs.', 'wpbn' ),
						'default'	=> '',
					),

					array(
						'id'		=> 'blog_cats_exclude',
						'type'		=> 'select',
						'data'		=> 'categories',
						'multi'		=> true,
						'title'		=> __( 'Exclude Categories From Blog', 'wpbn' ),
						'subtitle'	=> __( 'Use this option to exclude categories from your main blog template and/or your index (if using the homepage as a blog)', 'wpbn' ),
					),

					/**
							Blog => Archives
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Blog: Archives', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_style',
						'type'		=> 'select',
						'title'		=> __( 'Blog Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred blog style.', 'wpbn' ),
						'options'	=> array(
							'large-image-entry-style'	=> __( 'Large Image','wpbn' ),
							'thumbnail-entry-style'		=> __( 'Thumbnail','wpbn' ),
							'grid-entry-style'			=> __( 'Grid','wpbn' )
						),
						'default'	=> 'large-image-entry-style'
					),

					array(
						'id'		=> 'blog_grid_columns',
						'type'		=> 'select',
						'title'		=> __( 'Grid Style Columns', 'wpbn' ),
						'subtitle'	=> __( 'Select how many columns you want for your grid style blog archives.', 'wpbn' ),
						'options'	=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4'
						),
						'default'	=> '2',
						'required'	=> array('blog_style','equals','grid-entry-style'),
					),

					array(
						'id'		=> 'blog_archives_layout',
						'type'		=> 'select',
						'title'		=> __( 'Blog Archives Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your main blog page, categories and tags.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'right-sidebar'
					),

					array(
						'id'		=> 'blog_pagination_style',
						'type'		=> 'select',
						'title'		=> __( 'Pagination Style', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred pagination style for the blog.', 'wpbn' ),
						'options'	=> array(
							'standard'			=> __( 'Standard','wpbn' ),
							'infinite_scroll'	=> __( 'Infinite Scroll','wpbn' ),
							'next_prev'			=> __( 'Next/Prev','wpbn' )
						),
						'default'	=> 'standard'
					),

					array(
						'id'		=> 'blog_entry_image_hover_animation',
						'type'		=> 'select',
						'title'		=> __( 'Entry Image Hover Animation', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred animation style for blog entry images.', 'wpbn' ),
						'options'	=> $image_hovers,
						'default'	=> 'standard'
					),

					array(
						'id'	=> 'blog_exceprt',
						'type'	=> 'switch',
						'title'	=> __( 'Entry Auto Excerpts', 'wpbn' ),
						'subtitle'=> __( 'Toggle your blog auto excerpts on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'	=> __( 'On', 'wpbn' ),
						'off'	=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_excerpt_length',
						'type'		=> 'text',
						'title'		=> __( 'Entry Excerpt length', 'wpbn' ),
						'desc'		=> '',
						'subtitle'	=> __( 'How many words do you want to show for your blog entry excerpts?', 'wpbn' ),
						'default'	=> '40',
						'class'		=> 'small-text',
						'required'	=> array( 'blog_exceprt', 'equals', '1' ),
					),

					array(
						'id'		=> 'blog_entry_readmore',
						'type'		=> 'switch',
						'title'		=> __( 'Entry Read More Button', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the blog entry read more button on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_entry_author_avatar',
						'type'		=> 'switch',
						'title'		=> __( 'Entry Author Avatar', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the author avatar on your blog entries on or off. Note: This option only applies to certain blog styles.', 'wpbn' ),
						"default"	=> 0,
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
						'required'	=> array('blog_style','equals','large-image-entry-style'),
					),

					/**
							Blog => Single Post
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Blog: Single Post', 'wpbn' ),
					),
					array(
						'id'		=> 'blog_single_layout',
						'type'		=> 'select',
						'title'		=> __( 'Post Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your single posts. This setting can be overwritten on a per post basis via the meta options.', 'wpbn' ),
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'right-sidebar'
					),

					array(
						'id'		=> 'blog_single_thumbnail',
						'type'		=> 'switch',
						'title'		=>  __( 'Post Featured Image', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of featured images on single blog posts on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_bio',
						'type'		=> 'switch',
						'title'		=> __( 'Post Author Bio', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the author bio box on single blog posts on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_tags',
						'type'		=> 'switch',
						'title'		=> __( 'Post Tags', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the post tags display on single blog posts on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_related',
						'type'		=> 'switch',
						'title'		=> __( 'Post Related Articles', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the related articles section on single blog posts on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_related_count',
						'type'		=> 'text',
						'title'		=> __( 'Post Related Articles Count', 'wpbn' ),
						'subtitle'	=> __( 'Enter the number of related items to display.', 'wpbn' ),
						"default"	=> '3',
						'required'	=> array( 'blog_related', 'equals', '1' ),
					),

					array(
						'id'		=> 'blog_related_excerpt_length',
						'type'		=> 'text',
						'title'		=> __( 'Post Related Articles Excerpt Length', 'wpbn' ),
						'subtitle'	=> __( 'How many words to display for the related articles excerpt?', 'wpbn' ),
						"default"	=> '15',
						'required'	=> array( 'blog_related', 'equals', '1' ),
					),

					/**
							Blog => Other
					**/
					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Blog: Archives', 'wpbn' ),
					),

					array(
						'id'		=> 'breadcrumbs_blog_cat',
						'type'		=> 'switch',
						'title'		=> __( 'Category In Breadcrumbs', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of the category in breadcrumbs on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'post_series',
						'type'		=> 'switch',
						'title'		=> __( 'Post Series', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the post series custom taxonomy on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

				),

			);


			/**
				Images
			**/
			$this->sections[] = array(
				'icon'	=> 'el-icon-camera',
				'icon_class'	=> 'el-icon-large',
				'title'	=> __( 'Image Cropping', 'wpbn' ),
				'submenu'	=> true,
				'fields'	=> array(

					array(
						'id'	=> 'image_resizing',
						'type'	=> 'switch',
						'title'	=> __( 'Image Cropping', 'wpbn' ),
						'subtitle'=> __( 'Toggle the built-in image resizing function on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'	=> __( 'On', 'wpbn' ),
						'off'	=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'	=> 'retina',
						'type'	=> 'switch',
						'title'	=> __( 'Retina Support', 'wpbn' ),
						'subtitle'=> __( 'Toggle the retina support for your resized images on or off.', 'wpbn' ),
						"default"	=> 0,
						'on'	=> __( 'On', 'wpbn' ),
						'off'	=> __( 'Off', 'wpbn' ),
					),

					array(
						"title"	=> __( 'Blog Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"	=> "blog_entry_image_width",
						"default"	=> '680',
						"type"	=> "text",
					),

					array(
						"title"		=> __( 'Blog Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"	=> "blog_entry_image_height",
						"default"	=> '380',
						"type"	=> "text",
					),

					array(
						"title"		=> __( 'Blog Post: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"	=> "blog_post_image_width",
						"default"	=> '680',
						"type"	=> "text",
					),

					array(
						"title"	=> __( 'Blog Post: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"	=> "blog_post_image_height",
						"default"	=> '380',
						"type"	=> "text",
					),

					array(
						"title"	=> __( 'Blog Full-Width Post: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"	=> "blog_post_full_image_width",
						"default"	=> '980',
						"type"	=> "text",
					),

					array(
						"title"		=> __( 'Blog Full-Width Post: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"	=> "blog_post_full_image_height",
						"default"	=> '9999',
						"type"	=> "text",
					),

					array(
						"title"	=> __( 'Blog Related Posts: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"	=> "blog_related_image_width",
						"default"	=> '680',
						"type"	=> "text",
					),

					array(
						"title"		=> __( 'Blog Related Posts: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"	=> "blog_related_image_height",
						"default"	=> '380',
						"type"	=> "text",
					),

					array(
						"title"		=> __( 'Portfolio Archive Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "portfolio_entry_image_width",
						"default"	=> '500',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Portfolio Archive Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "portfolio_entry_image_height",
						"default"	=> '350',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Staff Archive Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "staff_entry_image_width",
						"default"	=> '500',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Staff Archive Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "staff_entry_image_height",
						"default"	=> '500',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Testimonial Archive Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "testimonial_entry_image_width",
						"default"	=> '45',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Testimonial Archive Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "testimonial_entry_image_height",
						"default"	=> '45',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "woo_entry_width",
						"default"	=> '480',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "woo_entry_height",
						"default"	=> '540',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Post: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "woo_post_image_width",
						"default"	=> '480',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Post: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "woo_post_image_height",
						"default"	=> '540',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Category Entry: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "woo_cat_entry_width",
						"default"	=> '',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'WooCommerce Category Entry: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "woo_cat_entry_height",
						"default"	=> '',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Custom WP Gallery: Image Width', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom width in pixels.', 'wpbn' ),
						"id"		=> "gallery_image_width",
						"default"	=> '500',
						"type"		=> "text",
					),

					array(
						"title"		=> __( 'Custom WP Gallery: Image Height', 'wpbn' ),
						"subtitle"	=> __( 'Enter your custom height in pixels. Enter 9999 to keep your image proportions.', 'wpbn' ),
						"id"		=> "gallery_image_height",
						"default"	=> '500',
						"type"		=> "text",
					),
				)
			);

			/**
				404
			**/
			$this->sections[] = array(
				'icon'			=> 'el-icon-error',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( '404 Page', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'error_page_redirect',
						'type'		=> 'switch',
						'title'		=> __( 'Redirect 404', 'wpbn' ),
						'subtitle'	=> __( 'Toggle on to redirect all 404 errors to your homepage. Some people think this is good for SEO.', 'wpbn' ),
						"default"	=> '',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'error_page_title',
						'type'		=> 'text',
						'title'		=> __( '404 Page Title', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom title for the 404 page.', 'wpbn' ),
						"default"	=> '',
						'required'	=> array( 'error_page_redirect', '!=', '1' ),
					),

					array(
						'id'		=> 'error_page_text',
						'type'		=> 'editor',
						'title'		=> __( '404 Page Content', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom content for the 404 page.', 'wpbn' ),
						"default"	=> '',
						'required'	=> array( 'error_page_redirect', '!=', '1' ),
					),

					array(
						'id'		=> 'error_page_styling',
						'type'		=> 'switch',
						'title'		=> __( '404 Page Custom Styling', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the custom styling for the 404 page content area (larger and lighter font) on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
						'required'	=> array( 'error_page_redirect', '!=', '1' ),
					),
				),
			);


			/**
				Footer
			**/
			$this->sections[] = array(
				'id'			=> 'footer',
				'icon'			=> 'el-icon-bookmark',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Footer', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'callout',
						'type'		=> 'switch',
						'title'		=> __( 'Footer Callout', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the callout area in the footer on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'callout_visibility',
						'type'		=> 'select',
						'title'		=> __( 'Callout Visibility', 'wpbn' ),
						'subtitle'	=> __( 'Select your callout visibility.', 'wpbn' ),
						'options'	=> $visibility,
						'default'	=> 'always-visible',
						'required'	=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'callout_text',
						'type'				=> 'editor',
						'title'				=> __( 'Footer Callout: Content', 'wpbn' ),
						'subtitle'			=> __( 'Enter your custom content for your footer callout.', 'wpbn' ),
						'default'			=> 'I am the footer call-to-action block, here you can add some relevant/important information about your company or product. I can be disabled in the theme options.',
						'required'			=> array( 'callout', 'equals', '1' ),
						'editor_options'	=> '',
					),

					array(
						'id'		=> 'callout_link',
						'type'		=> 'text',
						'title'		=> __( 'Footer Callout: Link', 'wpbn' ),
						'subtitle'	=> __( 'Enter a url for your footer callout button. Leave blank to disable and show the content full-width.', 'wpbn' ),
						'default'	=> 'http://www.wpbnplorer.com',
						'required'	=> array('callout','equals','1'),
					),

					array(
						'id'		=> 'callout_link_txt',
						'type'		=> 'text',
						'title'		=> __( 'Footer Callout: Link Text', 'wpbn' ),
						'subtitle'	=> __( 'Enter the text for your footer callout link.', 'wpbn' ),
						'default'	=> 'Get In Touch',
						'required'	=> array('callout','equals','1'),
					),

					array(
						'id'				=> 'footer_callout_bg',
						'type'				=> 'color',
						'title'				=> __( 'Footer Callout: Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer-callout-wrap',
						'target_style'		=> 'background-color',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'footer_callout_border',
						'type'				=> 'color',
						'title'				=> __( 'Footer Callout: Border Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer-callout-wrap',
						'target_style'		=> 'border-top-color',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'footer_callout_color',
						'type'				=> 'color',
						'title'				=> __( 'Footer Callout: Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> '',
						'transparent'		=> false,
						'target_element'	=> '#footer-callout-wrap',
						'target_style'		=> 'color',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'					=> 'footer_callout_link_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Footer Callout: Content Link Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'target_element'		=> '.footer-callout-content a',
						'target_element_hover'	=> '.footer-callout-content a:hover',
						'target_element_active'	=> '.footer-callout-content a:active',
						'target_style'			=> 'color',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'footer_callout_button_bg',
						'type'				=> 'color_gradient',
						'title'				=> __( 'Footer Callout: Button Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> array(
							'from'	=> '',
							'to'	=> ''
						),
						'transparent'		=> false,
						'target_element'	=> '#footer-callout .theme-button',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'footer_callout_button_color',
						'type'				=> 'color',
						'title'				=> __( 'Footer Callout: Button Text Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=>false,
						'default'			=> '',
						'target_element'	=> '#footer-callout .theme-button',
						'required'			=> array( 'callout', 'equals', '1' ),
						'target_style'		=> 'color',
					),

					array(
						'id'				=> 'footer_callout_button_hover_bg',
						'type'				=> 'color_gradient',
						'title'				=> __( 'Footer Callout: Button Hover Background', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'			=> array(
							'from'	=> '',
							'to'	=> ''
						),
						'transparent'		=> false,
						'target_element'	=> '#footer-callout .theme-button:hover',
						'required'			=> array( 'callout', 'equals', '1' ),
					),

					array(
						'id'				=> 'footer_callout_button_hover_color',
						'type'				=> 'color',
						'title'				=> __( 'Footer Callout: Button Hover Text Color', 'wpbn' ),
						'subtitle'			=> __( 'Select your custom hex color.', 'wpbn' ),
						'transparent'		=>false,
						'default'			=> '',
						'target_element'	=> '#footer-callout .theme-button:hover',
						'required'			=> array( 'callout', 'equals', '1' ),
						'target_style'		=> 'color',
					),

					array(
						'id'			=> 'callout_button_target',
						'type'			=> 'select',
						'title'			=> __( 'Footer Callout: Button Target', 'wpbn' ),
						'subtitle'		=> __( 'Select your footer callout button link target window.', 'wpbn' ),
						'options'		=> array(
							'blank'	=> __( 'New Window', 'wpbn' ),
							'self'	=> __( 'Same Window', 'wpbn' )
						),
						'default'		=> 'blank',
						'required'		=> array('callout','equals','1'),
					),

					array(
						'id'		=> 'callout_button_rel',
						'type'		=> 'select',
						'title'		=> __( 'Footer Callout: Button Rel', 'wpbn' ),
						'subtitle'	=> __( 'Select your footer callout button link rel value.', 'wpbn' ),
						'options'	=> array('dofollow'=> 'dofollow','nofollow'=> 'nofollow'),
						'default'	=> 'dofollow',
						'required'	=> array('callout','equals','1'),
					),

					array(
						'id'		=> 'callout_button_border_radius',
						'type'		=> 'text',
						'title'		=> __( 'Footer Callout: Button Border Radius', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom border radius for the callout button in px.', 'wpbn' ),
						'required'	=> array('callout','equals','1'),
					),

					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Footer Widgets', 'wpbn' ),
					),

					array(
						'id'		=> 'footer_widgets',
						'type'		=> 'switch',
						'title'		=> __( 'Footer Widgets', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the footer widgets on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'footer_col',
						'type'		=> 'select',
						'title'		=> __( 'Footer Widget Columns', 'wpbn' ),
						'subtitle'	=> __( 'Select how many columns you want for your footer widgets.', 'wpbn' ),
						'desc'		=> '',
						'options'	=> array(
							'4'	=> '4',
							'3'	=> '3',
							'2'	=> '2',
							'1'	=> '1',
						),
						'default'	=> '4',
						'required'	=> array('footer_widgets','equals','1'),
					),

					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Bottom Footer Area', 'wpbn' ),
					),

					array(
						'id'		=> 'footer_copyright',
						'type'		=> 'switch',
						'title'		=> __( 'Bottom Footer Area', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the bottom footer area on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'				=> 'footer_copyright_text',
						'type'				=> 'editor',
						'title'				=> __( 'Copyright', 'wpbn' ),
						'subtitle'			=> __( 'Enter your custom copyright text.', 'wpbn' ),
						'default'			=> 'Copyright 2013 - All Rights Reserved',
						'required'			=> array('footer_copyright','equals','1'),
						'editor_options'	=> '',
					),

					array(
						'id'	=> 'multi-info',
						'type'	=> 'info',
						'title'	=> false,
						'desc'	=> __( 'Scroll Up Button', 'wpbn' ),
					),

					array(
						'id'		=> 'scroll_top',
						'type'		=> 'switch',
						'title'		=> __( 'Scroll Up Button', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the scroll to top button on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'scroll_top_border_radius',
						'type'		=> 'text',
						'title'		=> __( 'Scroll Up Button Border Radius', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom border radius for the scroll top button. Default is 35px.', 'wpbn' ),
						'required'	=> array('scroll_top','equals','1'),
					),

					array(
						'id'			=> 'scroll_top_bg',
						'type'			=> 'link_color',
						'title'			=> __( 'Scroll Up Button Background', 'wpbn' ),
						'subtitle'		=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'		=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'required'				=> array('scroll_top','equals','1'),
						'target_element'		=> '#site-scroll-top',
						'target_element_hover'	=> '#site-scroll-top:hover',
						'target_element_active'	=> '#site-scroll-top:active',
						'target_style'			=> 'background',
					),

					array(
						'id'					=> 'scroll_top_border',
						'type'					=> 'link_color',
						'title'					=> __( 'Scroll Up Button Border', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'required'				=> array('scroll_top','equals','1'),
						'target_element'		=> '#site-scroll-top',
						'target_element_hover'	=> '#site-scroll-top:hover',
						'target_element_active'	=> '#site-scroll-top:active',
						'target_style'			=> 'border-color',
					),

					array(
						'id'					=> 'scroll_top_color',
						'type'					=> 'link_color',
						'title'					=> __( 'Scroll Up Button Color', 'wpbn' ),
						'subtitle'				=> __( 'Select your custom hex color.', 'wpbn' ),
						'default'				=> array(
							'regular'	=> '',
							'hover'		=> '',
							'active'	=> '',
						),
						'required'				=> array('scroll_top','equals','1'),
						'target_element'		=> '#site-scroll-top',
						'target_element_hover'	=> '#site-scroll-top:hover',
						'target_element_active'	=> '#site-scroll-top:active',
						'target_style'			=> 'color',
					),
				)
			);


			/**
				Social
			**/
			$this->sections[] = array(
				'icon'	=> 'el-icon-twitter',
				 'icon_class'	=> 'el-icon-large',
				'title'	=> __( 'Social Sharing', 'wpbn' ),
				'submenu'	=> true,
				'fields'	=> array(

					array(
						'id'		=> 'social_share_position',
						'type'		=> 'select',
						'title'		=> __( 'Social Sharing Position', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred social sharing buttons position.', 'wpbn' ),
						'desc'		=> '',
						'options'	=> array(
							'vertical'		=> __( 'Vertical','wpbn' ),
							'horizontal'	=> __( 'Horizontal','wpbn' )
						),
						'default'	=> 'vertical'
					),

					array(
						'id'		=> 'social_share_style',
						'type'		=> 'select',
						'title'		=> __( 'Social Sharing Style social sharing buttons position.', 'wpbn' ),
						'desc'		=> '',
						'options'	=> array(
							'minimal'	=> __( 'Minimal','wpbn' ),
							'flat'		=> __( 'Flat','wpbn' ),
							'three-d'	=> __( '3D','wpbn' ),
							// Not quite ready yet for release 'counter'	=> __( 'Counter','wpbn' )
						),
						'default'	=> 'minimal'
					),

					array(
						'id'		=> 'social_share_blog_posts',
						'type'		=> 'switch',
						'title'		=> __( 'Blog Posts: Social Share', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social sharing for this section of your site on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'social_share_blog_entries',
						'type'		=> 'switch',
						'title'		=> __( 'Blog Entries: Social Share', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social sharing icons on your blog entries on or off. Note: They will only display on the Large Image style blog entries && for the vertical social position.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
						'required'	=> array( 'social_share_position', 'equals', 'vertical' ),
					),

					array(
						'id'		=> 'social_share_pages',
						'type'		=> 'switch',
						'title'		=> __( 'Pages: Social Share', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social sharing for this section of your site on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'social_share_portfolio',
						'type'		=> 'switch',
						'title'		=> __( 'Portfolio: Social Share', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social sharing for this section of your site on or off.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'social_share_woo',
						'type'		=> 'switch',
						'title'		=> __( 'WooCommerce: Social Share', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the social sharing for this section of your site on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'social_share_sites',
						'type'		=> 'checkbox',
						'title'		=> __( 'Social Sharing Links', 'wpbn' ),
						'subtitle'	=> __( 'Select the social sharing links to include in the social sharing function.', 'wpbn' ),
						'options'	=> array(
							'twitter'		=> 'Twitter',
							'facebook'		=> 'Facebook',
							'google_plus'	=> 'Google Plus',
							'pinterest'		=> 'Pinterest',
							'linkedin'		=> 'LinkedIn',
						),
						'default'	=> array(
							'twitter'		=> '1',
							'facebook'		=> '1',
							'google_plus'	=> '1',
							'pinterest'		=> '1',
							'linkedin'		=> false,
						)
					),
				),
			);


			/**
				SEO
			**/
			$this->sections[] = array(
				'id'			=> 'seo',
				'icon'			=> 'el-icon-search',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'SEO', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'sidebar_headings',
						'type'		=> 'select',
						'title'		=> __( 'Sidebar Widget Title Headings', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred heading type.', 'wpbn' ),
						'desc'		=> '',
						'options'	=> array(
							'h2'	=> 'h2',
							'h3'	=> 'h3',
							'h4'	=> 'h4',
							'h5'	=> 'h5',
							'h6'	=> 'h6',
							'span'	=> 'span',
							'div'	=> 'div',
						),
						'default'	=> 'div'
					),

					array(
						'id'		=> 'footer_headings',
						'type'		=> 'select',
						'title'		=> __( 'Footer Widget Title Headings', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred heading type.', 'wpbn' ),
						'options'	=> array(
							'h2'	=> 'h2',
							'h3'	=> 'h3',
							'h4'	=> 'h4',
							'h5'	=> 'h5',
							'h6'	=> 'h6',
							'span'	=> 'span',
							'div'	=> 'div',
						),
						'default'	=> 'div'
					),

					array(
						'id'		=> 'breadcrumbs',
						'type'		=> 'switch',
						'title'		=> __( 'Breadcrumbs', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the site breadcrumbs on or off', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'				=> 'breadcrumbs_position',
						'type'				=> 'select',
						'title'				=> __( 'Breadcrumbs: Position', 'wpbn' ),
						'subtitle'			=> __( 'Select your preferred breadcrumbs style.', 'wpbn' ),
						'options'			=> array(
							'default'		=> __( 'Default', 'wpbn' ),
							'under-title'	=> __( 'Under Title', 'wpbn' ),
						),
						'default'	=> 'default',
						'required'	=> array('breadcrumbs','equals','1'),
					),

					array(
						'id'		=> 'breadcrumbs_home_title',
						'type'		=> 'text',
						'title'		=> __( 'Breadcrumbs: Custom Home Title', 'wpbn' ),
						'subtitle'	=> __( 'Enter your custom breadcrumbs home title. You can enter HTML if you want to display an icon instead (just like adding icons to your menu using FontAwesome).', 'wpbn' ),
						"default"	=> '',
						'required'	=> array( 'breadcrumbs', 'equals', '1' ),
					),

					array(
						'id'		=> 'breadcrumbs_title_trim',
						'type'		=> 'text',
						'title'		=> __( 'Breadcrumbs: Title Trim Length', 'wpbn' ),
						'subtitle'	=> __( 'Enter the max number of words to display for your breadcrumbs post title.', 'wpbn' ),
						"default"	=> '4',
						'required'	=> array('breadcrumbs','equals','1'),
					),

					array(
						'id'		=> 'remove_posttype_slugs',
						'type'		=> 'switch',
						'title'		=> __( 'Remove Custom Post Type Slugs (Experimental)', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the slug on/off for your custom post types (portfolio, staff, testimonials). Custom Post Types in WordPress by default should have a slug to prevent conflicts, you can use this setting to disable them, but be careful.', 'wpbn' ),
						'default'	=> '',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'remove_scripts_version',
						'type'		=> 'switch',
						'title'		=> __( 'Remove Version Parameter From JS & CSS Files', 'wpbn' ),
						'subtitle'	=> __( 'Most scripts and style-sheets called by WordPress include a query string identifying the version. This can cause issues with caching and such, which will result in less than optimal load times. You can toggle this setting on to remove the query string from such strings.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'remove_header_junk',
						'type'		=> 'switch',
						'title'		=> __( 'Cleanup WP Head', 'wpbn' ),
						'subtitle'	=> __( 'Enable to clean up your site\'s header from auto code added by WP, such as the WP version.', 'wpbn' ),
						"default"	=> '1',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),
				),
			);


			/**
				Other
			**/
			$this->sections[] = array(
				'id'			=> 'other',
				'icon'			=> 'el-icon-wrench',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Other', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'page_single_layout',
						'type'		=> 'select',
						'title'		=> __( 'Page Layout', 'wpbn' ),
						'subtitle'	=> __( 'Select your preferred layout for your pages. This setting can be overwritten on a per page basis via the meta options.', 'wpbn' ),
						'desc'		=> '',
						'options'	=> array(
							'right-sidebar'	=> __( 'Right Sidebar','wpbn' ),
							'left-sidebar'	=> __( 'Left Sidebar','wpbn' ),
							'full-width'	=> __( 'Full Width','wpbn' )
						),
						'default'	=> 'right-sidebar',
					),

					array(
						'id'		=> 'custom_wp_gallery',
						'type'		=> 'switch',
						'title'		=> __( 'Custom WordPress Gallery Output', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the built-in custom WordPress gallery output on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'blog_dash_thumbs',
						'type'		=> 'switch',
						'title'		=> __( 'Dashboard Featured Images', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of featured images in your WP dashboard on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'page_comments',
						'type'		=> 'switch',
						'title'		=> __( 'Comments on Pages', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the display of comments in pages on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'widget_icons',
						'type'		=> 'switch',
						'title'		=> __( 'Widget Icons', 'wpbn' ),
						'subtitle'	=> __( 'Certain widgets include little icons such as the recent posts widget. Here you can toggle the icons on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'jpeg_100',
						'type'		=> 'switch',
						'title'		=> __( 'JPEG 100% Quality', 'wpbn' ),
						'subtitle'	=> __( 'By default images cropped with WordPress are resized/cropped at 90% quality. Enable this setting to set all JPEGs to 100% quality.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'remove_jetpack_devicepx',
						'type'		=> 'switch',
						'title'		=> __( 'Remove Jetpack devicepx script', 'wpbn' ),
						'subtitle'	=> __( 'Toggle the jetpack devicepx script on/off. The file is used to optionally load retina/HiDPI versions of files (Gravatars etc) which are known to support it, for devices that run at a higher resolution. But can be disabled to prevent the extra js call.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'search_posts_per_page',
						'type'		=> 'text',
						'title'		=> __( 'Search Posts Per Page', 'wpbn' ),
						'subtitle'	=> __( 'How many posts do you wish to display on your search page before pagination?', 'wpbn' ),
						"default"	=> '10',
					),

				),
			);


			/**
				Custom CSS
			**/
			$this->sections[] = array(
				'icon'			=> 'el-icon-css',
				'icon_class'	=> 'el-icon-large',
				'title'			=> __( 'Custom CSS', 'wpbn' ),
				'submenu'		=> true,
				'fields'		=> array(

					array(
						'id'		=> 'custom_css',
						'type'		=> 'ace_editor',
						'mode'		=> 'css',
						'theme'		=> 'chrome',
						'title'		=> __( 'Design Edits', 'wpbn' ),
						'subtitle'	=> __( 'Quickly add some CSS to your theme to make design adjustments by adding it to this block. It is a much better solution then manually editing style.css', 'wpbn' ),
					),
				),
			);


			/**
				Auto Updates
			**/
			$wpbn_docs_img_url = get_template_directory_uri() . '/images/docs/';
			$this->sections[] = array(
				'icon_class'	=> 'el-icon-large',
				'icon'			=> 'el-icon-retweet',
				'title'			=> __( 'Theme Updates', 'wpbn' ),'submenu'	=> true,
				'fields'		=> array(

					array(
						'id'		=> 'enable_auto_updates',
						'type'		=> 'switch',
						'title'		=> __( 'Enable Auto Updates', 'wpbn' ),
						'subtitle'	=> __( 'You can toggle the automatic updates for your theme on or off.', 'wpbn' ),
						"default"	=> '0',
						'on'		=> __( 'On', 'wpbn' ),
						'off'		=> __( 'Off', 'wpbn' ),
					),

					array(
						'id'		=> 'envato_license_key',
						'type'		=> 'text',
						'title'		=> __( 'Item Purchase Code', 'wpbn' ),
						'subtitle'	=> __( 'Enter your Envato license key here if you wish to receive auto updates for your theme.', 'wpbn' ) .'<br /><br /><img src="'. $wpbn_docs_img_url .'envato-license-key.png" />',
						'required'	=> array('enable_auto_updates','equals','1'),
					),
				),
			);

			/**
				Import/Export
			**/
			$this->sections[] = array(
				'title'		=> __( 'Import / Export', 'wpbn' ),
				'icon'		=> 'el-icon-refresh',
				'fields'	=> array(

					array(
						'id'			=> 'opt-import-export',
						'type'			=> 'import_export',
						'title'			=> 'Import Export',
						'subtitle'		=> 'Save and restore your Redux options',
						'full_width'	=> false,
					),
				),
			);

		} // End setSections

		public function setArguments() {

			global $wp_version;
			$wpbn_redux_heading_dashicon = $wp_version >= 3.8 ? '<span class="dashicons dashicons-admin-generic"></span>' : '';

			$this->args = array(

				// TYPICAL -> Change these values as you need/desire
				'opt_name'			=> 'wpbn_options', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'		=> $wpbn_redux_heading_dashicon . __( 'Theme Options Panel','wpbn' ), // Name that appears at the top of your panel
				'display_version'	=> '', // Version that appears at the top of your panel
				'menu_type'			=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'	=> true, // Show the sections below the admin menu item or not
				'menu_title'		=> __( 'Theme Options', 'wpbn' ),
				'page'				=> __( 'Theme Options', 'wpbn' ),
				'google_api_key'	=> 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssIIƒ', // Must be defined to add google fonts to the typography module
				'global_variable'	=> '', // Set a different name for your global variable other than the opt_name
				'dev_mode'			=> false, // Show the time the page took to load, etc
				'customizer'		=> false, // Enable basic customizer support,
				'async_typography'	=> false, // Enable async for fonts

				// OPTIONAL -> Give you extra features
				'page_priority'		=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'		=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'	=> 'manage_options', // Permissions needed to access the options panel.
				'menu_icon'			=> '', // Specify a custom URL to an icon
				'last_tab'			=> '', // Force your panel to always open to a specific tab (by id)
				'page_icon'			=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
				'page_slug'			=> 'wpbn_options', // Page slug used to denote the panel
				'save_defaults'		=> true, // On load save the defaults to DB before user clicks save or not
				'default_show'		=> false, // If true, shows the default value next to each field that is not the default value.
				'default_mark'		=> '', // What to print by the field's title if the value shown is default. Suggested: *

				// CAREFUL -> These options are for advanced use only
				'transient_time'		=> 60 * MINUTE_IN_SECONDS,
				'output'				=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'			=> true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				//'domain'				=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
				'footer_credit'			=> "", // Disable the footer credit of Redux. Please leave if you can help it.
				'footer_text'			=> "",
				'show_import_export'	=> false,
				'system_info'			=> false,
				'help_tabs'				=> array(),
				'help_sidebar'			=> '', // __( '', $this->args['domain'] );

			);

		} // End setArguments

	} // End wpbn_Redux_Framework_Config class

	// Start our class
	$wpbn_redux_framework_class = new wpbn_Redux_Framework_Config();
}