$(function() {
	$.get('http://52.24.125.211/api/index.php/pois', function(data) {
		data.map(function(location) {
			new google.maps.Marker({
				position: { lat: location.latitude, lng: location.longitude },
				map: map,
				title: 'Gaflei'
			});
			console.log(location);
		});
		console.log(data);
	});
});