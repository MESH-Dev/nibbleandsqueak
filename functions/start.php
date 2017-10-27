<?php

//Use this file for wp menus, sidebars, image sizes, loadup scripts.



//enqueue scripts and styles *use production assets. Dev assets are located in  /css and /js
function loadup_scripts() {
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'autocomplete-js', get_template_directory_uri().'/js/jquery.auto-complete.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'geolocation-js', get_template_directory_uri().'/js/jquery.matchHeight.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'sidr-js', get_template_directory_uri().'/js/jquery.sidr.min.js', array('jquery'), '1.0.0', true );
    if(is_page_template("templates/template-map.php")){
        wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCbX_dvIvIBOUlSTYKA5lYPUHUkBAN-lb4', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'cluster', '//developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'map-js', get_template_directory_uri().'/js/map.js', array('jquery'), '1.0.0', true );
        //wp_enqueue_script( 'main-js', get_template_directory_uri().'/js/main.js', array('jquery'), '1.0.0', true );
   }
   if(is_singular('restaurant')){
        wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCbX_dvIvIBOUlSTYKA5lYPUHUkBAN-lb4', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'singlemap-js', get_template_directory_uri().'/js/single-map.js', array('jquery'), '1.0.0', true );
   }
   wp_enqueue_style( 'fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', true );
   wp_enqueue_style( 'autocomplete-style', get_template_directory_uri().'/css/jquery.auto-complete.css', true );
   wp_enqueue_style( 'sidr-style', get_template_directory_uri().'/css/jquery.sidr.bare.css', true );
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('background-fullscreen', 1800, 1200, true);
add_image_size('short-banner', 1800, 800, true);

add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('square', 500, 500, true); //square images
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');



//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Header and breadcrumb trail heirarchy',
        'social_nav' => 'Social menu used throughout',
        //footer navs
        'events_nav' => 'Events Footer Menu',
        'about_nav' => 'About Us Footer Menu',
        'involved_nav' => 'Get Involved Footer Menu',
        'terms_nav' => 'Terms &amp; Policies Footer Menu',
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );


if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}

function get_split_nav($menu_name=null, $raw=false){
//Get our menu object
$menu_name = 'events_nav';

     //Check to see if our menu object exists and is set
     if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
          $menu = wp_get_nav_menu_object($locations[$menu_name]);
          //$count = count($menu);
          //var_dump($count);
          $menu_items = wp_get_nav_menu_items($menu->term_id);

          //Create a new array with just the top level objects
          $newMenu = array();
          //$cnt=0;
          foreach($menu_items as $item){
               if($item->menu_item_parent != 0) continue;
               //$cnt++;
               array_push($newMenu, $item);
          }

          //Split menu array in half
          $len = count($newMenu);
          
          if($len > 8){
              $firsthalf = array_slice($newMenu, 0, $len / 2);
              $secondhalf = array_slice($newMenu, $len / 2);

              //Create left menu
              echo '<div id="eventMenuLeft"><ul>';
              foreach($firsthalf as $item){
                   echo "<li><a href='".$item->url."'>".$item->title."</a></li>";
              }
              echo '</ul></div>'; ?>


              <?php //Create right menu
              echo '<div id="eventMenuRight"><ul>';
              foreach($secondhalf as $item){
                   echo "<li><a href='".$item->url."'>".$item->title."</a></li>";
              }
              echo '</ul></div>';
          }
    }
}


?>
