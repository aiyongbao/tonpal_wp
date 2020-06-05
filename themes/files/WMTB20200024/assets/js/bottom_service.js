$(function(){

	setTimeout(function(){$('.bottomsidebar').animate({bottom:"0"},1000)},500);

	setTimeout(function(){$('.bottomsidebar .bottomlist .wel01').fadeIn('fast')},1500);

	setTimeout(function(){$('.bottomsidebar .bottomlist .wel02').fadeIn('fast')},2300);

	setTimeout(function(){$('.bottomsidebar .bottomlist .choose-button .close').fadeIn('fast')},2800);

	setTimeout(function(){$('.bottomsidebar .bottomlist .choose-button .goon').fadeIn('fast')},3500);

$('.inquiry-pop-bd').css('width',$(window).width()).css('height',$(window).height())


 $('.inquiry-form').each(function(){
		$(this).find('.captcha-image').append("<div class='captcha-image-empty' style='color:#F00;'>Please select</div>")
		$(this).find('.captcha-image .captcha-image-empty').hide()
		$(this).find('.form-btn-wrap .form-btn-submit').click(function(){
			 var val=$(this).parents('.inquiry-form').find('.captcha-image input:radio:checked').val();
            if(val==null){
					$(this).parents('.inquiry-form').find('.captcha-image .captcha-image-empty').show()
					  return false; 
					}	else{
						 $(this).parents('.inquiry-form').find('.captcha-image .captcha-image-empty').hide()
						}
			})
	})
 

})









function bottomClose(){

 $('.bottomsidebar').animate({bottom:"-268px"},1000)

}



function bottomGoo(){

	 $('.bootom-inquiry').animate({bottom:"0"},1000)

	 $('.bottomsidebar').animate({bottom:"-268px"},1000)



}

function bottomCloseDirect(){

	 $('.bootom-inquiry').animate({bottom:"-500px"},1000)

	 



}