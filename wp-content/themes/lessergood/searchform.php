<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" value="" placeholder="<?php _e('what are you looking for?', 'hemingway'); ?>" name="s" id="s" /> 
	<input type="submit" id="searchsubmit" value="<?php _e('Go', 'hemingway'); ?>">
</form>