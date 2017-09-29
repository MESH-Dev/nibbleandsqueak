<?php 
/* Template Name: Map Template*/

get_header(); ?>

<main id="content">

	<div class="">
		<div class="row">
			<div class="columns-6 locations">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>

				<?php endwhile; ?>
			</div>

			<div class="columns-6">
				<!-- <div id="map"> -->

				<!-- Change this to repeater of custom fields -->

				<?php //get_sidebar(); ?>
				<!-- </div> -->
			</div>

		</div>
	</div>
	<div id="map"></div>
</main><!-- End of Content -->

<?php get_footer(); ?>
