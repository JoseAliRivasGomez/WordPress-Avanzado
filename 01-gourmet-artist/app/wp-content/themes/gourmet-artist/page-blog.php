<?php
/**
 * Template Name: Blog
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GourmetArtist
 */

get_header(); ?>

	<div id="primary" class="content-area medium-8 columns medium-push-2 columns">
		<main id="main" class="site-main" role="main">

      <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

      <?php
      $query = array(
          'post_type' => 'post',
          'order' => 'DESC',
          'cat' => 4,
          'order_by' => 'date',
          'posts_per_page' => 5
      );

      echo '<ul class="no-bullet">';
      $blog = new WP_Query($query); while($blog->have_posts()): $blog->the_post();
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
      					<?php if(is_single()) {
      							the_title( '<h1 class="entry-title text-center">', '</h1>' );
      							the_post_thumbnail();
      					} else { ?>
      					<div class="imagen medium-6 columns">
      							<?php the_post_thumbnail('entrada'); ?>
      					</div>
      					<?php } ?>

      					<?php if(is_single()) { ?>
      					   	<div>
      					<?php } else { ?>
      							<div class="medium-6 columns">
      					<?php } ?>

      						<header class="entry-header ">
      							<?php
      								if ( is_single() ) {

      								} else {
      									the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      								}

      							if ( 'post' === get_post_type() ) : ?>
      							<div class="entry-meta">
      								<?php gourmet_artist_posted_on(); ?>
      							</div><!-- .entry-meta -->
      							<?php
      							endif; ?>
      						</header><!-- .entry-header -->

      						<div class="entry-content">
      							<?php
      								if(is_single() ) {
      											the_content();
      								} else {
      											$excerpt = substr( get_the_excerpt(), 0, 200 );
      											echo $excerpt . ' ...';
      											wp_link_pages( array(
      												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gourmet-artist' ),
      												'after'  => '</div>',
      											) );
      								?>
      								<a href="<?php the_permalink(); ?>" class="button">Ver Entrada</a>
      								<?php  } ?>



      						</div><!-- .entry-content -->


      		</div><!--.medium-6 colums-->
      </article><!-- #post-## -->

    <?php endwhile; wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
