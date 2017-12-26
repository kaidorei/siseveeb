jQuery(document).ready(function($){
	var mainHeader = $('.cd-header');

	mainHeader.on('click', '.nav-trigger', function(event){
		// open primary navigation on mobile
		event.preventDefault();
		mainHeader.toggleClass('nav-open');
	});
});