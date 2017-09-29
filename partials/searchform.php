<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div class="form input">
		<label for="searchHeader" class="sr-only">Search the site</label>
		<input id="searchHeader" class="hide" type="text" placeholder="Search the site..." value="<?php the_search_query(); ?>" name="s" id="s" />
		<div class="focus-bg"></div>
		<button type="submit" class="form submit search-submit" id="searchsubmit" value="" >
			<span class="sr-only">Submit search</span>
		</button>			
	</div>
</form>