<?php get_header(); ?>

<?php 
	$latitude = get_field('latitude');
	$longitude = get_field('longitude');
	// $neighborhood = get_the_terms($post->ID, 'neighborhood');
	// var_dump($neighborhood);
	// $neighborhood_name = $neighborhood->name;
	$neighborhood = get_the_terms($post->ID, 'neighborhood');
	if($neighborhood != ''){
		$neighborhood_name = get_the_terms($post->ID, 'neighborhood' )[0]->name;
	}else{
		$neighborhood_name ='';
	}
	// var_dump($neighborhood_name);
	// $cuisine = get_the_terms($post->ID, 'cuisine');
	// $cuisine_name = $cuisine->name;
	$cuisine = get_the_terms($post->ID, 'cuisine');
	if($cuisine != ''){
		$cuisine_name = get_the_terms($post->ID, 'cuisine' )[0]->name;
	}else{
		$cuisine_name = '';
	}
	$cost = get_field('price_point');
	$amenity = get_the_terms($post->ID, 'amenity' );
	$intro = get_field('intro_text')
?>
<script>
	var $_lat = <?php echo $latitude; ?>;
	var $_long = <?php echo $longitude; ?>;
</script>
<!-- <div class="bubble-wrap row">
		<a class="cta-bubble"href="<?php echo $cta_link; ?>" <?php echo $cta_link; ?>>
			<div class="bubble">
				<?php echo $cta_text; ?>
			</div>
		</a>
	</div> -->
<main id="content" class="inner-content">

	<div class="container">
		<div class="row">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<div class="post columns-8">
			<h1>
				<?php //the_title(); ?>
				<?php echo get_the_term_list( $post->ID, 'amenity', '', ', ', '' ) ?>
			</h1>
			<div class="location-info row">
				<span class="info"><?php echo $neighborhood_name;?>, <?php echo $cuisine_name; ?> | <?php echo $cost; ?></span>
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
		</div> <!-- end post.columns-8 -->
		<div class="page-content">
			<div class="columns-8">
				<div class="the-content">
					<div class="page-intro">
						<?php echo $intro; ?>
					</div>
					<?php the_content(); ?>
				</div>
			</div>

			<div class="columns-3 offset-by-1">
				<div class="restaurant-info">
					<div id="single-map"></div>
						
					<?php 
						$h_oop = get_field('hours_of_operation');
						$street = get_field('street_address');
						$city_address = get_field('city_address');
						$state_address = get_field('state_address');
						$zip_code = get_field('zip_code');
						$open_table = get_field('opentable_link');
						$menu = get_field('menu_link');
						$menu_mobile = get_field('mobile_menu_link');
						$gmd_link = get_field('gmd_link');
						//Get this to .com
						$website = get_field('location_website');
						$site_parse = parse_url($website);
						$domain = preg_replace('/^www\./', '', $site_parse['host']);
						$phone = get_field('phone');
						$facebook = get_field('location_facebook_link');
						$twitter = get_field('location_twitter');
					?>
					<div class="restaurant-data">
						<div class="loc-address">
							<?php echo $street; ?></br>
							<?php echo $city_address; ?>, <?php echo $state_address; ?>  <?php echo $zip_code; ?>
						</div>
						<div class="hours">
							Open:</br>
							<?php echo $h_oop; ?>
						</div>
						<?php if ($phone != ''){ ?>
							<div class="phone">
								<i class="fa fa-fw fa-mobile-phone"><span class="sr-only">Phone:</span></i>
								<span class="desktop"><?php echo $phone; ?></span>
								<span class="mobile"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></span>
							</div>
						<?php } ?>
						
						<?php if ($facebook != ''){ ?>
						<div class="facebook">
							<i class="fa fa-fw fa-facebook"><span class="sr-only">Facebook:</span></i><a href="https://facebook.com/<?php echo $facebook; ?>" target="_blank">On Facebook</a>
						</div>
						<?php } ?>
						<?php if ($twitter != ''){ ?>
							<div class="twitter">
								<i class="fa fa-fw fa-twitter"><span class="sr-only">Twitter:</span></i><a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank">@<?php echo $twitter; ?></a>
							</div>
						<?php } ?>
						<?php if ($website != ''){ ?>
							<div class="website">
								<i class="fa fa-fw fa-globe"><span class="sr-only">Website:</span></i><a href="<?php echo $website; ?>" target="_blank"><?php echo $domain; ?></a>
							</div>
						<?php } ?>
					</div>
					<?php if ($open_table != ""){ ?>
						<div class="loc-button open-table">
							<a href="<?php echo $open_table; ?>" target="_blank"><?php echo file_get_contents(get_template_directory().'/img/findtable.svg')?> Find a table</a>
						</div>
					<?php } ?>
					<?php if($menu != '' || $menu_mobile != ''){ ?>
					<div class="loc-button menu">
						<?php if( $menu != ''){ ?>
							<span class="desktop">
								<a href="<?php echo $menu; ?>" target="_blank"><?php echo file_get_contents(get_template_directory().'/img/viewmenu.svg')?> View the menu</a>
							</span>
						<?php } ?>
						<?php if( $menu != ''){ ?>
							<span class="mobile">
								<a href="<?php echo $menu_mobile; ?>" target="_blank"><?php echo file_get_contents(get_template_directory().'/img/viewmenu.svg')?> View the menu</a>
							</span>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="loc-button directions">
						<a href="<?echo $gmd_link; ?>" target="_blank"><?php echo file_get_contents(get_template_directory().'/img/findtable.svg')?> Get Directions</a>
					</div>
					
				</div>
				</div>
			</div> <!-- end columns-3 -->
		</div> <!-- end page-content -->
		<?php //comments_template( '', true ); ?>
		
	<?php endwhile; ?>
		</div>
	</div>
</main><!-- End of Content -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>