<?php
/* Write your awesome functions below */
// Add footer widget areas
add_action( 'widgets_init', 'hemingway_sidebar_reg' ); 

function hemingway_sidebar_reg() {
	register_sidebar(array(
	  'name' => __( 'Footer A', 'hemingway' ),
	  'id' => 'footer-a',
	  'description' => __( 'Widgets in this area will be shown in the left column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));	
	register_sidebar(array(
	  'name' => __( 'Footer B', 'hemingway' ),
	  'id' => 'footer-b',
	  'description' => __( 'Widgets in this area will be shown in the middle column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
	register_sidebar(array(
	  'name' => __( 'Footer C', 'hemingway' ),
	  'id' => 'footer-c',
	  'description' => __( 'Widgets in this area will be shown in the right column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
	register_sidebar(array(
	  'name' => __( 'Sidebar Left', 'hemingway' ),
	  'id' => 'sidebar',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
  register_sidebar(array(
	  'name' => __( 'Sidebar Right', 'hemingway' ),
	  'id' => 'sidebar2',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
  register_sidebar(array(
	  'name' => __( 'Sidebar - Account Left', 'hemingway' ),
	  'id' => 'sidebar4',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
  register_sidebar(array(
	  'name' => __( 'Sidebar - Account Right', 'hemingway' ),
	  'id' => 'sidebar3',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
  
}
function add_query_vars_filter( $vars ){
  $vars[] = "editmode";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function lessergood_load_javascript_files() {
	if ( !is_admin() ) {
	  wp_enqueue_script( 'lessergood_global', 'http://lessergood.org/wp-content/themes/lessergood/js/lessergood.js', array('jquery'), rand(111,9999), true );
	}
}

add_action( 'wp_enqueue_scripts', 'lessergood_load_javascript_files' );
