        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-32392850-7', 'auto');
        ga('create', 'UA-299779-1', 'auto', {
            'name': 'LevelGeral'
        }); //tracking para a Level Up geral
        ga('send', 'pageview'); 
        ga('LevelGeral.send', 'pageview'); //manda o tracking para Level Up Geral

		
		// HOTJAR ====================================================================================================	
	
		// ANALYCTICS EVENTS ====================================================================================================	

		$('#crie-sua-conta').on('click', function() {
		  ga('send', 'event', 'menu-navigation', 'crie-sua-conta-selection');
		});

		$('#download').on('click', function() {
		  ga('send', 'event', 'menu-navigation', 'download-selection');
		});

		$('section.download button').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'download', 'Gerenciador');
		});

		$('#master section.download div.other-options ul li:nth-child(1) a').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'download', 'Mirror-1');
		});
		$('#master section.download div.other-options ul li:nth-child(2) a').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'download', 'Mirror-2');
		});		

		$('#cadaster').on('click', '#form-container input.createacc', function() {
		  ga('send', 'event', 'criacao-de-conta', 'clique-botao-criar-conta');
		});

		$('#cadaster').on('click', '#form-container a.haveaccount', function() {
		  ga('send', 'event', 'criacao-de-conta', 'clique-botao-ja-tem-conta-lu');
		});
		
		$('#news ul .divLeft .topNews').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'click-bannerhome', 'BannerHome-Destaque');
		  /*alert("DESTAQUE");
		  return false;*/
		});

		$('#news ul .divRight .subNews:first-Child').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'click-bannerhome', 'BannerHome-Position-1');
		});
		
		$('#news ul .divRight .subNews:nth-Child(2)').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'click-bannerhome', 'BannerHome-Position-2');
		});
		
		$('#news ul .divRight .subNews:nth-Child(3)').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'click-bannerhome', 'BannerHome-Position-3');
		});
		
		$('#news ul .divRight .subNews:nth-Child(4)').on('click', function() {
		  ga('send', 'event', 'Ragnarok', 'click-bannerhome', 'BannerHome-Position-4');
		});