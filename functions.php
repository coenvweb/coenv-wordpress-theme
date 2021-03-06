<?php

// Load constants
require_once locate_template( '/inc/site-constants.php' );

// Custom Menu Walkers
require_once locate_template( '/inc/walker-main-menu.php' );
require_once locate_template( '/inc/walker-secondary-menu.php' );
require_once locate_template( '/inc/walker-top-menu.php' );
require_once locate_template( '/inc/walker-career-cat.php' );

// Rewrites
require_once locate_template( '/inc/rewrites.php' );

// Ajax
require_once locate_template( '/inc/ajax.php' );

// Signature Story
require_once locate_template( '/inc/signature-story-fun.php' );
//require_once locate_template( '/inc/gallery.php' ); (this is kinda working, but switched to slickslider plugin)

// Unique Meta Titles 
require_once locate_template( '/inc/meta-title.php' );

// Custom Metas (SEO and Social)
require_once locate_template( '/inc/custom-metas.php' );

//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'amethyst_enqueue_dashicons' );
function amethyst_enqueue_dashicons() {
    wp_enqueue_style( 'dashicons' );
}


/**
 * Print styles and scripts in header and footer
 */
add_action( 'wp_enqueue_scripts', 'coenv_styles_and_scripts' );
function coenv_styles_and_scripts() {

	// for public side only
	if ( is_admin() ) {
		return false;
	}

	// include theme scripts in footer
	wp_register_script( 'coenv-main2', get_template_directory_uri() . '/assets/scripts/build/main2.min.js', null, true );
	wp_enqueue_script( 'coenv-main2' );
    
    
    if (is_post_type_archive('faculty') || is_singular('faculty')) {

        // register faculty scripts, enqueued within template files
        wp_register_script( 'coenv-faculty', get_template_directory_uri() . '/assets/scripts/build/faculty.min.js', array( 'coenv-main2' ), null, true );
    }

	// make variables available to theme scripts
	wp_localize_script( 'coenv-main2', 'themeVars', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'themeurl' => get_template_directory_uri() ) );
}

require_once locate_template( '/inc/faculty.php' );

require_once locate_template( '/inc/widget-shortcode.php' );

/**
 * Incorporate CoEnv Member API into the theme
 * this used to be a separate plugin, but it makes more sense to include it in the theme
 */
require_once 'member-api.php';

/**
 * Admin only scripts
 */
add_action( 'admin_enqueue_scripts', 'coenv_admin_scripts' );
function coenv_admin_scripts() {
	wp_register_script( 'coenv_admin', get_template_directory_uri() . '/assets/scripts/build/admin.min.js' );
	wp_enqueue_script( 'coenv_admin' );
}


/**
 * Open graph doctype
 */
add_filter( 'language_attributes', 'coenv_language_attributes' );
function coenv_language_attributes( $output ) {
	return $output . ' xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml"';
}

/**
 * Admin settings
 */
add_action( 'admin_init', 'coenv_admin_settings' );
function coenv_admin_settings() {

	add_option( 'meta_description' );
	add_settings_field( 'meta_description', 'Site description', 'coenv_setting_meta_description', 'general' );
	register_setting( 'general', 'meta_description' );

	add_option( 'facebook' );
	add_settings_field( 'facebook', 'Facebook', 'coenv_setting_facebook', 'general' );
	register_setting( 'general', 'facebook' );

	add_option( 'twitter' );
	add_settings_field( 'twitter', 'Twitter', 'coenv_setting_twitter', 'general' );
	register_setting( 'general', 'twitter' );

	add_option( 'google_plus' );
	add_settings_field( 'google_plus', 'Google+', 'coenv_setting_google_plus', 'general' );
	register_setting( 'general', 'google_plus' );

	add_option( 'youtube' );
	add_settings_field( 'youtube', 'YouTube', 'coenv_setting_youtube', 'general' );
	register_setting( 'general', 'youtube' );
    
    add_option( 'instagram' );
	add_settings_field( 'instagram', 'Instagram', 'coenv_setting_instagram', 'general' );
	register_setting( 'general', 'instagram' );


//	add_option( 'feeds' );
//	add_settings_field( 'feeds', 'Feeds', 'coenv_setting_feeds', 'general' );
//	register_setting( 'general', 'feeds' );

	add_option( 'uw_social' );
	add_settings_field( 'UW Social', 'UW Social', 'coenv_setting_uw_social', 'general' );
	register_setting( 'general', 'uw_social' );
}

