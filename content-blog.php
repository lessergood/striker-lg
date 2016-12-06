<div class="posts">
<?php if ($qry->have_posts()) : while ($qry->have_posts()) : $qry->the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	  	<span class="post-date">
			<?php echo human_time_diff( get_the_time('U'), current_time('timestamp')). ' ago&nbsp;'; ?>
		</span>
		<span class="post-author">
		  <span class="fa fa-fw fa-user text-dark" title="Post Author"></span>
		  <?php the_author_posts_link(); ?>
		</span>
	</header><!-- .entry-header -->

	<div class="blog-content">
	  <br /><br />
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php endwhile; else: ?>
	<p><?php _e("There are currently no posts."); ?></p>
<?php endif; ?>
 </div> <!-- /posts -->