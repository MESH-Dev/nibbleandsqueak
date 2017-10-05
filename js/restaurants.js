

  var loadListings = function(listing_cat) {


    // Set the JSON file
    var listingsFile = $dir + '/helpers/listings.json';
    //console.log("The listings.json file is at "+listingsfile);

    //Declare this outside of the getJSON loop
    var map;
     
    //Keep this out of the getJSON loop
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: new google.maps.LatLng(38.9595194,-78.7438335),
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
        styles:
            [{"featureType":"all","elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}]
      });

    var infoWindow = new google.maps.InfoWindow();//, marker, i;

    //Create variable needed for Spider marker clustering
    var oms = new OverlappingMarkerSpiderfier(map, { 
            markersWontMove: true, 
            markersWontHide: true,
            basicFormatEvents: true,
            keepSpiderfied: true
          });
    
    //The JSON loop, parses the listings.json file for the information we need to make the map
    jQuery.getJSON(listingsFile).success(function(data) {
      var ctr = 1;
      //console.log(data);
            // Loop through the JSON file adding the markers
      for (var i = 0; i < data.length; i++) {

        if(data[i]['listing_category'] !== listing_cat){

          continue;
        }
        else if(data[i]['listing_category'] === listing_cat){

          var icon, text, type_class;
        var basedir = $dir;
          if(data[i]['primary_section'] == 'Outside &amp; In'){
            icon = '/img/outdoors-map-icon.png';
            type_class = 'outside-in-iw';
          }else if(data[i]['primary_section'] == 'Culture &amp; Heritage'){
            icon = '/img/culture-map-icon.png';
            type_class = 'culture-iw';
          }else if(data[i]['primary_section'] == 'Eat &amp; Drink'){
            icon = '/img/eat-map-icon.png';
            type_class = 'eat-drink-iw';
          }else if(data[i]['primary_section'] == 'Sleep &amp; Relax'){
            icon = '/img/sleep-map-icon.png';
            type_class = 'sleep-relax-iw';
          }else if(data[i]['primary_section'] == 'Shop In Town &amp; Out'){
            icon = '/img/shop-map-icon.png';
            type_class = 'shop-iw';
          }
          
        //Scoop out the titles from our JSON file
        var title = data[i]['title'];
        var color = data[i]['color'];

        var slug = data[i]['slug'];

        var address = data[i]['address'];
        if (address != ''){
          $address = address;
        }else{
          $address = '';
        }
        var city =  data[i]['city'];
        if (city != ''){
          $city = city;
        }else{
          $city = '';
        }
        var zip = data[i]['zip'];
        if (zip != ''){
          $zip = zip;
        }else{
          $zip = '';
        }
        var lat = data[i]['coordinates'][0];
        var _long = data[i]['coordinates'][1];

        
        $link = 'https://www.google.com/maps?saddr=My+location&daddr='+lat+','+_long;
      
          //Create the marker
          marker = new google.maps.Marker({
            //This is just the title of the blog post
            title: title,
            //Style the dang label
            label: {
              text:String(ctr),
              color:"#ffffff",
              fontSize:"2em",
              fontFamily:"alternate-gothic-no-1-d"
            },
            position: new google.maps.LatLng(data[i]['coordinates'][0], data[i]['coordinates'][1]),
            map: map,
            //Create the custom icon
            icon:{
              path: google.maps.SymbolPath.CIRCLE,
              scale: 15,
              fillColor:String(color),
              fillOpacity:1,
              strokeColor:'transparent',
             }
          });

        var infoWindowContent = '<div class="map-marker-title '+type_class+'"><span class="section">'+data[i]['primary_section'] +'</span><span class="list-title"><a href="#'+slug+'">'+ctr+ '. ' + data[i]['title'] + '</a></span><span class="directions cta"><a class="cta-link" href="'+$link+'" target="_blank">Get Directions &#10165;</a></span></div>';

        //'click' has been changed to 'spider_click' to start marker clustering
         google.maps.event.addListener(marker, 'spider_click', (function(marker, infoWindowContent, infoWindow) {
                return function() {
                  
                    infoWindow.setContent(infoWindowContent);
                    infoWindow.open(map, marker);
                }
                
            })(marker, infoWindowContent, infoWindow));

         //Add clustering to the markers
         oms.addMarker(marker);

         

        ctr++;
        } // end else

      }//end for loop

    }); //end $http.get
  }

var listing_cat = jQuery('.listing-grid').attr('data-category');
//var full = jQuery('main').attr('data-category');
//console.log(full);
// console.log(listing_cat);

loadListings(listing_cat);