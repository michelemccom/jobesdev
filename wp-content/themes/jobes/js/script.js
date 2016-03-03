jQuery('.menu-icon').click( function(event){
		event.preventDefault();
		if (jQuery('.mobile-nav ul').hasClass("open") ) {
			jQuery('.mobile-nav ul').removeClass("open");
			jQuery('.mobile-nav ul').addClass("closed");
		} else {	
			jQuery('.mobile-nav ul').removeClass("closed");
			jQuery('.mobile-nav ul').addClass("open");
		}
		return false;
	});