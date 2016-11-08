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
  'walker' 		 => $walker,
  'hide_empty'   => 0,
  'exclude'      => '1807,1808,1809,1810,1811,1812,1813,1814,574,412,863,869'
);



?>
<a name="filters" id="filters"></a>
<div id="careers-filter" class="careers-filter">
	<h3 class="title">Filter</h3>
	<div class="filters">
	<ul>
	<ul class="cat-filters" id="career_filter">
		<?php echo get_career_filters(); ?>
	</ul>
	
	<h4>Subscribe</h4>
	<ul class="subscribe">
		<li><a href="/students/career-resources/career-opportunities/subscribe-via-email/"><img src="/wp-content/themes/coenv-wordpress-theme/assets/img/icon-mail.png" alt="Subscribe via email" /></a></li>
		<li><a href="/feed/?post_type=careers"><img src="/wp-content/themes/coenv-wordpress-theme/assets/img/icon-feed.png" alt="Subscribe to our feed" /></a></li>
	</ul>
</div>
</div><!-- #blog-header -->
