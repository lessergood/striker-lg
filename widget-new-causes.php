<?php
  $args = array('role'=>'author'); 
  $users = get_users($args);
  foreach($users as $user){
    $cause_meta = get_user_meta($user->data->ID); 
    $cause_avatar = $cause_meta['upme_user_pic_thumb'][0] ? $cause_meta['upme_user_pic_thumb'][0] : 'http://1.gravatar.com/avatar/72c354ec39b352bd9cb7d07d7bc324e7?s=50&d=mm&r=g';
?>
  <div class="cause-avatar left"><img style="width: 32px;" src="<?php echo $cause_avatar; ?>" /></div>
  <div class="cause-info left" style="margin-left: 10px; margin-top: -2px;">
    <a href="http://lsrgd.in/<?php echo $cause_meta['nickname'][0]; ?>" style="text-decoration: none; color: #000;">
<h2 class="cause-name" style="font-size: 24px; line-height: 1em;"><?php echo $cause_meta['first_name'][0].' '.$cause_meta['last_name'][0] ?></h2>
    <div class="cause-org-name toolong" style="width: 185px;"><?php echo $cause_meta['org_name'][0] ?></div>
    <div class="cause-name" style="font-style: italic;"><?php echo $cause_meta['service_location'][0] ?>&nbsp;</div>
</a><br />
  </div>
  <div class="clear"></div>        
<?php }
//var_dump($users);
?>