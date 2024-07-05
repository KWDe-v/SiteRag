$(document).ready(function() {
	if(window.location.href.search('thor') > 0)
		$('#server a').attr("href", window.location.href.replace("thor", "valhalla"));
	else
		$('#server a').attr("href", window.location.href.replace("valhalla", "thor"));

	$('#input-monsters').keyup(function(e){	
		if(e.keyCode == 13) {
			doFilterExecute();
		}
	});

	$('#input-itens').keyup(function(e){	
		if(e.keyCode == 13) {
			doFilterExecute();
		}
	});

	$("#nav-center").find("[href]").each(function() {
		if(this.href == window.location.href.split('?')[0])
			$(this).addClass("active");
		else if(this.href == window.location.href.split('/detalhes')[0])
			$(this).addClass("active");
	});

	if(getParamValue('page') >= 1) {
		doFilterRead();

		if(window.location.href.search('monstros') > 0)
			$('#input-monsters').val(word_remod(getParamValue('nome')));
		else
			$('#input-itens').val(word_remod(getParamValue('nome')));
	}
});

$(window).click(function() {
	if($('#dropdown-content').is(':visible')){
	  $('#dropdown-content').hide();
	  $('#nav-collapse').removeClass("active");
	}
});

$('#nav-collapse').click(function(event){
	event.preventDefault();
	event.stopPropagation();
	if($('#dropdown-content').is(':visible')){
	  $('#dropdown-content').hide();
	  $('#nav-collapse').removeClass("active");
	}else{
	  $('#dropdown-content').show();
	  $('#nav-collapse').addClass("active");
	}
});

function setParam(name, value) {
	var href = window.location.href;
	var regex = new RegExp("[&\\?]" + name + "=");

	if(regex.test(href)) {
		regex = new RegExp("([&\\?])" + name + "=\\d+");
		window.location.href = href.replace(regex, "$1" + name + "=" + value);
	} else {
		if(href.indexOf("?") > -1)
			window.location.href = href + "&" + name + "=" + value;
		else
			window.location.href = href + "?" + name + "=" + value;
	}
}

function setFilter(name, params) {
	params = (params == '') ? '' : '&'+params;
	window.location.href = '?page=1&nome=' + encodeURIComponent(doReviseText(name)) + params;
}

$('#advanced-options-btn').click(function(event){
	event.preventDefault();
	if($('#advanced-options').is(':visible')){
		$('#advanced-options').hide();
		$('#advanced-options-btn').empty();
		$('#advanced-options-btn').append('<img src="../img/icones/more-options.png"> Ver opções avançadas');
	} else {
		$('#advanced-options').css('display', 'block');
		$('#advanced-options-btn').empty();
		$('#advanced-options-btn').append('<img src="../img/icones/less-options.png"> Ver opções avançadas');
	}
});

$('.multiple-items').slick({
	infinite: false,
	slidesToShow: 2,
	arrows:false,
	slidesToScroll: 2,
	variableWidth: true
});

$('#nav-button').click(function(e){
	e.preventDefault();
	if($('#filter').is(':visible')){
		$('#filter').hide();
	} else {
		$('#filter').show();
	}
});

$('.specified-filter label').click(function(e) {
	e.preventDefault();
	var label = $(this).closest('label');

	if(label.hasClass('active'))
		label.removeClass('active');
	else
		label.addClass('active');
});

$('.specified-filter.order label').click(function (e) {
	e.preventDefault();
	$(this).closest('label').addClass('active').siblings().removeClass('active');
});

function word_mod(str) {
	var str_mod = str.toLowerCase().replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[íìî]/g,'i').replace(/[ç]/g,'c');
	str_mod = str_mod.replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/[ ]/g,'_').replace(/[-]/g,'_');
	return str_mod;
}

function word_remod(str) {
	return str.replace(/[_]/g,' ');
}

function doReviseText(txt) {
	return txt.toLowerCase().replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[íìî]/g,'i').replace(/[ç]/g,'c').replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/^[ ]|[ ]$/g,'');
}

function getParam(param) {
	var hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		if(param == hash[0])
			return hash[0]+'='+hash[1];
	}
}

function getParamValue(param) {
	var hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		if(param == hash[0])
			return hash[1];
	}
}

function getFilterVars(){
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	
	return vars;
}

function getFilter() {
	return window.location.href.slice(window.location.href.indexOf('?') + 1).replace('&'+getParam('nome'), '');
}

function doSliderSetValues(slider_name, name_range, min, max) {
	var slider = document.getElementById(slider_name);
	if(!isNull(slider)) {
		if(!isNull(min) && !isNull(max)) {
			slider.noUiSlider.set([min, max]);
			slider.noUiSlider.on('update', function(values, handle) {
				if(values[0] == 0)
					document.getElementById(name_range).innerHTML = 'Todos';
				else
					document.getElementById(name_range).innerHTML = values[0]+'/'+values[1];
			});
		}
	}
}

