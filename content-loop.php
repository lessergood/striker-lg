<div class="posts">
<?php
  if ($qry->have_posts()) : while ($qry->have_posts()) : $qry->the_post(); ?>
  <?php
	if(get_current_user_id() == get_the_author_id()){
		$editmode = 1;	
	}else{
		$editmode = 0;
	}
	$excerpt_length = 55;
	$prayer = get_field( "need_prayer" );
	$prayer_desc = get_field( "need_prayer_desc" );
	$items = get_field( "need_items" );
	$items_desc = get_field( "need_items_desc" );
	$finances = get_field( "need_finances" );
	$finances_donation_link = get_field( "need_donation_link" );
	$finances_text2give = get_field( "need_text2give" );
	$volunteer = get_field( "need_volunteers" );
	$volunteer_desc = get_field( "need_volunteers_desc" );
	$study = get_field('need_study');
	$address = get_field( "need_address" );
	$address2 = get_field( "need_address2" );
	$city = get_field( "need_city" );
	$state = get_field( "need_state_province_region" );
	$postal_code = get_field('need_postal_code');
	$address_country = get_field('need_address_country');
  ?>	
	<div class="post">
		<div class="post-header">
		  <?php if(get_the_author_meta('user_pic')){$avatar = get_the_author_meta('user_pic');}else{$avatar = '/wp-content/uploads/2016/10/default-user.jpg';} ?>
				<div class="post-avatar left"><img style="width: 42px;" src="<?php echo $avatar; ?>" /></div>
				<div class="post-meta left">
					<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<span class="post-date">
					  	<!--<span class="fa fa-fw fa-calendar text-dark" title="Posted Date"></span>&nbsp;-->
					  	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp')). ' ago&nbsp;'; ?>
					</span>
						<span class="post-author">
						  <span class="fa fa-fw fa-user text-dark" title="Post Author"></span>
						  <?php the_author_posts_link(); ?>
				  		</span>
							<!--<button class="follow-author" data-authorid="<?php echo get_the_author_meta('ID'); ?>" data-userid="<?php echo $user_id ?>" data-field="<?php echo $key; ?>">Follow</button>-->
					 		&nbsp;
					<span class="need-country">
					<?php 
					  	$need_country = get_field( "need_country");
						if($need_country){
						  echo '<span class="fa fa-fw fa-globe text-dark" title="Country"></span>&nbsp;'.$need_country->name;
						  //echo '<a href="/'.$need_country->taxonomy.'/'.$need_country->slug.'">'.$need_country->name.'</a>';
						}
					?>
					</span>
					
					<span class="need-project-type">
					<?php 
						$need_project_type = get_field( "need_project_type");
						if($need_project_type){
							echo '&nbsp;';
						  	echo '<span class="fa fa-fw fa-gears text-dark" title="Project Type"></span>&nbsp;'.$need_project_type->name;
						  //echo '<a href="/'.$need_project_type->taxonomy.'/'.$need_project_type->slug.'">'.$need_project_type->name.'</a>';
						}
					?>
					</span>
					<span class="need-tags">
					  <?php /* if( has_tag()) { ?>
					  		<span class="fa fa-fw fa-tag text-dark" title="Project Type"></span>&nbsp;
					  		<?php the_tags('', ''); ?>
							<?php } */ ?>
					</span>
					<div style="clear: both;"></div>
			  </div>
				<div class="clear"></div>
				<div class="need-type-tags left">
						<div class="left need-prayer"><?php if($prayer[0]=="Yes"){echo '<div class="tag-sm tag-prayer">PRAY</div>'; } ?></div>
						<div class="left need-items"><?php if($items[0]=="Yes"){ echo '<div class="tag-sm tag-items">ITEMS</div>'; } ?></div>
						<div class="left need-finances"><?php if($finances[0]=="Yes"){ echo '<div class="tag-sm tag-finances">DONATE</div>'; } ?></div>
						<div class="left need-volunteers"><?php if($volunteer[0]=="Yes"){ echo '<div class="tag-sm tag-serve">SERVE</div>'; } ?></div>
					  	<div class="left need-study"><?php if($study[0]){ echo '<div class="tag-sm tag-study">STUDY</div>'; } ?></div>
					</div>
				  <div class="clear"></div>	
			</div> <!-- /post-header -->															
		<div class="post-content">
		  <div class="need-image">
		  	<?php 
				$image = get_field('need_image');
				//echo $image;
				echo '<img src="'.$image.'">';
				
			?>
		  </div>
		  <div class="need-video">
			<?php 
				  $videourl = get_field('need_video');
				  if($videourl){
				  $videobits = explode('=',$videourl);
				  $videoid = $videobits[1];
				  if($videoid){
					  echo '<iframe width="100%" height="346" src="https://www.youtube.com/embed/'.$videoid.'" frameborder="0" allowfullscreen></iframe>';
				  }
				  }
			?>  
		  </div>
		  <div class="need-desc">
			<?php echo wp_trim_words(get_field('need_desc'),$excerpt_length,'...'); ?>
			<?php if(str_word_count( strip_tags( get_field('need_desc') ) ) > $excerpt_length){ ?>
				<br /><br />
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">Read more&nbsp;&raquo;</a>
			<?php } ?> 
			<?php if($editmode){ ?>
				<button class="btn btn-blue right" onclick="window.location.href='<?php the_permalink(); ?>?editmode=1'">Edit Post</button>
			<?php } ?>
		  </div>
		</div> <!-- /post-content -->
	  <div class="clear"></div>
	</div> <!-- /post -->
  <?php //if ( comments_open() || get_comments_number() != '' ) : ?>
  <?php //comments_template( '', true ); ?>
  <?php //endif; ?>
<?php endwhile; else: ?>
	<p><?php _e("There are currently no posts."); ?></p>
<?php endif; ?>
 </div> <!-- /posts -->
<div style="clear: both;"></div>