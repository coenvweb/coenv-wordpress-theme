jQuery(function ($) {
	'use strict';

	// use chosen for form inputs
	$('select.chosen').chosen();

	// fitvids for responsive videos
	$('.entry-content').handleFitVids();

	// single faculty member tabs
	$('#member-tab-nav').memberTabs();

});

/**
 * Handle responsive videos
 */
$.fn.handleFitVids = function () {
	'use strict';

	$(this).fitVids();

	$('.fluid-width-video-wrapper').each( function () {
		var $this = $(this),
				maxWidth = parseFloat( $this.css('max-width') ),
				paddingTop = parseFloat( $this[0].style['padding-top'] );

		// increase padding-top relative to max-width set on this element
		var adjustment = maxWidth * ( paddingTop * 0.01 ) + '%';

		$this.css( 'padding-top', adjustment );
	} );
};

$.fn.memberTabs = function () {
	'use strict';

	var $nav = $(this),
			$tabs = $('.member-tabs'),
			activeClass = 'active-tab';

	$nav.find('a').click( function (e) {
		e.preventDefault();

		var $navItem = $(this),
				$tab = $tabs.find('.' + $(this).attr('data-tab') );

		$nav.find('.' + activeClass).removeClass( activeClass );
		$(this).parent('li').addClass( activeClass );

		$tabs.find('.' + activeClass).removeClass( activeClass );
		$tab.addClass( activeClass );
	} );
};