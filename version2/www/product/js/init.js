/*
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

		skel.init({
		reset: 'full',
		breakpoints: {
			'max': { range: '*', href: 'css/style.css', containers: 1440, viewport: { scalable: false }, grid: { gutters: 40 } },
			'wide': { range: '-1920', href: 'css/style-wide.css', containers: 1200 },
			'normal': { range: '-1680', href: 'css/style-normal.css', containers: 1200 ,                 grid: {	zoom:2}},
			'narrow': { range: '-1280', href: 'css/style-narrow.css', containers: 960 ,                  grid: { gutters: 30 , zoom:3 }},
			'samsung-note4': { range: '-1000', href: 'css/style-mobile-note4.css',  containers: '95%',   grid: { gutters: 20,  zoom:4 }},
			'narrower': { range: '-800', href: 'css/style-narrower.css', containers: '95%' ,             grid: { collapse: true, gutters: 20 , zoom:5 }},
			'mobile': { range: '-736', href: 'css/style-mobile.css', containers: '98%',                  grid: { collapse: true, gutters: 15,  zoom:6 }, viewport: { scalable: false }},
			'mobile-narrow': { range: '-480', href: 'css/style-mobile-narrow.css',  containers: '100%!', grid: { collapse: true, gutters: 10,  zoom:7 }, viewport: { scalable: false }},
			
		}
	});
	/*skel.init({
		reset: 'full',
		breakpoints: {
			'global':	{ range: '*', href: 'css/style.css' },
			'desktop':	{ range: '737-', href: 'css/style-desktop.css', containers: 1200, grid: { gutters: 25 } },
			'1000px':	{ range: '737-1200', href: 'css/style-1000px.css', containers: 960, grid: { gutters: 25 , zoom:2 }, viewport: { width: 1080 } },
			'mobile':	{ range: '-736', href: 'css/style-mobile.css', containers: '100%!', grid: { collapse: true, gutters: 15, zoom:3 }, viewport: { scalable: false } }
		}
	});*/

	$(function() {

		var	$window = $(window),
			$body = $('body');
			
		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');
			
			$window.on('load', function() {
				$body.removeClass('is-loading');
			});
			
		// Forms (IE<10).
			var $form = $('form');
			if ($form.length > 0) {
				
				if (skel.vars.IEVersion < 10) {
					$.fn.n33_formerize=function(){var _fakes=new Array(),_form = $(this);_form.find('input[type=text],textarea').each(function() { var e = $(this); if (e.val() == '' || e.val() == e.attr('placeholder')) { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } }).blur(function() { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) return; if (e.val() == '') { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } }).focus(function() { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) return; if (e.val() == e.attr('placeholder')) { e.removeClass('formerize-placeholder'); e.val(''); } }); _form.find('input[type=password]').each(function() { var e = $(this); var x = $($('<div>').append(e.clone()).remove().html().replace(/type="password"/i, 'type="text"').replace(/type=password/i, 'type=text')); if (e.attr('id') != '') x.attr('id', e.attr('id') + '_fakeformerizefield'); if (e.attr('name') != '') x.attr('name', e.attr('name') + '_fakeformerizefield'); x.addClass('formerize-placeholder').val(x.attr('placeholder')).insertAfter(e); if (e.val() == '') e.hide(); else x.hide(); e.blur(function(event) { event.preventDefault(); var e = $(this); var x = e.parent().find('input[name=' + e.attr('name') + '_fakeformerizefield]'); if (e.val() == '') { e.hide(); x.show(); } }); x.focus(function(event) { event.preventDefault(); var x = $(this); var e = x.parent().find('input[name=' + x.attr('name').replace('_fakeformerizefield', '') + ']'); x.hide(); e.show().focus(); }); x.keypress(function(event) { event.preventDefault(); x.val(''); }); });  _form.submit(function() { $(this).find('input[type=text],input[type=password],textarea').each(function(event) { var e = $(this); if (e.attr('name').match(/_fakeformerizefield$/)) e.attr('name', ''); if (e.val() == e.attr('placeholder')) { e.removeClass('formerize-placeholder'); e.val(''); } }); }).bind("reset", function(event) { event.preventDefault(); $(this).find('select').val($('option:first').val()); $(this).find('input,textarea').each(function() { var e = $(this); var x; e.removeClass('formerize-placeholder'); switch (this.type) { case 'submit': case 'reset': break; case 'password': e.val(e.attr('defaultValue')); x = e.parent().find('input[name=' + e.attr('name') + '_fakeformerizefield]'); if (e.val() == '') { e.hide(); x.show(); } else { e.show(); x.hide(); } break; case 'checkbox': case 'radio': e.attr('checked', e.attr('defaultValue')); break; case 'text': case 'textarea': e.val(e.attr('defaultValue')); if (e.val() == '') { e.addClass('formerize-placeholder'); e.val(e.attr('placeholder')); } break; default: e.val(e.attr('defaultValue')); break; } }); window.setTimeout(function() { for (x in _fakes) _fakes[x].trigger('formerize_sync'); }, 10); }); return _form; };
					$form.n33_formerize();
				}

			}
		
		// CSS polyfills (IE<9).
			if (skel.vars.IEVersion < 9)
				$(':last-child').addClass('last-child');

		// Scrolly.
			$window.load(function() {

				var x = parseInt($('.wrapper').first().css('padding-top')) - 15;
				$('#nav a, .scrolly').scrolly(1000, x);

			});
		
	});

})(jQuery);