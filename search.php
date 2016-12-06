<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Striker
 * @since Striker 1.0
 */

get_header();
?>
<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
<?php
$loggedin_user = wp_get_current_user();
$loggedin_user_causes = get_user_meta(get_current_user_id(),'causes',true);
global $wp_query;
//var_dump($wp_query);
//echo get_query_var('search_type');

/*
* Special Search for Causes if search_type is set to cause
*/
if(get_query_var('search_type')){
  $search_type = get_query_var('search_type');
  //echo $search_type;
  $search_string = esc_attr( trim( get_query_var('s') ) );
  $users = new WP_User_Query( array(
	  'search'         => "*{$search_string}*",
	  'role' 			 => 'Author',
	  'search_columns' => array(
		  'user_login',
		  'user_nicename',
		  'user_email',
		  'user_url',
	  ),
	  
	  'meta_query' => array(
		  'relation' => 'OR',
		  array(
			  'key'     => 'first_name',
			  'value'   => $search_string,
			  'compare' => 'LIKE'
		  ),
		  array(
			  'key'     => 'last_name',
			  'value'   => $search_string,
			  'compare' => 'LIKE'
		  )
	  )
  ) );
  $users_found = $users->get_results();
  //var_dump($users_found);
  
  ?>
			<?php 
			  echo '<h1>Search Results</h1>';
			  //get_search_form();
			  echo '<div class="clear"></div>';
				foreach($users_found as $user){
				  //echo $user->data->ID;
				  $user_id = $user->data->ID;
				  $cause_meta = get_user_meta( $user_id); 
				  // echo '<pre>'; print_r($cause_meta); echo '</pre>';
				  $cause_avatar = $cause_meta['upme_user_pic_thumb'][0] ? $cause_meta['upme_user_pic_thumb'][0] : 'https://1.gravatar.com/avatar/72c354ec39b352bd9cb7d07d7bc324e7?s=50&d=mm&r=g';
			  ?>
			  <div class="cause-listing" style="width: 100%">
				<div class="cause-avatar left"><img src="<?php echo $cause_avatar; ?>" /></div>
				<div class="cause-info left" style="margin-left: 10px; margin-top: -2px;">
				  <a href="http://lsrgd.in/<?php echo $cause_meta['nickname'][0]; ?>" style="text-decoration: none; color: #000;">
					<h2 class="cause-name" style="font-size: 20px; line-height: 1em; color: #0094FF;"><?php echo $cause_meta['first_name'][0].' '.$cause_meta['last_name'][0] ?></h2>
				  <div class="cause-org-name toolong"><?php echo $cause_meta['org_name'][0] ?></div>
				  <div class="cause-name gray" style="font-style: italic;"><?php echo $cause_meta['service_location'][0] ?>&nbsp;</div>
				  </a><br /><br />
				</div>
				<div class="right">
				<?php 
				  if($user_id != get_current_user_id()){
					//echo $loggedin_user_causes;
					//echo $user_data->data->ID;
					// echo strpos($loggedin_user_causes,$user_data->data->ID);
					
					  if (strpos($loggedin_user_causes, $user_id)==false) { ?>
							<button class="btn btn-blue" id="follow-cause" data-authorid="<?php echo $user_id; ?>" data-userid="<?php echo get_current_user_id(); ?>" data-field="causes"><i class="fa fa-fw fa-plus"></i>Follow</button>
					  <?php }else{ ?>
							<button class="btn btn-navy" id="follow-cause" data-authorid="<?php echo $user_id; ?>" data-userid="<?php echo get_current_user_id(); ?>" data-field="causes"><i class="fa fa-fw fa-times"></i>Unfollow</button>
					  <?php } ?>
				  <?php } ?>  
				</div>
				<div class="clear"></div>    
			  </div>
			  <?php } /* END USERS FOR LOOP */ ?>
			<?php 
			  if(count($users_found)==0){
			  echo 'No causes were found that match your search. Please try something else.';
			  }
			  ?>			  
  
<?php }else{ ?>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'striker' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php striker_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php striker_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>
			
<? } ?>
		<a href="/">Go back home</a>
	</div><!-- #content .site-content -->
</section><!-- #primary .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>