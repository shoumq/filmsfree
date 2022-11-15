<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package filmsfree
 */

get_header();
?>

	<main>
        <div class="container">
            <p class="title">Фильмы</p>

            <div class="video">
				
				<?php $args = array( 'post_type' => 'movies', 'posts_per_page' => 10);
				$the_query = new WP_Query( $args );?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
				
				<div class="video__el">
					<?php
					$terms = get_terms( 'genre' );
				
					?>
					<img class="video__el_img" src="<?php echo $image[0]; ?>" alt="">
					<div class="video__el_info">
						<p class="video__el_bc">
						<?php 
						$cur_terms = get_the_terms( $post->ID, 'genre' );
						if( is_array( $cur_terms ) ){
							foreach( $cur_terms as $cur_term ){
								echo $cur_term->name . ' ';
							}
						}	
						?>
						</p>
						<p class="video__el_name"><?php the_title(); ?></p>
						<p class="video__el_desc"><?php the_field('desc'); ?></p>
						<a href="<?php the_permalink(); ?>" class="video__el_link">Подробнее о фильме</a>
					</div>
				</div>
					<?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
				<?php else: ?>
					<p><?php _e( 'Записи не найдены.' ); ?></p>
				<?php endif; ?>
				
            </div>
        </div>
    </main>

    <div class="link_plus">
        <a href="/" class="link_plus_a">Смотреть еще</a>
    </div>

<?php
get_footer();
?>