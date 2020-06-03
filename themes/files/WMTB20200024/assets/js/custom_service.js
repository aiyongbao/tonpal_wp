
;(function($){
    $.fn.fix = function(options){
        var defaults = {
            float : 'left',
			minStatue : false,
			skin : 'blue',
			durationTime : 1000	
        }
        var options = $.extend(defaults, options);		

        this.each(function(){			
			var thisBox = $(this),
				closeBtn = thisBox.find('.close_btn' ),
				show_btn = thisBox.find('.show_btn' ),
				sideContent = thisBox.find('.side_content'),
				sideList = thisBox.find('.side_list')
				;	
			var defaultTop = thisBox.offset().top;	//Ĭtop	
			
			thisBox.css(options.float, 0);			
			if(options.minStatue){
				$(".show_btn").css("float", options.float);
				sideContent.css({'width':0,'display':'none'});
				show_btn.css('width', 37);
				
			}
			$(window).bind("scroll",function(){
				var offsetTop = defaultTop + $(window).scrollTop() + "px";
	            thisBox.animate({
	                top: offsetTop
	            },
	            {
	                duration: options.durationTime,	
	                queue: false
	            });
			});	
			closeBtn.bind("click",function(){
				sideContent.animate({width: '0px'},"fast");
            	show_btn.stop(true, true).delay(300).animate({ width: '37px'},"fast");
			});
			 show_btn.click(function() {
	            $(this).animate({width: '0px','display':'none'},"fast");
	            sideContent.stop(true, true).delay(200).animate({ width: '166px'},"fast");
	        });
				
        });	
    };
})(jQuery);

function showMsgPop(){


	$('.inquiry-pop-bd').fadeIn('fast')

}

function hideMsgPop(){

	 $('.inquiry-pop-bd').fadeOut('fast')

}