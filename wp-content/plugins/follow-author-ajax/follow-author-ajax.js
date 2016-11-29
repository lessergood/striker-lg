jQuery(document).on('click','#follow-cause',function($) {
  var author_id = jQuery(this).data('authorid');
  var user_id = jQuery(this).data('userid');
  var field = jQuery(this).data('field');
  //console.log(author_id,user_id,field)
  jQuery.ajax({
    url: ajaxmagic.ajax_url,
    type: 'post',
    data: {
      action: 'follow_author_ajax',
      author_id: author_id,
      user_id: user_id,
      field: field
    },
    success: function( response ) {
	  //console.log(response);
		toggleButtonState(response);
    },
  	error: function(errorThrown){
      console.log(errorThrown);
  	} 
  });

  return false;

});

function toggleButtonState(response){
	if(response == 0){
		jQuery('#follow-cause').html('<i class="fa fa-fw fa-plus"></i>Follow');
	}
	if(response > 0){
		jQuery('#follow-cause').html('<i class="fa fa-fw fa-times"></i>Unfollow');
	}
}