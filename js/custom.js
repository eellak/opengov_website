(function($){
	$(document).ready(function(){
	
		$('.navbar-nav > .dropdown > a').on('click', function(){
			var parent = $(this).parent();
			if(parent.hasClass('open')){
				parent.removeClass('open');
			} else{
				parent.addClass('open');
			}
		});
		
	});
})(jQuery);