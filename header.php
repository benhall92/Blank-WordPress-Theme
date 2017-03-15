<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Blank
 * @since Blank 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<title><?php wp_title(); ?></title>

<?php
/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */
wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- NAVIGATION WITH SCHEMA -->
<nav class="nav nav--mobile" id="mobileMenu" itemscope itemtype="http://schema.org/SiteNavigationElement">

	<div class="clearfix">
		<div id="menuCloseTrigger" class="h4 float-right nav--mobile__menu-close">x</div>
	</div>

	<?php 

		wp_nav_menu(
			array(
				'theme_location' 	=> 'main-menu',
				'container' 		=> false,
				'menu_class' 		=> 'list list--block'
			)
		);
	?>
	
<!-- NAVs -->
</nav>

<div id="page">

<!-- HEADER -->
<header id="header">

	<!-- NAVIGATION WITH SCHEMA -->
	<nav class="nav nav--primary" itemscope itemtype="http://schema.org/SiteNavigationElement">

		<?php 

			wp_nav_menu(
				array(
					'theme_location' 	=> 'main-menu',
					'container' 		=> false,
					'items_wrap' 		=> '<ul id="main-menu" class="list list--inline main-menu"><li id="mobileMenuTrigger"><i class="fa fa-bars" aria-hidden="true"></i></li>%3$s</ul>'
				)
			);
		?>
		
	<!-- NAVs -->
	</nav>
	
<!-- HEADER -->
</header>

<!-- OPEN MAIN TAG HERE-->
<!-- MAIN -->
<main class="main" id="main">

<!-- LOGO SCHEMA -->
<!--
<div itemscope itemtype="http://schema.org/Organization">
	<a itemprop="url" href="http://www.example.com/">
		<h1>Home</h1>
		<img itemprop="logo" src="http://www.example.com/logo.png" />
	</a>
</div>
-->


