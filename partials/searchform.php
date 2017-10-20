<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div class="form input">
		<label for="searchHeader" class="sr-only">Search the site</label>
		<input id="searchHeader" class="hide" type="text" placeholder="Search..." value="<?php the_search_query(); ?>" name="s" id="s" />
		<input id="city-search" type="hidden" name="city" type="text" placeholder="Search..." value="" name="s" id="s" />
		<button type="submit" class="form submit search-submit" id="searchsubmit" value="" >
			<span class="sr-only">Submit search</span>
			<?php echo file_get_contents(get_template_directory().'/img/search.svg')?>
		</button>			
	</div>
</form>