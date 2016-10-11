<?php get_header(); ?>
<?php
$args = array('post_type'=>'need');
$qry = new WP_Query($args); 
?>
<?php if(is_user_logged_in()){ ?>
	<div id="primary">
		<div id="content" role="main">
			<?php get_search_form(); ?>
			<?php include(locate_template('content-loop.php')); ?>
	  </div>
	</div>
	<?php get_sidebar(); ?>
<?php }else{ ?>
	<?php
	$post_id = 828;
	$queried_post = get_post($post_id);
	echo $queried_post->post_content;
  echo do_shortcode('[optin-cat id=866]').'<br /><br />';
  ?>
<?php } ?>
<?php get_footer(); ?>