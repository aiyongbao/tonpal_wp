// JavaScript Document
	$(document).ready(function(){
		$('.prisna-wp-translate-seo').contents().filter(function() {
		return this.nodeType === 3;
		}).remove();
		$('.change-language .change-language-cont').append("<div class='change-empty'>Untranslated</div>")
		$('.prisna-wp-translate-seo').append("<div class='lang-more'>More Language</div>")
		 
		if($('body .prisna-wp-translate-seo').length>0 && $('.change-language .prisna-wp-translate-seo').length<1){
			$('.prisna-wp-translate-seo').appendTo('.change-language-cont')
			if($('.change-language .change-language-cont .prisna-wp-translate-seo li').length>0){
				$('.change-language .change-language-cont .change-empty').hide()
				$('.change-language .change-language-cont .prisna-wp-translate-seo li').each(function(index){
					if(index>35 ){
						$(this).addClass('lang-item lang-item-hide')
						$('.change-language-cont').find('.lang-more').show()
						}else{
							$('.change-language-cont').find('.lang-more').hide()
							}

					})
					if($('.change-language-cont .lang-more').length>0){
						$('.change-language-cont .lang-more').click(function(){
							if($(this).parents('.change-language-cont').find('.prisna-wp-translate-seo li.lang-item').hasClass('lang-item-hide')){
								$(this).parents('.change-language-cont').find('.prisna-wp-translate-seo li.lang-item').removeClass('lang-item-hide')
								$(this).text('×')
								}else{
									$(this).parents('.change-language-cont').find('.prisna-wp-translate-seo li.lang-item').addClass('lang-item-hide')
									$(this).text('More Language')
									}
							})
						}
				}else{
					$('.change-language .change-language-cont .change-empty').fadeIn()
					}
			}
			var mouseover_tid = [];
var mouseout_tid = [];
	$('.change-language').each(function(index){
			
			$(this).hover( 

				function(){

					var _self = this;

					clearTimeout(mouseout_tid[index]);

					mouseover_tid[index] = setTimeout(function() {

						$(_self).find('.sub-content').slideDown();
						$('.change-language-info .change-language-title').addClass('title-show').removeClass('title-hide');

					}, 150);

				},

	 			function(){

					var _self = this;

					clearTimeout(mouseover_tid[index]);

					mouseout_tid[index] = setTimeout(function() {

						$(_self).find('.sub-content').slideUp();
						$('.change-language-info .change-language-title').addClass('title-hide').removeClass('title-show');

				  }, 50);

				}

			);

			
		})

		})