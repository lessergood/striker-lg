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
<?php $id = 828;
$content_post = get_post($id);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
$content = str_replace("\r", "<br />", $content);
echo $content;	
 /*
	$post_id = 828;
	$queried_post = get_post($post_id);
  	$content = $queried_post->post_content; 
  	echo apply_filters('the_content', $content);
  	echo '<div style="width: 40%; text-align: center; margin: 0 auto;">';
  echo '<h1 style="font-size: 48px;">Join us! It\'s free.</h1>';
  echo '<button class="btn btn-blue" onclick="window.location.href=\'/register\'" style="font-size: 32px;">Sign Up</button>';
  		//echo do_shortcode('[yikes-mailchimp form="2"]');
  	echo '</div><br />';
  	$post_id = 976;
	$queried_post = get_post($post_id);
  	$content = $queried_post->post_content; ?>
	<div id="content-full" class="site-content" role="main">
	  <h2>How It Works</h2>
	  <div class="entry-content">
	   <?php echo apply_filters('the_content', $content); ?>
		  <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'striker' ), 'after' => '</div>' ) ); ?>
		  <footer class="entry-meta">
			<?php //edit_post_link( __( 'Edit', 'striker' ), '<span class="edit-link">', '</span>' ); ?>
		  </footer><!-- .entry-meta -->
	  </div><!-- .entry-content -->
</div>
<?php */ } ?>
<?php get_footer(); ?>