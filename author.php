<?php
/*
* Template Name: Author
*/

get_header(); ?>
<?php 
global $wp_query;
$qry = $wp_query->query_vars;
$author_name = $qry['author_name'];
$author = get_user_by('login',$author_name);
$authorid = $author->data->ID;
$user_meta = get_user_meta($authorid);
//var_dump($user_meta);
$user_data = get_userdata($authorid);
//var_dump($user_data);
$args = array('author'=>$authorid);
$qry = new WP_Query($args);
if($user_data->roles[0] == 'subscriber'){
  //echo 'supporter detected';
  // test for supporter and author being the same to show that page
  if(get_current_user_id() == $authorid){
  	$causes = get_user_meta($authorid,'causes');
	include(locate_template('supporter.php'));
  }else{
	// if not authd, redirect to home.
	header("Location: http://lessergood.org");
	die();
  }
}else{
  //echo 'cause detected';
  	$args = array('author'=>$authorid,'post_type'=>'need');
	$qry = new WP_Query($args);
  	include(locate_template('cause.php'));
}
?>
<?php get_footer(); ?>