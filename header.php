<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
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

<?php

$company_telephone_number 	= get_field('company_telephone_number', 'option');
$contact_page_link 			= get_field('contact_page_link', 'option');
$my_account_page_link 		= get_field('my_account_page_link', 'option');
$header_logo 				= get_field('header_logo', 'option');

?>

</head>

<body <?php body_class(); ?>>

<div class="mega-menu-overlay"></div>

<div id="page">

	<div class="header header--secondary" data-palm="palm-hidden">

		<div class="wrapper">
		
			<div class="grid">

				<?php if ($company_telephone_number != ""): ?>

				<div class="grid__item float-left" data-desk="desk-8-12" data-lap="lap-4-8">

					<p>
						<a href="tel:<?php echo $company_telephone_number; ?>"><i class="fa fa-phone" aria-hidden="true"></i>
							<strong><?php _e('Freephone', 'oakworld'); ?> <?php echo $company_telephone_number; ?>
							</strong>
						</a>
					</p>
					
				</div>

				<?php endif ?>

				<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-4-8">

					<div class="header__page-links">

						<?php output_link('Contact us', $contact_page_link, false, false, 'p'); ?>

						<p class="page-links__separator"> | </p>

						<?php if ($my_account_page_link != ""): ?>
							
							<p>
								<i class="fa fa-user" aria-hidden="true"></i>
								<?php output_link('My Account', $my_account_page_link); ?>
							</p>

						<?php endif ?>
						
					</div>

					
					
				</div>
				
			</div>

		</div>

	</div>

	<!-- HEADER -->
	<header class="header" id="header" role="banner">

		<div class="wrapper">

			<div class="grid">

				<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-3-8" data-palm="palm-2-4">

					<div class="header__logo">
					
						<?php if (is_front_page() ): ?>

							<h1>
								<span style="display:none;"><?php bloginfo('title'); ?></span>

						<?php endif ?>

						<a itemprop="url" href="<?php echo get_home_url();?>">
							<img class="logo logo--header" itemprop="logo" src="<?php echo $header_logo['url']; ?>" title="<?php bloginfo('title'); ?>" alt="<?php bloginfo('title'); ?>" />
						</a>

						<?php if (is_front_page() ): ?>
							</h1>
						<?php endif ?>

					</div>

				</div>

				<div class="grid__item float-left" data-desk="desk-hidden"  data-lap="lap-5-8" data-palm="palm-2-4">

					<div class="header__icons">
						
						<span class="header__icon" id="searchTrigger">
							<i class="fa fa-search" aria-hidden="true"></i>
							<span class="icon__text">Search</span>
						</span>

						<span class="header__icon" id="mobileMenuTrigger">
							<i class="fa fa-bars" aria-hidden="true"></i>
							<span class="icon__text">Menu</span>
						</span>

						<span class="header__icon">
							<a href="<?php echo WC()->cart->get_cart_url(); ?>">
								<i class="fa fa-shopping-basket" aria-hidden="true"></i>
								(<?php echo  WC()->cart->get_cart_contents_count(); ?>)
								<span class="icon__text">Basket</span>
							</a>
						</span>

					</div>

				</div>

				<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-hidden" data-palm="palm-hidden">

					<div class="header__search">

						<?php get_search_form(true); ?>

					</div>

				</div>

				<div class="grid__item float-left" data-desk="desk-4-12" data-lap="lap-hidden" data-palm="palm-hidden">

					<div class="clearfix">

						<div class="header__wishlist float-left">

							<a class="font font--green" href="<?php echo get_permalink(get_option('yith_wcwl_wishlist_page_id')); ?>"><i class="icon icon--primary icon--medium fa fa-heart" aria-hidden="true"></i> <span><?php _e('Wish List', 'oakworld'); ?></span></a>

						</div>

						<div class="header__basket float-right">

							<div class="">

								<a class="btn btn--primary btn--small basket basket--primary" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class=" fa fa-shopping-basket" aria-hidden="true"></i>
									(<?php echo  WC()->cart->get_cart_contents_count(); ?>)
									<span><?php _e('CHECKOUT', 'oakworld'); ?></span></a>

							</div>

						</div>
					
					</div>

				</div>
				
			</div>

		</div>
		
	<!-- /HEADER -->
	</header>

	<div class="mobile-search">

		<?php get_search_form(true); ?>
		
	</div>

	<!-- NAVIGATION -->
	<div id="navigation" data-lap="lap-hidden" data-palm="palm-hidden">

		<!-- NAVIGATION WITH SCHEMA -->
		<nav class="nav nav--primary" itemscope itemtype="http://schema.org/SiteNavigationElement">

			<ul class="mega-menu">
	            <?php
	             
	            $locations = get_nav_menu_locations();

	            if ( isset( $locations[ 'mega_menu' ] ) ) :
	               
	                $menu = get_term( $locations[ 'mega_menu' ], 'nav_menu' );
	                
	                if ( $items = wp_get_nav_menu_items( $menu->name ) ) :
	                    
	                    foreach ( $items as $item ) : ?>

	                		<?php $class_names = esc_attr( implode( ' ', $item->classes ) ); ?>
	                        
	                        <li class="mega-menu__list <?php echo $class_names; ?>">

	                        	<div class="list__wrap">
	                            
		                            <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
		                            
		                            <?php if ( is_active_sidebar( 'mega-menu-widget-area-' . $item->ID ) ) : ?>

		                           		<i class="fa fa-chevron-down" aria-hidden="true"></i>
										
								<!-- list wrapp -->
		                        </div>
		                                
			                            <div id="mega-menu-<?php echo $item->ID;?>" class="mega-menu__container">

			                            	<div class="wrapper">

			                                	<ul class="mega-menu__widgets" id="mega">

			                                    <?php dynamic_sidebar( 'mega-menu-widget-area-' . $item->ID ); ?>

			                                	</ul>

			                                </div>

		                                </div>

		                               <?php else: ?>

		                        <!-- list wrapp -->
		                        </div>
		                            
		                            	<?php endif; ?>



	                        </li>
	                    
	                    <?php endforeach; ?>
	                
	                <?php endif; ?>
	            
	            <?php endif; ?>

	        </ul>
			
		<!-- NAVs -->
		</nav>
		
	<!-- NAVIGATION -->
	</div>

	<?php if ( have_rows('header_usps', 'option') ): ?>

	<?php $header_usp_count = 1; ?>

	<div class="header header--secondary">

		<div class="wrapper">

			<div class="grid">

				<?php while( have_rows('header_usps', 'option') ): the_row();

					$usp_type 	= get_sub_field('usp_type');
					$usp_text 	= get_sub_field('usp_text');
					$usp_icon 	= get_sub_field('usp_icon');
					$usp_image 	= get_sub_field('usp_image'); ?>

				<?php if ($header_usp_count == 1): ?>

					<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8">

				<?php elseif ($header_usp_count == 2): ?>

					<div class="grid__item float-left" data-desk="desk-3-12" data-lap="lap-4-8" data-palm="palm-hidden">

				<?php else: ?>

					<div class="grid__item float-left"  data-desk="desk-3-12" data-lap="lap-hidden" data-palm="palm-hidden">
					
				<?php endif ?>

					<div class="header__usp">

					<?php if ($usp_type == 'icon-text' ): ?>

						<?php if ($usp_icon != '' ): ?>
					
						<i class="<?php echo $usp_icon; ?>" aria-hidden="true"></i>

						<?php endif; ?>

						<?php output_text($usp_text, 'p'); ?>

					<?php else: ?>

						<?php if ($usp_image['url'] != '' || $usp_image['url'] != false ): ?>

							<img src="<?php echo $usp_image['url']; ?>" alt="<?php echo $usp_image['alt']; ?>">

						<?php endif; ?>

					<?php endif ?>

					</div>
					
				</div>

				<?php $header_usp_count++; ?>

				<?php endwhile; ?>
				
			</div>

		</div>
		
	</div>

	<?php endif; ?>

	<!-- NAVIGATION WITH SCHEMA -->
	<nav class="nav nav--mobile" id="mobileMenu" itemscope itemtype="http://schema.org/SiteNavigationElement">

		<!--<div class="clearfix">
			<div id="menuCloseTrigger" class="h4 float-right nav--mobile__menu-close">x</div>
		</div>-->

		<?php 

			wp_nav_menu(
				array(
					'theme_location' 	=> 'mobile_menu',
					'container' 		=> false,
					'menu_class' 		=> 'list list--block'
				)
			);
		?>
		
	<!-- NAVs -->
	</nav>

	<!-- OPEN MAIN TAG HERE-->
	<!-- MAIN -->
	<main class="main woocommerce" id="main" role="main">

<!-- LOGO SCHEMA -->
<!--
<div class="logo" itemscope itemtype="http://schema.org/Organization">
-->

<?php 
// wp_nav_menu(
// 	array(
// 		'theme_location' 	=> 'main-menu',
// 		'container' 		=> false,
// 		'items_wrap' 		=> '<ul id="main-menu" class="list list--inline main-menu"><li id="mobileMenuTrigger"><i class="fa fa-bars" aria-hidden="true"></i></li>%3$s</ul>'
// 	)
// );
?>


