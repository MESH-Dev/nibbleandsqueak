jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!
$(window).scroll(function(){
	 var scroll = $(window).scrollTop();    
    if (scroll >= 100) {
        $("header").addClass("fixed");
        $('.site-title').css({width:65});
        $('.logotext').css({display:'none'});
        $('.logo, nav, .funnel').css({height:50});
    }else{
    	$('header').removeClass('fixed');
    	$('.site-title').css({width:125});
    	 $('.logo, nav, .funnel').css({height:113});
    	 $('.logotext').css({display:'block'});
    }
})


//Autocomplete

//searchHeader

$('input[name="s"]').autoComplete({
    minChars: 2,
    source: function(term, suggest){
        term = term.toLowerCase();
        //var choices = ['ActionScript', 'AppleScript', 'Asp'];
        var choices = da_choices;
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
    }
});


$('.locations .map-listing').each(function(){
	var TT = $(this).offset().top;

	$(this).attr('data-offset', TT);
	//console.log(TT); 
});

var _hasLocations = $('locations');

function findOffset(){
	if(_hasLocations.length > 0){
	var _top = $('.locations .map-listing#'+marker.name).offset().top;
        console.log(_top);
        jQuery('.locations .map-listing').addClass('this-is-a-marker'+_top);
	}
}

$(window).resize(findOffset());
findOffset();

});
