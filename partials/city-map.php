<?php 
	$city_name = get_field('city_tax'); 
	$city = $city_name->slug;
	$city_label = $city_name->name;

	// Used for custom curation
	$restaurant_choice = get_field('restaurant_po');

	//  We're setting up an array for our query data here.  Note that we're putting it
	//  outside of our if/while loop.  This is important.
	$arr = array();
	//  if $city_name is not blank, we're gonna run a query using that data

	//if($restaurant_ch != '' ){}
	//These are our arguments for our query.
	$args = array(
	'post_type' => 'restaurant',
	'posts_per_page' => '-1',
	'orderby'=>'title',
	'order'=>'ASC',
	'tax_query'=>array(
			array(
			'taxonomy'=>'city',
			'field'=>'slug',
			'terms'=>$city,
			),
		),
	);

	$the_query = new WP_Query( $args );

	if ($the_query->have_posts()){

	while($the_query->have_posts()) { $the_query->the_post();

		// 1) Get all of our data from the individual posts
		//global $post;

		$slug = $post->post_name;
		$rid = $post->ID;
		$the_id = $rid;
		$post_image = get_field('primary_photo', $post->ID);
		$post_image_alt = $post_image['alt'];

		if($post_image != ''){
			$post_image_URL = $post_image['sizes']['large'];
		}else{
			$post_image_URL = get_template_directory_uri().'/img/NS_img_placeholder.png';
		}

		$amenity = get_the_terms($rid, 'amenity' );
		$lat = get_field('latitude', $rid);
		$long = get_field('longitude', $rid);
		$website = get_field('location_website', $rid);
		$address = get_field('street_address', $rid);
		$state = get_field('state_address', $rid);
		$zip = get_field('zip_code');
		$phone = get_field('phone', $rid);
		$coordinates = array((float)$lat, (float)$long);
		$coordinates_long = array($lat, $long);
		$_lat = (float)$coordinates[0];
		$_long = (float)$coordinates[1];
		$title = get_the_title();
		$city_address = $city_label;
		$title = get_the_title($rid);

		//  2) Get our neigborhood taxonomy.  
		//  There should only be one, but we're going to force it
		$hoods = get_the_terms($rid, 'neighborhood' );
		if($hoods != ''){
		$hoods_name = get_the_terms($rid, 'neighborhood' )[0]->name;
		}else{
			$hoods_name=" ";
		}

		//  3) Get our Cuisines
		//  There should only be one, but we're going to force it
		$cuisines = get_the_terms($rid, 'cuisine' );
		if($cuisines != ''){
			$cuisines_name = get_the_terms($rid, 'cuisine' )[0]->name;
		}else{
			$cuisines_name=' ';
		}

		//  4) Start a variable to hold all of the data for each post 

		$a = [
	          'id' => $rid,
	          "location_id" => $rid,
	          'slug' => $slug,
	          "url" => (string)$website,
	          "title" => $title,
	          'street' => $address,
	          'city' => $city_address,
	          'state' => $state,
	          'zip' => $zip,
	          'coordinates' => $coordinates,
	          'bounds' => $coordinates_long,
	          'latitude' => (int)$coordinates[0],
	          'longitude' => (int)$coordinates[1],
	          "phone" => $phone,
	          "website" => $website,
	        ];

	        //  5) Push that data to an array
	        array_push($arr, $a);

	 ?>


	 	<div class="map-listing queried is_rounded" id="<?php echo $slug; ?>">
			<div class="map-listing-content left_rounded">
				<span class="city"><?php echo $city_address; ?></span>
				<h2 class="post-title">
					<?php the_title(); ?> 
				</h2>
				<div class="loc-tags">
					<?php echo $hoods_name; ?>
					<?php //foreach($hoods as $hood){ 
						 //echo $hood->name; 
					 //} ?>
				</div>
				<div class="loc-tags">
					<?php echo $cuisines_name; ?>
					<?php //foreach($cusines as $cusine){ 
						 //echo $cusine->name; 
					 //} ?>
				</div>
				<ul class="loc-amenities">
					<?php 
						if($amenity != ''){
						foreach($amenity as $icon){
							$icon_id = $icon->term_id;
							$icon_name = $icon->name;
							$icon_img = get_term_meta($icon_id, 'meta-image', true );
						?>
						<li>
							<span class="sr-only"><?php echo $icon_name; ?></span><?php echo file_get_contents($icon_img); ?>
						</li>
					<?php } } ?>
					<!-- <li>highchairs</li>
					<li>Changing Tables</li> -->
				</ul>
			</div>
			<div class="listing-image right_rounded" style="background-image:url('<?php echo $post_image_URL; ?>">
				<span class="sr-only"><?php echo $post_image_alt; ?></span>
			</div>
			<div class="border" aria-hidden="true"></div>
		</div>
	<?php 
			// 6) Pretty up that data so that we can pull that info into javascript
			//    To do that we're going to use json_encode to generate a json object
			//    Note WHERE we are doing this.  It is important to encode this data 
			//    just after the last loop has run.
			$a_json = json_encode($arr, JSON_PRETTY_PRINT);
	        
			} //end while

	    } //end if

	     wp_reset_query(); 

	?>
	<script>var _data = <?php echo $a_json; ?></script>