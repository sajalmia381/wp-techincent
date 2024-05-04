jQuery( function ( $ ) {
	'use strict';

	$( '.penci-google-map' ).each( function () {

		var map = $( this ),
			Option = map.data( "map_options" ),
			mapID = map.attr( 'id' );



		var mapTypePre = google.maps.MapTypeId.ROADMAP;
		switch ( Option.map_type ) {
			case"satellite":
				mapTypePre = google.maps.MapTypeId.SATELLITE;
				break;
			case"hybrid":
				mapTypePre = google.maps.MapTypeId.HYBRID;
				break;
			case"terrain":
				mapTypePre = google.maps.MapTypeId.TERRAIN
		}
		var latLng = new google.maps.LatLng( - 34.397, 150.644 );
		var map = new google.maps.Map( document.getElementById( mapID ), {
			zoom: Option.map_zoom,
			center: latLng,
			mapTypeId: mapTypePre,
			panControl: Option.map_pan,
			zoomControl: Option.map_is_zoom,
			mapTypeControl: true,
			scaleControl: Option.map_scale,
			streetViewControl: Option.map_street_view,
			rotateControl: Option.map_rotate,
			overviewMapControl: Option.map_overview,
			scrollwheel: Option.map_scrollwheel
		} );
		var marker = new google.maps.Marker( {
			position: latLng,
			map: map,
			title: Option.marker_title,
			icon: Option.marker_img
		} );

		if ( Option.info_window ) {
			var infoWindow = new google.maps.InfoWindow( {
				content: Option.info_window
			} );

			google.maps.event.addListener( marker, "click", function () {
				infoWindow.open( map, marker );
			} );
		}

		if ( 'coordinates' == Option.map_using && Option.latitude && Option.longtitude ) {
			latLng = new google.maps.LatLng( Option.latitude, Option.longtitude );
			map.setCenter( latLng );
			marker.setPosition( latLng );
		} else {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( {
				address: Option.address
			}, function ( results ) {
				var loc = results[0].geometry.location;
				latLng = new google.maps.LatLng( loc.lat(), loc.lng() );
				map.setCenter( latLng );
				marker.setPosition( latLng );
			} );
		}
	} );
} );