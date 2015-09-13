var map;
$(function() {
		google.maps.event.addDomListener(window, 'load', function() {
			initialize();

			$.get('http://52.24.125.211/api/index.php/pois', function(data) {
			data.map(function(location) {
				var pos = { lat: Number(location.latitude), lng: Number(location.longitude) };
				new google.maps.Marker({
					position: pos,
					map: map,
					title: location.name
				});
			});
		});
	});
});

function initialize() {
	var mapCanvas = document.getElementById('map');

	var styles = [
	  {
		stylers: [
		  { hue: "#00ffe6" },
		  { saturation: -20 }
		]
	  }, {
		featureType: "road",
		elementType: "geometry",
		stylers: [
		  { lightness: 100 },
		  { visibility: "simplified" }
		]
	  }, {
		featureType: "road",
		elementType: "labels",
		stylers: [
		  { visibility: "off" }
		]
	  }
	];

    var mapOptions = {
        center: new google.maps.LatLng(47.139495, 9.524542),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: styles,
		disableDefaultUI: true,
		draggable: false,
		scrollwheel: false,
		disableDoubleClickZoom: true
    }

    map = new google.maps.Map(mapCanvas, mapOptions);
}
