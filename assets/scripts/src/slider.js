jQuery(function ($) {
	'use strict';

	// no slider animations for < ie8
    if (!$('body').is('.lt-ie8 .post-template-cambodia-signature-story')) {
        if ($('body').is('.post-template-cambodia-signature-story')) {
            $('.big-element.element-slider_gallery').royalSlider({
                loop: true,
                autoScaleSlider: true,
                imageScaleMode: 'fill',
                controlNavigation: 'bullets',
                arrowsNav: true,
                transitionType: 'fade',
                controlsInside: false,
                arrowsNavAutoHide: false,
                globalCaption:true,
                block: {
                    fadeEffect: true
                },
            });
            $('.element.element-').royalSlider({
                loop: true,
                autoScaleSlider: true,
                autoScaleSliderWidth: 1347,
                autoScaleSliderHeight: 1216,
                imageScaleMode: 'fill',
                height: 300,
                width: 750,
                controlNavigation: 'bullets',
                arrowsNav: true,
                transitionType: 'fade',
                controlsInside: false,
                arrowsNavAutoHide: false,
                block: {
                    fadeEffect: true
                }
            });
        }
    }
});