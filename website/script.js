$(function() {

	checkHash();
	
	function showContent(html) {
		$('#content').html(html);
		$('#page-content').fadeIn();
	}
	
	function checkHash() {
		var hash = location.hash;
		if (hash === '') return;
		
		hash = hash.substr(1);
		$.post('content/' + hash + '.html', function(data) {
			showContent(data);
		});
		$('#close-page-content-btn').click(function() {
			$('#page-content').fadeOut();
		});
	}
	
	$(window).on('hashchange', function() {
		checkHash();
	});
});