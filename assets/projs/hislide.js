(function($) {
   
    var slide = function(ele,options) {
        var $ele = $(ele);
        var setting = {
        		
            speed: 1800,
            
            interval: 3000,
            
        };
        
        $.extend(true, setting, options);

        var slidesLen = ele.getElementsByTagName('UL')[0].childNodes.length-1;
        var midTerm = slidesLen;
        if(midTerm % 2 != 0) {
            midTerm = midTerm + 1; 
            midTerm = midTerm / 2;
        }else if(midTerm % 2 == 0){
            midTerm = midTerm / 2;
        }
        var statesFrw = [];
        var statesRev = [];
         for (var i = 0; i < midTerm; i++) { 
             var newObj = new Object();
             
            if (screen.width > 601) {
                newObj.$zIndex = i+1;
				newObj.width = 200;
				newObj.height = 250;
                newObj.top = 59;
                newObj.left = 500;
                newObj.$opacity = 0.2;
			}
			 else{
				newObj.$zIndex = i-1;
				newObj.width = 50;
				newObj.height = 100;
				newObj.top = 59;
				newObj.left = 0;
				newObj.$opacity = 0.4; 
			 }
             statesFrw.push(newObj);
            }

         for (var i = midTerm; i > 1; i--) { 
            var newObj = new Object();
            newObj.$zIndex = i - 1;
			   if (screen.width > 601) {
				
				newObj.width = 200;
				newObj.height = 250;
				newObj.top = 59;
				newObj.left = 650;
				newObj.$opacity = 0.2;
			}
			 else{
				newObj.$zIndex = i - 2;
				newObj.width = 39;
				newObj.height = 88;
				newObj.top = 59;
				newObj.left = 270;
				newObj.$opacity = 0.4; 
			 }
            statesRev.push(newObj);
         }

         if (screen.width > 601) {
            var states = statesFrw.concat(statesRev);
            states[midTerm-3].width = 260;
            states[midTerm-3].height = 350;
            states[midTerm-3].top = 59;
            states[midTerm-3].left = 30;
            states[midTerm-3].$opacity = 0.4;

            states[midTerm-2].width = 300;
            states[midTerm-2].height = 400;
            states[midTerm-2].top = 35;
            states[midTerm-2].left = 185;
            states[midTerm-2].$opacity = 0.7;

            states[midTerm-1].width = 354;
            states[midTerm-1].height = 470;
            states[midTerm-1].top = 0;
            states[midTerm-1].left = 380;
            states[midTerm-1].$opacity = 1;

            states[midTerm].width = 300;
            states[midTerm].height = 400;
            states[midTerm].top = 35;
            states[midTerm].left = 622;
            states[midTerm].$opacity = 0.7;

            states[midTerm+1].width = 260;
            states[midTerm+1].height = 350;
            states[midTerm+1].top = 59;
            states[midTerm+1].left = 800;
            states[midTerm+1].$opacity = 0.4;
        }
        else{
             var states = statesFrw.concat(statesRev);
            states[midTerm-3].width = 50;
            states[midTerm-3].height = 100;
            states[midTerm-3].top = 59;
            states[midTerm-3].left = 0;
            states[midTerm-3].$opacity = 0.4;

            states[midTerm-2].width = 75;
            states[midTerm-2].height = 130;
            states[midTerm-2].top = 35;
            states[midTerm-2].left = 49;
            states[midTerm-2].$opacity = 0.7;

            states[midTerm-1].width = 120;
            states[midTerm-1].height = 154;
            states[midTerm-1].top = 22;
            states[midTerm-1].left = 110;
            states[midTerm-1].$opacity = 1;

            states[midTerm].width = 75;
            states[midTerm].height = 130;
            states[midTerm].top = 35;
            states[midTerm].left = 226;
            states[midTerm].$opacity = 0.7;

            states[midTerm+1].width = 50;
            states[midTerm+1].height = 100;
            states[midTerm+1].top = 59;
            states[midTerm+1].left = 300;
            states[midTerm+1].$opacity = 0.4;
        }
            console.log(states);

        var $lis = $ele.find('li');
        var thln = $lis.length;
        var hfcnt = parseFloat(thln/2);
        var imageLength = 7;
        var ab = 0;
        var timer = null;

      
        $ele.find('.hi-next').on('click', function() {
              next();
            
        });
        $ele.find('.hi-prev').on('click', function() {
          
			states.push(states.shift());
            move();
        });
        $ele.on('mouseenter', function() {
            clearInterval(timer);
            timer = null;
        }).on('mouseleave', function() {
           autoPlay();
        });

        move();
       autoPlay();

        
        function move() {
           
            $lis.each(function(index, element) {
                var state = states[index];
                if(state!=undefined){
				 $(element).css('zIndex', state.$zIndex).finish().animate(state, setting.speed).find('img').css('opacity', state.$opacity);
                }
               
            });
        }   

        function next() {
            states.unshift(states.pop());
            move();
        }

        function autoPlay() {
			  timer = setInterval(next, setting.interval);
        }
    }
    $.fn.hiSlide = function(options) {
        $(this).each(function(index, ele) {
			slide(ele,options);
        });
        return this;
    }
})(jQuery);
(function($) {
   
    var slide = function(ele,options) {
        var $ele = $(ele);
        var setting = {
        		
            speed: 1800,
            
            interval: 3000,
            
        };
        
        $.extend(true, setting, options);

        var slidesLen = ele.getElementsByTagName('UL')[0].childNodes.length-1;
        var midTerm = slidesLen;
        if(midTerm % 2 != 0) {
            midTerm = midTerm + 1; 
            midTerm = midTerm / 2;
        }else if(midTerm % 2 == 0){
            midTerm = midTerm / 2;
        }
        var statesFrw = [];
        var statesRev = [];
         for (var i = 0; i < midTerm; i++) { 
             var newObj = new Object();
             
            if (screen.width > 601) {
                newObj.$zIndex = i+1;
				newObj.width = 200;
				newObj.height = 250;
                newObj.top = 59;
                newObj.left = 500;
                newObj.$opacity = 0.2;
			}
			 else{
				newObj.$zIndex = i-1;
				newObj.width = 50;
				newObj.height = 100;
				newObj.top = 59;
				newObj.left = 0;
				newObj.$opacity = 0.4; 
			 }
             statesFrw.push(newObj);
            }

         for (var i = midTerm; i > 1; i--) { 
            var newObj = new Object();
            newObj.$zIndex = i - 1;
			   if (screen.width > 601) {
				
				newObj.width = 200;
				newObj.height = 250;
				newObj.top = 59;
				newObj.left = 650;
				newObj.$opacity = 0.2;
			}
			 else{
				newObj.$zIndex = i - 2;
				newObj.width = 39;
				newObj.height = 88;
				newObj.top = 59;
				newObj.left = 270;
				newObj.$opacity = 0.4; 
			 }
            statesRev.push(newObj);
         }

         if (screen.width > 601) {
            var states = statesFrw.concat(statesRev);
            states[midTerm-3].width = 260;
            states[midTerm-3].height = 350;
            states[midTerm-3].top = 59;
            states[midTerm-3].left = 30;
            states[midTerm-3].$opacity = 0.4;

            states[midTerm-2].width = 300;
            states[midTerm-2].height = 400;
            states[midTerm-2].top = 35;
            states[midTerm-2].left = 185;
            states[midTerm-2].$opacity = 0.7;

            states[midTerm-1].width = 354;
            states[midTerm-1].height = 470;
            states[midTerm-1].top = 0;
            states[midTerm-1].left = 380;
            states[midTerm-1].$opacity = 1;

            states[midTerm].width = 300;
            states[midTerm].height = 400;
            states[midTerm].top = 35;
            states[midTerm].left = 622;
            states[midTerm].$opacity = 0.7;

            states[midTerm+1].width = 260;
            states[midTerm+1].height = 350;
            states[midTerm+1].top = 59;
            states[midTerm+1].left = 800;
            states[midTerm+1].$opacity = 0.4;
        }
        else{
             var states = statesFrw.concat(statesRev);
            states[midTerm-3].width = 50;
            states[midTerm-3].height = 100;
            states[midTerm-3].top = 59;
            states[midTerm-3].left = 0;
            states[midTerm-3].$opacity = 0.4;

            states[midTerm-2].width = 75;
            states[midTerm-2].height = 130;
            states[midTerm-2].top = 35;
            states[midTerm-2].left = 49;
            states[midTerm-2].$opacity = 0.7;

            states[midTerm-1].width = 120;
            states[midTerm-1].height = 154;
            states[midTerm-1].top = 22;
            states[midTerm-1].left = 110;
            states[midTerm-1].$opacity = 1;

            states[midTerm].width = 75;
            states[midTerm].height = 130;
            states[midTerm].top = 35;
            states[midTerm].left = 226;
            states[midTerm].$opacity = 0.7;

            states[midTerm+1].width = 50;
            states[midTerm+1].height = 100;
            states[midTerm+1].top = 59;
            states[midTerm+1].left = 300;
            states[midTerm+1].$opacity = 0.4;
        }
            console.log(states);

        var $lis = $ele.find('li');
        var thln = $lis.length;
        var hfcnt = parseFloat(thln/2);
        var imageLength = 7;
        var ab = 0;
        var timer = null;

      
        $ele.find('.hi-next').on('click', function() {
              next();
            
        });
        $ele.find('.hi-prev').on('click', function() {
          
			states.push(states.shift());
            move();
        });
        $ele.on('mouseenter', function() {
            clearInterval(timer);
            timer = null;
        }).on('mouseleave', function() {
           autoPlay();
        });

        move();
       autoPlay();

        
        function move() {
           
            $lis.each(function(index, element) {
                var state = states[index];
                if(state!=undefined){
				 $(element).css('zIndex', state.$zIndex).finish().animate(state, setting.speed).find('img').css('opacity', state.$opacity);
                }
               
            });
        }   

        function next() {
            states.unshift(states.pop());
            move();
        }

        function autoPlay() {
			  timer = setInterval(next, setting.interval);
        }
    }
    $.fn.hiSlide = function(options) {
        $(this).each(function(index, ele) {
			slide(ele,options);
        });
        return this;
    }
})(jQuery);
