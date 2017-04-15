<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WCMS_Base_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<!--Adding a container to the top-->
<body <?php body_class(); ?>>

</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'wcms-base' ); ?></a><!--adding the class "sr-only" to hide the "skip content" in this screenreader-->

	<header id="masthead" class="site-header" role="banner">
		<div class= "slider-logo">
			<div class= "logo">
				<?php 	?>

			</div>
		</div>
		<?php 
			echo do_shortcode('[smartslider3 slider=2]');
		?>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse"><!--Adding the Bootstrap 4's nav walker-->
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class= "container">
			<a class="navbar-brand" href="#"><?php bloginfo(''); ?></a>
				<?php
					wp_nav_menu( array(
						'theme_location'	=> 'menu-1',
						'container'			=> 'div',
						'container_class'	=> 'collapse navbar-collapse',
						'container_id'      => 'navbarCollapse',
						'menu_class'		=> 'nav navbar-nav mr-auto ml-auto',
						'fallback_cb'		=> '__return_false',
						'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'				=> 2,
						'walker'			=> new bootstrap_4_walker_nav_menu()
					) );
				?>
			</div>
			<div class= "search-form-container">
				<?php get_search_form(); ?>
			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container"><!--lägger en container för att det ska bli en liten white space vid sidorna-->
