<?php get_header(); ?>

<main id="content" class="inner-content">

	<div class="container">
		<div class="row">
			<!-- <div class="columns-9"> -->
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>

					<?php endwhile; ?>

					<?php if(have_rows('page_column')):
						//  The 2-column row will not be a 50-50 row, so we're going to start a counter
						//  to give us something we can use to pick from an array of column classes
						$col_cnt = 0;
						while(have_rows('page_column')):the_row();
						// Count the number of page_column rows so that we know what classes to use
						$count = count(get_field('page_column'));
						// Increment our count so that we can use this value to step through our array for 2-column entries
						// **Note that we are subtracting 1 from this value to obtain the correct location in the array
						//   we could do this a little differently, but this works just as well.
						$col_cnt++;
							$intro = get_sub_field('text_callout');
							$content = get_sub_field('content_text');

							if($count == 2){
								//  Set up an array of the two classes we want to use here, then we can just cycle through
								//  as the loop runs
								$columns_class = ['columns-4', 'columns-8'];
								// Pick our array location based on the column count "-1", see above for the logic
								$columns = $columns_class[$col_cnt-1];
							}elseif($count == 3){
								$columns = 'columns-4';
							}else{
								$columns = '';
							}

						?>
						<div class="page-wrap <?php echo $columns; ?>">
							<div class="page-intro"><?php echo $intro; ?></div>
							<div class="the-content"><?php echo $content; ?></div>
						</div>

					<?php endwhile; endif; ?>
			</div>
			<div class="row">
				<?php get_template_part('partials/separator'); ?>
			</div>

			<?php 
						$related_articles = get_field('related_articles');

						if($related_articles != ''){ ?>

					<?php 
							if(have_rows('related_articles')): ?>

					<div class="related-articles row fix_pad">
					<?php
							while(have_rows('related_articles')):the_row();
								$ra_link = get_sub_field('related_article');
								$post_ra = $ra_link;
								setup_postdata($post_ra);
								$ra_id = $post_ra->ID;
								$ra_bg=get_field('primary_photo', $ra_id);
								if($ra_bg != ''){
									$ra_bg_URL = $ra_bg['sizes']['large'];
								}else{
									$ra_bg_URL = get_template_directory_uri().'/img/NS_img_placeholder.png';
								}
								//$ra_subtitle = get_sub_field('nf_lead_text');
								$ra_city = get_the_terms($ra_id, 'city');
								//$post_subtitle = 

								// foreach($nibble_featured as $featured_post){
								// var_dump($featured_post);
					?>
						<div class="columns-4">
							<div class="featured-article is_rounded">	
								<div class="border-wrap is_rounded">
									<img class="periwinkle" src="<?php echo $ra_bg_URL; ?>" >
									<div class="border" aria-hidden="true"></div>
								</div>
								<?php 
									if($ra_city != ""){
										foreach($ra_city as $ra_term){ ?>
									<span class="city"><?php echo $ra_term->name; ?></span>
								<?php } } ?>
								<h2 class="post-title"><?php echo $post_ra->post_title; ?></h2>
								<!-- <h3 class="post-subtitle"><?php echo $nf_subtitle; ?></h3> -->
							</div>
						</div>

					
				<?php  wp_reset_postdata(); endwhile;?>
					</div> <!-- end row.related-articles -->
				<?php endif; } ?>
		<!-- </div> -->
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
