<?php
/**
 * Total functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Media Interactive Studio
 * @since Media Interactive Studio 1.0
 */

include_once("functions/wp_bootstrap_navwalker.php");

// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'media-interactive-studio' ) );


add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function custom_post_type() {
    $labels = array(
        'name'               => _x( 'Parallax', 'general name' ),
        'singular_name'      => _x( 'Page', 'singular name' ),
        'add_new'            => _x( 'Add New', 'parallax' ),
        'add_new_item'       => __( 'Add New Page' ),
        'edit_item'          => __( 'Edit Page' ),
        'new_item'           => __( 'New Page' ),
        'all_items'          => __( 'All Pages' ),
        'view_item'          => __( 'View Page' ),
        'search_items'       => __( 'Search Pages' ),
        'not_found'          => __( 'No pages found' ),
        'not_found_in_trash' => __( 'No pages found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Parallax'
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => null,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', "custom-fields", "revisions", "post-formats"),
        'has_archive'   => true,
    );

    register_post_type(__( 'parallax' ), $args);
}

add_action( 'init', 'custom_post_type' );

function add_custom_meta_box_parallax() {
    add_meta_box(
        'parallax_template', // $id
        'Parallax Template', // $title
        'show_custom_meta_box_parallax', // $callback
        'parallax', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box_parallax');

$custom_meta_fields = array(
    array (
	    'label' => 'Template:',
	    'id'    => 'theme',
	    'type'  => 'radio',
	    'options' => array (
			'one' 	=> array ('label' => 'Section Logo', 'value' => 'logo'),
			'two' 	=> array ('label' => 'Section Recommend', 'value' => 'recommend'),
			'three' => array ('label' => 'Section Offer', 'value' => 'offer'),
			'four' 	=> array ('label' => 'Section PortFolio', 'value' => 'portfolio'),
			'five' 	=> array ('label' => 'Section Team', 'value' => 'team'),
			'six' 	=> array ('label' => 'Motywacyjne', 'value' => 'motywacyjne')
		)
	)
);

// The Callback
function show_custom_meta_box_parallax() {
global $custom_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	echo '<ul>';
    // Begin the field table and loop
    foreach ($custom_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br />';
                switch($field['type']) {
                    // radio
                    case 'radio':
                        foreach ( $field['options'] as $option ) {
                            echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
                                    <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
                        }
                    break;
                } //end switch
    } // end foreach
	echo '</ul>';
}

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;

    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }

    // loop through fields and save the data
    foreach ($custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            // delete_post_meta($post_id, $field['id'], $old);
			update_post_meta($post_id, $field['id'], '');
        }
    } // end foreach

}
add_action('save_post', 'save_custom_meta');



/*------------------------------------------------*/
/*	- ReduxFramework Admin Panel
/*------------------------------------------------*/

// Remove horrible Redux popup&tracking class
require_once( get_template_directory() . '/functions/redux/tracking-class-override.php' );

// Include the Redux theme options Framework
if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/admin/framework.php' );
}

// Tweak the Redux framework
// Register all the theme options
// Registers the wpex_option function
require_once( get_template_directory() . '/functions/admin-config.php' );