function doSliderSetValue(slider_name, name_range, min, max) {
	var slider = document.getElementById(slider_name);
	if(!isNull(slider)) {
		slider.noUiSlider.set([min]);
		slider.noUiSlider.on('update', function(values, handle) {
			if(values[0] != 0)
				document.getElementById(name_range).innerHTML = values[0]+'/'+max;
			else
				document.getElementById(name_range).innerHTML = 'Todos';
		});
	}
}

function setParamFieldWithArray(field, array) {
	var result = '';
	for (var j = 0; j <= $('.specified-filter.'+field+' label').length - 1; j++) {
		if($('.specified-filter.'+field+' label:nth-child('+(j+1)+')').hasClass('active')) {
			if(result != '') result += ',';
			result += array[j];
		}
	}

	return setParamStr(field, result);
}

function setParamFieldWithNumber(field) {
	result = '';
	for (var j = 0; j <= $('.specified-filter.'+field+' label').length - 1; j++) {
		if($('.specified-filter.'+field+' label:nth-child('+(j+1)+')').hasClass('active')) {
			result += result != '' ? ','+result : result;
		}
	}

	return setParamStr(field, result);
}

function setParamFieldWithText(field) {
	result = '';
	for (var j = 0; j <= $('.specified-filter.'+field+' label').length - 1; j++) {
		if($('.specified-filter.'+field+' label:nth-child('+(j+1)+')').hasClass('active')) {
			if(result != '') result += ',';
			result += $('.specified-filter.'+field+' label:nth-child('+(j+1)+')').text();
		}
	}

	return setParamStr(field, result);
}

function isNull(obj) {
	return typeof obj === 'undefined' || obj == NaN || obj == '' || obj == null;
}

function doCheckType(obj, type) {
	return typeof obj === type;
}

function setParamStr(name, value) {
	return name+'='+value;
}

$('.drops-itens').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result .monstros').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.summon').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result .itens').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.combo').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result .combo').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.experience').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result ul .experiencia').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.habitat').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result ul .habitat').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.skills').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result .habilidades').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

$('.drops-monsters').click(function(e) {
	$('#slider-result ul li').removeClass('show');
	$('#slider-result .itens').addClass('show');
	$('#slider-result .equipamentos').addClass('show');
	$('#slider-result .armamentos').addClass('show');
	$('#slider-result .itens-slot').addClass('show');
	$('#slider ul li').removeClass('active');
	$(this).addClass('active');
});

//Sliders
var levelslider = document.getElementById('level-slider');
if(levelslider) {
	noUiSlider.create(levelslider, {
		start: [1, 200], step: 1, connect: true,
		range: {'min': 1,'max': 200},
		format: wNumb({decimals: 0})
	});
	levelslider.noUiSlider.on('update', function(values, handle) {
		document.getElementById('level-range').innerHTML = values[0]+'/'+values[1];
	});
}
//------------------//
var dodgeslider = document.getElementById('dodge-slider');
if(dodgeslider) {
	noUiSlider.create(dodgeslider, {
		start: [1, 1000], step: 1, connect: true,
		range: {'min': 1,'max': 1000},
		format: wNumb({decimals: 0})
	});
	dodgeslider.noUiSlider.on('update', function(values, handle) {
		document.getElementById('dodge-range').innerHTML = values[0]+'/'+values[1];
	});
}
//------------------//
var accuracyslider = document.getElementById('accuracy-slider');
if(accuracyslider) {
	noUiSlider.create(accuracyslider, {
		start: [1, 1000], step: 1, connect: true,
		range: {'min': 1,'max': 1000},
		format: wNumb({decimals: 0})
	});
	accuracyslider.noUiSlider.on('update', function(values, handle) {
		document.getElementById('accuracy-range').innerHTML = values[0]+'/'+values[1];
	});
}
//------------------//
var lvweapon = document.getElementById('lvweapon-slider');
if(lvweapon) {
	noUiSlider.create(lvweapon, {
		start: [1, 4], step: 1, connect: true,
		range: {'min': 1,'max': 4},
		format: wNumb({decimals: 0})
	});
	lvweapon.noUiSlider.on('update', function(values, handle) {
		document.getElementById('lvweapon-range').innerHTML = values[0]+'/4';
	});
}
//------------------//
var slot = document.getElementById('slot-slider');
if(slot) {
	noUiSlider.create(slot, {
		start: 0, step: 1,
		range: {'min': 0,'max': 4},
		format: wNumb({decimals: 0})
	});
	doSliderSetValue('slot-slider', 'slot-range', '', 4);
}
//------------------//
/*var lvrequire = document.getElementById('lvrequire-slider');
if(lvrequire) {
	noUiSlider.create(lvrequire, {
		start: [1, 175], step: 1, connect: true,
		range: {'min': 1,'max': 175},
		format: wNumb({decimals: 0})
	});
	lvrequire.noUiSlider.on('update', function(values, handle) {
		document.getElementById('lvrequire-range').innerHTML = values[0]+'/'+values[1];
	});
}*/