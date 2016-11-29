<?php 
/*
* Template Name: Profile
*/
?>
<?php get_header(); ?>
<div class="wrapper section-inner">	
  <?php get_sidebar('accountleft'); ?>
	<div class="content left">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="posts">
			<div class="post">			
				<div class="post-header">				
				    <h2 class="post-title"><?php the_title(); ?></h2>		    
			    </div> <!-- /post-header -->    			        		                
				<div class="post-content">                                      
					<?php the_content(); ?>
					<div class="clear"></div>						            			                        
				</div> <!-- /post-content -->
			</div> <!-- /post -->
		</div> <!-- /posts -->
	    <div class="clear"></div>
		<?php endwhile; else: ?>
			<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "hemingway"); ?></p>
		<?php endif; ?>
	</div> <!-- /content -->
  <?php get_sidebar('account'); ?>
  <div class="clear"></div>
</div> <!-- /wrapper section-inner -->
<?php get_footer(); ?>