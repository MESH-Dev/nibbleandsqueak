jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!
$(window).scroll(function(){
	 var scroll = $(window).scrollTop();    
    if (scroll >= 100) {
        $("header").addClass("fixed");
        $('.site-title').css({width:50});
    }else{
    	$('header').removeClass('fixed');
    	$('.site-title').css({width:125});
    }
})
  

});
