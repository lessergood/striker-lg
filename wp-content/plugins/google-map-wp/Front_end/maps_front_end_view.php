<?php
function showpublishedmap( $id ) {
	ob_start();
	global $wpdb;
	$sql           = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "g_maps WHERE id=%s", $id );
	$getMapContent = $wpdb->get_results( $sql );
	if ( $getMapContent ) {
		foreach ( $getMapContent as $map ) {
			$i = rand( 1, 1000000 );
			?>
			<div id="huge_it_google_map<?php echo $i; ?>_container">
				<div class="hide" id="huge_it_google_map<?php echo $i; ?>"
				     style="position:relative !important;height:<?php echo $map->height; ?>px; width:<?php echo $map->width; ?>%;
					     border-radius:<?php echo $map->border_radius; ?>px !important;
				     <?php if ( $map->align == 'left' ) {
					     ?>
					     float:left !important;
					     margin:0px 0px 0px 0px !important;
					     <?php ;
				     }
				     if ( $map->align == 'right' ) {
					     ?>
					     float:right !important;
					     margin:0px 0px 0px 0px !important;
					     <?php ;
				     }
				     if ( $map->align == 'center' ) {
					     ?>
					     margin:0px auto !important;
					     float:none;
					     <?php ;
				     }
				     ?>">
				</div>
			</div>
			<style>
				#huge_it_google_map<?php echo $i; ?> img {
					max-width: none;
					visibility: visible !important;
				}
				.hide {
					display: none;
				}
			</style>
			<script>
				jQuery(document).ready(function () {
					function InitializeMap<?php echo $i; ?>() {
						var marker = [];
						var polygone = [];
						var polyline = [];
						var polylinepoints;
						var newpolylinecoords = [];
						var polygonpoints;
						var polygoncoords = [];
						var directions = [];
						var directionMarkers = [];
						var newcircle = [];
						var infowindow = [];
						var newcirclemarker = [];
						var circlepoint;
						var width = jQuery("#huge_it_google_map").width();
						var height = jQuery("#huge_it_google_map").height();
						var div = parseInt(width) / parseInt(height);
						var trafficLayer = new google.maps.TrafficLayer();
						var bikeLayer = new google.maps.BicyclingLayer();
						var transitLayer = new google.maps.TransitLayer();
						function bindInfoWindow(marker, map, infowindow, description, info_type) {
							if (info_type == "click") {
								google.maps.event.addListener(marker, 'click', function () {
									infowindow.setContent(description);
									infowindow.open(map, marker);
								});
							}
							if (info_type == "hover") {
								google.maps.event.addListener(marker, 'mouseover', function () {
									infowindow.setContent(description);
									infowindow.open(map, marker);
								});
								google.maps.event.addListener(marker, 'mouseout', function () {
									infowindow.close(map, marker);
								});
							}
						}
						jQuery(document).on("click tap drag scroll", function (e) {
							if (window.matchMedia('(max-width:768px)').matches) {
								var container = jQuery("#huge_it_google_map<?php echo $i; ?>");
								if (!container.is(e.target) && container.has(e.target).length === 0) {
									front_end_map.setOptions({
										draggable: false,
										scrollwheel: false,
									});
								} else {
									front_end_map.setOptions({
										draggable:<?php echo $map->draggable; ?>,
										scrollwheel:<?php echo $map->wheel_scroll; ?>,
									});
								}
							}
						});
						jQuery(window).on("resize", function () {
							var newwidth = jQuery("#huge_it_google_map").width();
							var newheight = parseInt(newwidth) / parseInt(div) + "px";
							jQuery("#huge_it_google_map").height(newheight);
							console.log(jQuery("#huge_it_google_map").height());
						})
						var center_lat = <?php echo $map->center_lat; ?>;
						var center_lng = <?php echo $map->center_lng; ?>;
						var center_coords = new google.maps.LatLng(center_lat, center_lng);
						var styles = [
							{
								stylers: [
									{hue: "#<?php echo $map->styling_hue; ?>"},
									{saturation:<?php echo $map->styling_saturation; ?> },
									{lightness:<?php echo $map->styling_lightness; ?> },
									{gamma:<?php echo $map->styling_gamma; ?> },
								]
							}
						]
						var frontEndMapOptions = {
							zoom: parseInt(<?php echo $map->zoom; ?>),
							center: center_coords,
							disableDefaultUI: true,
							styles: styles,
							panControl: <?php echo $map->pan_controller; ?>,
							zoomControl: <?php echo $map->zoom_controller; ?>,
							mapTypeControl: <?php echo $map->type_controller; ?>,
							scaleControl: <?php echo $map->scale_controller; ?>,
							streetViewControl: <?php echo $map->street_view_controller; ?>,
							overviewMapControl: <?php echo $map->overview_map_controller; ?>,
							mapTypeId: google.maps.MapTypeId.<?php if ( is_numeric( $map->type ) ) {
							echo "ROADMAP";
						} else {
							echo $map->type;
						} ?>,
							minZoom: parseInt(<?php echo $map->min_zoom; ?>),
							maxZoom: parseInt(<?php echo $map->max_zoom; ?>)
						}
						var front_end_map = new google.maps.Map(document.getElementById('huge_it_google_map<?php echo $i; ?>'), frontEndMapOptions);
						if (window.matchMedia('(max-width:768px)').matches) {
							front_end_map.setOptions({
								draggable: false,
								scrollwheel: false,
							});
						} else {
							front_end_map.setOptions({
								draggable:<?php echo $map->draggable; ?>,
								scrollwheel:<?php echo $map->wheel_scroll; ?>,
							});
						}
						var huge_map_shown = 0;
						function front_map_animations() {
							var map_anim;
							huge_map_shown = 1;
							var block = jQuery("#huge_it_google_map<?php echo $i; ?>");
							if ("<?php echo $map->animation; ?>" == "none") {
								map_anim = "";
							} else {
								map_anim = "<?php echo $map->animation; ?>";
							}
							block.removeClass("hide");
							block.addClass("animated " + map_anim);
							google.maps.event.trigger(front_end_map, 'resize');
							front_end_map.setCenter(center_coords);
						}
						if (jQuery(window).scrollTop() <= jQuery("#huge_it_google_map<?php echo $i; ?>_container").offset().top
							&& jQuery(window).scrollTop() + jQuery(window).height() >= jQuery("#huge_it_google_map<?php echo $i; ?>_container").offset().top
						) {
							setTimeout(function () {
								front_map_animations();
							}, 500);
						}
						jQuery(window).scroll(function () {
							if (jQuery(window).scrollTop() <= jQuery("#huge_it_google_map<?php echo $i; ?>_container").offset().top
								&& jQuery(window).scrollTop() + jQuery(window).height() >= jQuery("#huge_it_google_map<?php echo $i; ?>_container").offset().top
							) {
								setTimeout(function () {
									front_map_animations();
								}, 500);
							}
						});
						if ("<?php echo $map->bike_layer; ?>" == "true") {
							bikeLayer.setMap(front_end_map);
						}
						if ("<?php echo $map->traffic_layer; ?>" == "true") {
							trafficLayer.setMap(front_end_map);
						}
						if ("<?php echo $map->transit_layer; ?>" == "true") {
							transitLayer.setMap(front_end_map);
						}
						var front_end_data = {
							action: 'g_map_options',
							map_id:<?php echo $id; ?>,
							task: 'ajax'
						}
						jQuery.ajax({
							url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
							dataType: 'json',
							method: 'post',
							data: front_end_data,
							beforeSend: function () {
							}
						}).done(function (response) {
							HGinitializeMap(response);
						}).fail(function () {
							console.log('Failed to load response from database');
						});
						function HGinitializeMap(response) {
							if (response.success) {
								var mapInfo = response.success;
								var markers = mapInfo.markers;
								for (var i = 0; i < markers.length; i++) {
									var name = markers[i].name;
									var address = markers[i].address;
									var anim = markers[i].animation;
									var description = markers[i].description;
									var markimg = markers[i].img;
									var img = new google.maps.MarkerImage(markimg,
										new google.maps.Size(20, 20));
									var point = new google.maps.LatLng(
										parseFloat(markers[i].lat),
										parseFloat(markers[i].lng));
									var html = "<b>" + name + "</b> <br/>" + address;
									if (anim == 'DROP') {
										marker[i] = new google.maps.Marker({
											map: front_end_map,
											position: point,
											title: name,
											icon: markimg,
											content: description,
											animation: google.maps.Animation.DROP,
										});
									}
									if (anim == 'BOUNCE') {
										marker[i] = new google.maps.Marker({
											map: front_end_map,
											position: point,
											title: name,
											content: description,
											icon: markimg,
											animation: google.maps.Animation.BOUNCE
										});
									}
									if (anim == 'NONE') {
										marker[i] = new google.maps.Marker({
											map: front_end_map,
											position: point,
											icon: markimg,
											content: description,
											title: name,
										});
									}
									infowindow[i] = new google.maps.InfoWindow;
									bindInfoWindow(marker[i], front_end_map, infowindow[i], description, "<?php echo $map->info_type; ?>");
								}
								var polygones = mapInfo.polygons;
								for (var i = 0; i < polygones.length; i++) {
									var name = polygones[i].name;
									var line_opacity = polygones[i].line_opacity;
									var line_color = "#" + polygones[i].line_color;
									var fill_opacity = polygones[i].fill_opacity;
									var line_width = polygones[i].line_width;
									var fill_color = "#" + polygones[i].fill_color;
									var latlngs = polygones[i].latlng;
									polygoncoords = [];
									for (var j = 0; j < latlngs.length; j++) {
										polygonpoints = new google.maps.LatLng(parseFloat(latlngs[j].lat),
											parseFloat(latlngs[j].lng))
										polygoncoords.push(polygonpoints)
									}
									//alert(polygoncoords);
									polygone[i] = new google.maps.Polygon({
										paths: polygoncoords,
										map: front_end_map,
										strokeOpacity: line_opacity,
										strokeColor: line_color,
										strokeWeight: line_width,
										fillOpacity: fill_opacity,
										fillColor: fill_color,
										draggable: false,
									});
									google.maps.event.addListener(polygone[i], 'click', function (event) {
										var polygone_index = polygone.indexOf(this);
										var polygone_url = polygones[polygone_index].url;
										if (polygone_url != "") {
											window.open(polygone_url, '_blank');
										}
									})
									google.maps.event.addListener(polygone[i], 'mouseover', function (event) {
										var polygone_index = polygone.indexOf(this);
										hover_new_line_opacity = polygones[polygone_index].hover_line_opacity;
										hover_new_line_color = "#" + polygones[polygone_index].hover_line_color;
										hover_new_fill_opacity = polygones[polygone_index].hover_fill_opacity;
										hover_new_fill_color = "#" + polygones[polygone_index].hover_fill_color;
										this.setOptions({
											strokeColor: hover_new_line_color,
											strokeOpacity: hover_new_line_opacity,
											fillOpacity: hover_new_fill_opacity,
											fillColor: hover_new_fill_color,
										});
									})
									google.maps.event.addListener(polygone[i], 'mouseout', function (event) {
										polygone_index = polygone.indexOf(this);
										new_line_opacity = polygones[polygone_index].line_opacity;
										new_line_color = "#" + polygones[polygone_index].line_color;
										new_fill_opacity = polygones[polygone_index].fill_opacity;
										new_line_width = polygones[polygone_index].line_width;
										new_fill_color = "#" + polygones[polygone_index].fill_color;
										this.setOptions({
											strokeColor: new_line_color,
											strokeOpacity: new_line_opacity,
											fillOpacity: new_fill_opacity,
											fillColor: new_fill_color,
										});
									})
								}
								var polylines = mapInfo.polylines;
								for (var i = 0; i < polylines.length; i++) {
									var name = polylines[i].name;
									var line_opacity = polylines[i].line_opacity;
									var line_color = polylines[i].line_color;
									var line_width = polylines[i].line_width;
									var latlngs = polylines[i].latlng;
									newpolylinecoords = [];
									for (var j = 0; j < latlngs.length; j++) {
										polylinepoints = new google.maps.LatLng(parseFloat(latlngs[j].lat),
											parseFloat(latlngs[j].lng))
										newpolylinecoords.push(polylinepoints)
									}
									polyline[i] = new google.maps.Polyline({
										path: newpolylinecoords,
										map: front_end_map,
										strokeColor: "#" + line_color,
										strokeOpacity: line_opacity,
										strokeWeight: line_width,
									})
									google.maps.event.addListener(polyline[i], 'mouseover', function (event) {
										var polyline_index = polyline.indexOf(this);
										hover_new_line_opacity = polylines[polyline_index].hover_line_opacity;
										hover_new_line_color = "#" + polylines[polyline_index].hover_line_color;
										hover_new_fill_opacity = polylines[polyline_index].hover_fill_opacity;
										hover_new_fill_color = "#" + polylines[polyline_index].hover_fill_color;
										this.setOptions({
											strokeColor: hover_new_line_color,
											strokeOpacity: hover_new_line_opacity,
											fillOpacity: hover_new_fill_opacity,
											fillColor: hover_new_fill_color,
										});
									})
									google.maps.event.addListener(polyline[i], 'mouseout', function (event) {
										polyline_index = polyline.indexOf(this);
										new_line_opacity = polylines[polyline_index].line_opacity;
										new_line_color = "#" + polylines[polyline_index].line_color;
										new_line_width = polylines[polyline_index].line_width;
										this.setOptions({
											strokeColor: new_line_color,
											strokeOpacity: new_line_opacity
										});
									})
								}
								var info_directions = mapInfo.directions;
								for( var d = 0; d < info_directions.length; d++ ){
									var dir_name = info_directions[d].name;
									var dir_start_lat = info_directions[d].start_lat;
									var dir_start_lng = info_directions[d].start_lng;
									var dir_end_lat = info_directions[d].end_lat;
									var dir_end_lng = info_directions[d].end_lng;
									var dir_show_steps = info_directions[d].show_steps;
									var dir_travel_mode = info_directions[d].travel_mode;
									var dir_line_width = info_directions[d].line_width;
									var dir_line_color = info_directions[d].line_color;
									var dir_line_opacity = info_directions[d].line_opacity;
									var dir_show_steps = info_directions[d].show_steps == 'yes';
									var directionsService = new google.maps.DirectionsService();
									var stepDisplay = new google.maps.InfoWindow;
									var request = {
										destination: new google.maps.LatLng(parseFloat(dir_end_lat),
											parseFloat(dir_end_lng)),
										origin: new google.maps.LatLng(parseFloat(dir_start_lat),
											parseFloat(dir_start_lng)),
										travelMode: google.maps.TravelMode[dir_travel_mode]
									};
									(function(d){
										directionsService.route(request, function(response, status) {
											if (status == google.maps.DirectionsStatus.OK) {
												directions[d] = new google.maps.DirectionsRenderer({
													map: front_end_map,
													draggable: false,
													preserveViewport : true,
													polylineOptions : {
														clickable : false,
														strokeColor: "#" + info_directions[d].line_color,
														strokeOpacity: info_directions[d].line_opacity,
														strokeWeight: info_directions[d].line_width
													}
												});
												directions[d].setDirections(response);
												if( info_directions[d].show_steps == "yes" ){
													if(directionMarkers[d]){
														for (var o = 0; o < directionMarkers[d].length; o++) {
															directionMarkers[d][o].setMap(null);
														}
													}else{
														directionMarkers[d] = [];
													}
													var newRoute = directions[d].directions.routes[0].legs[0];
													for (var w = 0; w < newRoute.steps.length; w++) {
														var marker = directionMarkers[d][w] = directionMarkers[d][w] || new google.maps.Marker;
														marker.setMap(front_end_map);
														marker.setPosition(newRoute.steps[w].start_location);
														HgGmapsMainMapAttachInstructionText(
															stepDisplay, marker, newRoute.steps[w].instructions, front_end_map);
													}
													function HgGmapsMainMapAttachInstructionText(stepDisplay, marker, text, map) {
														google.maps.event.addListener(marker, 'click', function() {
															/*Open an info window when the marker is clicked on, containing the text of the step.*/
															stepDisplay.setContent(text);
															stepDisplay.open(map, marker);
														});
													}
												}
											}
										});
									}(d));
								}
								var circles = mapInfo.circles;
								for (var i = 0; i < circles.length; i++) {
									var circle_name = circles[i].name;
									var circle_center_lat = circles[i].center_lat;
									var circle_center_lng = circles[i].center_lng;
									var circle_radius = circles[i].radius;
									var circle_line_width = circles[i].line_width;
									var circle_line_color = circles[i].line_color;
									var circle_line_opacity = circles[i].line_opacity;
									var circle_fill_color = circles[i].fill_color;
									var circle_fill_opacity = circles[i].fill_opacity;
									var circle_show_marker = parseInt(circles[i].show_marker);
									circlepoint = new google.maps.LatLng(parseFloat(circles[i].center_lat),
										parseFloat(circles[i].center_lng));
									newcircle[i] = new google.maps.Circle({
										map: front_end_map,
										center: circlepoint,
										title: name,
										radius: parseInt(circle_radius),
										strokeColor: "#" + circle_line_color,
										strokeOpacity: circle_line_opacity,
										strokeWeight: circle_line_width,
										fillColor: "#" + circle_fill_color,
										fillOpacity: circle_fill_opacity
									});
									if (circle_show_marker == '1') {
										newcirclemarker[i] = new google.maps.Marker({
											position: circlepoint,
											map: front_end_map,
											title: circle_name,
										});
									}
									google.maps.event.addListener(newcircle[i], 'mouseover', function (event) {
										var circle_index = newcircle.indexOf(this);
										hover_new_line_opacity = circles[circle_index].hover_line_opacity;
										hover_new_line_color = "#" + circles[circle_index].hover_line_color;
										hover_new_fill_opacity = circles[circle_index].hover_fill_opacity;
										hover_new_fill_color = "#" + circles[circle_index].hover_fill_color;
										this.setOptions({
											strokeColor: hover_new_line_color,
											strokeOpacity: hover_new_line_opacity,
											fillOpacity: hover_new_fill_opacity,
											fillColor: hover_new_fill_color,
										});
									});
									google.maps.event.addListener(newcircle[i], 'mouseout', function (event) {
										circle_index = newcircle.indexOf(this);
										new_line_opacity = circles[circle_index].line_opacity;
										new_line_color = "#" + circles[circle_index].line_color;
										new_fill_opacity = circles[circle_index].fill_opacity;
										new_fill_color = "#" + circles[circle_index].fill_color;
										this.setOptions({
											strokeColor: new_line_color,
											strokeOpacity: new_line_opacity,
											fillOpacity: new_fill_opacity,
											fillColor: new_fill_color,
										});
									});
								}
							}
						}
					}
					InitializeMap<?php echo $i; ?>();
				})
			</script>
			<?php ;
		}
	}
	return ob_get_clean();
}

?>
