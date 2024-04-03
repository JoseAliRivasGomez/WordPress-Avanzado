<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GourmetArtist
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info row">

				<div class="medium-4 columns">
					<?php wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'menu_id' => 'footer-menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s vertical medium-horizontal  text-center">%3$s</ul>',
						)); ?>
				</div>
				<div class="medium-2 columns">
					<?php wp_nav_menu( array(
								'theme_location' => 'social-menu',
								'menu_id' => 'social-menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s ">%3$s</ul>',
						)); ?>

				</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
