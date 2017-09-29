<?php 
/* Template Name: Landing Template*/

get_header(); ?>

<main id="content">

	<div class=""><!-- container -->
		<div class="row">
			<!-- <div class="columns-9"> -->
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php //the_title(); ?></h1>

					<?php //the_content(); ?>

				<?php endwhile; ?>
				<?php 
					$bg = get_field('banner_background_image');
					$bg_URL = $bg['sizes']['short-banner'];
					$b_subtitle = get_field('banner_subtitle');
					$cta_text = get_field('cta_text');
					$cta_link = get_field('cta_link');
					
					$cb_external = get_field('cb_external');
					$cta_target='';
					if($cb_external == true){
						$cta_target='target="_blank"';
					}
				?>
				<div class="banner" style="background-image:url('<?php echo $bg_URL; ?>');">
					<a class="cta-bubble"href="<?php echo $cta_link; ?>" <?php echo $cta_link; ?>>
						<div class="bubble">
							<?php echo $cta_text; ?>
						</div>
					</a>
					<div class="wrap">
						<div class="content">
							<p class="banner-subtitle">
								<?php echo $b_subtitle; ?>
							</p>
							<div class="gateway">
								<?php get_template_part('/partials/searchform'); ?>
								for
							</div>
						</div>
					</div>
				</div>
				<div class="container"> <!-- start container -->
					<div class="amenities">
						<div class="row">
							<ul>
								<?php if (have_rows('amenities')):
								//var_dump(get_field('amenities'));
										while(have_rows('amenities')):the_row();
										//var_dump(get_field('amenities'));
										$amenity = get_sub_field('amenity');
										//var_dump($amenity);
										$post_a = $amenity;
										setup_postdata($post_a);
										$term_id = $post_a->term_id;
										$amenity_icon = get_term_meta($term_id, 'meta-image', true );
										//var_dump($amenity);
										// foreach($amenity as $icon)
										//Trying to get property of non-object
										?>
										<li>
											<div class="amenity-icon">
												<img src="<?php echo $amenity_icon; ?>">
											</div>
											<h2 class="sub-title"><?php echo $post_a->slug;?></h2>
										</li>
							<?php wp_reset_postdata(); endwhile; endif; ?>
							</ul>
						</div>
					</div>
				
				<div class="row">
					<?php 
						$featured_post = get_field('featured_post_block');

						//var_dump($featured_post->post_content);
						// override $post
						//$post = $post_object;
						//setup_postdata( $post ); 

						$fa_id = $featured_post->ID;
						$fa_bg = get_field('primary_photo', $fa_id);
						//var_dump($fa_bg);
						$fa_bg_URL = $fa_bg['sizes']['large'];
						//var_dump($fa_id);
					?>
					<div class="columns-8">
						<div class="featured-article is_rounded has_border periwinkle" style="background-image:url('<?php echo $fa_bg_URL; ?>');">
							<div class="content">
								<h2><?php echo $featured_post->post_title; ?></h2>
							</div>
						</div>
					</div>
					<?php wp_reset_postdata(); ?>

					<?php 
						$mbx_bg = get_field('mpx_bg_image');
						$mbx_bg_URL = $mbx_bg['sizes']['large'];
						$mbx_title = get_field('mbx_title');
						$mbx_subtitle = get_field('mbx_subtitle');
						$mbx_link = get_field('mbx_link');
						$mbx_external = get_field('external');
						$mbx_target='';
							if($mbx_external == true){
								$mbx_target='target="_blank"';
							}
					?>
					<div class="columns-4">
						<div class="map-callout" style="background-image:url('<?php echo $mbx_bg_URL; ?>');">
							<h2><?php echo $mbx_title; ?></h2>
							<p><?php echo $mbx_subtitle; ?></p>
						</div>
					</div>
				</div>
 				
 				<?php 
						$nibble_featured = get_field('nibble_featured');
						
						

						if($nibble_featured != ''){ ?>

					<?php 
							if(have_rows('nibble_featured')): ?>

					<div class="nibble-featured row">
					<?php
							while(have_rows('nibble_featured')):the_row();
								$fa_link = get_sub_field('nibble_featured_article');
								$post_nf = $fa_link;
								setup_postdata($post_nf);
								$nf_id = $post_nf->ID;
								$nf_bg=get_field('primary_photo', $nf_id);
								$nf_bg_URL = $nf_bg['sizes']['large'];
								//$post_subtitle = 

								// foreach($nibble_featured as $featured_post){
								// var_dump($featured_post);
					?>

					

						<div class="columns-4 no-padding">
							<div class="featured-article is_rounded">
								<img class="has_border periwinkle" src="<?php echo $nf_bg_URL; ?>" >
								<h2><?php echo $post_nf->post_title; ?></h2>
							</div>
						</div>

					
				<?php  wp_reset_postdata(); endwhile; ?>
					</div>
				<?php endif; } ?>
				<div class="">
					<div>
						Latest Events
					</div>
					<div>s
						Email Signup
					</div>
				</div>
				<?php 
					if (have_rows('restaurant_reviews')):
				?>
				<div class="reviews">
					<?php 
					while (have_rows('restaurant_reviews')):the_row();
						$rr_link = get_sub_field('review');
						$post_rr = $rr_link;
						setup_postdata($post_rr);
						$rr_id = $post_rr->ID;
						$rr_bg=get_field('primary_photo', $rr_id);
						$rr_bg_URL = $rr_bg['sizes']['large'];
						$rr_title = $post_rr->post_title;
					?>

					<div class="columns-2">
						<div class="restaurant-review has_border">
							<img src="<?php echo $rr_bg_URL; ?>">
							<h2><?php echo $rr_title; ?></h2>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			</div>

			<!-- <div class="columns-3"> -->

				<!-- Change this to repeater of custom fields -->

				<?php //get_sidebar(); ?>
			<!-- </div> -->
		</div> <!-- end container -->
		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
