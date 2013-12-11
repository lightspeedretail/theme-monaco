$(document).ready(function () {
	$('.mobile-menu-btn').click(function () {
		$(".col1,.col2").toggleClass("show");
		$("#container").toggleClass("noverflow");
	});
});
window.onresize = function () {
	$(".col1,.col2").removeClass("show");
	$("#container").removeClass("noverflow");
};