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
		<input type="text" class="field" id="s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="Search..." />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
	</form>
