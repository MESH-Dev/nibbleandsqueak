<?php 
/* Template Name: Journal Archive Template*/
get_header(); ?>

<main id="content" class="inner-content archive_php">
	<?php ///$slug = $_GET['amenity'];  echo $slug; 
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		//Get the amenity term for this archive
		$amenity = get_query_var( 'amenity' );
		$amenity_term = get_term_by('slug', $amenity, 'amenity');
		$amenity_name = $amenity_term->name;
		//var_dump($amenity_term);
	?>
	<div class="container">
 
			<div class="row"><!-- class="columns-9" -->

				<?php 
					global $query_string;
					query_posts( $query_string . '&posts_per_page=-1' );

				if ( have_posts() ) : ?>
					<h1 class="search-title">
						<?php //if ( is_day() ) : ?>
							<?php //printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
						<?php //elseif ( is_month() ) : ?>
							<?php //printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
						<?php //elseif ( is_year() ) : ?>
							<?php //printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
						<?php //else : ?>
							<?php //_e( 'Blog Archives' ); ?>
						<?php //endif; ?>
						All results for <span><?php echo $amenity_name; ?><?php if ($city != ''){?></span> in <span><?php $city; ?><?php }?></span>
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
						
							<div class="columns-4 eq block">
								<a href="<?php the_permalink($post->id)?>">
								<div class="search-article is_rounded" style="margin-bottom:2em;">	
									<div class="border-wrap is_rounded" style="background-image:url('<?php echo $photo_URL; ?>');">
										<span class="sr-only"><?php echo $photo_alt; ?></span>
										<div class="border" aria-hidden="true"></div>
									</div>
									<?php 

									$columnsClass = '';
									if($amenity != ''){
										$columnsClass = "class='columns-8'";
									}
									?>
									<div <?php echo $columnsClass; ?>>
									<?php if($city_label != ''){?>
										<span class="city"><?php echo $city_label; ?></span>
									<?php } ?>
									<h2 class="post-title"><?php the_title(); ?></h2>
									</div>
									<?php if($amenity != ''){?>
									<div class="columns-4">
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
													$icon_slug = $icon->slug;
													$icon_img = get_term_meta($icon_id, 'meta-image', true );
													//  We only want two amenity items, so only print them out if 
													//  the number is less than 2
													if($a_cnt <= 2){
												?>
												<li>
													<!-- <a href="<?php echo esc_url( home_url( '/' ) ); ?>amenity/<?php echo $icon_slug; ?>?city=<?php echo $_COOKIE['city'];?>"> -->
														<span class="sr-only"><?php echo $icon_name ?></span><?php echo file_get_contents($icon_img); ?>
													<!-- </a> -->
												</li>
										
										<?php } } } ?>
									</ul>
								</div>
								<?php } ?>
								</div> <!-- end search-article -->
								</a>
							</div><!-- end .eq.block -->
						

					<?php endwhile; ?>
					<?php else : ?>
					<h1>Nothing Found</h1>
					<p>Nothing matched your search criteria. Please try again with some different keywords.</p>

					<div class="notfound-search">
							<?php get_template_part('partials/searchform') ?>
					</div>
				<?php endif; ?>

			</div>
			<?php get_template_part('partials/separator'); ?>
 		
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
