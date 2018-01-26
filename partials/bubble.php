<?php 
	$l_city_field = get_field('city_tax');
	$l_city_tax = get_the_terms($post->ID, 'city');
	
	
	$city_slug =  $_COOKIE['city'];
	$l_id = get_id_by_slug($city_slug);
	
	$cta_text = get_field('cta_text', $l_id);
	$cta_link = get_field('cta_link', $l_id);
	
	$cb_external = get_field('cb_external', $l_id);
	
	if($cb_external == true){
		$bubble_target='target="_blank"';
	}
?>
<div class="bubble-wrap row">
	<a class="cta-bubble" href="<?php echo $cta_link; ?>" <?php echo $bubble_target; ?>>
		<div class="bubble">
			<?php echo $cta_text; ?> >>
		</div>
	</a>
</div>