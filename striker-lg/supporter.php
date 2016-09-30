<div id="primary" class="content-area">
	<div class="clear"></div>
	<div id="content" class="site-content" role="main">
	<div class="cause-container">
		<div class="cause-content">
			<div class="cause-info left">
			  <!--<h2 class="cause-name">Updates from your causes</h2>-->
			  <?php 
				$args = array('author'=>implode(',',$causes),'post_type'=>'need');
				$qry = new WP_Query($args); 
			  ?>
			  <?php include(locate_template('content-loop.php')); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
<div id="secondary">
	<div class="widget">
	  	<div class="widget-content">
		  <h3 class="widget-title">Causes You Follow:</h3>
		  <?php 
			foreach($causes as $causeid){
				$cause = get_user_by('ID',$causeid); 
			  	//var_dump($cause);
			  	$cause_meta = get_user_meta($causeid);
			  	$cause_avatar = $cause_meta['upme_user_pic_thumb'][0] ? $cause_meta['upme_user_pic_thumb'][0] : 'http://1.gravatar.com/avatar/72c354ec39b352bd9cb7d07d7bc324e7?s=50&d=mm&r=g';
			  	//var_dump($cause_meta);
			  ?>
		  <div class="cause-avatar left"><img style="width: 32px;" src="<?php echo $cause_avatar; ?>" /></div>
		  <div class="cause-info left" style="margin-left: 10px; margin-top: -2px;">
			<h2 class="cause-name" style="font-size: 24px; line-height: 1em;"><?php echo $cause_meta['first_name'][0].' '.$cause_meta['last_name'][0] ?></h2>
			<span class="cause-org-name"><?php echo $cause_meta['org_name'][0] ?></span>
		  	<a href="http://lsrgd.in/<?php echo $cause_meta['nickname'][0]; ?>">Visit</a>
			<div class="cause-name" style="font-style: italic;"><?php echo $cause_meta['service_location'][0] ?>&nbsp;</div>
		  </div>
		  <div class="clear"></div>
	  <?php } ?>
	  	</div>
	</div>
</div>
<!--CAUSE OWNED PROFILE-->
<!--SIDEBAR-->
<div id="secondary">


</div>
<!--/SIDEBAR-->