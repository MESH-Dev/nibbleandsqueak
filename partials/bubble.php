<?php 
	$cta_text = get_field('cta_text', $post->ID);
	$cta_link = get_field('cta_link', $post->ID);
?>
<div class="bubble-wrap row">
	<a class="cta-bubble"href="<?php echo $cta_link; ?>" <?php echo $cta_link; ?>>
		<div class="bubble">
			<?php echo $cta_text; ?>
		</div>
	</a>
</div>