/**
 * Meta description setting
 */
function coenv_setting_meta_description() {
	$value = get_option('meta_description');

	?>	
		<p>In one or two short sentences, describe your site. This description is used in the search results of search engines like Google.</p>
		<textarea name="meta_description" id="meta_description" cols="30" rows="10" style="width: 100%"><?php echo $value ?></textarea>
	<?php
}

/**
 * Facebook setting
 */
function coenv_setting_facebook() {
	$value = get_option('facebook');

	?>	
		<input name="facebook" type="text" id="facebook" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Facebook page (e.g. https://facebook.com&hellip;).</p>
	<?php
}

/**
 * Twitter setting
 */
function coenv_setting_twitter() {
	$value = get_option('twitter');

	?>	
		<input name="twitter" type="text" id="twitter" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Just the handle ONLY (e.g. @handle).</p>
	<?php
}

/**
 * Google Plus setting
 */
function coenv_setting_google_plus() {
	$value = get_option('google_plus');

	?>	
		<input name="google_plus" type="text" id="google_plus" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Google+ profile.</p>
	<?php
}

/**
 * YouTube setting
 */
function coenv_setting_youtube() {
	$value = get_option('youtube');

	?>	
		<input name="youtube" type="text" id="youtube" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your YouTube Channel.</p>
	<?php
}

/**
 * YouTube setting
 */
function coenv_setting_instagram() {
	$value = get_option('instagram');

	?>	
		<input name="instagram" type="text" id="instagram" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Instagram profile.</p>
	<?php
}

/**
 * Feeds setting
 */
function coenv_setting_feeds() {
	$value = get_option('feeds');

	?>	
		<input name="feeds" type="text" id="feeds" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Feeds aggregation page (e.g. http://www.feedburner&hellip;).</p>
	<?php
}

/**
 * UW Social setting
 */
function coenv_setting_uw_social() {
	$value = get_option('uw_social');

	?>	
		<input name="uw_social" type="text" id="uw_social" value="<?php echo $value; ?>" class="regular-text">
	<?php
}

/**
 * Theme setup
 */
add_action( 'after_setup_theme', 'coenv_theme_setup' );
function coenv_theme_setup() {

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// Register nav menus
	register_nav_menus(array(
		'uw-links' => 'UW links',
		'top-links' => 'Top links',
		'top-buttons' => 'Top buttons',
        'footer-top-links' => 'Footer Top Links',
		'footer-links' => 'Footer links',
		'footer-units' => 'Footer academic units'
	));

	// Featured images
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support('post-thumbnails');
	}

	// Set media sizes
	// thumbnail: 200x200 square crop
  update_option( 'thumbnail_size_w', 200 );
  update_option( 'thumbnail_size_h', 200 );
  update_option( 'thumbnail_crop', 1 );

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'tiny', 129, 129, true );
		add_image_size( 'small', 262, 262 );
		add_image_size( 'banner', 1680 );
        add_image_size( 'homepage-column-retina', 528 );
        add_image_size( 'homepage-column', 253 );
		add_image_size( 'half', 375 );
		add_image_size( 'one-third', 250 );
        // restrained height
        add_image_size( 'homepage-column-standard', '253', '168', true );
        add_image_size( 'homepage-hero-standard', '680', '450', true );
	}

  // medium: 528x528
  update_option( 'medium_size_w', 528 );
  update_option( 'medium_size_h', 528 );

  // large: 750x750
  update_option( 'large_size_w', 794 );
  update_option( 'large_size_h', 794 );
}

add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
$addsizes = array(
"half" => __( "50% of column"),
"one-third" => __( "33% of column"),
"homepage-column-standard" => __( "Hompage Column Standard Aspect"),
"homepage-hero-standard" => __( "Homepage Hero Standard Aspect")
);
$newsizes = array_merge($sizes, $addsizes);
return $newsizes;
}


/**
 * Register Careers
 */

require_once locate_template( '/inc/careers.php' );
require_once locate_template( '/inc/infinite-scroll.php' );

