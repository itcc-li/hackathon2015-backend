$(function() {
	$.get('http://52.24.125.211/api/index.php/pois', function(data) {
		console.log(data);
	});
});