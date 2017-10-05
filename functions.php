<?php

//Add all custom functions, hooks, filters, ajax etc here

include('functions/start.php');
include('functions/cpt.php');
include('functions/clean.php');

//Custon wp-admin logo
function my_custom_login_logo() {
  echo '<style type="text/css">
		        h1 a {
		          background-size: 227px 85px !important;
		          margin-bottom: 20px !important;
		          background-image:url('.get_bloginfo('template_directory').'/img/logo.png) !important; }
		    </style>';
}

//Add ajax functionality to pages, all not just in admin
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
    ?>
    <script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
    }

// Updates the map with new or updated listings on listing post-type update
function update_restaurant_map( $post_id, $r_response ) {

    $post_type = get_post_type($post_id);

    if("restaurant" != $post_type){ return; }
    else{
        $arr = array();

        $args = array(
          'post_type' => 'restaurant',
          'posts_per_page'=> -1,
          'post_status' => 'publish',
          'orderby' => 'title',
          'order' => 'asc'
        );

        query_posts( $args );

        while (have_posts()) { the_post();
          //Save the post ID to a variable
          $p_id = get_the_ID();



          //Get post info to save to our json file
          $title = get_the_title();
          GLOBAL $post;
          $slug = $post->post_name;
          $r_id = get_field('location_id', $p_id);
          $address = get_field('street_address',$p_id);
          $city = get_field('city',$p_id);
          $phone = get_field('phone_number',$p_id);
          $website = get_field('web_address',$p_id);
          $zip = get_field('zip',$p_id);
          //$primary_section = get_the_terms($p_id, 'primary_section'); 
          //$color = get_term_meta($primary_section[0]->term_id, 'color');
          //__Get the categories for the post, we'll break it up below
          $listing_cats = get_the_category($p_id); 
          return $r_id;
          //----
        
          //get one category by splitting the value from above
          // if($listing_cats){
          //   foreach ($listing_cats as $cat) {
          //    $listing_category = $cat->slug;
          //    $listing_name = $cat->name;
          //    break;
          //   }
          // }
          
          // if($primary_section){
          //   foreach ($primary_section as $ps){
          //    $primary_sec = $ps->name;
          //     break;
          //   }
          // }
          

          $description = get_the_content();

          //Save the address, city, & zip to a variable to use in the getCoordinates function
         
           
          //Override   
          //Check to see if the latitude and longitude overides on the listing posttype are being used
          //If so, use those values to retrieve our location information for our map
          //If not, run the getCoordinates function to dynamically retrieve the lat and lng  
           if (get_field('latitude',$p_id) && get_field('longitude',$p_id)) {
             $lat = get_field('latitude');
             $long = get_field('longitude');
             $coordinates = array((float)$lat, (float)$long);
           }else{
            $f = $address . ' ' . $city . ' ' . $zip;
            $coordinates = getCoordinates($f);
            //If we got a good response from Google, update post_meta 
            //For latitude and longitude to help save some time when new entries are created
            update_post_meta($post->ID, 'latitude', $coordinates[0]);
            update_post_meta($post->ID, 'longitude' , $coordinates[1]);
          }

          	$tok = 'PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
			var_dump($tok);
			$_date = date("Ymd");
			// var_dump($_date);
			//$r_url = 'https://api.foursquare.com/v2/venues/'.$r_id.'?v='.$_date.'&oauth_token='.$tok;
			$r_url = 'https://api.foursquare.com/v2/venues/4be442ac7e2a76b0aaab1c9b?v=20131016&oauth_token=PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
			$r_response = file_get_contents($r_url);
			var_dump($r_response);
			// var_dump($r_url);

          //$data = get4S_data($r_response);
          //var_dump($data);
  
            //Add all of the listing 'parts' to an array
            $a = [
              "location_id" => $r_id,
              "title" => $title,
              "response" => $r_response,
              // "slug"=> $slug,
              // "address" => $address,
              // "city" => $city,
              // "phone" => $phone,
              // "website" => $website,
              // "zip" => $zip,
              // "coordinates" => $coordinates,
              // "listing_category" => $listing_category,
              // "listing_name"=>$listing_name,
              // "primary_section" => $primary_sec,
              // "description" => $description,
              // "color" => $color
            ];

            array_push($arr, $a);

        }

        

        //Reset the query in-between loops
        wp_reset_query();

        // JSON-encode the response
       	var_dump($arr);
        $json = json_encode($arr, JSON_PRETTY_PRINT);

        //The file location for the json file we're creating
        $directory = get_template_directory().'/helpers/restaurants.json';

        //Write to our file
        $myfile = fopen(''.$directory.'', "w") or die("Unable to open file!");
        fwrite($myfile, $json);
        fclose($myfile);  
    }

}

add_action('save_post', 'update_restaurant_map', 10, 3);

function get4S_data($r_id){
	$tok = 'PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
	var_dump($tok);
	$_date = date("Ymd");

	$r_url = 'https://api.foursquare.com/v2/venues/'.$r_id.'?v='.$_date.'&oauth_token='.$tok;
	var_dump($r_url);
	$r_response = file_get_contents($r_url);
	var_dump($r_response);
	return $r_response;
}

//add_action('edit_post', 'get4S_data', 10, 3);

//Dynamically retrieve our lat lng info based on the address provided
//** See Override above for situations where the use of this function is overriden per lisitng post
function getCoordinates($address){

          //var_dump($response)
          $address = urlencode($address);

          $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address . "&key=AIzaSyDXR8bORut0sXyoust5FWnhi-9TA8TWktw";
          $response = file_get_contents($url);
          $json = json_decode($response,true);

          //Check to see if we received a good response from GoogleMaps
          if ($json['status'] == 'OK'){
            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];
          //If not, set lat lng values to 0 
          //** This should be good to narrow down issues with a particular listing,
          //   as problem listings will return a 0 value lat lng in our json file
          }else{
            $lat = 0;
            $lng = 0;
          }

          return array($lat, $lng);      
}

?>