/**
 * Register Staff
 */

require_once locate_template( '/inc/staff.php' );

/**
 * Register Students
 */

require_once locate_template( '/inc/student-ambassadors.php' );

/**
 * Returns a unit color (hex value)
 *
 * @param int Unit post ID
 * @return string Color hex value
 */
function coenv_unit_color( $unit_id ) {
	global $coenv_member_api;
	return $coenv_member_api->unit_color( $unit_id );
}


/**
 * Register sidebars for all pages, format widget HTML,
 * include widgets.php
 */
add_action( 'widgets_init', 'coenv_widgets_init' );

function coenv_widgets_init() {

	// include custom widgets
	$file = dirname(__FILE__) . '/widgets.php';

	if ( file_exists( $file ) ) {
		require( $file );
	}

	$before_widget	= '<section id="%1$s" class="widget %2$s">';
	$before_title 	= '<header class="section-header"><h3>';
	$after_title	= '</h3></header> <!-- end .section-header -->';
	$after_widget	= '</section> <!-- end #%1$s -->';

	// this will return only top-level pages
	$pages = get_pages('parent=0&sort_column=menu_order&sort_order=ASC');

	// remove specific pages by page name
	$pages_to_remove = array( );

	if ( empty( $pages ) ) {
		return false;
	}

	foreach( $pages as $page ) {
        // remove specific pages
		if( !in_array( $page->post_name, $pages_to_remove ) ) {
            if ((get_field('show_as_top-level_page', $page->ID) == true ) || has_post_thumbnail($page->ID) || (get_option('page_on_front') == $page->ID) && ($page->post_title !== 'Home')){
                register_sidebar( array(
                    'name' 			=> $page->post_title . ' / Sidebar',
                    'id'			=> 'sidebar-' . $page->ID,
                    'before_widget' => $before_widget,
                    'after_widget'	=> $after_widget,
                    'before_title' 	=> $before_title,
                    'after_title'	=> $after_title
                ) );
                register_sidebar( array(
                    'name' 			=> $page->post_title . ' / Footer',
                    'id'			=> 'sidebar-footer-' . $page->ID,
                    'before_widget' => $before_widget,
                    'after_widget'	=> $after_widget,
                    'before_title' 	=> $before_title,
                    'after_title'	=> $after_title
                ) );
            }
            if( ($page->post_title == 'Home')){
                register_sidebar( array(
                    'name' 			=> 'Homepage / Sidebar',
                    'id'			=> 'sidebar-' . $page->ID,
                    'before_widget' => $before_widget,
                    'after_widget'	=> $after_widget,
                    'before_title' 	=> '<header class="section-header"><h2>',
                    'after_title'	=> '</h2></header> <!-- end .section-header -->'
                ) );
            }
		}
	}

	$additional_sidebars = array('Search');

	if ( !empty( $additional_sidebars ) ) {
		foreach ( $additional_sidebars as $sidebar ) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => 'sidebar-' . str_replace(' ', '-', strtolower( $sidebar ) ),
				'before_widget' => $before_widget,
				'after_widget'	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title'	=> $after_title
			) );
		}
	}

}

/**
 * Add class 'page-top-level' class to top level page body_class
 */
add_filter( 'body_class', 'coenv_page_top_ancestor_class' );
function coenv_page_top_ancestor_class( $classes ) {
	$post = get_queried_object();
	$ancestor_id = coenv_get_ancestor('ID');

	if ( isset( $post->ID ) && $post->ID == $ancestor_id ) {
		$classes[] = 'page-top-level';
	}
	return $classes;
}

/**
 * Gets the top-level ancestor for pages, posts and custom post types
 * Credit: https://github.com/elcontraption/wp-tools 
 * @param
 * - string
 * @return 
 * - array
 */
