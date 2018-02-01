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

// Updates the map with new or updated listings on restaurant post-type update
function update_restaurant_map( $post_id ) {

    $post_type = get_post_type($post_id);
    $r_id = get_field('location_id', $post_id);
    $data = get4S_data($r_id); 

    // if("restaurant" != $post_type){ return; }
    // else{
    //     $arr = array();

        // $args = array(
        //   'post_type' => 'restaurant',
        //   'posts_per_page'=> -1,
        //   'post_status' => 'publish',
        //   'orderby' => 'title',
        //   'order' => 'asc'
        // );

        //query_posts( $args );

        //while (have_posts()) { the_post();
          //Save the post ID to a variable
          // $post_id = get_the_ID();

         //__--__!!  We only need this for testing the return value
          //          remove or comment this out prior to production

        $p_id = get_the_ID();
           $the_id = (string)$p_id;
          // //Get post info to save to our json file
           $title = get_the_title();

           //-------------------------------------------------------------------
          // GLOBAL $post;
          // $slug = $post->post_name;
          
          // $address = get_field('street_address',$p_id);
          // $city = get_field('city',$p_id);
          // $phone = get_field('phone_number',$p_id);
          // $website = get_field('web_address',$p_id);
          // $zip = get_field('zip',$p_id);
          //$primary_section = get_the_terms($p_id, 'primary_section'); 
          //$color = get_term_meta($primary_section[0]->term_id, 'color');
          //__Get the categories for the post, we'll break it up below
          //$listing_cats = get_the_category($p_id); 
          //return $r_id;
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
          

          //$description = get_the_content();

          //Save the address, city, & zip to a variable to use in the getCoordinates function
         
           
          //Override   
          //Check to see if the latitude and longitude overides on the listing posttype are being used
          //If so, use those values to retrieve our location information for our map
          //If not, run the getCoordinates function to dynamically retrieve the lat and lng  
          //  if (get_field('latitude',$p_id) && get_field('longitude',$p_id)) {
          //    $lat = get_field('latitude');
          //    $long = get_field('longitude');
          //    $coordinates = array((float)$lat, (float)$long);
          //  }else{
          //   $f = $address . ' ' . $city . ' ' . $zip;
          //   $coordinates = getCoordinates($f);
          //   //If we got a good response from Google, update post_meta 
          //   //For latitude and longitude to help save some time when new entries are created
          //   update_post_meta($post->ID, 'latitude', $coordinates[0]);
          //   update_post_meta($post->ID, 'longitude' , $coordinates[1]);
          // }

            // This should really be it's own function...keep plugging on that

   //         $tok = 'PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
      // //var_dump($tok);
      // $_date = date("Ymd");
      // // var_dump($_date);
      // $r_url = 'https://api.foursquare.com/v2/venues/'.$r_id.'?v='.$_date.'&oauth_token='.$tok;
      // //$r_url = 'https://api.foursquare.com/v2/venues/4be442ac7e2a76b0aaab1c9b?v=20131016&oauth_token=PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
      // $r_response = file_get_contents($r_url);
      // $r_json = json_decode($r_response,true);
      //var_dump($r_response);
      // var_dump($r_url);

      //---------------------------------------------

          //Call in our function to obtain Foursquare API result 
          //& save to $data variable to parse
          //$data = get4S_data($r_id);
          
          //Pull Data from Foursquare API
          $phone = $data['response']['venue']['contact']['formattedPhone'];
          $lat = $data['response']['venue']['location']['lat'];
          $long = $data['response']['venue']['location']['lng'];
          $address_full = $data['response']['venue']['location']['formattedAddress'];
          $street = $data['response']['venue']['location']['address'];
          $city = $data['response']['venue']['location']['city'];
          $state = $data['response']['venue']['location']['state'];
          $zip = $data['response']['venue']['location']['postalCode'];
          $hours = $data['response']['venue']['hours'];
          $website = $data['response']['venue']['url'];
          $cuisine = $data['response']['venue']['categories'][0]['shortName'];
          // $facebook = $data['response']['venue']['page']['user']['contact']['facebook'];
          $contact = $data['response']['venue']['contact'];
          
          // $facebook = 
          $price = $data['response']['venue']['attributes']['groups'][0]['items'];
          $menu = $data['response']['venue']['menu']['url'];
          //May need a separate ACF for this one
          $mobileMenu = $data['response']['venue']['menu']['mobileUrl'];
          
          //Update ACF with information from Foursquare API
          update_post_meta($post_id, 'phone', $phone);
          update_post_meta($post_id, 'street_address', $street);
          update_post_meta($post_id, 'city_address', $city);
          update_post_meta($post_id, 'state_address', $state);
          update_post_meta($post_id, 'zip_code', $zip);
          update_post_meta($post_id, 'latitude', $lat);
          update_post_meta($post_id, 'longitude', $long);
          update_post_meta($post_id, 'location_website', $website);
          update_post_meta($post_id, 'price_point', $price[0]['displayValue']);
          update_post_meta($post_id, 'menu_link', $menu);
          update_post_meta($post_id, 'mobile_menu_link', $mobileMenu); 
          //update_post_meta($post_id, 'gmd_link', 'https://www.google.com/maps?saddr=My+location&daddr='.$lat.','.$long);
          update_post_meta($post_id, 'gmd_link', 'https://www.google.com/maps?saddr=My+location&daddr='.$street.' '.$city.' '.$state);
          //update_post_meta($post_id, 'cuisine', $cuisine);
          //update_metadata('post', $post_id, 'cuisine', $cuisine);
          //add_metadata('post', $post_id, 'cuisine', $cuisine);
          //add_post_meta('post', $post_id, 'cuisine', $cuisine);
          wp_set_post_terms($post_id, $cuisine, 'cuisine', true);
          //Did the location provide Facebook info in their Foursquare data? We need that
          if($contact['facebookUsername'] != '' || $contact['facebookUsername'] != null ){
            update_post_meta($post_id, 'location_facebook_link', 'https://facebook.com/'.$contact['facebookUsername']);
          }elseif($contact['facebookUsername'] == '' && ($contact['facebook'] != '' || $contact['facebook'] != null )){
            update_post_meta($post_id, 'location_facebook_link', 'https://facebook.com/'.$contact['facebook']);
          }

          //Did the location provide Twitter info in their Foursquare data? We need that, too
          if($contact['twitter'] != '' || $contact['twitter'] != null ){
            update_post_meta($post_id, 'location_twitter', $contact['twitter']);
          }

          //Break down hours and add it to the hours_of_operation field

          if($hours['timeframes'] != ''){
            $open = $hours['timeframes'];
            //var_dump($open);
            $output = '';
            foreach ($open as $is_open){
              //update_post_meta($post_id, 'hours_of_operation')
              //var_dump($is_open);
              $output .= '<span class="h_op"><span class="day">'.$is_open['days'].'</span> <span class="time">'.$is_open['open'][0]['renderedTime'].'</span></span></br>';
              

            }

            update_post_meta($post_id, 'hours_of_operation', $output);
          }

          //__--__!!  We only need this if we find that we CAN get neighborhood
          //          from the Foursquare API.  If not, remove or comment this out
          //          prior to production

          // Use this to add a term as a taxonomy value based on the API return 
          // 1) Check to see if the term currently exists

          if( !term_exists( $city, 'city' ) ) {
            // 2) If it doesn't, "!term_exists", let's add it
            //    ** Note:
            //       -Here, we can add a term by just using the term name, this is not the case 
            //        when we want to set the term, if we are using a heirarchical term, which is
            //        most often the case
            //       -Note the commented out "array" information, this works like the 'manual' version
            //        of creating a taxonomy term.  If we wanted to add a description, or override the slug,
            //        we could do that here.  This is being left on purpose.
             wp_insert_term(
                 $city,
                 'city'
                 // array(
                 //   'description' => 'This is an example category created with wp_insert_term.',
                 //   'slug'        => 'example-category'
                 //)
             );
         }
         
         //Since we're going to try to set this on the post being updated, we 
         //need to tease out some information from the term.

         // Here, we're getting the term by "name", this is easier than trying to turn the 
         // return value into the slug

         $term = get_term_by('name', $city, 'city');

         if( !term_exists( $cuisine, 'cuisine' ) ) {
            // 2) If it doesn't, "!term_exists", let's add it
            //    ** Note:
            //       -Here, we can add a term by just using the term name, this is not the case 
            //        when we want to set the term, if we are using a heirarchical term, which is
            //        most often the case
            //       -Note the commented out "array" information, this works like the 'manual' version
            //        of creating a taxonomy term.  If we wanted to add a description, or override the slug,
            //        we could do that here.  This is being left on purpose.
             wp_insert_term(
                 $cuisine,
                 'cuisine'
                 // array(
                 //   'description' => 'This is an example category created with wp_insert_term.',
                 //   'slug'        => 'example-category'
                 //)
             );
         }

         $c_term = get_term_by('name', $cuisine, 'cuisine');

         // Since we're working with a heirarchical term, we cannot use the character value of the 
         // term, so we're gonna need the ID
         $t_id = $term->term_id;
         $c_id = $c_term->term_id;
         // Using the post ID, term id ($t_id), taxonomy ('cuisine'), set the term for the post we're saving
         // The last value, 'true', appends the value, which just means to set the value on the post
         $st = wp_set_post_terms($post_id, $t_id, 'city', true);
         $ct = wp_set_post_terms($post_id, $c_id, 'cuisine', true);

         //-------------------------------------------------------------------
          
          //__--__!!  We only need this for testing the return value
          //          remove or comment this out prior to production

            //Add all of the listing 'parts' to an array
        //     $a = [
        //       'id' => $the_id,
        //       "location_id" => $r_id,
        //       "url" => (string)$website,
        //       "title" => $title,
        //       //"response" => $data,
        //       'street' => $street,
        //       'city' => $city,
        //       'state' => $state,
        //       'full_address' => $address_full,
        //       'latitude' => $lat,
        //       'longitude' => $long,
        //       "phone" => $phone,
        //       "hours" => $hours,
        //       "website" => $website,
        //       "cuisine" => $cuisine,
        //       "price_point" => $price,
        //       "contact" => $contact,
        //       "menu" => $menu,
        //       "mobile_menu" => $mobileMenu,
        //       // "phone" => $data[]
        //       // "slug"=> $slug,
        //       // "address" => $address,
        //       // "city" => $city,
        //       // "phone" => $phone,
        //       // "website" => $website,
        //       // "zip" => $zip,
        //       // "coordinates" => $coordinates,
        //       // "listing_category" => $listing_category,
        //       // "listing_name"=>$listing_name,
        //       // "primary_section" => $primary_sec,
        //       // "description" => $description,
        //       // "color" => $color
        //     ];

        //     $arr[$the_id] = $a;
        //     array_push($arr, $a);

        // }

        //Reset the query in-between loops
        //wp_reset_query();


        

        // JSON-encode the response
        //var_dump($arr);
        // $json = json_encode($arr, JSON_PRETTY_PRINT);

        // //The file location for the json file we're creating
        // $directory = get_template_directory().'/helpers/restaurants.json';

        // //Write to our file
        // $myfile = fopen(''.$directory.'', "w") or die("Unable to open file!");
        // fwrite($myfile, $json);
        // fclose($myfile);

        // --------------------------------------------------------  
    }

