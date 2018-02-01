<?php 
/* Template Name: Landing Template*/

get_header(); ?>

<main id="content">
		<div class="row fix_pad">
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
					<div class="wrap">
						<div class="content">
							<p class="banner-subtitle">
								<?php echo $b_subtitle; ?>
							</p>
							<div class="gateway">
								<?php //get_template_part('/partials/searchform'); ?>
								<div class="gateway-item citysearch">
									<span style="display:inline-block;">Search</span>
									<ul style="display:inline-block;">
										<li>
											<input placeholder="Place" class="city-input">
											<span class="arrow">
												<?php echo file_get_contents(get_template_directory().'/img/arrow.svg')?>
											</span>
										<ul class="sub-menu">

										<div class="city-wrap">
											<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-name="All Cities" data-slug="none">All Cities</a></li>
										<?php 
											//$cities = get_the_terms('city'); 
											//var_dump($cities);
										$cities = get_terms(array('taxonomy'=>'city', 'hide_empty'=>false));
										$c_cnt2=0;
										$city_cnt = count($cities);
										//var_dump($city_cnt);
											foreach($cities as $city){
												//$city_cnt = count($city);
												$c_cnt2++;
												$half_count = $city_cnt/2;
												$half_round = round($half_count);

												if($c_cnt2 == $half_round+1){
													?>
												</div><div class="city-wrap">
												<?php }

												//Give 'no city' a value of "all cities"
												?>


												<li><a href="#" data-name="<?php echo $city->name; ?>" data-slug="<?php echo $city->slug; ?>"><?php echo $city->name; ?></a></li>
											<?php } 
												if($city_cnt - $c_cnt2 == 0){
											?>
											</div>
											<?php } ?>
									</ul></li></ul>
								</div>
								<div class="break">
									for
								</div>
								<div class="gateway-item">
									<form method="get" id="banner-searchform" action="<?php bloginfo('url'); ?>/">
										<div class="form input">
											<label for="searchHeader" class="sr-only">Search the site</label>
											<input id="searchHeader" class="hide" type="text" placeholder="cuisine, restaurant, etc..." value="<?php the_search_query(); ?>" name="s" id="s" />
											<input id="city-banner-search" type="hidden" name="city" type="text" value="" name="s" id="s" />
											<button type="submit" class="form submit search-submit" id="searchsubmit" value="" >
												<span class="sr-only">Submit search</span>
												<?php echo file_get_contents(get_template_directory().'/img/arrow.svg')?>	
											</button>	
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end banner -->
			<div class="container"> <!-- start container -->
					<div class="amenities row">
						<!-- <div class="row"> -->
							<ul>
								<?php 
									$city_tax = get_field('city_tax');
									$city_term = get_term_by('id', $city_tax, 'city');
									//var_dump($city);
									if (have_rows('amenities')):
								//var_dump(get_field('amenities'));
										while(have_rows('amenities')):the_row();
										//var_dump(get_field('amenities'));
										$amenity = get_sub_field('amenity');
										//var_dump($amenity);
										$post_a = $amenity;
										setup_postdata($post_a);
										$term_id = $post_a->term_id;
										$amenity_slug = $post_a->slug;
										//var_dump($amenity_slug);
										$amenity_icon = get_term_meta($term_id, 'meta-image', true );
										//var_dump($amenity);
										// foreach($amenity as $icon)
										//Trying to get property of non-object
										?>
										<li class="eq block">
											<a data-slug="<?php echo $amenity_slug; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>amenity/<?php echo $amenity_slug; ?><?php if(!is_front_page()){ echo '/?'.$city_term->slug; }?>">
												<div class="amenity-icon" data-svg="<?php echo $amenity_icon; ?>">
													<?php 
													//$icon_dir = get_bloginfo('template_directory').'/img/icons/highchairs.svg';
													//var_dump($icon_dir);
													echo file_get_contents($amenity_icon); ?>
													<!-- <img src="<?php //echo $amenity_icon; ?>"> -->
												</div>
												<h2 class="sub-title"><?php echo $post_a->name;?></h2>
											</a>
										</li>
							<?php wp_reset_postdata(); endwhile; endif; ?>
							</ul>
						<!-- </div> -->
					</div><!-- end amenities.row -->
				
				<div class="row featured-posts fix_pad">
					<?php 
						$featured_post = get_field('featured_post_block');
						//var_dump($featured_post);
						$teaser = get_field('fa_lead_text');
						$city = get_field('city');
						//var_dump($featured_post->post_content);
						// override $post
						//$post = $post_object;
						//setup_postdata( $post ); 

						$fa_id = $featured_post->ID;
						$fa_bg = get_field('primary_photo', $fa_id);
						$fa_city = get_the_terms($fa_id, 'city');
						//var_dump($fa_city);
						//var_dump($fa_bg);
						$fa_bg_URL = $fa_bg['sizes']['large'];
						//var_dump($fa_id);
					?>
					<a href="<?php echo the_permalink($fa_id);?>">
						<div class="columns-8">
							<div class="border-wrap is_rounded">
								<div class="featured featured-article is_rounded periwinkle" style="background-image:url('<?php echo $fa_bg_URL; ?>');">
									<div class="content">
										<?php foreach($fa_city as $term){ ?>
											<span class="city"><?php echo $term->name; ?></span>
										<?php } ?>
										<h2 class="post-title"><?php echo $featured_post->post_title; ?></h2>
										<h3 class="post-subtitle"><?php echo $teaser; ?></h3>
									</div>
									<div class="border" aria-hidden="true"></div>
								</div>
							</div>
						</div>
					</a>
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
						<a href="<?php echo $mbx_link; ?>" <?php echo $mbx_target; ?> >
							<div class="map-callout" style="background-image:url('<?php echo $mbx_bg_URL; ?>');">
								<div class="content">
									<div class="wrap">
										<h2><?php echo $mbx_title; ?></h2>
										<p><?php echo $mbx_subtitle; ?></p>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div> <!-- end row.featured-posts -->
 				
 				<?php get_template_part('partials/separator'); ?>

 				<?php 
						$nibble_featured = get_field('nibble_featured');
						
						

						if($nibble_featured != ''){ ?>

					<?php 
							if(have_rows('nibble_featured')): ?>

					<div class="nibble-featured row fix_pad">
					<?php
							while(have_rows('nibble_featured')):the_row();
								$fa_link = get_sub_field('nibble_featured_article');
								$post_nf = $fa_link;
								setup_postdata($post_nf);
								$nf_id = $post_nf->ID;
								$nf_bg=get_field('primary_photo', $nf_id);
								$nf_bg_URL = $nf_bg['sizes']['large'];
								$nf_subtitle = get_sub_field('nf_lead_text');
								$nf_city = get_the_terms($nf_id, 'city');
								//$post_subtitle = 

								// foreach($nibble_featured as $featured_post){
								// var_dump($featured_post);
					?>

					
					<a href="<?php echo the_permalink($nf_id); ?>">
						<div class="columns-4">
								<div class="featured-article is_rounded">	
									<div class="border-wrap is_rounded" style="background-image:url('<?php echo $nf_bg_URL; ?>'); background-repeat:no-repeat; background-size:cover; background-position:center center;">
										<!-- <img class="periwinkle" src="<?php echo $nf_bg_URL; ?>" > -->
										<div class="border" aria-hidden="true"></div>
									</div>
									<?php foreach($nf_city as $nf_term){ ?>
										<span class="city"><?php echo $nf_term->name; ?></span>
									<?php } ?>
									<h2 class="post-title"><?php echo $post_nf->post_title; ?></h2>
									<h3 class="post-subtitle"><?php echo $nf_subtitle; ?></h3>
							</div>
						</div>
					</a>
					
				<?php  wp_reset_postdata(); endwhile; ?>
					</div> <!-- end row.nibble-featured -->
				<?php endif; } ?>

				<?php get_template_part('partials/separator'); ?>

				<div class="row lscape fix_pad">
					<div class='columns-6 has_gradient is_rounded landscape'>
						<?php 
							$ec_text=get_field('ec_text');


						?>
						<div class="section">
							<h2><?php echo $ec_text; ?></h2>
						</div>
						<?php if (have_rows('ec_button')):
								while(have_rows('ec_button')):the_row();

								$button_text=get_sub_field('button_text');
								$button_link=get_sub_field('button_link');
								$b_external = get_sub_field('external');
								$button_target='';
							if($b_external == true){
								$button_target='target="_blank"';
							}
								?>
								<div class="content section">
									<div class="event-button">
										<a href="<?php echo $button_link; ?>" <?php echo $button_target; ?>>
											<?php echo $button_text; ?>
										</a>
									</div>
								</div>
							<?php endwhile; endif; ?>
					</div>
					<div class='columns-6 has_gradient is_rounded landscape' >
						<div class="section">
							<h2>Sign up &amp; stay in the loop with our emails</h2>
						</div>
						<div class="email-signup content section">
							<input type="email" placeholder="Your Email here">
							<button><?php echo file_get_contents(get_template_directory().'/img/arrow.svg')?>	</button>
						</div>
					</div>
				</div> <!-- end row.lscape -->
				<?php 
					if (have_rows('restaurant_reviews')):
				?>

				<?php get_template_part('partials/separator'); ?>

				<div class="row reviews fix_pad">
					<?php 
					while (have_rows('restaurant_reviews')):the_row();
						$rr_link = get_sub_field('restaurant_review');
						$post_rr = $rr_link;
						setup_postdata($post_rr);
						$rr_id = $post_rr->ID;
						$rr_bg=get_field('primary_photo', $rr_id);
						$rr_bg_URL = $rr_bg['sizes']['large'];
						$rr_title = $post_rr->post_title;
						$rr_city = get_the_terms($rr_id, 'city');
					?>
					<a href="<?php echo the_permalink($rr_id); ?>">
						<div class="columns-2 eq">
							<div class="restaurant-review">
								<div class="review-hover is_rounded img" style="background-image:url('<?php echo $rr_bg_URL; ?>');">
									<!-- <img src="<?php echo $rr_bg_URL; ?>"> -->
									<div class="hover">
										<div class="wrap">
											<div class="content">
												<span>Read Our Review ></span>
											</div>
										</div>
									</div>
								</div>
								<?php foreach($rr_city as $rr_term){ ?>
									<span class="city"><?php echo $rr_term->name; ?></span>
								<?php } ?>
								<h2 class="post-title"><?php echo $rr_title; ?></h2>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
				</div><!-- end reviews -->
			<?php endif; ?>

			<?php get_template_part('partials/separator'); ?>

			</div><!-- end reviews -->

			
		</div> <!-- end container -->
	</div><!-- end row.fix_pad -->

</main><!-- End of Content -->

<?php get_footer(); ?>
