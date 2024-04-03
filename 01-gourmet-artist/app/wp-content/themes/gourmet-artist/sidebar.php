<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GourmetArtist
 */
?>

<aside id="secondary" class="widget-area medium-4 columns" role="complementary">
	<div class="row">
			<div class="medium-12 columns">
					<a data-open="newsletter">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/newsletter.jpg" alt="suscribete al newsletter">
					</a>
			</div>
	</div>

	<div id="newsletter" class="small reveal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out">
			<form>
					<h2 class="text-center">Suscríbete al Newsletter</h2>

					<div class="row columns">
							<label>Nombre
									<input type="text" placeholder="Tu Nombre">
							</label>
					</div>
					<div class="row columns">
							<label>E-mail
									<input type="text" placeholder="Tu Email">
							</label>
					</div>
					<div class="row columns">
							<input type="submit" value="Enviar" class="button" id="newsletter_enviar">
					</div>
			</form>
	</div>
	<?php
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
	?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
