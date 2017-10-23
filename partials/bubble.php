<?php 
	$l_city_field = get_field('city_tax');
	$l_city_tax = get_the_terms($post->ID, 'city');
	//var_dump($l_city_tax);
	//var_dump($l_city_field);
	//$cta_link = '';
	//$cta_text = '';
	if(is_front_page()){
		$cta_text = get_field('cta_text', $post->ID);
		$cta_link = get_field('cta_link', $post->ID);
	}elseif(is_home() || is_singular('restaurant')){
		if($l_city_tax != ''){
			$l_city = get_the_terms($post->ID, 'city');
			//var_dump($l_city);
			$l_city_name = get_the_terms($post->ID, 'city' )[0]->name;

			$l_id = get_id_by_slug($l_city_name);
			$cta_text = get_field('cta_text', $l_id);
			$cta_link = get_field('cta_link', $l_id);
		}else{
			$l_id = get_id_by_slug('/');
			$cta_text = get_field('cta_text', $l_id);
			$cta_link = get_field('cta_link', $l_id);
		}
	}
	elseif(is_page_template('templates/template-landing.php') || is_page_template('templates/template-map.php')){
		if($l_city_field != ''){
			$l_city_id = get_field('city_tax');
			$l_city_tax = get_term_by('id', $l_city_id, 'city');
			$l_city_name = $l_city_tax->slug;
			$l_id = get_id_by_slug($l_city_name);
			$cta_text = get_field('cta_text', $l_id);
			$cta_link = get_field('cta_link', $l_id);
		}else{
			$l_id = get_id_by_slug('/');
			$cta_text = get_field('cta_text', $l_id);
			$cta_link = get_field('cta_link', $l_id);
		}
	}
	
?>
<div class="bubble-wrap row">
	<a class="cta-bubble"href="<?php echo $cta_link; ?>" <?php echo $cta_link; ?>>
		<div class="bubble">
			<?php echo $cta_text; ?>
		</div>
	</a>
</div>