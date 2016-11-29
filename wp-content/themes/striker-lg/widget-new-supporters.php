<?php
  $args = array('role'=>'subscriber','number'=>5); 
  $users = get_users($args);
  foreach($users as $user){
    $supp_meta = get_user_meta($user->data->ID); 
	$supp_data = get_userdata($user->data->ID);
    $supp_avatar = $supp_meta['upme_user_pic_thumb'][0] ? $supp_meta['upme_user_pic_thumb'][0] : '/wp-content/uploads/2016/10/default-user.jpg';
?>
  <div class="cause-avatar left"><img style="width: 32px;" src="<?php echo $supp_avatar; ?>" /></div>
  <div class="cause-info left" style="margin-left: 10px; margin-top: -2px;">
	<h2 class="cause-name" style="font-size: 20px; line-height: 1em; color: #0094FF;">
		<?php 
		$suppname = $supp_data->display_name;
	  	echo $suppname; 
	  	?>
	</h2>
    <div class="cause-name">
	  <?php
	//echo '#'.$supp_meta['causes'][0].'#';
	if($supp_meta['causes'][0] !='' && count($supp_meta['causes'][0]) > 2){
		$cause_count = count($supp_meta['causes'][0]);
		echo $cause_count.' causes';
	}elseif($supp_meta['causes'][0] !='' && count($supp_meta['causes'][0])==1){
		$cause_count = count($supp_meta['causes'][0]);
	  	echo $cause_count.' cause';
	}else{  
	 	echo 'no causes';
	}
	  ?>&nbsp;
	</div>
	
	<br />
  </div>
  <div class="clear"></div>        
<?php }
//var_dump($users);
?>