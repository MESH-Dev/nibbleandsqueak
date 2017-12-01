 

<footer class="site-footer">
			<div class="footer-interaction row" style="background-color:white;">
				<div class="columns-8 email-signup">
					<div class="label">
						Sign up and stay in the loop with our emails:
					</div>
					<div class="signup">
						<input placeholder="Your email here">
						<button>
							<span class="sr-only">Submit Email</span>
							<?php echo file_get_contents(get_template_directory().'/img/arrow.svg')?>
						</button>
					</div>
				</div>
				<div class="columns-4">
					<div class="social">
						<div class="hashtag">
							<?php 
							$hashtag = get_field('twitter_hashtag', 'options');
							?>
							#<?php echo $hashtag; ?>
						</div>
						<ul class="social-nav">
							<li><a href="https://twitter.com/nibble_squeak"><i class="fa fa-fw fa-twitter"></i></a></li>
							<li><a href="https://www.facebook.com/nibbleandsqueak/"><i class="fa fa-fw fa-facebook"></i></a></li>
							<li><a href="https://www.instagram.com/nibbleandsqueak/"><i class="fa fa-fw fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-navs row">
				<div class="columns-6 events">
					<h2 class="nav-title">Events</h2>
					<?php 
							//Check out funcitions/start.php for setup of this nav
							//The nav is split half-way so that it it split visually in the footer
				
							//Get that nav
							$split_nav = get_split_nav('events_nav');
						
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

<?php if(is_singular('restaurant')){ ?>

<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59f3382bc03ba174"></script> 

<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
