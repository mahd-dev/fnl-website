jQuery(function($){

	//initlize onepagenav
	
	$('#menu-onepage-menu').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 900,
        scrollOffset: 200,
        scrollThreshold: 0.5,
        filter: ':not(.no-scroll)'

    });


	
});