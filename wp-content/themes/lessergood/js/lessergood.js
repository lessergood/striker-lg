jQuery(document).ready(function($) {

	$(document).ready(function(){

	});

	$(document).on('click','.projects-widget .widget-title',function(){
		$('.projects-widget ul').toggle();
		$('.countries-widget form').hide();
		$('.tags-widget .tagcloud').hide();
	});

	$(document).on('click','.countries-widget .widget-title',function(){
		$('.countries-widget form').toggle();
		$('.projects-widget ul').hide();
		$('.tags-widget .tagcloud').hide();
	});

	$(document).on('click','.tags-widget .widget-title',function(){
		$('.tags-widget .tagcloud').toggle();
		$('.countries-widget form').hide();
		$('.projects-widget ul').hide();
	});

});