  var iconUrl = '/img/mapmarker.svg';
  var activeUrl = '/img/activeMapmarker.svg';
  var hoverUrl = '/img/mapmarker-hover.svg';
  var gmarkers = [];

  var icon = {
    url: $dir+iconUrl, // url
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
  };

   var hoverIcon = {
    url: $dir+hoverUrl, // url
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
  };

  var activeIcon = {
    url: $dir+activeUrl, // url
    scaledSize: new google.maps.Size(40, 40), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
    //zIndex: 999999
  };

  var infoWindow = new google.maps.InfoWindow(), marker, i;

  var mapStyles = [
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#333333"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#d5d5d5"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#7574c0"
            },
            {
                "saturation": "-37"
            },
            {
                "lightness": "75"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#7574c0"
            },
            {
                "saturation": "-2"
            },
            {
                "lightness": "53"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#dedede"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#7574c0"
            },
            {
                "lightness": "69"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#7574c0"
            },
            {
                "lightness": "25"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "lightness": "38"
            },
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f2f2f2"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e9e9e9"
            },
            {
                "lightness": 17
            }
        ]
    }
];

    //Keep this out of the getJSON loop
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: new google.maps.LatLng(_data[0]['coordinates'][0], _data[0]['coordinates'][1]),
        scrollwheel:  false,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_BOTTOM,
        },
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: true,
        styles:mapStyles      
    });


    //var markers = [];
    var bounds = new google.maps.LatLngBounds();
    

    var _data;
    //Loop through the JSON file adding the markers
    for (var i = 0; i < _data.length; i++) {
          
        //Scoop out the titles from our JSON file
        var title = _data[i]['title'];
        var latitude = _data[i]['coordinates'][0];
        var longitude = _data[i]['coordinates'][1];
        var slug = _data[i]['slug'];
        var street = _data[i]['street'];
        var state = _data[i]['state'];
        var city = _data[i]['city'];

        //console.log(_id);
        //Construct url parameters
        var $address, $city, $state;

        var address = _data[i]['address'];
        //console.log(address);
        if (address != ''){
          $address = address;
        }else{
          $address = '';
        }
        // var city =  _data[i]['city'];
        // if (city != ''){
        //   $city = city;
        // }else{
        //   $city = '';
        // }
        var zip = _data[i]['zip'];
        if (zip != ''){
          $zip = zip;
        }else{
          $zip = '';
        }
 
        
        $link = 'https://www.google.com/maps?saddr=My+location&daddr='+latitude+','+longitude;

        //setIcon(icon);

        //Create the html for the infoWindow
        var infoWindowContent = '<div class="map-marker-title"><h2 class="list-title"><a href="'+$home+'/restaurant/'+slug+'">'+ _data[i]['title'] + '</a></h2><span class="list-address">'+street+'</br>'+city+', '+state+' '+zip+'</span><div class="directions cta"><a class="cta-link" href="'+$link+'" target="_blank">Get Directions >></a></div><div class="border"></div></div>';
        
        //Create the marker
        marker = new google.maps.Marker({
            //This is just the title of the blog post
            title: title,
            position: new google.maps.LatLng(latitude, longitude),
            map: map,
            id: i,
            name: slug,
            optimized:false,
            zIndex: 999999+i,
            //Create the custom icon
            icon:icon,
        });

        bounds.extend(marker.getPosition());

        //markers.push(marker);

        
         
 
        //CLICK LISTENER TO SET AND SHOW INFOWINDOW, PAN TO ICON, AND SCROLL TO LEFT LOCATION
        google.maps.event.addListener(marker, 'click', (function(marker, infoWindowContent, infoWindow) {
            return function() {
                
                for(i=0; i < gmarkers.length; i++){
                  gmarkers[i].setIcon(icon);
                }

                infoWindow.setContent(infoWindowContent);
                infoWindow.open(map, marker);
                this.setIcon(activeIcon);
                var markerID = marker.id;
                var markerCenter = marker.position;



                var _mID = marker.name;
                var _top = jQuery('.locations .map-listing#'+marker.name).offset().top;
                var _offset = jQuery('.locations .map-listing#'+marker.name).data('offset');
                jQuery('.locations .map-listing').removeClass('location-active');
                jQuery('.locations .map-listing#'+marker.name).addClass('location-active');
                //var center = new google.maps.LatLng(_data[i]['coordinates'][0], _data[i]['coordinates'][1]); 
                map.panTo(markerCenter);
                console.log(_offset);
                //console.log(_top);
                //jQuery('.locations .map-listing').addClass('this-is-a-marker'+_top);
                //jQuery('.locations .map-listing').data('top', _top);
                //jQuery('locations').scrollTop(_top);
                //console.log(_mID);
                //jquery('locations').scrollTo(_top);
                jQuery(".locations").animate({ scrollTop: _offset-200 }, "slow");
                //scrollToMarker()

            }
        })(marker, infoWindowContent, infoWindow));

        //  google.maps.event.addListener(marker,'mouseover',function(){
        //   //jQuery(this).find('svg').addClass('hovered');
        //   //console.log(jQuery(this).find('svg').attr('src'));
        //   this.setIcon(hoverIcon);
        // });

        // google.maps.event.addListener(marker,'mouseout',function(){
        //   //jQuery(this).find('circle').css({color:'white'});
        //   //jQuery(this).find('svg').removeClass('hovered');
        //   //console.log('not-hovered');
        //   this.setIcon(icon);
        // });

        /*
         * The google.maps.event.addListener() event waits for
         * the creation of the infowindow HTML structure 'domready'
         * and before the opening of the infowindow defined styles
         * are applied.
         */
        google.maps.event.addListener(infoWindow, 'domready', function() {

            // Reference to the DIV which receives the contents of the infowindow using jQuery
            var iwOuter = jQuery('.gm-style-iw');

           /* The DIV we want to change is above the .gm-style-iw DIV.
            * So, we use jQuery and create a iwBackground variable,
            * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
            */
            var iwBackground = iwOuter.prev();

            iwBackground.parent().addClass('iw-background');

            // Remove the background shadow DIV
            iwBackground.children(':nth-child(2)').css({'display' : 'none'});

            // Remove the white background DIV
            iwBackground.children(':nth-child(4)').css({'display' : 'none'});

           // The next 2 lines will change the 'left' position of the tail shadow, and the actual tail
           //     It really works best when you are working with a specific, single, infowindow, otherwise
           //     the tail doesn't line up with all markers, so we ain't using it.

            // Moves the shadow of the arrow 76px to the left margin.
            //iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

            // Moves the arrow 76px to the left margin.
            //iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

           //---------------------------------------------------------------------------------------------

            // Changes the desired tail shadow color, and the color of the tail itself
             iwBackground.children(':nth-child(3)').find('div').children().addClass('tail').css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1', 'background':'#7495ff'});
            //iwBackground.children(':nth-child(3)').next('div').parent().addClass('tail-container').css({'width':'40px', 'height':'30px'});

            // Taking advantage of the already established reference to
            // div .gm-style-iw with iwOuter variable.
            // You must set a new variable iwCloseBtn.
            // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
            // Is this div that groups the close button elements.
            var iwCloseBtn = iwOuter.next();

            // Apply the desired effect to the close button
            iwCloseBtn.css({
              opacity: '0', // by default the close button has an opacity of 0.7
              right: '0px', top: '3px', // button repositioning
              border: '7px solid #7495ff', // increasing button border and new color
              'border-radius': '13px', // circular effect
              'box-shadow': '0 0 5px #3990B9' // 3D effect to highlight the button
            });

            // The API automatically applies 0.7 opacity to the button after the mouseout event.
            // This function reverses this event to the desired value.
            iwCloseBtn.mouseout(function(){
                  jQuery(this).css({opacity: '0'});
            });
        });
  gmarkers.push(marker);
}//end for loop


