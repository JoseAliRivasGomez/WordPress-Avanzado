<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GourmetArtist
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gourmet_artist_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php if('recetas'== get_post_type()) { ?>
			 <div class="taxonomia">
						 <div class="hora-comida">
								 <?php echo get_the_term_list($post->ID, 'horario-menu', "Hora de comida: ", ', ', ''); ?>
						 </div>
						 <div class="tipo-comida">
								 <?php echo get_the_term_list($post->ID, 'tipo-comida', "Tipo de Platillo: ", ', ', ''); ?>
						 </div>
			 </div>
	 <?php }

		 the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php gourmet_artist_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
