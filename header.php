<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?> <?php if(!is_front_page()){ echo ' | ' . get_the_title(); } ?></title>

	<!-- Meta / og: tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

	<!-- Fonts
	================================================== -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
	<!-- <script src="https://use.typekit.net/ptx0dcp.js"></script>
	// <script>try{Typekit.load({ async: true });}catch(e){}</script>-->

	<script>
  (function(d) {
    var config = {
      kitId: 'ptx0dcp',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>


	<?php 
	$bugherd="false";
	if($bugherd = 'true'){
	?>

	<!-- Bugherd -->
	<script type='text/javascript'>
	(function (d, t) {
	  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
	  bh.type = 'text/javascript';
	  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=2hn9gc6zwswhoax8u4cwza';
	  s.parentNode.insertBefore(bh, s);
	  })(document, 'script');
	</script>
	
	<?php } ?> 

	<?php wp_head(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113158507-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-113158507-1');
	</script>

</head>
<script>
	var $dir = '<?php echo get_template_directory_uri(); ?>';  
	var $home = '<?php echo esc_url( home_url( '/' ) ); ?>'
</script>
<script>
	<?php 
		$amenities = get_terms(array('taxonomy'=>'amenity', 'hide_empty'=>false));
		//var_dump($amenities);
		$cuisines = get_terms(array('taxonomy'=>'cuisine', 'hide_empty'=>false));
		//var_dump($cuisines);
		$neighborhoods = get_terms(array('taxonomy'=>'neighborhood', 'hide_empty'=>false));
		//var_dump($neighborhoods);
		$cities = get_terms(array('taxonomy'=>'city', 'hide_empty'=>false));
		//var_dump($cities);
		$geo_array = [];

		$amenity_name='';
		$separator = ', ';
		foreach ($amenities as $amenity){
			//var_dump($amenity);
			$amenity_name .= '"'.$amenity->name.'"'.$separator;
		}

		$cuisine_name = '';
		foreach ($cuisines as $cuisine_single){
			$cuisine_name .= '"'.$cuisine_single->name.'"'.$separator;
		} 

		$neighborhood_name = '';
		foreach($neighborhoods as $neighborhood){
			$neighborhood_name .= '"'.$neighborhood->name.'"'.$separator;
		}

		$city_name = '';
		foreach($cities as $city){
			$city_name .= '"'.$city->name.'"'.$separator;
			$city_name_single = $city->name;
			$city_id = $city->term_id;
			$city_slug = $city->slug;
			
			$lat = get_term_meta($city_id, 'latitude');
			$long = get_term_meta($city_id, 'longitude');

			$g = [
				'name' => $city_name_single,
				'slug' => $city_slug,
				'id'   => $city_id,
				'lat'  => $lat,
				'long' => $long,
				// $city_name_single,
				// $city_slug,
				// $city_id,
				// $lat,
				// $long,
			];

			array_push($geo_array, $g);
			$g_json = json_encode($geo_array, JSON_PRETTY_PRINT);

		}

		$city_trim = rtrim($city_name, ', ');

	?>

		var da_choices= [];
		var geo_choices = <?php echo $g_json; ?>;
		da_choices.push(<?php echo $amenity_name.$cuisine_name.$neighborhood_name.$city_trim; ?>);


		///console.log(jQuery.inArray( 'Asheville' , geo_choices));
		//console.log(geo_choices);
</script>
<body <?php body_class(); ?>>
 	<?php //$landing_id = get_page_by_path( home_url( '/' )); 

 	//var_dump($landing_id);

 	//var_dump(get_id_by_slug());
 	//$l_id = get_id_by_slug();
 	?>
	<header>
		<div class="header-wrap"><!-- container -->
			<div class="row head">
				<div class="mobile-search-trigger"><?php if (is_page_template('templates/template-landing.php')){ echo 'Select A City'; }else{ echo 'Search'; } ?></div>
				<div class="funnel">
					<div class="close the_search">Close</div>
					<div class="wrap">
						<ul class="city-dropdown <?php if(!is_page_template('templates/template-landing.php')){ echo 'no_landing';}else{ echo 'landing'; } ?>">
							<li ><span id="city" <?php if(!is_front_page()){ echo 'class="inner"'; }?> >Select A City</span><span class="arrow"><?php echo file_get_contents(get_template_directory().'/img/arrow.svg')?></span>
								<ul class="sub-menu">
									<div class="city-wrap">
										<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-name="All Cities" data-slug="none">All Cities</a></li>
									<?php 
										//$cities = get_the_terms('city'); 
										//var_dump($cities);
									$c_cnt=0;
									$city_cnt = count($cities);
										foreach($cities as $city){
											//$city_cnt = count($city);
											$c_cnt++;
											$half_count = $city_cnt/2;
											$half_round = round($half_count);

											if($c_cnt == $half_round+1){
												?>
											</div><div class="city-wrap">
											<?php }
											//Give 'no city' a value of "all cities"
											?>


											<li>
												<a href="<?php  if ( is_page_template('templates/template-landing.php')){ echo esc_url( home_url( '/' )).$city->slug; } ?>" <?php if(!is_page_template()){echo 'class="linked"';} ?> data-name="<?php echo $city->name; ?>" data-slug="<?php echo $city->slug; ?>">
													<?php echo $city->name; ?>
												</a>
											</li>
										<?php } 
											if($city_cnt - $c_cnt == 0){
										?>
										</div>
										<?php } ?>
								</ul>
							</li>
						</ul>
						<?php if (! is_page_template('templates/template-landing.php')){ ?>
							<div class="search-form">
								<?php get_template_part('partials/searchform') ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<!-- <div class="columns-12"> -->
				<div class="logo">
					<h1 class="site-title">
						<a id="homelink" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img class="logomark" src="<?php bloginfo('template_directory'); ?>/img/logo_mark.png">
							<img class="logotext" src="<?php bloginfo('template_directory'); ?>/img/logo_text.png">
						</a>
					</h1>
				</div>
				<div class="sidr-trigger">MENU</div>
				<nav class="main-navigation">
					
					<div class="close">Close</div>
					<div class="wrap">
					<?php if(has_nav_menu('main_nav')){
								$defaults = array(
									'theme_location'  => 'main_nav',
									'menu'            => 'main_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'menu',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								); wp_nav_menu( $defaults );
							}else{
								echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
					<ul class="social-nav">
						<li><a href="https://twitter.com/nibble_squeak" target="_blank"><i class="fa fa-fw fa-twitter"></i></a></li>
						<li><a href="https://www.facebook.com/nibbleandsqueak/" target="_blank"><i class="fa fa-fw fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/nibbleandsqueak/" target="_blank"><i class="fa fa-fw fa-instagram"></i></a></li>
					</ul>
					</div>
				</nav>
			</div>
		</div>
		<?php if(!is_page_template('templates/template-landing.php')){ ?>
		<div class="gradient-line"></div>
		<?php } ?>
		<?php get_template_part('partials/bubble'); ?>
	</header>
	
