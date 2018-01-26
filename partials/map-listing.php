<div class="map-listing queried is_rounded" id="<?php echo $slug; ?>">
	<div class="map-listing-content left_rounded">
		<span class="city">New York</span>
		<h2 class="post-title">
			<?php echo get_the_title($rid); ?> 
		</h2>
		<div class="loc-tags">
			<?php echo $hoods_name; ?>
			<?php //foreach($hoods as $hood){ 
				 //echo $hood->name; 
			 //} ?>
		</div>
		<div class="loc-tags">
			<?php echo $cuisines_name; ?>
			<?php //foreach($cusines as $cusine){ 
				 //echo $cusine->name; 
			 //} ?>
		</div>
		<ul class="loc-amenities">
			<?php 
			if($amenity != ''){
				foreach($amenity as $icon){
					$icon_id = $icon->term_id;
					$icon_img = get_term_meta($icon_id, 'meta-image', true );
				?>
				<li style="width:25px; list-style-type:none; float:left; display:inline-block; margin-right:1em;">
					<?php echo file_get_contents($icon_img); ?>
				</li>
			<?php } } ?>
			<!-- <li>highchairs</li>
			<li>Changing Tables</li> -->
		</ul>
	</div>
	<div class="listing-image right_rounded" style="background-image:url('<?php echo $post_image_URL; ?>')"></div>
	<div class="border" aria-hidden="true"></div>
</div>