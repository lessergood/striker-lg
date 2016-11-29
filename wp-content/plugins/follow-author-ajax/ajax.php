<?php 
/**
 * Plugin Name: Follow Author Ajax
 * Plugin URI: http://rncrtr.com
 * Description: follow author with ajax
 * Version: 1.0.0
 * Author: Ryan Carter
 * Author URI: http://rncrtr.com
 * License: GPL2
 */

// init
add_action( 'wp_enqueue_scripts', 'follow_author_enqueue_scripts' );
function follow_author_enqueue_scripts() {
  wp_enqueue_script( 'follow-author-ajax', plugins_url( '/follow-author-ajax.js', __FILE__ ), array('jquery'), rand(111,9999), true );

  wp_localize_script('follow-author-ajax','ajaxmagic',array(
    'ajax_url' => admin_url('admin-ajax.php')
  ));
}

add_action( 'wp_ajax_follow_author_ajax', 'follow_author_ajax' );

function follow_author_ajax() {
	$causeid = $_REQUEST['author_id'];
	$userid = $_REQUEST['user_id'];
	$fieldname = $_REQUEST['field'];
  $causes = get_user_meta($userid,$fieldname,true);
  $supporters = get_user_meta($causeid,'supporters',true);
  // causes exist?
  if($causes){
    // split list into an array to work with it
    $causes_array = explode(',',$causes);
    $supporters_array = explode(',',$supporters);
    if(count($causes_array) > 0){
      // is our new cause in the list already? If not, add it
      if(in_array($causeid,$causes_array)){
        // if it is in there already, delete it
        $removable_index = array_search($causeid,$causes_array);
        unset($causes_array[$removable_index]);
        $new_array = implode(',',$causes_array);
        update_user_meta($userid,$fieldname,$new_array);
        echo 0;
      }else{
		    array_push($causes_array,$causeid);
		    $new_array = implode(',',$causes_array);
        update_user_meta($userid,$fieldname,$new_array);
        echo 1;
      }
    }
  }else{
    // if there are no causes in there, this is the first, just add it
    update_user_meta($userid,$fieldname,$causeid);
    echo 2;
  }
  // supporters exist?
  if($supporters){
    if(count($supporters_array) > 0){
      // is our new supporter in the list already? If not, add it
      if(in_array($userid,$supporters_array)){
        // if it is in there already, delete it
        $removable_index2 = array_search($userid,$supporters_array);
        unset($supporters_array[$removable_index2]);
        $new_array2 = implode(',',$supporters_array);
        update_user_meta($causeid,'supporters',$new_array2);
        echo 0;
      }else{
        array_push($supporters_array,$userid);
        $new_array = implode(',',$supporters_array);
        update_user_meta($causeid,'supporters',$new_array2);
        echo 1;
      }
    }
  }else{
    // if there are no causes in there, this is the first, just add it
    update_user_meta($causeid,'supporters',$userid);
    echo 2;
  } 
}