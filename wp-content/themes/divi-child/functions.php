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
			add_menu_page($category->name, '<span style="'. $cat_styles .'">'. $category->count .'</span>' . $category->name, 'read', $menu_slug, null, $icons[$category->name], 4);
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
	$parent = $child->parent;

	if( $parent == 0 ) {
		$parent_file = 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $child->term_id . '&filter_action=Filter&paged=1&action2=-1';
	} else if ($child) {
		$parent_file = 'edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat='. $parent . '&filter_action=Filter&paged=1&action2=-1';
	}
	return $parent_file;
}

add_action( 'admin_menu', 'modify_menu' );
add_filter( 'parent_file', 'set_modified_menu' );

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