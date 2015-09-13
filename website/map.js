var map;
$(function() {
		google.maps.event.addDomListener(window, 'load', function() {
			initialize();
			
			$.get('http://52.24.125.211/api/index.php/pois', function(data) {
			data.map(function(location) {
				var pos = { lat: location.latitude, lng: location.longitude };
				new google.maps.Marker({
					position: pos,
					map: map,
					title: 'Gaflei'
				});
				console.log(pos);
			});
		});
	});
});

function initialize() {
	var mapCanvas = document.getElementById('map');
    var mapOptions = {
        center: new google.maps.LatLng(47.139495, 9.524542),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
	
	map = new google.maps.Map(mapCanvas, mapOptions);

    /* Tab click functions */
    $('#mp_ui_LeftCLickerTab').click(function() {
        $('#mp_ui_RightTab').fadeOut();
        $('#mp_ui_RightCLickerTab').css('border-bottom' , 'none');

        $('#mp_ui_LeftTab').delay(500).fadeIn();
        $('#mp_ui_LeftCLickerTab').css('border-bottom' , '3px solid #507512');
    });

    $('#mp_ui_RightCLickerTab').click(function() {
        $('#mp_ui_LeftTab').fadeOut();
        $('#mp_ui_LeftCLickerTab').css('border-bottom' , 'none');

        $('#mp_ui_RightTab').delay(500).fadeIn();
        $('#mp_ui_RightCLickerTab').css('border-bottom' , '3px solid #507512');
    });
}
