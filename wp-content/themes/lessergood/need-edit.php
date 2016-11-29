<?php
/*
Template Name: Add Need
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<div class="wrapper section-inner">						
	<?php get_sidebar('accountleft'); ?>
	<div class="content left">
	  <?php //get_search_form(); ?>
		<?php
		acf_form(array(
			'post_id'		=> 'new_post',
			'post_title'	=> true,
		  	'new_post'		=> array(
				'post_type'		=> 'need'
			)
		));
		?>
	</div> <!-- /content left -->
  <?php get_sidebar('account'); ?>
	<div class="clear"></div>
</div> <!-- /wrapper -->
<?php get_footer(); ?>