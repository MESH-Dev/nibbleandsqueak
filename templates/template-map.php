<?php 
/* Template Name: Map Template*/

get_header(); ?>

<main class="map-page" id="content">
		<div class="row">
			<div class="locations">
				<!-- <div class=""> -->
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h2><?php the_title(); ?></h2>

					<?php the_content(); ?>

				<?php endwhile; wp_reset_query(); ?>
				<?php 

					//  Get the city from the page.  We'll only get this if this page is 
					//  being used for a particular city.  More about that later.
					// $city_name = get_field('city_tax'); 
					// $city = $city_name->slug;

					// Used for custom curation
					$restaurant_choice = get_field('restaurant_po');
					if ($restaurant_choice != ''){

					get_template_part('partials/curated-map');
						}else{ 
						get_template_part('partials/city-map');
					}?>
				 <!-- </div>  -->       
			</div>
		</div>
	<div id="map"></div>
</main><!-- End of Content -->

<?php get_footer(); ?>
