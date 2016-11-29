<?php get_header(); ?>
<div class="wrapper section-inner">						
  <?php get_sidebar('accountleft'); ?>
	<div class="content left">
		<?php get_search_form(); ?>
		<?php get_template_part( 'content', '' ); ?>
	</div> <!-- /content left -->
  <?php get_sidebar('account'); ?>
	<div class="clear"></div>
</div> <!-- /wrapper -->
<?php get_footer(); ?>