<?php get_header(); ?>

<main id="content" class="inner-content fourohfour_php">
	<div class="container">
		<div class="row">
			<div id="content">
				
				<h1 class="notfound-title">Page Not Found</h1>
				<p>Nothing matched your search criteria. Please try again with some different keywords.</p>

				<div class="notfound-search">
						<?php get_template_part('partials/searchform') ?>
				</div>

			</div><!-- End of Content -->
		</div>
	</div>
</main>
<?php get_footer(); ?>