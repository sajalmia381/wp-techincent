function initMap() {
	'use strict';
	var Location = {
		lat: 40.749278,
		lng: -73.985894
	};
	var Canvas = document.getElementById('map');
	var options = {
		center: Location,
		zoom: 18,
		scrollwheel: false
	};
	var map = new google.maps.Map(Canvas, options);

	var marker = new google.maps.Marker({
		position: Location,
		map: map,
		animation: google.maps.Animation.BOUNCE
	});

}