//}

add_action('save_post', 'update_restaurant_map', 10, 3);

function get4S_data($r_id){
  $tok = 'PSZK5500FKOOKPRKAWEU4UCPLQK5AOMMKNDZOI14KBUS2V5Z';
  //New token 11/21/17
  //Replace if necessary
  //$tok = 'WYKV5T3KXZV3FWOKLESJLBJBPOJAKXRUMJNVJF3MOQ02L0OJ';
  //var_dump($tok);
  $_date = date("Ymd");

  $r_url = 'https://api.foursquare.com/v2/venues/'.$r_id.'?v='.$_date.'&oauth_token='.$tok;
  //var_dump($r_url);
  $r_response = file_get_contents($r_url);
  $r_json = json_decode($r_response,true); 
  //var_dump($r_response);
  return $r_json;
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

function search_filter($query){
 if ( !is_admin() && $query->is_main_query() ) {
  //Use is archive for archive page for Amenities
    if ($query->is_search) {
      $city = $_GET["city"];
    
      $city_query = array(
       'posts_per_page' => -1,
        array(
            'taxonomy' => 'city',
            'field'    => 'slug',
            'terms'    => $city,
        )
    );
       $query->set('tax_query', $city_query);
    //}
  }
}
}
//
add_action('pre_get_posts','search_filter');

$city = $_GET["city"];
//var_dump($city);
$dropdown = $_COOKIE["dropdown"];
//var_dump($dropdown);
      //var_dump($city);

//Run special query only if a city is chosen
//if($city != null || $dropdown == 'true'){
function archive_filter($query){
 if ( !is_admin() && $query->is_main_query() ) {
  //Use is archive for archive page for Amenities
  $city = $_GET["city"];
  $dropdown = $_COOKIE["dropdown"];
      //var_dump($city);
      
    if ($query->is_archive && ! $query->is_category ) {
      

      //if($city != null || $dropdown == 'true'){
      $city_query = array(
        'posts_per_page' => -1,
        array(
            'taxonomy' => 'city',
            'field'    => 'slug',
            'terms'    => $city,
        )
    );
       $query->set('tax_query', $city_query);
     }
    //}
  //} //end if city not blank
}
}
//
if($city != null || $city != ''){
  add_action('pre_get_posts','archive_filter');
}

function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
};

?>
