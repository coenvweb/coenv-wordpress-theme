<?php
//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)
$taxonomy     = 'career_category';
$orderby      = 'name'; 
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';
$walker = new CoEnv_Career_Category();

$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'walker' 		 => $walker
);
?>
<a name="filters" id="filters" />
<div id="careers-filter" class="careers-filter">
	<h3 class="title">Filter</h3>
	<div class="filters">
	<ul>
		<li>Sort by
			<ul>
				<li><a href="/students/career-resources/career-opportunities/?sort=post_date">Post date</a></li>
				<li><a href="/students/career-resources/career-opportunities/?sort=deadline">Deadline</a></li>
			</ul>
		</li>
	<ul>
		<?php wp_list_categories( $args ); ?>
	</ul>
	
	<h4>Subscribe</h4>
	<ul class="subscribe">
		<li><a href="http://depts.washington.edu/coenv/careers-blog/subscribe-via-rss/"><img src="/wp-content/themes/coenv-wordpress-theme/assets/img/icon-feed.png" alt="Subscribe to our feed" /></a></li>
		<li><a href="http://depts.washington.edu/coenv/careers-blog/subscribe-via-listservemail/"><img src="/wp-content/themes/coenv-wordpress-theme/assets/img/icon-mail.png" alt="Subscribe via email" /></a></li>
	</ul>
	<form role="search" method="get" class="search-form Form--inline" action="/students/career-resources/career-opportunities/">
	  <div class="field-wrap">
	    <input type="text" name="st" id="st" placeholder="Search" />
	    <button type="submit"><i class="icon-search"></i><span>Search</span></button>
	  </div>
	</form>
</div>
</div><!-- #blog-header -->
