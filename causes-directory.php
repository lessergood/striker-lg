<?php
/*
* Template Name: Cause Dir
*/
get_header();
$args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => '',
	'role__in'     => array('author'),
	'role__not_in' => array(),
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'date_query'   => array(),        
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'user_nicename',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => ''
 ); 
$users = get_users( $args );
// Cause Search Form
//include(locate_template('search-form-causes.php'));
///////////////
?>
<div class="clear"></div>
<h1 style="margin-left: 30px;">Causes Directory</h1>
<?php
  foreach($users as $user){
    $cause_meta = get_user_meta($user->data->ID); 
    $cause_avatar = $cause_meta['upme_user_pic_thumb'][0] ? $cause_meta['upme_user_pic_thumb'][0] : 'https://1.gravatar.com/avatar/72c354ec39b352bd9cb7d07d7bc324e7?s=50&d=mm&r=g';
?>

<div class="cause-listing" style="width: 100%; margin-left: 30px;">
  <div class="cause-avatar left"><img src="<?php echo $cause_avatar; ?>" /></div>
  <div class="cause-info left" style="margin-left: 10px; margin-top: -2px;">
    <a href="http://lsrgd.in/<?php echo $cause_meta['nickname'][0]; ?>" style="text-decoration: none; color: #000;">
	  <h2 class="cause-name" style="font-size: 20px; line-height: 1em; color: #0094FF;"><?php echo $cause_meta['first_name'][0].' '.$cause_meta['last_name'][0] ?></h2>
    <div class="cause-org-name toolong"><?php echo $cause_meta['org_name'][0] ?></div>
    <div class="cause-name gray" style="font-style: italic;"><?php echo $cause_meta['service_location'][0] ?>&nbsp;</div>
	</a><br /><br />
  </div>
  <div class="clear"></div>    
</div>
<?php } ?>
<?php get_footer(); ?>