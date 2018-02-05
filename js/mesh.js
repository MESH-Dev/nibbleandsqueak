jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!

//Animate the stickyness/size of the header
var vh = $(window).height();

$(window).scroll(function(){
   var scroll = $(window).scrollTop();   
   //if(vh >= 600){ 
    if (scroll >= 100) {
        $('header').addClass('fixed');
        //$('header').hide().addClass('fixed').stop().slideDown();
        //$('.head').animate({height:50}, 10);
        //$('.site-title').animate({width:65},5);
        //$('.site-title').animate({width:65}, 50);
        //$('.logotext').animate({'opacity':'0', display:'none'}, 10);
        
        
        //$('.head').css({height:50});
    }else{
      $('header').removeClass('fixed');
      //$('header').css({'position':'relative'});
      //$('.head').animate({height:113},20);
      //$('.site-title').animate({width:125},20);
      //$('.head').css({height:113});
      // $('.site-title').animate({width:125}, 60);
      
       //$('.logotext').animate({'opacity':'1', display:'block'},20);
    }
  //}
});

var $f_cnt=0;
var wW = $(window).width();

if(wW <= 500){
$('.funnel').click(function(){
  $f_cnt++;

  if ($f_cnt==1 ){
  $(this).find('.sub-menu').css({'left':'0'});
    
  }else{
    $(this).find('.sub-menu').css({'left':'-99999px'});
    $f_cnt=0;
  }
  console.log($f_cnt);
});
}
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

// var d = new Date();
//     d.setTime(d.getTime() + (exdays*24*60*60*1000));
//     var expires = "expires="+ d.toUTCString();

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

console.log(readCookie());

function eraseCookie(name) {
createCookie(name,"",-1);
}

var homeLink = $('a#homelink').attr('href');
var $select = $('.no_landing #city');
var $bannerSelect = $('.city-input');

//$bannerSelect.addClass('new');
createCookie('dropdown', false);

$('.city-dropdown.no_landing .sub-menu a.linked').click(function (e) {

    _newText = $(this).data('name');
    _newCookie = $(this).data('slug');
    createCookie('dropdown', true);
    $select.text( _newText );
    //$bannerSelect.val( _newText );

    // if(_newText == "All Cities"){
    //   console.log("All Cities Chosen")
    //   eraseCookie('city');
    //   eraseCookie('cityName');
    // }

    // $('.amenities li a').each(function(){
    // var $slug = $(this).data('slug');
    //  if(_newText != "All Cities"){
    //   $(this).attr('href',$home+'/amenity/'+$slug+'/?city='+_newCookie);
    //   }
   
    // });
    //$('a.linked')


    //if($(this).hasClass('linked')){
      e.preventDefault();
      //$select.text( cookieName );
    //}

    //$(this).addClass($(this).data('select'));
    //eraseCookie('city');
    
    eraseCookie('city');
    createCookie('city', _newCookie, '1' );
    eraseCookie('cityName');
    createCookie('cityName', _newText, '1' );
    var cookieVal = readCookie('city');
    var cookieName = readCookie('cityName');
    //var gateVal = readCookie('citygate');
    console.log('Cookie = '+cookieVal);
    console.log('Cookie Name ='+cookieName);
    //$('a#homelink').attr('href', homeLink+cookieVal);
    $('input#city-search').attr('value', cookieVal);
    $('input#city-banner-search').attr('value', cookieVal);
    $('#city').text(cookieName);
    //$bannerSelect.val(cookieName);
});

$('.citysearch .sub-menu a').click(function (e) {
  e.preventDefault();
    _newText = $(this).data('name');
    _newCookie = $(this).data('slug');
    _gateCookie = $(this).data('slug');
    _gateText = $(this).data('name');
    //$select.text( _newText );
    $bannerSelect.val( _newText);
    //$(this).addClass($(this).data('select'));
    //eraseCookie('city');
    
    // eraseCookie('citygate');
    // createCookie('citygate', _gateCookie, '1' );
    // eraseCookie('cityGateName');
    // createCookie('cityGateName', _gateText, '1' );
    eraseCookie('city');
    createCookie('city', _newCookie, '1' );
    eraseCookie('cityName');
    createCookie('cityName', _newText, '1' );
      //var cookieVal = readCookie('city');
    //var cookieName = readCookie('cityName');
   //var gateVal = readCookie('citygate');
    //var gateName = readCookie('cityGateName');
   var cookieVal = readCookie('city');
    var cookieName = readCookie('cityName');
    //console.log('Cookie = '+cookieVal);
    //$('a#homelink').attr('href', homeLink+cookieVal);
    //$('input#city-search').attr('value', cookieVal);
    $('input#city-banner-search').attr('value', cookieVal);
    //$('#city').text(cookieName);
    //$bannerSelect.val(cookieName);
});

