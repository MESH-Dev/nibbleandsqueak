

  // var loadMap = function() {


  //   // Set the JSON file
  //   //var listingsFile = $dir + '/helpers/listings.json';

  //   //Declare this outside of the getJSON loop
  //   var map;

  //   //var infoWindow;

  //    var infoWindow = new google.maps.InfoWindow(), marker, i;

  var iconUrl = '/img/mapmarker.svg';

  // var icon = {
  //   url: $dir+iconUrl, // url
  //   scaledSize: new google.maps.Size(60, 60), // scaled size
  //   origin: new google.maps.Point(0,0), // origin
  //   anchor: new google.maps.Point(0, 0) // anchor
  // };

  var map; 


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
    map = new google.maps.Map(document.getElementById('single-map'), {
        zoom: 14,
        center: new google.maps.LatLng($_lat, $_long),
        scrollwheel:  false,
        zoomControl: false,
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_BOTTOM,
        },
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        styles:mapStyles      });

    //Declaring this after the map variable is vitally important
    marker = new google.maps.Marker({
            //This is just the title of the blog post
            //title: title,
            position: new google.maps.LatLng($_lat, $_long),
            map: map,
            //Create the custom icon
            icon:$dir+iconUrl,
            
          });
    
    //Create variable needed for Spider marker clustering
    // var oms = new OverlappingMarkerSpiderfier(map, { 
    //         markersWontMove: true, 
    //         markersWontHide: true,
    //         basicFormatEvents: true
    //       });
    
    //The JSON loop, parses the listings.json file for the information we need to make the map
    //jQuery.getJSON(listingsFile).success(function(data) {
      //var ctr = 0;
            // Loop through the JSON file adding the markers
//       for (var i = 0; i < data.length; i++) {
          
//         //Scoop out the titles from our JSON file
//         var title = data[i]['title'];
//         var color = data[i]['color'];

//         //Construct url parameters
//         var $address, $city, $state;

//         var address = data[i]['address'];
//         if (address != ''){
//           $address = address;
//         }else{
//           $address = '';
//         }
//         var city =  data[i]['city'];
//         if (city != ''){
//           $city = city;
//         }else{
//           $city = '';
//         }
//         var zip = data[i]['zip'];
//         if (zip != ''){
//           $zip = zip;
//         }else{
//           $zip = '';
//         }
//         var lat = data[i]['coordinates'][0];
//         var _long = data[i]['coordinates'][1];

//           $link = 'https://www.google.com/maps?saddr=My+location&daddr='+lat+','+_long;

//         //Let's start using our icons 
//         var icon, text, type_class;
//         var basedir = $dir;
//           if(data[i]['primary_section'] == 'Outside &amp; In'){
//             icon = '/img/outdoors-map-icon.png';
//             type_class = 'outside-in-iw';
//           }else if(data[i]['primary_section'] == 'Culture &amp; Heritage'){
//             icon = '/img/culture-map-icon.png';
//             type_class = 'culture-iw';
//           }else if(data[i]['primary_section'] == 'Eat &amp; Drink'){
//             icon = '/img/eat-map-icon.png';
//             type_class = 'eat-drink-iw';
//           }else if(data[i]['primary_section'] == 'Sleep &amp; Relax'){
//             icon = '/img/sleep-map-icon.png';
//             type_class = 'sleep-relax-iw';
//           }else if(data[i]['primary_section'] == 'Shop In Town &amp; Out'){
//             icon = '/img/shop-map-icon.png';
//             type_class = 'shop-iw';
//           }


//         //Create the html for the infoWindow
//         var infoWindowContent = '<div class="map-marker-title '+type_class+'"><span class="section">'+data[i]['primary_section'] +'</span><span class="list-title">'+ data[i]['title'] + '</span><span class="directions cta"><a class="cta-link" href="'+$link+'" target="_blank">Get Directions &#10165;</a></span></div>';
       
//           //Create the marker
//           marker = new google.maps.Marker({
//             //This is just the title of the blog post
//             title: title,
//             position: new google.maps.LatLng(data[i]['coordinates'][0], data[i]['coordinates'][1]),
//             map: map,
//             //Create the custom icon
//             icon:basedir + icon,
//           });

//           //'click' has been changed to 'spider_click' to start marker clustering
//           google.maps.event.addListener(marker, 'spider_click', (function(marker, infoWindowContent, infoWindow) {
//                 return function() {
                  
//                     infoWindow.setContent(infoWindowContent);
//                     infoWindow.open(map, marker);
//                 }
//             })(marker, infoWindowContent, infoWindow));

//           //Add clustering to the markers
//           oms.addMarker(marker);

//       }//end for loop

//     }); //end $http.get
//   }

// var full = jQuery('main').attr('data-category');

// loadMap(full);