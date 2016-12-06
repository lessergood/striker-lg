<?php
/**
 * The template for displaying search forms in Striker
 *
 * @package Striker
 * @since Striker 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text">Search</label>
		<input type="text" class="field" name="as" id="sul-s" placeholder="Search Causes" value="">	
	  	<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
	</form>