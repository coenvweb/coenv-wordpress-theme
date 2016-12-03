jQuery(function ($) {
	'use strict';

	if ( !$('body').hasClass('lt-ie8') ) {

		// placeholders for older browsers
		$('input, textarea').placeholder();

		// fitvids for responsive videos
		$('article').fitVids();

		// single faculty member tabs
		$('.Faculty-member-tab-nav').memberTabs();

		// banner image reveals
		$('.banner-wrapper').bannerReveals();
		
		// share buttons
		$('.share').coenvshare();
		
		// lightbox
		$('a:not([href*=youtube]):not([href*=youtu]):not([href*=vimeo])').nivoLightbox();
        
        $('figure a img').each(function () {
            var $this = $(this);
            $this.parent().attr('title', $this.attr('alt'));
		});
        
        $('div.gallery img').each(function () {
            var $this = $(this);
            $this.parent().attr('title', $this.attr('alt'));
		});

        // split galleries using parent id 
		$('div.gallery a').each(function () {
            var $this = $(this);
            $this.attr('data-lightbox-gallery', $this.closest('div').attr('id'));
		});
        
        if ( $('body').hasClass('post-type-archive-faculty') ) {
        
            // custom scrollbar
            $('.js .faculty-toolbox-roller-items').mCustomScrollbar({
                autoHideScrollbar: false,
                setHeight:175,
                theme: 'minimal-dark',
                scrollInteria: 1,
            });

            // scroll to selection
            $('.js .faculty-toolbox-roller-items').mCustomScrollbar(
                'scrollTo', '.Faculty-toolbox-roller-item--active'
            );
        }
        
        if ( $('body').hasClass('home') ) {
            var $boxes = $('.story-thung');
            $boxes.hide();

            $('.stories-container').imagesLoaded( function() {
                $boxes.fadeIn();

                $('.stories-container').masonry({
                    // options
                    itemSelector: '.story',
                    columnWidth: '.story-sizer',
                    percentPosition: true
                });
            });
            
        }

	}
    
});

jQuery("document").ready(function($){
	
	var nav = $('#careers-filter');
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 685) {
			nav.addClass("f-nav");
		} else {
			nav.removeClass("f-nav");
		}
	});
 
});

/**
 * Banner image reveals
 */
$.fn.bannerReveals = function () {
	'use strict';

	return this.each( function () {

		var $container = $(this),
				$revealBtn = $('.banner-info'),
				activeClass = 'banner-revealed';



		$revealBtn.on( 'click', function ( e ) {
			e.preventDefault();
			e.stopPropagation();

			$('body').toggleClass( activeClass );
		} );

		$container.on( 'click', function () {
			if ( $('body').hasClass( activeClass ) ) {
				$('body').removeClass( activeClass );
			}
		} );

	} );
};

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

/**
 * Faculty member tabs
 */

$.fn.memberTabs = function () {
	'use strict';

	var $nav = $(this),
		$tabs = $('.Faculty-member-tabs'),
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


/**
 * Close UW Alert
 */

jQuery(document).ready(function() {
  closeUWAlert();
});

function closeUWAlert () {
  if($('#uwalert-alert-message').is(':hidden')){ //if the container is visible on the page
    if ($('#uwalert-alert-message')){
        $('#uwalert-alert-header').append('<div class="button right" id="closer">X</div>');
        var alertHeading = $('#uwalert-alert-header')[0];
        $('#closer').live('click', function(e){
            $('#uwalert-alert-message').removeClass('please-unhide');
            $('#uwalert-alert-message').hide();
            localStorage.clicked = alertHeading.innerHTML;
        });
        if(localStorage.clicked === alertHeading.innerHTML){
            console.log('UW Alert is hidden ' + localStorage.clicked);
            $('#uwalert-alert-message').hide();
        } else {
            $('#uwalert-alert-message').addClass('please-unhide');
        }
    }
  } else {
    setTimeout(closeUWAlert, 50); //wait 50 ms, then try again
  }
}