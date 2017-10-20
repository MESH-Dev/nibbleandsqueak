// Get User's Coordinate from their Browser
window.onload = function() {
  // HTML5/W3C Geolocation
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(UserLocation);
  }
  // Default to Washington, DC
  else
    NearestCity(38.8951, -77.0367);
}

// Callback function for asynchronous call to HTML5 geolocation
function UserLocation(position) {
  console.log(position);
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

//var lat = 0; // user's latitude
//var lon = 0; // user's longitude

// var cities = [
//   ["Washington", 38.8951, -77.0367, ""],
//   ["New York", 40.7127837, -74.0059413, ""],
//   ["Huntington", 38.4192496, -82.44515400000002, ""],
//   ["Charleston", 38.3607022,-81.6432097, ""]
// ];

var cities = geo_choices;
console.log(jQuery.inArray('Asheville', cities));
console.log(cities);
// cities[index][1] = latitude;
// cities[index][2] = longitude
//console.log(cities[index][1]);

function NearestCity(latitude, longitude) {
  var temp = 999999;
  var closest;
  console.log(cities.length);
  for (index = 0; index < cities.length; ++index) {
    var dif = PythagorasEquirectangular(latitude, longitude, cities[index]['lat'][0], cities[index]['long'][0]);
    console.log(dif);
    //console.log(index);

    if (dif < temp) {
      closest = index;
      temp = dif;
    }
  }
  

  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
  // echo the nearest city
  //if(dif >)
  var cityVal = document.getElementById("city").innerHTML = cities[closest]['slug'];
  console.log(cityVal);
  //document.cookie = "city="+cityVal;
  eraseCookie('city');
  createCookie('city', cityVal, '');
  var cityCook = getCookie(city);

  var homeLink = jQuery('a#homelink').attr('href');
  jQuery('a#homelink').attr('href', homeLink+cityVal);

  //console.log(cityCook);
 
}