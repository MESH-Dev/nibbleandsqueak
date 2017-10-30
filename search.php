<?php get_header(); ?>


<main id="content" class="inner-content search_php">

	<div class="container">
		<div class="row">
			
				<?php if ( have_posts() ) : ?>
					<h1 class="search-title"> 
						All results for <span><?php echo get_search_query(); ?></span> in <span><?php echo $_COOKIE['cityName'];?></span>
					</h1>
					 <?php
					//$the_query = new WP_Query( $args ); 
					if (have_posts());
					while (have_posts() ) : the_post(); ?>
						<?php 
							$city_name = get_terms('city', $post->ID); 
							
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
						</div> <!-- end columns-4 eq block -->
					
					<?php endwhile; ?>

				<?php else : ?>
					<h1>Nothing Found</h1>
					<p>Nothing matched your search criteria. Please try again with some different keywords.</p>

					<div class="notfound-search">
							<?php get_template_part('partials/searchform') ?>
					</div>
				<?php endif; ?>
			
			<!-- </div> -->
		</div><!-- end row -->
		<?php get_template_part('partials/separator'); ?>
	</div> <!-- end container -->

</main><!-- End of Content -->

<?php get_footer(); ?>
