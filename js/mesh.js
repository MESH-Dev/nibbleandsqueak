jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!

//Animate the stickyness/size of the header
$(window).scroll(function(){
	 var scroll = $(window).scrollTop();    
    if (scroll >= 100) {
        $('header').addClass('fixed');
        $('.logotext').css({display:'none'});
        $('.site-title').animate({width:65}, 40);
        $('.head').animate({height:50}, 45);
    }else{
    	$('header').removeClass('fixed');
    	$('.logotext').css({display:'block'});
    	$('.site-title').animate({width:125}, 20);
    	 $('.head').animate({height:113},15);
    }
})


//Autocomplete
// see https://goodies.pixabay.com/jquery/auto-complete/demo.html for more info 

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

//  Get the current offset value of map listing items, and save it
//  as a data-offset variable
//  run the function on load and on window scroll

function getOffset(){
	$('.locations .map-listing').each(function(){
		var TT = $(this).offset().top;
		$(this).attr('data-offset', TT);
	});
}
getOffset();
$(window).scroll(getOffset)

//  Just a variable for the 'locations' class
var _hasLocations = $('locations');


//Find 
function findOffset(){
	if(_hasLocations.length > 0){
	var _top = $('.locations .map-listing#'+marker.name).offset().top;
        //console.log(_top);
        //jQuery('.locations .map-listing').addClass('this-is-a-marker'+_top);
	}
}

$(window).resize(findOffset);
findOffset();

//Create Cookies
function createCookie(name,value,days) {
if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
}
else var expires = "";
document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}

function eraseCookie(name) {
createCookie(name,"",-1);
}

var homeLink = $('a#homelink').attr('href');
var $select = $('#city');
var $bannerSelect = $('.city-input');

//$bannerSelect.addClass('new');


$('.city-dropdown .sub-menu a').click(function () {
    _newText = $(this).data('name');
    _newCookie = $(this).data('slug');
    $select.text( _newText );
    $bannerSelect.val( _newText );

    //$(this).addClass($(this).data('select'));
    //eraseCookie('city');
    
    eraseCookie('city');
    createCookie('city', _newCookie, '' );
    eraseCookie('cityName');
    createCookie('cityName', _newText, '' );
    var cookieVal = readCookie('city');
    var cookieName = readCookie('cityName');
    console.log('Cookie = '+cookieVal);
    $('a#homelink').attr('href', homeLink+cookieVal);
    $('input#city-search').attr('value', cookieVal);
    $('input#city-banner-search').attr('value', cookieVal);
    $('#city').text(cookieName);
    $bannerSelect.val(cookieName);
});

$('.citysearch .sub-menu a').click(function () {
    _newText = $(this).data('name');
    _newCookie = $(this).data('slug');
    $select.text( _newText );
    $bannerSelect.val( _newText );
    //$(this).addClass($(this).data('select'));
    //eraseCookie('city');
    
    eraseCookie('city');
    createCookie('city', _newCookie, '' );
    eraseCookie('cityName');
    createCookie('cityName', _newText, '' );
    var cookieVal = readCookie('city');
    var cookieName = readCookie('cityName');
    console.log('Cookie = '+cookieVal);
    $('a#homelink').attr('href', homeLink+cookieVal);
    $('input#city-search').attr('value', cookieVal);
    $('input#city-banner-search').attr('value', cookieVal);
    $('#city').text(cookieName);
    $bannerSelect.val(cookieName);
});

var geo = readCookie('is_geo_run');


// Get User's Coordinate from their Browser
window.onload = function() {
	if(geo != 1){
  // HTML5/W3C Geolocation

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(UserLocation);
  }
  // Default to Washington, DC
  else
    NearestCity(38.8951, -77.0367);
	
	}
}


// Callback function for asynchronous call to HTML5 geolocation
function UserLocation(position) {
  //console.log(position);
  NearestCity(position.coords.latitude, position.coords.longitude);
}


// Convert Degress to Radians
function Deg2Rad(deg) {
  return deg * Math.PI / 180;
}

function PythagorasEquirectangular(lat1, lon1, lat2, lon2) {
  lat1 = Deg2Rad(lat1);
  lat2 = Deg2Rad(lat2);
  lon1 = Deg2Rad(lon1);
  lon2 = Deg2Rad(lon2);
  var R = 6371; // km
  var x = (lon2 - lon1) * Math.cos((lat1 + lat2) / 2);
  var y = (lat2 - lat1);
  var d = Math.sqrt(x * x + y * y) * R;
  return d;
}

var cities = geo_choices;

var _cityName, _citySlug;

function NearestCity(latitude, longitude) {
  var temp = 999999;
  var closest;
  console.log(cities.length);
  for (index = 0; index < cities.length; ++index) {
    var dif = PythagorasEquirectangular(latitude, longitude, cities[index]['lat'][0], cities[index]['long'][0]);

    if (dif < temp) {
      closest = index;
      temp = dif;
    }
  }

	//var cityVal = document.getElementById("city").innerHTML = cities[closest]['slug'];

 	_citySlug = cities[closest]['slug']; //cityVal
	_cityName = cities[closest]['name'];

	console.log("City Name = "+_citySlug);

	//if(_cityName !='' || _cityName != null){
		$select.text(_cityName);
	//}else{
		//$select.text('Select');
	//}
	
	$bannerSelect.attr('placeholder','').val(_cityName);
	//var cityName = cities[closest]['name'];
	//console.log(cityName);
	//console.log(cityVal);
	createCookie('city', _citySlug, '');
	createCookie('cityName', _cityName, '')
  	
  	//return cityVal;
  	return _citySlug, _cityName; 
 
}//end nearest city

// var _citySlug = cities[closest]['slug']; //cityVal
// 	var _cityName = cities[closest]['name'];
	
	var cookieVal = readCookie('city');
	var cookieName = readCookie('cityName');
	console.log('Cookie = '+cookieName);
 	createCookie('is_geo_run', '1');

 	$('a#homelink').attr('href', homeLink+cookieVal);
 	$('input#city-search').attr('value', cookieVal);
 	$('input#city-banner-search').attr('value', cookieVal);
 	$('.amenities li a').each(function(){
 		var $slug = $(this).data('slug');
 		$(this).attr('href',$home+'/amenity/'+$slug+'/?city='+cookieVal);
 	})
 	//$('#city').text(cookieName);
 	//$bannerSelect.val(cookieName);
 	if(cookieName != '' || cookieName != null){
 		$('#city').text(cookieName);
 		$bannerSelect.val(cookieName);
 	}//else{
 		//$('#city').text('Select A City');
 		//$bannerSelect.val('Place');
 	//}

$(function() {
    $('.eq.block').matchHeight(
      { byRow: true,
    property: 'height',
    target: null,
    remove: false }
      );
});

// $(function() {
//     $('.eq .img').matchHeight(
//       { byRow: true,
//     property: 'height',
//     target: null,
//     remove: false }
//       );
// });

$ms_cnt = 0;
$('.mobile-search-trigger').click(function(){
	$ms_cnt++;
	//console.log($ms_cnt);
	if($ms_cnt == 1){
		$('.funnel').slideDown('slow');
		//console.log($ms_cnt);
	}else{
		$('.funnel').slideUp('slow');
		$ms_cnt = 0;
	}
});
//}

//Sidr
$('.sidr-trigger').sidr({
      name: 'sidr-main',
      source: '.main-navigation',
      renaming: false,
      side: 'right',
      displace: false,      
       //onOpen: function(){

        //$('.sidr-trigger').animate({right:"20000"},50);
      //}////end sidr onOpen function

 });//end sidr onOpen function

});


