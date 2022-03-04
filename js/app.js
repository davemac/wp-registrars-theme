
'use strict';
jQuery(document).ready(function($) {

    $('.property-slider-combined').flickity({
		// options
		cellAlign: 'left',
		wrapAround: true,
		groupCells: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: 2
	});

    var options = {
        valueNames: [
            'reg_name',
            'reg_location',
            'reg_position',
            'reg_specialisation',
        ]
    };
    var userList = new List('tablelist', options);

});