function coenv_get_ancestor($attr = 'ID') {
	
	$post = get_queried_object();

	// test for search
	if ( is_search() ) {
		return false;
	}
    

	if ( (is_archive() || $post->post_type == 'post' || $post->post_type == 'intranet' || is_search()) && !is_post_type_archive( array( 'faculty' ) ) && !is_post_type_archive( array( 'careers' ) ) ) {

		$page_for_posts = get_option( 'page_for_posts' );

		if ( $page_for_posts == 0 ) {
			return false;
		}

		$ancestor = get_post( $page_for_posts );
        
        
        if ((isset($post->post_type)) && $post->post_type == 'intranet') {
            unset ($ancestor);
            $ancestor = get_post( 267 );
        }
		return $ancestor->$attr;
        
	}

	// test for pages
    if ((isset($post->post_type)) && $post->post_type == 'page' ) {

        // test for top-level pages
        if ( $post->post_parent == 0 ) {
            return $post->$attr;
        }

        // must be a child page
        $ancestors = get_post_ancestors( $post->ID );
        $ancestor = get_post( array_pop( $ancestors ) );
        return $ancestor->$attr;
    }

	// test for custom post types
	$custom_post_types = get_post_types( array( '_builtin' => false ), 'object' );
	if ( !empty( $custom_post_types ) && (isset($post->post_type)) && array_key_exists( $post->post_type, $custom_post_types ) ) {

		// is parent_page slug defined?
		if ( isset( $custom_post_types[ $post->post_type ]->parent_page ) ) {

			// parent_page slug is defined.
			$parent = get_page_by_path( $custom_post_types[ $post->post_type ]->parent_page );

		} else {

			// parent_page slug is not defined
			// find custom slug
			$slug = $custom_post_types[ $post->post_type ]->rewrite[ 'slug' ];

			// if a page exists with the same slug, assume that's the parent page
			$parent = get_page_by_path( $slug );
		}

		// get ancestors of $parent
		$ancestors = get_post_ancestors( $parent->ID );

		// if ancestors is empty, just return $parent;
		if ( empty( $ancestors ) ) {
			return $parent->$attr;
		}

		$ancestor = get_post( array_pop( $ancestors ) );
		return $ancestor->$attr;
	}
    
}

/**
 * Customize TinyMCE editor formats
 */
add_filter('tiny_mce_before_init', 'coenv_editor_formats');
function coenv_editor_formats( $init )
{
	$init['theme_advanced_blockformats'] = 'p, h1, h2, h3, h4';
	
	return $init;
}

/**
 * Page banners
 *
 * 2013.07.31 | Darin | disabled check for post thumbnail, will always fall back to ancestor thumbnail.
 */
function coenv_banner() {
	$obj = get_queried_object();

	$page_id = false;
	$banner = false;
    
    $ancestor = coenv_get_ancestor();
    if (is_singular('careers')) {
        unset($ancestor);
        $ancestor = 32;
    }

    if (is_singular('newsletter')) {
        unset($ancestor);
        $ancestor = 5;
    }
    
    if (is_page_template('templates/future-ug-sub.php')) {
        unset($ancestor);
        $ancestor = 38568;
    }
    
    if (is_page_template('templates/future-grad-sub.php')) {
        unset($ancestor);
        $ancestor = 38585;
    }

	if ((isset($obj->ID)) && has_post_thumbnail( $obj->ID ) && (!is_single() || is_page_template('templates/signature-story.php')) ) {
		$page_id = $obj->ID;

	} else if ( has_post_thumbnail( $ancestor ) ) {

		$page_id = $ancestor;
    }

	if ( $page_id == false ) {
		return false;
	}

	$thumb_id = get_post_thumbnail_id( $page_id );
	$image_src = wp_get_attachment_image_src( $thumb_id, 'banner' );
	$attachment_post_obj = get_post( $thumb_id );
    
  if (is_page_template('templates/signature-story.php')) {
      $thumb_id_custom = get_field('banner_image');
      $image_src = wp_get_attachment_image_src( $thumb_id_custom, 'banner' );
  }
  $banner = array(
    'url' => $image_src[0],
    'permalink' => get_permalink( $attachment_post_obj->ID ),
  );

	return $banner;
}

