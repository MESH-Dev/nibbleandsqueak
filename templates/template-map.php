<?php 
/* Template Name: Map Template*/

get_header(); ?>

<main class="map-page" id="content">
		<div class="row">
			<div class="columns-4 locations">
				<div class="">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>

				<?php endwhile; ?>
				<?php $city_name = get_field('city_tax'); 
						$city = $city_name->slug;
						//var_dump($city);
						//var_dump($city_name->name);
						// foreach($city_name as $city){
						// 	var_dump($city->name);
						// }


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
							$rid = $post->ID;
							$post_image = get_field('primary_photo', $post->ID);
							$post_image_URL = $post_image['sizes']['large'];
							$amenity = get_the_terms($rid, 'amenity' );
							$hoods = get_the_terms($rid, 'neighborhood' );
							$hoods_name = get_the_terms($rid, 'neighborhood' )[0]->name;

							$hood = '';

							// if($hoods != ''){
							// 	$hood = $hood.
							// }
							$cusines = get_the_terms($rid, 'cuisine' );
							$cusines_name = get_the_terms($rid, 'cuisine' )[0]->name;
							//var_dump($hoods);
						 ?>
						 	<div class="map-listing queried">
								<div class="map-listing-content left_rounded">
									<span class="city">New York</span>
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
										<?php echo $cusines_name; ?>
										<?php //foreach($cusines as $cusine){ 
											 //echo $cusine->name; 
										 //} ?>
									</div>
									<ul class="loc-amenities">
										<?php foreach($amenity as $icon){
												$icon_id = $icon->term_id;
												$icon_img = get_term_meta($icon_id, 'meta-image', true );
											?>
											<li style="width:25px; list-style-type:none; float:left; display:inline-block; margin-right:1em;">
												<?php echo file_get_contents($icon_img); ?>
											</li>
										<?php } ?>
										<!-- <li>highchairs</li>
										<li>Changing Tables</li> -->
									</ul>
								</div>
								<div class="listing-image right_rounded" style="background-image:url('<?php echo $post_image_URL; ?>"></div>
							</div>
						<?php } } wp_reset_postdata(); ?>

			</div>

			<!-- <div class="columns-6"> -->
				<!-- <div id="map"> -->

				<!-- Change this to repeater of custom fields -->

				<?php //get_sidebar(); ?>
				<!-- </div> -->
			<!-- </div> -->

		</div>
	</div>
	<div id="map"></div>
</main><!-- End of Content -->

<?php get_footer(); ?>
