<?php  
/**
 * Individual article on the search results page.
 */
?>
<article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

	<header class="article__header">

		<?php //coenv_breadcrumbs() ?>

		<?php if ( is_page() || is_single() ) : ?>
			<h1 class="article__title"><?php the_title() ?></h1>
		<?php else : ?>
			<h1 class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h1>
		<?php endif ?>

	</header>

	<section class="article__content">
				<?php the_advanced_excerpt('length=20&length_type=words&no_custom=1&ellipsis=%26hellip;&exclude_tags=img,p,strong,table&no_shortcode=1'); ?>
	</section>

</article><!-- .article -->	