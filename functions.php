<?php
/* Write your awesome functions below */
function add_query_vars_filter( $vars ){
  $vars[] = "editmode";
  $vars[] = "search_type";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

add_action( 'after_setup_theme', 'parent_override' );
function parent_override() {

    unregister_sidebar('left_column');
    unregister_sidebar('center_column'); 
    unregister_sidebar('right_column');  
    /** I have looked for the ID of the sidebar by looking at        
     *  the source code in the admin.. and saw the widget's id="sidebar-4"
     */ 


    if ( ! function_exists( 'striker_scripts' ) ) {
        function striker_scripts () {
          wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
              wp_enqueue_script( 'comment-reply' );
            }
            if ( is_singular() && wp_attachment_is_image() ) {
              wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
            }
            
              wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
            
              wp_enqueue_script( 'smoothup', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '',  true );
         } 
	}
  
  function cherrypick_child_enqueue_css(){
      wp_register_style( 'striker-lg-stylesheet', get_stylesheet_uri(),array(),rand(111,9999));
	wp_register_style( 'lg-stylesheet', '//lessergood.org/wp-content/themes/striker-lg/lg-styles.css',array(),rand(111,9999));
      wp_enqueue_style( 'striker-lg-stylesheet');
	wp_enqueue_style( 'lg-stylesheet');
	  //wp_register_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	  //wp_enqueue_style( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'cherrypick_child_enqueue_css', 99 );
    
}

/* This enables author-${role} templates */
/*
function author_role_template( $templates = '' ) {
    $author = get_queried_object();
    $role = $author->roles[0];
 
    if ( ! is_array( $templates ) && ! empty( $templates ) ) {
        $templates = locate_template( array( "author-$role.php", $templates ), false );
    } elseif ( empty( $templates ) ) {
        $templates = locate_template( "author-$role.php", false );
    } else {
        $new_template = locate_template( array( "author-$role.php" ) );
        if ( ! empty( $new_template ) ) {
            array_unshift( $templates, $new_template );
        }
    }
 
    return $templates;
}
add_filter( 'author_template', 'author_role_template' );
*/


