<?php 
/*
* Template Name: Map
*/
?>
<?php get_header(); ?>
<div class="wrapper section-inner">						
	<div class="content full-width">
	  	<?php get_search_form(); ?>
	  	<br />
		<div class="posts">
			<div class="post">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; else: ?>
				<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "hemingway"); ?></p>
			<?php endif; ?>
			</div>
		</div>
	</div> <!-- /content left -->
	<div class="clear"></div>
</div> <!-- /wrapper -->
<?php get_footer(); ?>