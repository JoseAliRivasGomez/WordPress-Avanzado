<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GourmetArtist
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gourmet-artist' ); ?></a>

	<header id="masthead" class="site-header row" role="banner">

		<?php if ( get_header_image() ) : ?>
			<div class="header-image" style="background-image: url(<?php header_image(); ?>)">
						<div class="site-branding text-center">


							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif; ?>
						</div><!-- .site-branding -->
			</div>
		<?php else:  ?>
			<div class="no-imagen">
						<div class="site-branding text-center">

							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif; ?>
						</div><!-- .site-branding -->
			</div>


		<?php endif; // End header image check. ?>



				<nav style="margin-bottom:10px;" id="site-navigation" class="main-navigation " role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gourmet-artist' ); ?></button>
					<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_id' => 'primary-menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s vertical medium-horizontal  expanded text-center">%3$s</ul>',
						)); ?>
				</nav><!-- #site-navigation -->
				<?php get_search_form( $echo = true ) ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
