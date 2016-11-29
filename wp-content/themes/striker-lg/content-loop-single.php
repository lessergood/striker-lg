<div class="posts">
<?php
  if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php
	if(get_current_user_id() == get_the_author_id()){
		$editmode = 1;	
	}else{
		$editmode = 0;
	}
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
		  <?php if(get_the_author_meta('upme_user_pic_thumb')){$avatar = get_the_author_meta('upme_user_pic_thumb');}else{$avatar = 'http://1.gravatar.com/avatar/72c354ec39b352bd9cb7d07d7bc324e7?s=50&d=mm&r=g';} ?>
				<div class="post-avatar left"><img style="width: 42px;" src="<?php echo $avatar; ?>" /></div>
				<div class="post-meta left">
					<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<span class="post-date">
					  	<!--<span class="fa fa-fw fa-calendar text-dark" title="Posted Date"></span>&nbsp;-->
					  	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp')). ' ago&nbsp;'; ?>
					</span>
						<span class="post-author">
						  <span class="fa fa-fw fa-user text-dark" title="Post Author"></span>
						  <?php the_author_posts_link(); ?></span>
					<!--<button class="follow-author" data-authorid="<?php echo get_the_author_meta('ID'); ?>" data-userid="<?php echo $user_id ?>" data-field="<?php echo $key; ?>">Follow</button>-->
					 		&nbsp;
					<span class="need-country">
					<?php 
					  	$need_country = get_field( "need_country");
						if($need_country){
						  echo '<span class="fa fa-fw fa-globe text-dark" title="Country"></span>&nbsp;<a href="/'.$need_country->taxonomy.'/'.$need_country->slug.'">'.$need_country->name.'</a>';
						}
					?>
					</span>
					
					<span class="need-project-type">
					<?php 
						$need_project_type = get_field( "need_project_type");
						if($need_project_type){
							echo '&nbsp;';
							echo '<span class="fa fa-fw fa-gears text-dark" title="Project Type"></span>&nbsp;<a href="/'.$need_project_type->taxonomy.'/'.$need_project_type->slug.'">'.$need_project_type->name.'</a>';
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
		  	<?php if($editmode){ ?>
				<button class="btn btn-blue right" onclick="window.location.href='<?php the_permalink(); ?>?editmode=1'">Edit Post</button>
			<?php } ?>
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
					  echo '<iframe width="1010px" height="565px" src="https://www.youtube.com/embed/'.$videoid.'" frameborder="0" allowfullscreen></iframe>';
				  }
				  }
			?>  
		  </div>
		  <div class="need-desc">
			<?php echo get_field('need_desc'); ?>
		  </div>
		  <div class="need-actions">
					  <br />
					  <strong>ACTION TO TAKE:</strong>
				  		<div class="need-prayer">
							<?php 
								if($prayer[0]=="Yes"){
								  echo '<div class="tag tag-prayer">PRAY</div>';
								  echo '<div class="tag-desc tag-prayer-desc">'.$prayer_desc.'</div>';
								}
							?>
						</div>
					  <div class="need-items">
						  	<?php 
								
								if($items[0]=="Yes"){
								  echo '<div class="tag tag-items">ITEMS</div>';
								  echo '<div class="tag-desc tag-items-desc">'.$items_desc.'</div>';
								}
							?>
					  </div>
					  <div class="need-finances">
							<?php 
								
								if($finances[0]=="Yes"){
								  echo '<div class="tag tag-finances">DONATE</div>';
								  echo '<div class="tag-desc tag-finances-desc">';
								  
								  if($finances_donation_link){
									echo 'Online: <a href="'.$finances_donation_link.'">CLICK HERE</a>';
								  }
								  if($finances_donation_link && $finances_text2give){
								  	echo ' or ';
								  }
								  if($finances_text2give){
									echo '<span class="upper">'.$finances_text2give.'</span>';
								  }
								}
							?>
						</div>
					  <div class="need-volunteers">
							<?php 
								if($volunteer[0]=="Yes"){
								  echo '<div class="tag tag-serve">SERVE</div>';
								  echo '<div class="tag-desc tag-volunteers-desc">'.$volunteer_desc;
									echo '<br />';
								  	if($address){
									  echo '<br />Address:<br />';
									  echo '<div class="need-address">'.$address.'</div>';
									  echo '<div class="need-address2">'.$address2.'</div>';
									  echo '<div class="need-city">';
									  echo $city;
									  if($state){
										echo ', '.$state.' '.$postal_code;
									  }
									
									  echo '</div>';
									}
								  echo '</div>';
								}
							?>
					  </div>
						<?php 
						  if($study[0]){
							echo '<div class="need-study">';
							echo '<div class="tag tag-study">STUDY</div>';
								echo '<div class="tag-desc tag-study-desc">';
								echo '<a href="'.$study.'">Download study materials</a>';
								echo '<br /><span class="tiny">from our friends at <a href="http://smallworldbiggod.com" target="_blank">Small World Big God</a></span>';
							echo '<br /><br /></div></div>';
						  }
						?>
					  <div class="need-share">
							<?php 
// echo '<div class="tag tag-share">SHARE</div>';
// echo '<div class="tag-desc tag-share-desc"></div>'; 
							?>
					  </div>
			</div><!-- /need-actions -->
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