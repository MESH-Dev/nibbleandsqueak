<?php 

//Add Custom Post Types and Custom Taxonomies
// Register Custom Post Type
function restaurant_CPT() {

	$labels = array(
		'name'                  => _x( 'Restaurants', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Restaurant', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Restaurants', 'text_domain' ),
		'name_admin_bar'        => __( 'Restaurants', 'text_domain' ),
		'archives'              => __( 'Restaurant Archives', 'text_domain' ),
		'attributes'            => __( 'Restaurant Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Restaurant :', 'text_domain' ),
		'all_items'             => __( 'All Restaurants', 'text_domain' ),
		'add_new_item'          => __( 'Add New Restaurant', 'text_domain' ),
		'add_new'               => __( 'Add New Restaurant', 'text_domain' ),
		'new_item'              => __( 'New Restaurant', 'text_domain' ),
		'edit_item'             => __( 'Edit Restaurant', 'text_domain' ),
		'update_item'           => __( 'Update Restaurant', 'text_domain' ),
		'view_item'             => __( 'View Restaurant', 'text_domain' ),
		'view_items'            => __( 'View Restaurants', 'text_domain' ),
		'search_items'          => __( 'Search Restaurants', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Restaurant', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Restaurant', 'text_domain' ),
		'items_list'            => __( 'Restaurants list', 'text_domain' ),
		'items_list_navigation' => __( 'Restaurants list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Restaurants list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Restaurant', 'text_domain' ),
		'description'           => __( 'CPT for Restaurants', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', ),
		'taxonoimies'			=> array('category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'restaurant', $args );

}
add_action( 'init', 'restaurant_CPT', 0 );

// Register City Taxonomy
function city_tax() {

	$labels = array(
		'name'                       => _x( 'Cities', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'City', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'City', 'text_domain' ),
		'all_items'                  => __( 'All Cities', 'text_domain' ),
		'parent_item'                => __( 'Parent City', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent City:', 'text_domain' ),
		'new_item_name'              => __( 'New City Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New City', 'text_domain' ),
		'edit_item'                  => __( 'Edit City', 'text_domain' ),
		'update_item'                => __( 'Update City', 'text_domain' ),
		'view_item'                  => __( 'View City', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Cities', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Cities', 'text_domain' ),
		'search_items'               => __( 'Search Cities', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Cities', 'text_domain' ),
		'items_list'                 => __( 'Citiess list', 'text_domain' ),
		'items_list_navigation'      => __( 'Cities list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'city', array( 'restaurant', 'post' ), $args );

}
add_action( 'init', 'city_tax', 0 );

// Register Amenities Taxonomy
function amenity_tax() {

	$labels = array(
		'name'                       => _x( 'Amenities', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Amenity', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Amenity', 'text_domain' ),
		'all_items'                  => __( 'All Amenities', 'text_domain' ),
		'parent_item'                => __( 'Parent Amenity', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Amenity:', 'text_domain' ),
		'new_item_name'              => __( 'New Amenity Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Amenity', 'text_domain' ),
		'edit_item'                  => __( 'Edit Amenity', 'text_domain' ),
		'update_item'                => __( 'Update Amenity', 'text_domain' ),
		'view_item'                  => __( 'View Amenity', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Amenities', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Amenities', 'text_domain' ),
		'search_items'               => __( 'Search Amenities', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Amenities', 'text_domain' ),
		'items_list'                 => __( 'Amenitiess list', 'text_domain' ),
		'items_list_navigation'      => __( 'Amenities list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'amenity', array( 'restaurant' ), $args );

}
add_action( 'init', 'amenity_tax', 0 );

// Register Cuisine Taxonomy
function cuisine_tax() {

	$labels = array(
		'name'                       => _x( 'Cuisines', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Cuisine', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Cuisine', 'text_domain' ),
		'all_items'                  => __( 'All Cuisines', 'text_domain' ),
		'parent_item'                => __( 'Parent Cuisine', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Cuisine:', 'text_domain' ),
		'new_item_name'              => __( 'New Cuisine Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Cuisine', 'text_domain' ),
		'edit_item'                  => __( 'Edit Cuisine', 'text_domain' ),
		'update_item'                => __( 'Update Cuisine', 'text_domain' ),
		'view_item'                  => __( 'View Cuisine', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Cuisines', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Cuisines', 'text_domain' ),
		'search_items'               => __( 'Search Cuisines', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Cuisines', 'text_domain' ),
		'items_list'                 => __( 'Cuisiness list', 'text_domain' ),
		'items_list_navigation'      => __( 'Cuisines list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'cuisine', array( 'restaurant', 'post' ), $args );

}
add_action( 'init', 'cuisine_tax', 0 );

// Register Cuisine Taxonomy
function neighborhood_tax() {

	$labels = array(
		'name'                       => _x( 'Neighborhoods', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Neighborhood', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Neighborhood', 'text_domain' ),
		'all_items'                  => __( 'All Neighborhoods', 'text_domain' ),
		'parent_item'                => __( 'Parent Neighborhood', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Neighborhood:', 'text_domain' ),
		'new_item_name'              => __( 'New Neighborhood Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Neighborhood', 'text_domain' ),
		'edit_item'                  => __( 'Edit Neighborhood', 'text_domain' ),
		'update_item'                => __( 'Update Neighborhood', 'text_domain' ),
		'view_item'                  => __( 'View Neighborhood', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Neighborhoods', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Neighborhoods', 'text_domain' ),
		'search_items'               => __( 'Search Neighborhoods', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Neighborhoods', 'text_domain' ),
		'items_list'                 => __( 'Neighborhoodss list', 'text_domain' ),
		'items_list_navigation'      => __( 'Neighborhoods list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'neighborhood', array( 'restaurant' ), $args );

}
add_action( 'init', 'neighborhood_tax', 0 );


//Add Custom Meta field to Amenity Taxonomies
add_action('init', 'amenity_register_meta');
        function amenity_register_meta(){
            //register_meta('term', 'icon','' );
            register_meta('term', 'meta-image', '');
        }

add_action( 'amenity_add_form_fields', 'amenity_new_term_field' ); 
//add_action( 'amenity_add_form_fields', array ( $this, 'add_category_image' ), 10, 2  ); 
        function amenity_new_term_field() { 
            wp_nonce_field( basename( __FILE__ ), 'amenity_term_nonce' ); ?> 
            <div class="form-field amenity-term-wrap"> 
            	<!-- <label for="amenity-term">
                <?php _e( 'Icon', 'amenity' ); ?></label> 
                <input type="text" name="amenity_term" id="amenity-term" value="" class="amenity-field" />  -->
               
               <!--  //This can be removed if media uploads not working/not needed -->
               <div class="row">
	               <p>
					    <label for="meta-image" class="prfx-row-title"><?php _e( 'Amenity Icon')?></label>
					    <input type="text" name="meta-image" id="meta-image" value="<?php if ( isset ( $old_media['meta-image'] ) ) echo $old_media['meta-image'][0]; ?>" />
					    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Add Media', 'prfx-textdomain' )?>" />
					</p>
				</div>
				<!-- ++++++++++++++++++++++ -->
			</div> 
                <?php }

        //Remove this function if we don't/can't get this working

        /**
		 * Loads the image management javascript
		 */
        
		function amenity_image_enqueue() {
		    //global $typenow;
		    //if( $typenow == 'post' ) {
		        wp_enqueue_media();
		 
		        // Registers and enqueues the required javascript.
		        wp_register_script( 'meta-box-image', get_template_directory_uri().'/js/media-upload.js', array( 'jquery' ) );
		        wp_localize_script( 'meta-box-image', 'meta_image',
		            array(
		                'title' => __( 'Add Media' ),
		                'button' => __( 'Use this image' ),
		            )
		        );
		        wp_enqueue_script( 'meta-box-image' );
		    //}
		}
		add_action( 'admin_enqueue_scripts', 'amenity_image_enqueue' );

		//-----------------------------------------------------

 		add_action( 'amenity_edit_form_fields', 'amenity_edit_term_field' );

            function amenity_edit_term_field( $term ) {

                //$default = '#ffffff';
                //$location_term = location_get_term( $term->term_id, true );

                //$icon = get_term_meta( $term->term_id, 'icon', true );
                $image = get_term_meta( $term->term_id, 'meta-image', true );
                

               //if ( ! $location_term )
                    //$color = $default; ?>

               <!--  <tr class="form-field amenity-term-wrap">
                    <th scope="row"><label for="amenity-term"><?php _e( 'Icon', 'amenity' ); ?></label></th>
                    <td>
                        <?php wp_nonce_field( basename( __FILE__ ), 'amenity_term_nonce' ); ?>
                        <input type="text" name="amenity_term_icon" id="amenity-term-icon" value="<?php echo esc_attr( $icon ); ?>" class="location-field" />
                    </td>
                </tr> -->
             	<tr class="form-field amenity-term-wrap">
                    <th scope="row"><label for="amenity-term"><?php _e( 'Image', 'amenity' ); ?></label></th>
                    <td>
                        <?php wp_nonce_field( basename( __FILE__ ), 'amenity_term_nonce' ); ?>
                        <div id="category-image-wrapper">
				         <?php //if ( $image ) { ?>
				          	<?php echo wp_get_attachment_image ( $image, 'thumbnail' ); ?>
				         <?php //} ?>
				       </div>
						<input type="text" name="meta-image" id="meta-image" value="<?php echo esc_attr( $image ); ?>" />
						<input type="button" id="meta-image-button" class="button" value="<?php _e( 'Add Media' )?>" />
						
					</td>
					
                </tr>
                <?php }

    	add_action( 'edit_amenity',   'amenity_save_term_icon' );
        add_action( 'create_amenity', 'amenity_save_term_icon' );

        function amenity_save_term_icon($term_id) {

            if ( ! isset( $_POST['amenity_term_nonce'] ) || ! wp_verify_nonce( $_POST['amenity_term_nonce'], basename( __FILE__ ) ) )
                return;

            //$old_term = get_term_meta( $term_id, 'icon', true );
            $old_media = get_term_meta($term_id, 'meta-image', true);
            //$new_term = $_POST['amenity_term_icon'];
            $new_media = $_POST['meta-image'];

            // if ( $old_term && '' === $new_term )
            //     delete_term_meta( $term_id, 'icon' );

            // else if ( $old_term !== $new_term )
            //     update_term_meta( $term_id, 'icon', $new_term );

            if ( $old_media && '' === $new_media )
                delete_term_meta( $term_id, 'meta-image' );

            else if ( $old_media !== $new_media )
                update_term_meta( $term_id, 'meta-image', $new_media );

        }

    add_action('init', 'city_register_meta');
        function city_register_meta(){
            register_meta('term', 'latitude','' );
            register_meta('term', 'longitude', '');
        }

	add_action( 'city_add_form_fields', 'city_new_term_field' ); 
        function city_new_term_field() { 
            wp_nonce_field( basename( __FILE__ ), 'latitude_term_nonce' ); 
            wp_nonce_field( basename( __FILE__ ), 'longitude_term_nonce' );
            ?> 
            <div class="form-field latitude-term-wrap"> 
            	<label for="city-term-latitude"><?php _e( 'Latitude', 'city' ); ?></label> 
                <input type="text" name="city_term_latitude" id="city-term-latitude" value="" class="latitude-term-field" />
            </div>
             <div class="form-field longitude-term-wrap"> 
                <label for="city-term-longitude"><?php _e( 'Longitude', 'city' ); ?></label> 
                <input type="text" name="city_term_longitude" id="city-term-longitude" value="" class="longitude-term-field" /> 
            </div>  
                <?php }

 add_action( 'city_edit_form_fields', 'city_edit_term_field' );

            function city_edit_term_field( $term ) {

                //$default = '#ffffff';
                //$location_term = location_get_term( $term->term_id, true );

                //$color = get_term_meta( $term->term_id, 'color', true );
                $latitude = get_term_meta( $term->term_id, 'latitude', true );
                //var_dump($latitude);
                $longitude = get_term_meta( $term->term_id, 'longitude', true );
                //var_dump($longitude);

               //if ( ! $location_term )
                    //$color = $default; ?>

                <tr class="form-field city-term-wrap">
                    <th scope="row"><label for="city-term-latitude"><?php _e( 'Latitude', 'city' ); ?></label></th>
                    <td>
                        <?php wp_nonce_field( basename( __FILE__ ), 'latitude_term_nonce' ); ?>
                        <input type="text" name="city_term_latitude" id="city-term-latitude" value="<?php echo esc_attr( $latitude ); ?>" class="latitude-field" />
                    </td>
                </tr>
                <tr class="form-field city-term-wrap">
                    <th scope="row"><label for="city-term-longitude"><?php _e( 'Longitude', 'city' ); ?></label></th>
                    <td>
                        <?php wp_nonce_field( basename( __FILE__ ), 'longitude_term_nonce' ); ?>
                        <input type="text" name="city_term_longitude" id="city-term-longitude" value="<?php echo esc_attr( $longitude ); ?>" class="longitude-field" />
                    </td>
                </tr>
                <?php }

    	add_action( 'edit_city',   'city_save_term' );
        add_action( 'create_city', 'city_save_term' );

        function city_save_term($term_id) {

            if ( ! isset( $_POST['latitude_term_nonce'] ) || ! wp_verify_nonce( $_POST['latitude_term_nonce'], basename( __FILE__ ) ) || ! isset( $_POST['longitude_term_nonce'] ) || ! wp_verify_nonce( $_POST['longitude_term_nonce'], basename( __FILE__ ) ))
                return;

            $old_latitude = get_term_meta( $term_id, 'latitude', true );
            $new_latitude = $_POST['city_term_latitude'];
            //var_dump($new_latitude);
            $old_longitude = get_term_meta( $term_id, 'longitude', true );
            $new_longitude = $_POST['city_term_longitude'];
            //var_dump($new_longitude);

            if ( $old_latitude && '' === $new_latitude )
                delete_term_meta( $term_id, 'latitude' );

            else if ( $old_latitude !== $new_latitude )
                update_term_meta( $term_id, 'latitude', $new_latitude );

            if ( $old_longitude && '' === $new_longitude )
                delete_term_meta( $term_id, 'longitude' );

            else if ( $old_longitude !== $new_longitude )
                update_term_meta( $term_id, 'longitude', $new_longitude );

            // if ( $old_term && '' === $new_term )
            //     delete_term_meta( $term_id, 'address' );

            // else if ( $old_term !== $new_term )
            //     update_term_meta( $term_id, 'address', $new_term );
        }

?>