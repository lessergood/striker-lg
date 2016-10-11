<?php 
/*
* Template Name: Add Post
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<div id="acf-add-form">
<?php 
	echo '<h2 class="page-title">Add Post</h2>';
	$opts = array('post_id'=>'new_post',
				  		'post_title'=>true,
				  		'new_post'		=> array(
							'post_type'		=> 'need',
							'post_status'		=> 'publish'
					));
	acf_form($opts); 
?>
</div>
<?php get_footer(); ?>