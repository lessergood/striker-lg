<?php 
/*
* Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php
$args = array('post_type'=>'post');
$qry = new WP_Query($args); 
?>
	<div id="primary">
		<div id="content" role="main">
			<?php include(locate_template('content-blog.php')); ?>
	  </div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>