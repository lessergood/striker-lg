<?php
/**
 * The Sidebar containing the account menu
 *
 * @package Striker
 * @since Striker 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'account_menu' ) ) : ?>
		  <div style="width: 240px;" class="right">
		  	<a class="right" href="/register">Register</a>&nbsp;&nbsp;&nbsp;<a class="right" href="/login">Login</a>
		  </div>
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->

		