

  // var loadMap = function() {


  //   // Set the JSON file
  //   //var listingsFile = $dir + '/helpers/listings.json';

  //   //Declare this outside of the getJSON loop
  //   var map;

  //   //var infoWindow;
  var icon = '/img/mapmarker.png';
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
        styles:mapStyles      });
    
   var bounds = new google.maps.LatLngBounds();
   var position = [];
   //map.fitBounds(response[0].geometry.viewport);
    //console.log(bounds);
     //map.fitbounds;
    // var bounds = map.getBounds();
    // console.log(bounds);

    //var geoCoder = new GClientGeocoder();
    //console.log(geoCoder);
    //   geoCoder.setViewport(map.getBounds());
    //   geoCoder.getLocations('searchquery', function(latlng) {
    //     if( latlng.Placemark.length > 0 ) {
    //       var box = latlng.Placemark[0].ExtendedData.LatLonBox;
    //       var bounds = new GLatLngBounds(new GLatLng(box.south, box.west), new GLatLng(box.north, box.east));
    //       var center = new GLatLng(box.Placemark[0].Point.coordinates[1], latlng.Placemark[0].Point.coordinates[0]);
    //       var zoom = oMap.getBoundsZoomLevel(bounds);
    //       map.setCenter(center, zoom);
    //     }
    //   });

    // var box = LatLng.Placemark[0].ExtendedData.LatLonBox;
    // console.log(box);
    //Create variable needed for Spider marker clustering
    // var oms = new OverlappingMarkerSpiderfier(map, { 
    //         markersWontMove: true, 
    //         markersWontHide: true,
    //         basicFormatEvents: true
    //       });
    
    //The JSON loop, parses the listings.json file for the information we need to make the map
    //jQuery.getJSON(listingsFile).success(function(data) {
      var ctr = 0;
      var _data;
      //console.log(_data[0]['city']);
            //Loop through the JSON file adding the markers
      for (var i = 0; i < _data.length; i++) {
          
        //Scoop out the titles from our JSON file
        var title = _data[i]['title'];
        var color = _data[i]['color'];
        var city = _data[i]['city'];
        var street = _data[i]['street'];
        var state = _data[i]['state'];
        var _id = _data[i]['slug'];
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
        var lat = _data[i]['coordinates'][0];
        var _long = _data[i]['coordinates'][1];

        //var myBounds = bounds.extend(parseInt(lat), parseInt(_long));
        

          $link = 'https://www.google.com/maps?saddr=My+location&daddr='+lat+','+_long;

        //Let's start using our icons 
        var icon, text, type_class;
        var basedir = $dir;
          if(_data[i]['primary_section'] == 'Outside &amp; In'){
            icon = '/img/outdoors-map-icon.png';
            type_class = 'outside-in-iw';
          }else if(_data[i]['primary_section'] == 'Culture &amp; Heritage'){
            icon = '/img/culture-map-icon.png';
            type_class = 'culture-iw';
          }else if(_data[i]['primary_section'] == 'Eat &amp; Drink'){
            icon = '/img/eat-map-icon.png';
            type_class = 'eat-drink-iw';
          }else if(_data[i]['primary_section'] == 'Sleep &amp; Relax'){
            icon = '/img/sleep-map-icon.png';
            type_class = 'sleep-relax-iw';
          }else if(_data[i]['primary_section'] == 'Shop In Town &amp; Out'){
            icon = '/img/shop-map-icon.png';
            type_class = 'shop-iw';
          }


        //Create the html for the infoWindow
        var infoWindowContent = '<div class="map-marker-title"><h2 class="list-title">'+ _data[i]['title'] + '</h2><span class="list-address">'+street+'</br>'+city+', '+state+' '+zip+'</span><div class="directions cta"><a class="cta-link" href="'+$link+'" target="_blank">Get Directions >></a></div><div class="border"></div></div>';
       
          //Create the marker
          marker = new google.maps.Marker({
            //This is just the title of the blog post
            title: title,
            position: new google.maps.LatLng(_data[i]['coordinates'][0], _data[i]['coordinates'][1]),
            map: map,
            id: i,
            name: _data[i]['slug'],
            //Create the custom icon
            icon:$dir + icon,
          });
          
          //var bounds = new google.maps.LatLngBounds();
   //map.fitBounds(response[0].geometry.viewport);
    //console.log(bounds);

    
    position.push(marker.getPosition());
    //console.log(position);
    //console.log(marker.getPosition());
    

          //'click' has been changed to 'spider_click' to start marker clustering
          google.maps.event.addListener(marker, 'click', (function(marker, infoWindowContent, infoWindow) {
                return function() {
                  
                    infoWindow.setContent(infoWindowContent);
                    infoWindow.open(map, marker);
                    var markerID = marker.id;
                    var markerCenter = marker.position;

                    var _mID = marker.name;
                    var _top = jQuery('.locations .map-listing#'+marker.name).offset().top;
                    var _offset = jQuery('.locations .map-listing#'+marker.name).data('offset');
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

   //__-- The next 2 lines will change the 'left' position of the tail shadow, and the actual tail
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

        bounds.extend(position);
          //Add clustering to the markers
          //addMarker(marker);
          //map.fitBounds(bounds);
      }//end for loop

    //}); //end $http.get
  //}

// var full = jQuery('main').attr('data-category');
//jQuery( document ).ready(function($) {
// loadMap(full);
function scrollToMarker(){
  //alert('Scrolled'+marker.id);
  var _mID = marker.name;
  var _top = jQuery('.locations .map-listing').data('id', marker.name).offset().top;
  jQuery('.locations .map-listing').data('top', _top);
  //console.log(_mID);
  //jquery('locations').scrollTo(_top);
  jQuery(".locations").animate({ scrollTop: _top+100 }, "slow");
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

//});