var geo = readCookie('is_geo_run');


// Get User's Coordinate from their Browser
window.onload = function() {
  if(geo != 1){
  // HTML5/W3C Geolocation

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(UserLocation);
    //$select.text(_cityName);
    $bannerSelect.val(_cityName);
  }
  // Default to Washington, DC
  else
    NearestCity(38.8951, -77.0367);
  //Keeps the value of these fields in the initial state until/unless geolocation has run
  $('#city').text('Select A City');
  $bannerSelect.val('Place');
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
      //console.log('dif < temp');
    }else{
      //console.log('dif > temp');
      closest = index;
      temp = dif;
    }
  }

  //var cityVal = document.getElementById("city").innerHTML = cities[closest]['slug'];

  _citySlug = cities[closest]['slug']; //cityVal
  console.log(_citySlug);
  _cityName = cities[closest]['name'];
  console.log(_cityName);

  console.log("City Name = "+_citySlug);

  
  //$select.text(_cityName);
  $bannerSelect.val(_cityName);
  //$bannerSelect.attr('placeholder','').val(_cityName);
  //$('a#homelink').attr('href', homeLink+_citySlug);

  createCookie('city', _citySlug, '1');
  createCookie('cityName', _cityName, '1');
 
}//end nearest city
  
  var cookieVal = readCookie('city');
  //console.log(cookieVal);
  var cookieName = readCookie('cityName');
  var gateVal = readCookie('citygate');
  var gateName = readCookie('cityGateName');
  //console.log('Cookie = '+cookieName);
  createCookie('is_geo_run', '1', '');

  //var $curl = homelink+cookieVal;
  //console.log($curl);
  // if(cookieVal !== null && cookieVal != 'none'){
  //   $('a#homelink').attr('href', homeLink+cookieVal);
  // }
  
  //console.log(cookieVal);

  //console.log( $('a#homelink').attr('href', homeLink+cookieVal))
  $('input#city-search').attr('value', cookieVal);
  $('input#city-banner-search').attr('value', cookieVal);
  $('.amenities li a').each(function(){
    var $slug = $(this).data('slug');
    // if(cookieVal != 'none' && cookieVal !== null){ //cookieVal !== null || 
     // $(this).attr('href',$home+'/amenity/'+$slug+'/?city='+cookieVal);
    // }
  })
  //$('#city').text(cookieName);
  $select.text(cookieName);
  //$bannerSelect.val(cookieName);
  if(cookieName !== null && cookieVal != 'none'){
    //$('#city').text(cookieName);
    $bannerSelect.val(cookieName);
  }else{
    $('#city').text('Select A City');
    $bannerSelect.val('Place');
  }

$(function() {
    $('.eq.block').matchHeight(
      { byRow: true,
    property: 'height',
    target: null,
    remove: false }
      );
});

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
      displace: false     
 });//end sidr onOpen function

$('.close').click(
    function(){
      $.sidr('close', 'sidr-main');
       //console.log("Sidr should be closed");
    });

// Hide subnavs so that we can accordion them later
    $('.sidr ul.sub-menu').hide();

    //Save the location of the first li and link that has children
    $topLink = $('.sidr-inner ul.menu > li.menu-item-has-children > a');

    //Add a 'button' to just after the link in any top level li that has children
    $('<span class="open"><i class="fa fa-fw fa-chevron-down"></i> </span>').insertAfter($topLink);
    
    //Now we get all of the peices together

    //1 Create a counter to act as a toggle, we will be setting this counter to 1, then back to 
    //  zero with each click
    $openCnt = 0;

    $('.open').click(function(e){
      //Increment our counter
      $openCnt++;

      //Perform an action on our submenus based on the counter value,
      //setting back to 0 each 'even' numbered click
      if($openCnt == 1){
        $(this).next('.sub-menu').slideDown();
        $(this).html(' <i class="fa fa-fw fa-chevron-up"></i> ');
      }else{
        $(this).next('.sub-menu').slideUp();
        $(this).html(' <i class="fa fa-fw fa-chevron-down"></i> ');
        $openCnt = 0;
      }
   });
});
