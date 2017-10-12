<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Oakworld
 * @since Oakworld 1.0
 */
?>

<!-- WOOCOMMERCE -->
<?php

get_header();

wp_reset_query();

get_template_part('theme/includes/page_before');

woocommerce_content();

get_template_part('theme/includes/page_after');

get_footer(); ?>