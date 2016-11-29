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
		<input type="text" class="field" id="author_name" name="author_name" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search..." />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
	</form>
