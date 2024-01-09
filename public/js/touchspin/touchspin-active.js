(function ($) {
 "use strict";
 
	$(".capture").TouchSpin({
		buttondown_class: 'btn btn-white',
		buttonup_class: 'btn btn-white',
		min: 1,
		step: 1,
		max: 5,
	});


	$(".pwm").TouchSpin({
		buttondown_class: 'btn btn-white',
		buttonup_class: 'btn btn-white',
		decimals: 1,
		min: 0,
		step: 0.5,
		max: 6.0,
	});

	$(".sampling").TouchSpin({
		buttondown_class: 'btn btn-white',
		buttonup_class: 'btn btn-white',
		min: 20,
		step: 5,
		max: 100,
	});

/*

$(".touchspin2").TouchSpin({
		min: 0,
		max: 100,
		step: 0.1,
		decimals: 2,
		boostat: 5,
		maxboostedstep: 10,
		postfix: '%',
		buttondown_class: 'btn btn-white',
		buttonup_class: 'btn btn-white'
	});

*/

	
 
})(jQuery); 