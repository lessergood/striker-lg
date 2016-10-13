<?php
$user = get_currentuserinfo();
$username = $user->user_login;
$user_displayname = $user->display_name;
$user_meta = get_user_meta($user->ID);
$user_avatar = $user_meta['user_pic'][0] ? $user_meta['user_pic'][0] : '/wp-content/uploads/2016/10/default-user.jpg';
?>
<?php if(is_user_logged_in()){ ?>
<div id="secondary">
	<h3 class="menu-title right">
		<button class="nostyle" onclick="jQuery('.account-menu-links').toggle();">
			<?php echo $user_displayname; ?>&nbsp;
			<i class="fa fa-fw fa-chevron-down right"></i>
		</button>
	</h3>
	<div class="account-menu-avatar">
		<img src="<?php echo $user_avatar; ?>" />
	</div>
	<div class="account-menu-links">
	  <?php 
	  	$user = wp_get_current_user();
	  	if ( in_array( 'subscriber', (array) $user->roles ) ) {
		?>
			<a href="/author/<?php echo $username; ?>"><i class="fa fa-fw fa-bolt"></i>&nbsp;My Causes</a>
	 	<?php }else{ ?>
	 		<a href="/author/<?php echo $username; ?>"><i class="fa fa-fw fa-flag"></i>&nbsp;Cause</a>
	  	<?php } ?>
	  <a href="/profile"><i class="fa fa-fw fa-user"></i>&nbsp;Profile</a>
		<?php if(current_user_can('publish_posts')){ ?>
	  		<a href="/add-post"><i class="fa fa-fw fa-plus"></i>&nbsp;New Post</a>
	  	<?php } ?>
		<a href="<?php echo wp_logout_url(); ?>"><i class="fa fa-fw fa-sign-out"></i>&nbsp;Logout</a>
	</div>
</div>
<?php }else{ ?>
<a href="/login" class="left" style="margin-top: 5px; margin-right: 10px !important;"><i class="fa fa-fw fa-sign-in"></i>&nbsp;Login</a>
	<a href="/register" class="left" style="margin-top: 5px; margin-right: 10px !important;"><i class="fa fa-fw fa-check"></i>&nbsp;Sign Up</a>
<?php } ?>