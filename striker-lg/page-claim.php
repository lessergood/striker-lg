<?php 
/*
* Template Name: Claim
*/
get_header();
?>
<div class="content-area">
	<div id="content-full" class="site-content" role="main">
		<?php  if (have_posts()) : while (have_posts()) : the_post(); ?> 
		  	<h2><?php the_title() ?></h2>
			<?php the_content(); ?>
			<div style="display: none;">
			  <div class="upme-field upme-edit upme-edit-show">
				  <label class="upme-field-type" for="user_name_email-1">
					  <i class="upme-icon upme-icon-user"></i>
					  <span>Your Email</span>
				  </label>
				  <div class="upme-field-value">
					  <input type="text" class="upme-input" name="user_name_email" id="user_name_email-1" value=""></div>
			  </div>
		  
			  <div class="upme-field upme-edit upme-edit-show">
				  <label class="upme-field-type upme-blank-lable">&nbsp;</label>
				  <div class="upme-field-value">
					  <div class="upme-back-to-login">
					 
				  <input type="button" name="upme-forgot-pass" id="upme-forgot-pass-btn-1" class="upme-button upme-login" value="Claim your cause">
				  </div>
			  </div>
		  </div>
		<?php endwhile; else: ?>
			<p><?php _e("There are currently no posts."); ?></p>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>