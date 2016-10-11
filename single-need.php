<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php 
$editmode = get_query_var('editmode');
?>
<div class="content-area">
	<div id="content-full" class="site-content" role="main">
	  <div class="posts">
	<?php 
	$editmode = get_query_var('editmode'); 
	//echo $editmode;
	if($editmode==1){
	  echo '<div id="acf-edit-form">';
	  	echo '<h2 class="page-title">Edit Need</h2>';
	  	acf_form(array(
			'post_title'	=> true,
		));
	  echo '</div>';
	}else{
		include(locate_template('content-loop-single.php'));
	}
	  ?>
	  </div>
	  </div>
</div>
<?php get_footer(); ?>