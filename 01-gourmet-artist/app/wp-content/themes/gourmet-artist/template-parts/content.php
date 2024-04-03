<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GourmetArtist
 */

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
									 if('recetas'== get_post_type()) { ?>
											<div class="taxonomia">
														<div class="hora-comida">
																<?php echo get_the_term_list($post->ID, 'horario-menu', "Hora de comida: ", ', ', ''); ?>
														</div>
														<div class="tipo-comida">
																<?php echo get_the_term_list($post->ID, 'tipo-comida', "Tipo de Platillo: ", ', ', ''); ?>
														</div>
											</div>
									<?php
											}
											$excerpt = substr( get_the_excerpt(), 0, 200 );
											echo $excerpt . ' ...';
											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gourmet-artist' ),
												'after'  => '</div>',
											) );
								?>
								<a href="<?php the_permalink(); ?>" class="button">Ver Receta</a>
								<?php  } ?>
						</div><!-- .entry-content -->


		</div><!--.medium-6 colums-->
</article><!-- #post-## -->
