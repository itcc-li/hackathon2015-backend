$(function() {
	var map = $('#map')[0];
	
	$.get('http://52.24.125.211/api/index.php/pois', function(data) {
		data.map(function(location) {
			var marker = new google.maps.Marker({
				position: { lat: location.lat, lng: location.lng },
				map: map,
				title: 'Gaflei'
			});
		});
		console.log(data);
	});
});