<?php get_header(); ?>

<main id="content" class="inner-content index_php">

	<div class="container">
 
			<div class="row">

				<?php if ( have_posts() ) : ?>
					<h1>
						<?php //if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
						<?php //elseif ( is_month() ) : ?>
							<?php //printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
						<?php //elseif ( is_year() ) : ?>
							<?php //printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
						<?php// else : ?>
							<?php //_e( 'Blog Archives' ); ?>
						<?php //endif; ?>
						All results for <span><?php echo get_search_query(); ?></span> in <span><?php echo $_COOKIE['cityName'];?></span>
					</h1>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
							$city_name = get_terms('city', $post->ID); 
							// if($city_name != ''){
							// 	$city = $city_name->slug;
							// 	$city_label = $city_name->name;
							// }
							//$cities = get_the_terms('city');
							// $city_label='';
							// foreach ($cities as $city_tax){
							// 	$city_label = 
							// }
							$city_label = get_the_terms($post->ID, 'city')[0]->name;
							$amenity = get_the_terms($post->ID, 'amenity' );
							$photo = get_field('primary_photo', $post->ID);
							$photo_alt = $photo['alt'];
							if($photo != ''){
								$photo_URL = $photo['sizes']['large'];
							}else{
								$photo_URL = get_template_directory_uri().'/img/NS_img_placeholder.png';
							}	

						?>
						<a href="<?php the_permalink($post->id)?>">
							<div class="columns-4">
								<div class="search-article is_rounded" style="margin-bottom:2em;">	
									<div class="border-wrap is_rounded" style="background-image:url('<?php echo $photo_URL; ?>');">
										<span class="sr-only"><?php echo $photo_alt; ?></span>
										<div class="border" aria-hidden="true"></div>
									</div>
									<?php if($city_label != ''){?>
										<span class="city"><?php echo $city_label; ?></span>
									<?php } ?>
									<h2 class="post-title"><?php the_title(); ?></h2>
									<ul class="loc-amenities">
										<?php 
										// Start a variable to count the $amenities attached to the post
										$a_cnt = 0;
											if($amenity != ''){
											foreach($amenity as $icon){
												// Increment our $amenity count
												$a_cnt++; 
												$icon_id = $icon->term_id;
												$icon_name = $icon->name;
												$icon_slug = $icon->name;
												$icon_img = get_term_meta($icon_id, 'meta-image', true );
												//  We only want two amenity items, so only print them out if 
												//  the number is less than 2
												if($a_cnt <= 2){
											?>
											<li>
												<a href="<?php echo esc_url( home_url( '/' ) ); ?>amenity/<?php echo $icon_slug; ?>?city=<?php echo $_COOKIE['city'];?>">
													<span class="sr-only"><?php echo $icon_name ?></span><?php echo file_get_contents($icon_img); ?>
												</a>
											</li>
										<?php } } } ?>
									</ul>
								</div>
							</div>
						</a>

					<?php endwhile; ?>

				<?php endif; ?>

			</div>
 		<?php get_template_part('partials/separator'); ?>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>