//set bounds for map. 
map.fitBounds(bounds);

function markerFocus(marker_slug){
   for(i=0; i < gmarkers.length; i++){
       var marker = gmarkers[i];
       marker.setIcon(icon);
       if(marker.name == marker_slug){

        var infoWindowContent = '<div class="map-marker-title"><h2 class="list-title"><a href="'+$home+'/restaurant/'+marker_slug+'">'+ marker.title + '</a></h2><span class="list-address">'+street+'</br>'+city+', '+state+' '+zip+'</span><div class="directions cta"><a class="cta-link" href="'+$link+'" target="_blank">Get Directions >></a></div><div class="border"></div></div>';
        infoWindow.setContent(infoWindowContent);
         infoWindow.open(map, marker);
         marker.setIcon(activeIcon);
         var position = marker.getPosition();
         map.setCenter(position);
         //break;
       }
      }
}
var windowW = jQuery(window).width();
console.log(windowW);
//if(jQuery(window).width() > 500){
jQuery('.map-listing').click(function(e){
  var windowW = jQuery(window).width();
  if (windowW >= 500){
    //e.preventDefault();
  }
  map.panTo(marker.getPosition());
  var marker_slug = jQuery(this).attr('id');
  markerFocus(marker_slug);
  jQuery('.locations .map-listing').removeClass('location-active');
  jQuery(this).addClass('location-active');
})

function scrollToMarker(){
  //alert('Scrolled'+marker.id);
  var _mID = marker.name;
  var _top = jQuery('.locations .map-listing').data('id', marker.name).offset().top;
  jQuery('.locations .map-listing').data('top', _top);
  //console.log(_mID);
  //jquery('locations').scrollTo(_top);
  //jQuery(".locations").animate({ scrollTop: _top+100 }, "slow");
//   $(function() {
// $('a[href*=#]:not([href=#])').click(function() {
// if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
//   var target = $(this.hash);
//   target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
//   if (target.length) {
//     //alert("BAMM!");
//     $('html,body').animate({
//       //'top-75' is custom.  limits the offset to top of window plus 75px
//       scrollTop: (target.offset().top-75)
//     }, 800);
//     return false;
//   }
// }
// });
// });
}
jQuery(window).resize(scrollToMarker());
//scrollToMarker();
//});