function my_gallery_default_type_set_link( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter( 'media_view_settings', 'my_gallery_default_type_set_link');

/**
 * Remove WordPress's default padding on images with captions
 *
 * @param int $width Default WP .wp-caption width (image width + 10px)
 * @return int Updated width to remove 10px padding
 */
function remove_caption_padding( $width ) {
	return $width - 10;
}
add_filter( 'img_caption_shortcode_width', 'remove_caption_padding' );

/**
 * Display breadcrumb links for a page, post or faculty
 */
function coenv_breadcrumbs() {
	global $post;

	$post_type_obj = get_post_type_object( get_post_type( $post ) );

	switch ( $post_type_obj->labels->singular_name ) {
		case 'Post':
			$post_type = 'News';
			break;
		default:
			$post_type = $post_type_obj->labels->singular_name;
			break;
	}

	$output = '<div class="breadcrumbs">';
	$output .= $post_type . ': ';

	// for news, output date
	if ( $post_type == 'News' ) {
		$output .= '<ul class="breadcrumbs__list">';
		$output .= '<li>' . coenv_post_date() . '</li>';
		$output .= '</ul>';
	}

	if ( isset( $post->ancestors ) && !empty( $post->ancestors ) ) {
		$output .= '<ul class="breadcrumbs__list">';
		
		foreach ( $post->ancestors as $ancestor ) {
			$output .= '<li><a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
		}

		$output .= '</ul>';
	}

	$output .= '</div>';

	echo $output;
}

/**
 * Add submenu checkbox to wp custom nav menus
 */
add_action( 'wp_update_nav_menu', 'coenv_save_nav_menu_custom_fields' );
function coenv_save_nav_menu_custom_fields() {

	$ids_to_save = array();

	// collect ids submitted in $_POST['menu-item-subheader']
	$checked_ids = isset( $_POST['menu-item-subheader'] ) ? $_POST['menu-item-subheader'] : array();

	foreach ( $checked_ids as $key => $value ) {
		$ids_to_save[] = "$key";
	}

	update_option( 'coenv_main_menu_subheaders', $ids_to_save );

	// this gets called twice for some reason
	remove_action( 'wp_update_nav_menu', __FUNCTION__ );
}

/**
 * Add ajax action to check if checkbox is checked for subhead nav item
 */
add_action( 'wp_ajax_coenv_ajax_get_menu_status', 'coenv_ajax_get_menu_status' );
function coenv_ajax_get_menu_status() {

	// get items saved as subheaders
	$subheaders = get_option( 'coenv_main_menu_subheaders' );

	exit( json_encode( $subheaders ) );
}

/**
 * Checks if a page's ancestor is assigned in a custom menu
 * Returns true/false
 */
function coenv_has_menu( $menu_slug ) {

	global $post;

	$top_level_nav_item_permalinks = array();

	$ancestor_permalink = get_permalink( coenv_get_ancestor( 'ID' ) );

	$nav_menu_items = wp_get_nav_menu_items( $menu_slug );

	foreach ( $nav_menu_items as $item ) {

		// filter for top level items
		// add permalink to array
		if ( empty( $item->post_parent ) ) {
			$top_level_nav_item_permalinks[] = $item->url;
		}
	}

	// check if the ancestor permalink is in permalinks array
	if ( in_array( $ancestor_permalink, $top_level_nav_item_permalinks ) ) {
		return true;
	}

	return false;
}

/*
|---------------------------------------------------------------------------
| Pagination
|---------------------------------------------------------------------------
*/
function coenv_paginate() {

	if( is_singular() )
		return;

	global $wp_query;

	$prev_label = '&laquo;';
	$next_label = '&raquo;';

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( $prev_label ) );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( $next_label ) );

	echo '</ul></div>' . "\n";
}

