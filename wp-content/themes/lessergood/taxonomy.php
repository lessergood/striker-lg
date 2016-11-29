<?php get_header(); ?>  
<div class="wrapper section-inner">						
	<?php get_sidebar('left'); ?>
	<div class="content left">
		<?php get_search_form(); ?>
		<?php get_template_part( 'content', '' ); ?>
	</div> <!-- /content left -->
  <?php get_sidebar('right'); ?>
	<div class="clear"></div>
</div> <!-- /wrapper -->	
<?php get_footer(); ?>