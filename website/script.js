$(function() {
	var hash = location.hash;
	if (hash === '') return;
	hash = hash.substr(1);
	$.post(hash + '.html', function(data) {
		showContent(data);
	});
	function showContent(html) {
		console.log(html);
	}
});