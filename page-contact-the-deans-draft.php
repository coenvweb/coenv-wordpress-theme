<?php
/**
 * page.php
 *
 * The main page template
 */
get_header();

$ancestor_id = coenv_get_ancestor();

$ancestor = array(
	'id' => $ancestor_id,
	'permalink' => get_permalink( $ancestor_id ),
	'title' => get_the_title( $ancestor_id )
);


?>

	<section id="page" role="main" class="template-page">

		<div class="container">

			<?php if ( in_array( $post->post_type, array('page') ) ) : ?>

				<nav id="secondary-nav" class="side-col">

			<ul id="menu-secondary" class="menu">
	              <?php wp_list_pages( array(
	              		'child_of' => $ancestor['id'],
	                  'depth' => 3,
	                  'title_li' => '<a href="' . $ancestor['permalink'] . '">' . $ancestor['title'] . '</a>',
	                  'link_after' => '<i class="icon-arrow-right"></i>',
	                  'walker' => new CoEnv_Secondary_Menu_Walker,
	                  'sort_column' => 'menu_order'
	              ) ) ?>
	          </ul>

				</nav><!-- #secondary-nav.side-col -->

			<?php endif ?>

			<main id="main-col" class="main-col">
                
                <article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>
                    
                    <header class="article__header">
                        <h1 class="article__title"><?php the_title() ?></h1>
                    </header>

	               <section class="article__content">
                   <?php
                        $terms = get_terms( 'team', array(
                        'hide_empty' => 0
                    ) );

                    foreach( $terms as $term ) {

                        // Define the query
                        $args = array(
                            'post_type'     =>  'staff',
                            'post_status'   =>  'publish',
                            'meta_key'		=>  'placement',
                            'orderby'		=>  'meta_value_num',
                            'order'			=>  'ASC',
                            'posts_per_page' => -1,
                            'team'          =>  $term->slug
                        );
                        $query = new WP_Query( $args );

                        echo '<h2>' . $term->name . '</h2>';
                
                        while ( $query->have_posts() ) : $query->the_post(); ?>

                           <?php get_template_part( 'partials/partial', 'staff' ) ?>
                        <?php endwhile;
                        wp_reset_postdata();
                    } ?>
                       
                    </section>
                    
                </article>
                
            <div class="side-footer">
                <?php get_sidebar('contact') ?>
            </div>

			</main><!-- .main-col -->

			<div class="side-col">
				<?php get_sidebar() ?>
			</div><!-- .side-col -->

		</div><!-- .container -->

	</section><!-- #page -->

<?php get_footer() ?>