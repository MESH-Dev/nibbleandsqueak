 

<footer class="site-footer">
			<div class="footer-navs row">
				<div class="columns-6 events">
					<h2 class="nav-title">Events</h2>
					<?php 
							//Check out funcitions/start.php for setup of this nav
							//The nav is split half-way so that it it split visually in the footer
				
							//Get that nav
							$split_nav = get_split_nav('events_nav');
							//var_dump($split_nav->left_menu);

							//if($split_nav->left_menu != ''){

							//render left nav
							//echo $split_nav->left_menu; 
			
							//render right nav
							//echo $split_nav->right_menu;

							// }else{
							// 	// if(has_nav_menu('events_nav')){
							// 	$defaults = array(
							// 		'theme_location'  => 'events_nav',
							// 		'menu'            => 'events_nav',
							// 		'container'       => false,
							// 		'container_class' => '',
							// 		'container_id'    => '',
							// 		'menu_class'      => 'footer-menu',
							// 		'menu_id'         => '',
							// 		'echo'            => true,
							// 		'fallback_cb'     => 'wp_page_menu',
							// 		'before'          => '',
							// 		'after'           => '',
							// 		'link_before'     => '',
							// 		'link_after'      => '',
							// 		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							// 		'depth'           => 0,
							// 		'walker'          => ''
							// 	); wp_nav_menu( $defaults );
							// 	}
								// else{
								// 	echo "<p><em>about_nav</em> doesn't exist! Create it and it'll render here.</p>";
								// } 
							//}
						?>
				</div>
				<div class="columns-2 about">
					<h2 class="nav-title">About</h2>
					<?php if(has_nav_menu('about_nav')){
								$defaults = array(
									'theme_location'  => 'about_nav',
									'menu'            => 'about_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'footer-menu',
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
								echo "<p><em>about_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</div>
				<div class="columns-2 involved">
					<h2 class="nav-title">Get involved</h2>
					<?php if(has_nav_menu('involved_nav')){
								$defaults = array(
									'theme_location'  => 'involved_nav',
									'menu'            => 'involved_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'footer-menu',
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
								echo "<p><em>involved_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</div>
				<div class="columns-2 terms">
					<h2 class="nav-title">Terms</h2>
					<?php if(has_nav_menu('terms_nav')){
								$defaults = array(
									'theme_location'  => 'terms_nav',
									'menu'            => 'terms_nav',
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
								echo "<p><em>terms_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</div>
			</div>
			
			<div class="tagline row">
				<div class="columns-6">
					<p class="info">Nibble &amp; Squeak.  Brooklyn NY, 11211 <a href="mailto:info@nibbleandsqueak.com">info@nibbleandsqueak.com</a></p>
				</div>
				<div class="columns-6">
					<p class="signature">Site Design by <a href="http://meshfresh.com" target="_blank">MESH</a></p>
				</div>
			</div><!-- end tagline -->
			<!-- </div> --><!-- End of Footer -->
		<!-- </div> --><!-- end row -->

</footer>

<?php wp_footer(); ?>

</body>
</html>
