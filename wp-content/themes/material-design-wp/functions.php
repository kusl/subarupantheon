<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Material_Design_WP
 */

 /*
	**** Enqueue Material Design Icon
 */
 if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

 function material_design_wp_scripts() {
 // load material icons css
 	  wp_enqueue_style( 'material-design-wp-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
    wp_enqueue_style( 'material-design-wp-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'material-design-wp-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    // load Material Design Color Scheme from Customizer
    wp_enqueue_style( 'material-design-color-scheme-css', get_stylesheet_directory_uri() . '/css/color-schemes/' . get_theme_mod('theme_color_scheme') . '.css');
    

  if ( is_singular() ) :
  	wp_enqueue_script( "comment-reply" );
  endif;
 }
 add_action( 'wp_enqueue_scripts', 'material_design_wp_scripts', 15 );

/**
 * Customizer in the Theme
 */
 function material_design_wp_customize_preview_js() {
 	wp_enqueue_script( 'material-design-wp_customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ) );
 }
 add_action( 'customize_preview_init', 'material_design_wp_customize_preview_js' );

 function material_design_wp_customize_register( $wp_customize ) {

 	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
 	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
 	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


 		/*==============================
 		Color Scheme Settings
 		- theme color schemes
 		===============================*/
 		$wp_customize->add_section('material_design_wp_color_scheme', array(
 		        'title'    => __('Color Scheme', 'material-design-wp'),
 		        'description' => '',
 		        'priority' => 120,
 		    ));
 	 /*============================
 		Theme Color Scheme Choices
 	 =============================*/

 				$wp_customize->add_setting('theme_color_scheme', array(
 		         'default'        => 'default_cs',
 						 'transport'			=> 'refresh',
 		         'type'           => 'theme_mod',
 						 'sanitize_callback' => 'wp_filter_nohtml_kses',

 		     ));
 		     $wp_customize->add_control( 'select_color_scheme', array(
 		         'settings' => 'theme_color_scheme',
 		         'label'   => __('Select Color Scheme:', 'material-design-wp'),
 		         'section' => 'material_design_wp_color_scheme',
 		         'type'    => 'select',
 		         'choices'    => array(
 		             'default_cs' => __('Default', 'material-design-wp'),
 		             'magenta_pink' => __('Magenta Pink', 'material-design-wp'),
 		             'navy_indigo' => __('Navy Indigo', 'material-design-wp'),
 		             'dark_olive' => __('Dark Olive', 'material-design-wp'),
 		             'orange_light' => __('Orange Light', 'material-design-wp'),
 		             'sky_light' => __('Sky Light', 'material-design-wp')
 		         )
 		     ));

 }
 add_action( 'customize_register', 'material_design_wp_customize_register' );


/***
  *** Post Meta
*
*/

 if ( ! function_exists( 'wp_bootstrap_starter_posted_on' ) ) :
 /**
  * Prints HTML with meta information for the current post-date/time and author.
  */
 function wp_bootstrap_starter_posted_on() {
 	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
 	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
 		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
 	}

 	$time_string = sprintf( $time_string,
 		esc_attr( get_the_date( 'c' ) ),
 		esc_html( get_the_date() ),
 		esc_attr( get_the_modified_date( 'c' ) ),
 		esc_html( get_the_modified_date() )
 	);

 	$posted_on = sprintf(
 		esc_html_x( 'Posted on %s', 'post date', 'material-design-wp' ),
 		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
 	);

 	$byline = sprintf(
 		esc_html_x( 'Posted by %s', 'post author', 'material-design-wp' ),
 		'<span class="author vcard"><i class="material-icons md-12">&#xE853;</i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
 	);

 	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

     if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
         echo ' <span class="comments-link"><i class="material-icons md-12">&#xE8AF;</i>';
         /* translators: %s: post title */
         comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'material-design-wp' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
         echo '</span>';
     }

 }
 endif;

 if ( ! function_exists( 'wp_bootstrap_starter_entry_footer' ) ) :
 /**
  * Prints HTML with meta information for the categories, tags and comments.
  */
 function wp_bootstrap_starter_entry_footer() {
 	// Hide category and tag text for pages.
 	if ( 'post' === get_post_type() ) {
 		/* translators: used between list items, there is a space after the comma */
 		$categories_list = get_the_category_list( esc_html__( ', ', 'material-design-wp' ) );
 		if ( $categories_list && wp_bootstrap_starter_categorized_blog() ) {
 			printf( '<span class="cat-links"><i class="material-icons md-12">&#xE2C8;</i>' . esc_html__( 'Posted in %s', 'material-design-wp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
 		}

 	/* translators: used between list items, there is a space after the comma */
 		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'material-design-wp' ) );
 		// if ( $tags_list ) {
 		// 	printf( ' | <span class="tags-links">' . esc_html__( 'Tagged %1$s', 'material-design-wp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
 		// }
 	}
 	edit_post_link(
 		sprintf(
 			/* translators: %s: Name of current post */
 			esc_html__( 'Edit %s', 'material-design-wp' ),
 			the_title( '<span class="screen-reader-text">"', '"</span>', false )
 		),
 		' <span class="edit-link">',
 		'</span>'
 	);
 }
 endif;
