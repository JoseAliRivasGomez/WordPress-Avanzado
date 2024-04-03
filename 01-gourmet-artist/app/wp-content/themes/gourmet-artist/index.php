<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GourmetArtist
 */

get_header(); ?>

  <div class="row">
  <?php get_template_part('template-parts/slider'); ?>
  </div>

  <div class="platillos-por-hora">
      <h2 id="hora" class="text-center">Prepara esto para: </h2>
      <div id="por-hora" class="row">

      </div>

  </div>



<div id="filtrar" >
  <div class="menu-centrado">
    <ul class="menu vertical">
      <?php
        $terminos = get_terms( array(
            'taxonomy' => 'tipo-comida'
        ));

        foreach($terminos as $termino) {
          echo "<li><a href='#" . $termino->slug . "'>" . $termino->name . "</a></li>";
        }
      ?>
    </ul>
  </div>

  <div id="platillos">
    <?php
        foreach($terminos as $termino) {
          filtrar_platillos($termino->slug);
        }
    ?>
  </div> <!--#platillos-->

</div> <!--#filtrar-->
<div class="row">
	<div id="primary" class="content-area medium-8 columns">
		<main id="main" class="site-main" role="main">

			<h2 class="ultimas-recetas text-center">Últimas Recetas</h2>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */


		 	while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; wp_reset_postdata();

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
echo "</div>";
get_footer();
