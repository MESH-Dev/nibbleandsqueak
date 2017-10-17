// 1) Get all of our data from the individual posts
//$rid = $post->ID;
$the_id = $rid;
$post_image = get_field('primary_photo', $post->ID);
$post_image_URL = $post_image['sizes']['large'];
$amenity = get_the_terms($rid, 'amenity' );
$lat = get_field('latitude', $rid);
$long = get_field('longitude', $rid);
$website = get_field('location_website', $rid);
$address = get_field('street_address', $rid);
$state = get_field('state_address', $rid);
$zip = get_field('zip_code');

//  2) Get our neigborhood taxonomy.  
//  There should only be one, but we're going to force it
$hoods = get_the_terms($rid, 'neighborhood' );
$hoods_name = get_the_terms($rid, 'neighborhood' )[0]->name;

//  3) Get our Cuisines
//  There should only be one, but we're going to force it
$cuisines = get_the_terms($rid, 'cuisine' );
$cuisines_name = get_the_terms($rid, 'cuisine' )[0]->name;

//  4) Start a variable to hold all of the data for each post 

$a = [
      'id' => $rid,
      "location_id" => $rid,
      "url" => (string)$website,
      "title" => the_title(),
      //"response" => $data,
      'street' => $street,
      'city' => $city,
      'state' => $state,
      //'full_address' => $address_full,
      'latitude' => $lat,
      'longitude' => $long,
      "phone" => $phone,
      "hours" => $hours,
      "website" => $website,
      "latitude" => $latitutde,
      "longitude" => $longitude,
      //"cuisine" => $cuisine,
      //"price_point" => $price,
      //"contact" => $contact,
      //"menu" => $menu,
      //"mobile_menu" => $mobileMenu,
      // "phone" => $data[]
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

    //  5) Push that data to an array
    array_push($arr, $a);