<?php get_header(); ?>

<main id="content">
	<div class="container">
		<div class="row">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<div class="post columns-9">
			<h1>
				<?php the_title(); ?>
			</h1>
			<!-- <p class="postinfo">By <?php the_author(); ?> | Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?></p> -->
			
			<?php the_content(); ?>
		</div>

		<div class="columns-3">
			<h1>Extra Stuff</h1>
		</div>
		
		<?php //comments_template( '', true ); ?>
		
	<?php endwhile; ?>
		</div>
	</div>
</main><!-- End of Content -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>