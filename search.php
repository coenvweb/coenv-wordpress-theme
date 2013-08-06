<?php
/**
 * search.php
 *
 * The search results template.
 */
get_header();

$classes = array();

if ( get_query_var('post_type') == 'post' ) {
	$classes[] = 'template-blog';
} else {
	$classes[] = 'template-page';
}

?>

	<section id="search" role="main" class="<?php echo implode( ',', $classes ) ?>">

		<div class="layout-container">

			<nav id="secondary-nav" class="side-col">
				<ul>
					<li class="pagenav"><a href="#">Search results</a></li>
				</ul>
			</nav><!-- #secondary-nav.side-col -->

			<div class="main-col">

				<section class="article">
					<header class="article-header">
						<h1>Search results for "<?php the_search_query() ?>"</h1>
					</header>
				</section>

				<div class="search-results">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post() ?>

							<?php get_template_part( 'partials/partial', 'article' ) ?>

						<?php endwhile ?>

					<?php endif ?>

				</div><!-- .search-results -->

				<footer class="pagination">
					<?php coenv_paginate() ?>
				</footer>

			</div><!-- .main-col -->

		</div><!-- .layout-container -->

	</section><!-- #page -->

<?php get_footer(); ?>