<?php get_header(); ?>

<?php 
	$latitude = get_field('latitude');
	$longitude = get_field('longitude');
?>
<script>
	$_lat= <?php echo $latitude; ?>;
	$_long = <?php echo $longitude; ?>;
</script>

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
			<div class="restaurant-info">
				<div id="single-map" style="height:200px;"></div>
					
				<?php $h_oop = get_field('hours_of_operation');
				?>
				<div class="hours">
					<?php echo $h_oop; ?>
				</div>
			</div>
		</div>
		
		<?php //comments_template( '', true ); ?>
		
	<?php endwhile; ?>
		</div>
	</div>
</main><!-- End of Content -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>