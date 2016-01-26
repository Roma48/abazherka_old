window.addEvent('load', function() {
    if(document.id('gkExtraMenu') && document.id('gkMainMenu').hasClass('gkMenuClassic')) {
        // fix for the iOS devices     
        document.getElements('#gkExtraMenu ul li span').each(function(el) {
            el.setProperty('onmouseover', '');
        });

        document.getElements('#gkExtraMenu ul li a').each(function(el) {
            el.setProperty('onmouseover', '');

            if(el.getParent().hasClass('haschild') && document.getElement('body').getProperty('data-tablet') != null) {
                el.addEvent('click', function(e) {
                    if(el.retrieve("dblclick", 0) === 0) {
                        e.stop();
                        el.store("dblclick", new Date().getTime());
                    } else {
                    	if(el.getParent().getElements('div.childcontent')[0].getStyle('overflow') == 'visible') {
                    		window.location = el.getProperty('href');
                    	}
                        var now = new Date().getTime();
                        if(now - el.retrieve("dblclick", 0) < 500) {
                            window.location = el.getProperty('href');
                        } else {
                            e.stop();
                            el.store("dblclick", new Date().getTime());
                        }
                    }
                });
            }
        });

        var base = document.id('gkExtraMenu');

        if($GKMenu && ($GKMenu.height || $GKMenu.width)) {     
            var gk_selector = 'li.haschild';
            base.getElements(gk_selector).each(function(el){     
                if(el.getElement('.childcontent')) {
                    var content = el.getElement('.childcontent');
                    var prevh = content.getSize().y;
                    var prevw = content.getSize().x;

                    var fxStart = { 'height' : $GKMenu.height ? 0 : prevh, 'width' : $GKMenu.width ? 0 : prevw, 'opacity' : 0 };
                    var fxEnd = { 'height' : prevh, 'width' : prevw, 'opacity' : 1 };

                    var fx = new Fx.Morph(content, {
                        duration: $GKMenu.duration,
                        link: 'cancel',
                        onComplete: function() {
                            if(content.getSize().y == 0){
                                content.setStyle('overflow', 'hidden');
                            } else if(content.getSize().y - prevh < 30 && content.getSize().y - prevh >= 0) {
                                content.setStyle('overflow', 'visible');
                            }
                        }
                    });

                    fx.set(fxStart);
                    content.setStyles({'left' : 'auto', 'overflow' : 'hidden' });

                    el.addEvents({
                        'mouseenter': function(){
                            var content = el.getElement('.childcontent');

                            if(content.getProperty('data-base-margin') != null) {
                                content.setStyle('margin-left', content.getProperty('data-base-margin') + "px");
                            }

                            var pos = content.getCoordinates();
                            var winWidth = window.getCoordinates().width;
                            var winScroll = window.getScroll().x;

                            if(pos.left + prevw > (winWidth + winScroll)) {
                                var diff = (winWidth + winScroll) - (pos.left + prevw) - 5;
                                var base = content.getStyle('margin-left').toInt();
                                var margin = base + diff;

                                if(base > 0) {
                                    margin = -prevw + 10;  
                                }
                                content.setStyle('margin-left', margin + "px");

                                if(content.getProperty('data-base-margin') == null) {
                                    content.setProperty('data-base-margin', base);
                                }
                            }

                            fx.start(fxEnd);
                        },

                        'mouseleave': function(){
                            content.setStyle('overflow', 'hidden');
                            fx.start(fxStart);
                        }
                    });
                }
            });
        }
    } else if(document.id('gkExtraMenu') && document.id('gkMainMenu').hasClass('gkMenuOverlay')) {
    	var overlay = new Element('div', {
    		'id': 'gkMenuOverlay',
    		'html': ''
    	});
    	
    	overlay.inject(document.body, 'bottom');
    	overlay.fade('out');
    	overlay.set('tween', { duration: 250 });
    	
    	var overlaywrapper = new Element('div', {
    		'id': 'gkMenuOverlayWrap',
    		'html': '<div><i id="gkMenuOverlayClose" class="gk-icon-cross"></i><h3 id="gkMenuOverlayHeader"></h3><div id="gkMenuOverlayContent"></div></div>'
    	});
    	
    	overlaywrapper.inject(document.body, 'bottom');
    	overlay.fade('out');
    	overlaywrapper.set('tween', { duration: 250 });
    	overlaywrapper.fade('out');
    	
    	
    	
    	
    	var overlaywrap = overlaywrapper.getElement('div');
 		overlaywrap.set('tween', { duration: 250 });
 		overlaywrap.fade('out');
    	var header = document.id('gkMenuOverlayHeader');
    	var content = document.id('gkMenuOverlayContent');
    	header.set('tween', { duration: 250 });
    	header.setStyle('margin-top', -100);
    	var submenus = [];
    	
    	document.id('gkMenuOverlayClose').addEvent('click', function() {
    		overlay.fade('out');
    		overlaywrapper.fade('out');
    		overlaywrap.fade('out');
    		header.tween('margin-top', -100);
    		setTimeout(function() {
    			overlay.removeClass('open');
    			overlaywrapper.removeClass('open');
    			header.innerHTML = '';
    			content.innerHTML = '';
    		}, 500);
    	});
    	
    	overlay.addEvent('click', function(e) {
    		e.stopPropagation();
    		if(e.target == overlay) {
    			document.id('gkMenuOverlayClose').fireEvent('click');	
    		}
    	});
    	
    	document.id('gkExtraMenu').getElements('.haschild').each(function(el) {
    		if(el.getParent().hasClass('level0')) {
    			var link = el.getElement('a');
    			submenus[link.getProperty('id')] = {
    				"link": link,
    				"submenu": el.getElement('.childcontent')
    			};
    			
    			link.addEvent('click', function(e) {
    				e.stop();
    				overlay.setStyle('height', document.body.getSize().y);
    				var menuID = e.target.getProperty('id');
    				header.innerHTML = '';
    				submenus[menuID].link.clone().inject(header);
    				content.innerHTML = '';
    				submenus[menuID].submenu.clone().inject(content);
    				overlay.addClass('open');
    				overlaywrapper.addClass('open');
    				overlay.fade('in');
    				overlaywrapper.fade('in');
    				
    				setTimeout(function() {
    					overlaywrap.fade('in');
    					header.tween('margin-top', 0);
    				}, 500);
    			});
    		}
    	});
    }
}); 