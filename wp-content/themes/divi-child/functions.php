<?php

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

function modify_menu(){

	remove_menu_page( 'edit.php' );

		$categories  = get_categories(array( 'hide_empty' => false, 'parent' => 0, 'exclude' => array('1') ));
        $menu_pages =  array();

        $cat_styles = "padding: 0px 5px;background-color: #e74c3c;font-weight: bold;font-style: italic;color: #FFF;border-radius: 3px;font-size: 10px;margin-right: 5px;";
        $subcat_styles = "padding: 0px 5px;background-color: #3498db;font-weight: bold;font-style: italic;color: #FFF;border-radius: 3px;font-size: 10px;margin-right: 5px;";

        $icons = array(
            'News' => 'dashicons-book',
            'Community' => 'dashicons-groups',
            'Entertainment' => 'dashicons-star-filled',
            'Real Estate' => 'dashicons-admin-multisite',
            'Travel' => 'dashicons-location-alt',
            'Lifestyle' => 'dashicons-universal-access',
            'Opportunities' => 'dashicons-awards',
            'Event' => 'dashicons-megaphone'
        );

		foreach ( $categories as $category ) {

			$menu_slug = 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $category->term_id . '&filter_action=Filter&paged=1&action2=-1';
			add_menu_page($category->name, '<span style="'. $cat_styles .'">'. $category->count .'</span>' . $category->name, 'read', $menu_slug, null, null, 4);
			$subcategories = get_categories(array( 'hide_empty' => false, 'parent' => $category->term_id, 'exclude' => array('6')));
			$submenu_pages = array();

			foreach ( $subcategories as $subcategory ) {
				array_push($submenu_pages, array(
					'parent_slug' => 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat=' . $category->term_id . '&filter_action=Filter&paged=1&action2=-1',
					'page_title'  => '',
					'menu_title'  => '<span style="'. $subcat_styles .'">'. $subcategory->count .'</span>' . $subcategory->name,
					'capability'  => 'read',
					'menu_slug'   => 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $subcategory->term_id . '&filter_action=Filter&paged=1&action2=-1',
					'function'    => null
				));
            };
            
			foreach ( $submenu_pages as $submenu ) {
				add_submenu_page(
					$submenu['parent_slug'],
					$submenu['page_title'],
					$submenu['menu_title'],
					$submenu['capability'],
					$submenu['menu_slug'],
					$submenu['function']
				);
            }
		};
}

function set_modified_menu( $parent_file ) {
	global $submenu_file, $current_screen, $pagenow;

	$parent_file;
	$child = get_category(get_query_var('cat'));

	var_dump($child);
	$parent = $child->parent;

	if( $parent == 0 ) {
		$parent_file = 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $child->term_id . '&filter_action=Filter&paged=1&action2=-1';
	} else if ($child) {
		$parent_file = 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $parent . '&filter_action=Filter&paged=1&action2=-1';
	}
	return $parent_file;
}

add_action( 'admin_menu', 'modify_menu' );
// add_filter( 'parent_file', 'set_modified_menu' );

// function return_publish_permissions() {
//     $user = get_role( 'contributor' );
//     $user->add_cap( 'edit_posts' );
// }
// register_deactivation_hook( __FILE__, 'return_publish_permissions' );
    
// function take_away_publish_permissions() {
//     $user = get_role( 'contributor' );
//     $user->add_cap('publish_posts', false);
// }
// register_activation_hook( __FILE__, 'take_away_publish_permissions' );

add_action('init', 'init_remove_support',100);
function init_remove_support()
{
   $post_type = 'post';
   remove_post_type_support( $post_type, 'editor');
}

add_action('pre_get_posts','users_own_attachments');
function users_own_attachments( $wp_query_obj ) {

    global $current_user, $pagenow;

    $is_attachment_request = ($wp_query_obj->get('post_type')=='attachment');

    if( !$is_attachment_request )
        return;

    if( !is_a( $current_user, 'WP_User') )
        return;

    if( !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) )
        return;

    if( !current_user_can('delete_pages') )
        $wp_query_obj->set('author', $current_user->ID );

    return;
}

add_action('admin_head', 'adminCSS');

function adminCSS(){
    ?><style type='text/css'>
    #region-tabs li, 
	#category-tabs li,
	#province-tabs li,
	#taxonomy-region #region-adder,
	#taxonomy-category #category-adder,
	#tagsdiv-province #link-province,
	#regionchecklist #region-0,
	#provincechecklist #province-0 {
        display: none !important;
    }
	#region-tabs li:first-child,
	#category-tabs li:first-child,
	#province-tabs li:first-child,
	#regionchecklist #region-0:last-child,
	#provincechecklist #province-0:last-child {
        display: inline !important;
    }
    </style><?php
}

// C:\xampp\htdocs\wordpress\wp-content\themes\Divi\includes\builder\module\FullwidthPostSlider.php
// C:\xampp\htdocs\wordpress\wp-content\themes\Divi\includes\builder\functions.php:
// https://wordpress.stackexchange.com/questions/84921/how-do-i-query-a-custom-post-type-with-a-custom-taxonomy

function DS_Custom_Modules(){
	if(class_exists("ET_Builder_Module")){
	include("CustomFullwidthPostSlider.php");
	}
   }
   
   function Prep_DS_Custom_Modules(){
	global $pagenow;
   
   $is_admin = is_admin();
	$action_hook = $is_admin ? 'wp_loaded' : 'wp';
	$required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
	$specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
	$is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
	$is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
	$is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import']; 
	$is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];
   
   if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
	add_action($action_hook, 'DS_Custom_Modules', 9789);
	}
   }
   Prep_DS_Custom_Modules();