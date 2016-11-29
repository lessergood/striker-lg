<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php 
$editmode = get_query_var('editmode');
?>
<div class="wrapper section-inner">
  <?php 
	if($editmode==1){
		get_sidebar('accountleft');
	}else{
		get_sidebar('left');
	} 
  ?>
	<div class="content left">	
	<?php 
	$editmode = get_query_var('editmode'); 
	//echo $editmode;
	if($editmode==1){
	  	echo '<h2>Edit Need</h2>';
	  	acf_form(array(
			'post_title'	=> true,
		));
	}else{
	?>  
	  <?php get_search_form(); ?>
	  <br />
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="posts">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				  	<?php
					$prayer = get_field( "need_prayer" );
					$prayer_desc = get_field( "need_prayer_desc" );
					$items = get_field( "need_items" );
					$items_desc = get_field( "need_items_desc" );
					$finances = get_field( "need_finances" );
					$finances_donation_link = get_field( "need_donation_link" );
					$finances_text2give = get_field( "need_text2give" );
				  	$volunteer = get_field( "need_volunteers" );
					$volunteer_desc = get_field( "need_volunteers_desc" );
					$study = get_field( "need_study" );
					$address = get_field( "need_address" );
					$address2 = get_field( "need_address2" );
					$city = get_field( "need_city" );
					$state = get_field( "need_state_province_region" );
					$postal_code = get_field('need_postal_code');
					$address_country = get_field('need_address_country');
				  	?>
					<div class="post-header">
				<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
				<div class="post-meta">
				  	<div class="need-type-tags left">
						<div class="left need-prayer"><?php if($prayer[0]=="Yes"){echo '<div class="tag-sm tag-prayer">PRAYER</div>'; } ?></div>
						<div class="left need-items"><?php if($items[0]=="Yes"){ echo '<div class="tag-sm tag-items">ITEMS</div>'; } ?></div>
						<div class="left need-finances"><?php if($finances[0]=="Yes"){ echo '<div class="tag-sm tag-finances">DONATE</div>'; } ?></div>
						<div class="left need-volunteers"><?php if($volunteer[0]=="Yes"){ echo '<div class="tag-sm tag-serve">SERVE</div>'; } ?></div>
					  	<div class="left need-study"><?php if($study[0]){ echo '<div class="tag-sm tag-study">STUDY</div>'; } ?></div>
					</div>
				  <div class="clear"></div>	
				  <div>	
					<span class="post-date">
					  	<span class="fa fa-fw fa-calendar text-dark" title="Posted Date"></span>&nbsp;
					  	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp')). ' ago&nbsp;&nbsp;|&nbsp;&nbsp;'; ?>
					</span>
						<span class="post-author">
						  <span class="fa fa-fw fa-user text-dark" title="Post Author"></span>
						  <?php the_author_posts_link(); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
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
							echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
							echo '<span class="fa fa-fw fa-gears text-dark" title="Project Type"></span>&nbsp;<a href="/'.$need_project_type->taxonomy.'/'.$need_project_type->slug.'">'.$need_project_type->name.'</a>';
						}
					?>
					</span>
				  </div>
			  </div>
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
							  $videobits = explode('=',$videourl);
							  $videoid = $videobits[1];
							  if($videoid){
								  echo '<iframe width="615" height="346" src="https://www.youtube.com/embed/'.$videoid.'" frameborder="0" allowfullscreen></iframe>';
							  }
						?>  
					  </div>
					  <div class="need-desc"><?php echo get_field( "need_desc" ); ?></div>
					</div> <!-- /post-content -->
				  <div class="post-footer">
				  	<span class="need-tags">
					  <?php if( has_tag()) { ?>
						<span class="fa fa-fw fa-tag text-dark" title="Project Type"></span>&nbsp;
						<?php the_tags('', ''); ?>
					  <?php } ?>
					</span>
					<div style="clear: both;"></div>
				  </div>
					<div class="need-actions">
					  <br />
					  <strong>ACTIONS YOU CAN TAKE:</strong>
				  		<div class="need-prayer">
							<?php 
								if($prayer[0]=="Yes"){
								  echo '<div class="tag tag-prayer">PRAYER</div>';
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
					  <div class="need-study">
						<?php 
						  if($study[0]){
							echo '<div class="tag tag-study">STUDY</div>';
								echo '<div class="tag-desc tag-study-desc">';
								echo '<a href="'.$study.'">Download study materials</a>';
								echo '<br /><span class="tiny">from our friends at <a href="http://smallworldbiggod.com" target="_blank">Small World Big God</a></span>';
							echo '<br /><br /></div>';
						  }
						?>
					  </div>
					  <div class="need-share">
							<?php 
// echo '<div class="tag tag-share">SHARE</div>';
// echo '<div class="tag-desc tag-share-desc"></div>'; 
							?>
					  </div>
				  	</div>
				  
					 <?php the_content(); ?>
				  
					 	<?php //acf_form(); ?>
						<?php
						//echo '<pre style="font-size: 10px;">';
						//print_r($post_custom);
						//echo '</pre>';
						?>	        
					
					            
					<div class="clear"></div>
					
					<div class="post-meta-bottom">
																		
						<!--
						<p class="post-categories"><span class="category-icon"><span class="front-flap"></span></span> <?php the_category(', '); ?></p>
						-->
						<div class="clear"></div>
												
						<!--
						<div class="post-nav">
													
							<?php
							$prev_post = get_previous_post();
							if (!empty( $prev_post )): ?>
							
								<a class="post-nav-older" title="<?php _e('Previous post:', 'hemingway'); echo ' ' . get_the_title($prev_post); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
								
								<h5><?php _e('Previous post', 'hemingway'); ?></h5>																
								<?php echo get_the_title($prev_post); ?>
								
								</a>
						
							<?php endif; ?>
							
							<?php
							$next_post = get_next_post();
							if (!empty( $next_post )): ?>
								
								<a class="post-nav-newer" title="<?php _e('Next post:', 'hemingway'); echo ' ' . get_the_title($next_post); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
								
								<h5><?php _e('Next post', 'hemingway'); ?></h5>							
								<?php echo get_the_title($next_post); ?>
								
								</a>
						
							<?php endif; ?>
														
							<div class="clear"></div>
						
						</div> -->
						<!-- /post-nav -->
											
					</div> <!-- /post-meta-bottom -->
					
				  <?php //comments_template( '', true ); ?>
												                        
			   	<?php endwhile; else: ?>
			
					<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "hemingway"); ?></p>
				
				<?php endif; ?>    
		
			</div> <!-- /post -->
			
		</div> <!-- /posts -->
	  <?php } // end editmode else ?>
	
	</div> <!-- /content -->
	
	  <?php 
		if($editmode==1){
			get_sidebar('account');
		}else{
			get_sidebar('right');
		} 
	  ?>
	
	<div class="clear"></div>
	
</div> <!-- /wrapper -->
		
<?php get_footer(); ?>