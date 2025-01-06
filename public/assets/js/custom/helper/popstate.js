(function ($) {
    $.fn.popstate = function () {
		var url  		= window.location.href;
		var urlExplode 	= url.split('/');
		var urlLast 	= urlExplode[urlExplode.length-1];

    };
}(jQuery));