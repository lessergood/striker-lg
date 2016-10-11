<?php
$excerpt_length = 55;
$thisauthor = get_query_var('author_name');
$thisuser = wp_get_current_user();
//var_dump($thisuser);
$key = 'followed_authors';
$usermeta = get_user_meta($thisuser->ID,$key,true);
$user_id = $thisuser->ID;
//update_user_meta($thisuser->ID,$key,'[3,4]');
echo $usermeta;
if(is_author($thisauthor)){
  // if this is an author archive
  $args = array('post_type' => 'need','author_name'=>$thisauthor);
  $thisauthorid = get_the_author_meta('ID');
  if($user_id == $thisauthorid){
	// if logged in user is the author this page is for
	$editmode = true;
  }
}else if(is_tax()){
  	$thisterm = get_query_var( 'term' );
  	$thistax = get_query_var( 'taxonomy' );
	$args = array('post_type' => 'need',
		'tax_query' => array(
			array(
				'taxonomy' => $thistax,
				'field'    => 'slug',
				'terms'    => $thisterm,
			),
		),			 
	);
}else{
	$args = array('post_type' => 'need');
}
$qry = new WP_Query($args);
?>
<?php get_template_part('content-loop',''); ?>