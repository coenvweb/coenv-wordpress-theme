<form role="search" method="get" class="search-form Form--inline" action="<?php echo home_url( '/' ); ?>">
  <div class="field-wrap">
	<label for="s2">Search Field</label>
    <input type="text" value="<?php echo get_search_query() ?>" name="s2" id="s2" placeholder="Search this site" />
    <button type="submit"><i class="icon-search"></i><span>Search</span></button>
  </div>
</form>