/*
|---------------------------------------------------------------------------
| Archive titles
|---------------------------------------------------------------------------
*/
if ( !function_exists( 'coenv_archive_title' ) ) {

	function coenv_archive_title()
	{
		if ( is_category() ) {
			printf( __( 'Category Archives: %s', 'coenv' ), '<span>' . single_cat_title( '', false ) . '</span>' );

		} elseif ( is_tag() ) {
			printf( __( 'Tag Archives: %s', 'coenv' ), '<span>' . single_tag_title( '', false ) . '</span>' );

		} elseif ( is_author() ) {
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			printf( __( 'Author Archives: %s', 'coenv' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		} elseif ( is_day() ) {
			printf( __( 'Daily Archives: %s', 'coenv' ), '<span>' . get_the_date() . '</span>' );

		} elseif ( is_month() ) {
			printf( __( 'Monthly Archives: %s', 'coenv' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		} elseif ( is_year() ) {
			printf( __( 'Yearly Archives: %s', 'coenv' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		} else {
			_e( 'Archives', 'coenv' );

		}
	}

}

/**
 * Print breadcrumbs
 * For print stylesheet only
 */
function coenv_print_breadcrumbs() {
	global $post;

	print '<pre>';
	print_r($post->ancestors);
	print '</pre>';

	$output = get_bloginfo('url');
	echo $output;
}

/**
 * Add Read More button links to RSS
 */

function fields_in_feed($content) {  
    if(is_feed()) {  
        $post_id = get_the_ID();  
        $output = '<a href="' . get_field('story_link_url', $post_id) . '" name="' . get_field('story_source_name', $post_id) . '">' . get_field('story_source_name', $post_id) . '</a>';  
        $content = $content.$output;  
    }  
    return $content;  
}  
add_filter('the_content','fields_in_feed');

/**
 * Remove comment RSS
 */
remove_action( 'wp_head','feed_links', 2 );
remove_action( 'wp_head','feed_links_extra', 3 );
add_action( 'wp_head', 'reinsert_rss_feed', 1 );

function reinsert_rss_feed() {
	echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('sitename') . ' &raquo; RSS Feed" href="' . get_bloginfo('rss2_url') . '" />';
}

/**
 * Blank search searches for ' ' instead.
 **/
if(!is_admin()){
	add_action('init', 'search_query_fix');
	function search_query_fix(){
		if(isset($_GET['s']) && $_GET['s']==''){
			$_GET['s']=' ';
		}
	}
}

/**
 * Adds divs around all inline images (for excerpts)
 **/
function breezer_addDivToImage( $content ) {

   // A regular expression of what to look for.
   $pattern = '/(<img([^>]*)>)/i';
   // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
   $replacement = '<div class="myphoto">$1</div>';

   // run preg_replace() on the $content
   $content = preg_replace( $pattern, $replacement, $content );

   // return the processed content
   return $content;
}
if (is_archive()):
	add_filter( 'the_content', 'breezer_addDivToImage' );
endif;

/**
 * Add custom media metadata fields
 *
 * Be sure to sanitize your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $form_fields An array of fields included in the attachment form
 * @param $post The attachment record in the database
 * @return $form_fields The final array of form fields to use
 */
function add_image_attachment_fields_to_edit( $form_fields, $post ) {		
	// Add a Credit field
	$form_fields["credit_text"] = array(
		"label" => __("Credit"),
		"input" => "text", // this is default if "input" is omitted
		"value" => esc_attr( get_post_meta($post->ID, "_credit_text", true) ),
		"helps" => __("The owner of the image."),
	);
	
	// Add a Credit field
	$form_fields["credit_link"] = array(
		"label" => __("Credit URL"),
		"input" => "text", // this is default if "input" is omitted
		"value" => esc_url( get_post_meta($post->ID, "_credit_link", true) ),
		"helps" => __("Attribution link to the image source or owners website."),
	);
	
	return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

/**
 * Save custom media metadata fields
 *
 * Be sure to validate your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $post The $post data for the attachment
 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
 * @return $post
 */
function add_image_attachment_fields_to_save( $post, $attachment ) {
	if ( isset( $attachment['credit_text'] ) )
		update_post_meta( $post['ID'], '_credit_text', esc_attr($attachment['credit_text']) );
		
	if ( isset( $attachment['credit_link'] ) )
		update_post_meta( $post['ID'], '_credit_link', esc_url($attachment['credit_link']) );

	return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes
 * 
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 */
function jk_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'      => '',
		'align'   => 'aligncenter',
		'width'   => '',
		'caption' => ''
	), $attr));
	
	// No caption, no dice... But why width? 
	if ( 1 > (int) $width || empty($caption) )
		return $val;
 
	if ( $id )
		$id = esc_attr( $id );
		$attach_id = str_replace('attachment_', '', $id);
		$photo_source = get_post_meta( $attach_id, '_credit_text', true );
		$photo_source_url = get_post_meta( $attach_id, '_credit_link', true );
	
		if ( $photo_source ) {
		if (!empty($photo_source_url)) {
			$photo_source_div = "<div class=\"source\"><a href=\"$photo_source_url\" target=\"blank\">$photo_source</a></div>";
		} else 
			$photo_source_div = "<div class=\"source\">$photo_source</div>";
		} else
			$photo_source_div= " ";
		
	


	return '<figure title="' . $caption . '" id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . $photo_source_div . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
	
}
add_filter( 'img_caption_shortcode', 'jk_img_caption_shortcode_filter', 10, 3 );


function youtube_nocookie( $data, $url, $args ){
  
  $data = str_replace( 'www.youtube.com', 'www.youtube-nocookie.com', $data );
  
  return $data;
  
}

add_filter( 'oembed_result', 'youtube_nocookie', 10, 3 );

/**
 * Add taxonomies & news functions
 */

require_once locate_template( '/inc/news.php' );
require_once locate_template( '/inc/intranet.php' );

function coenv_base_date_filter($post_type,$coenv_month,$coenv_year) {
	$counter = 0;
	$ref_month = '';
	$monthly = new WP_Query(array('posts_per_page' => -1, 'post_type'	=> $post_type));
	echo '<select name="select-category" class="select-category" id="date-filter">';
	echo '<option value="' . strtok($_SERVER['REQUEST_URI'],'?') . '">By Date</option>';
	if( $monthly->have_posts() ) :
		while( $monthly->have_posts() ) : $monthly->the_post();
		    if( get_the_date('mY') != $ref_month ) {
		    	$month_num = get_the_date('m');
		    	$month_str = get_the_date('F');
		    	$year_num = get_the_date('Y');
		    	if ($year_num == $coenv_year && $month_num == $coenv_month) {
		    	 $selected = ' selected="selected"';
		    	} else {
		    		$selected = '';
		    	}
		    	echo '<option value="page/1/?coenv-year=' . $year_num . '&coenv-month=' . $month_num  . '"' . $selected . '>' . $month_str . ' ' . $year_num . '</option>';
		       // echo "\n".get_the_date('F Y');
		        $ref_month = get_the_date('mY');
		        $counter = 0;
		    }
		endwhile; 
	endif;
	echo '</select>';
	wp_reset_postdata();
	wp_reset_query();
}

function remove_faculty_search( $query ) {
    // Run only on search
    if ( $query->is_search() && $query->is_main_query() ) {
        //dont set post type if one is already specified
        if(!$query->query_vars['post_type']) {
            $types = get_post_types(array('exclude_from_search'=>false));
            // remove faculty from post types to search
            unset($types['faculty']);
            unset($types['careers']);
            $query->query_vars['post_type'] = $types;
        }
        $query->query_vars['posts_per_page'] = 15;

    }
}
add_action( 'pre_get_posts', 'remove_faculty_search' );

if($_SERVER['HTTP_HOST'] !== 'environment.uw.dev' && $_SERVER['HTTP_HOST'] !== 'environment.uw.local' && $_SERVER['HTTP_HOST'] !== 'uwenvironment.local' && $_SERVER['HTTP_HOST'] !== 'beta.environment.uw.edu') {
    function cdn_upload_url() {
        return 'https://coenv-media-gene1ufvxiloffjq.stackpathdns.com';
    }
    add_filter( 'pre_option_upload_url_path', 'cdn_upload_url' );
}

function add_pending_revision_status(){
	register_post_status( 'pending_revision', array(
		'label'                     => 'Pending Revision',
		'public'                    => false,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( '<span class="count">(%s)</span> Pending Revision', 'Unread <span class="count">(%s)s</span> Pending Revision' ),
	) );
}
add_action( 'init', 'add_pending_revision_status' );

add_action( 'admin_bar_menu', 'add_revision_link', 999 );
function add_revision_link( $wp_admin_bar ) {
    if(current_user_can('ow_make_revision') && current_user_can('ow_make_revision_others') && is_page() && !is_front_page() && !is_preview()) {
        $args = array(
            'id'    => 'revision',
            'title' => do_shortcode('[ow_make_revision_link text="Make Revision" class="" type="text" post_id="'.get_the_ID().'"]'),
            'href'  => '',
        );
        $wp_admin_bar->add_node( $args );
    }
}
