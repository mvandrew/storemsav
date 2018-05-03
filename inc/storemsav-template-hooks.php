<?php
/**
 * Registers the processing of the Store MSAV theme hooks.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Header
 *
 * @see storemsav_before_site()
 */
add_action( 'storemsav_before_site',                    'storemsav_before_site' );
add_action( 'storemsav_header',                         'storefront_skip_links',                        0 );
add_action( 'storemsav_header',                         'storemsav_site_branding',                      20 );
add_action( 'storemsav_header',                         'storefront_secondary_navigation',              30 );
add_action( 'storemsav_header',                         'storefront_primary_navigation_wrapper',        42 );
add_action( 'storemsav_header',                         'storefront_primary_navigation',                50 );
add_action( 'storemsav_header',                         'storefront_primary_navigation_wrapper_close',  68 );


/**
 * Footer
 *
 * @see storefront_footer_widgets()
 * @see storemsav_footer_widgets()
 * @see storemsav_credit()
 */
add_action( 'storemsav_footer',                         'storefront_footer_widgets',                    10 );
add_action( 'storemsav_footer',                         'storemsav_footer_widgets',                     20 );
add_action( 'storemsav_footer',                         'storemsav_credit',                             30 );


/**
 * Customize parent theme elements
 *
 * @see storemsav_single_post_posted_on_html()
 * @see storemsav_the_author_posts_link()
 */
add_action( 'storefront_single_post_posted_on_html',    'storemsav_single_post_posted_on_html' );
add_action( 'the_author_posts_link',                    'storemsav_the_author_posts_link' );


/**
 * Posts
 *
 * @see storemsav_post_meta()
 * @see storemsav_post_thumbnail()
 */
add_action( 'storefront_loop_post',                     'storemsav_post_meta',                          35 );
add_action( 'storefront_single_post',                   'storemsav_post_meta',                          35 );
add_action( 'storefront_post_content_before',           'storemsav_post_thumbnail',                     10 );


/**
 * Homepage
 *
 * @see storemsav_on_sale_products()
 * @see storemsav_best_selling_products()
 * @see storemsav_product_categories()
 * @see storefront_homepage_content()
 */
add_action( 'homepage',                                 'storefront_featured_products',                 30 );
add_action( 'storefront_featured_products_args',        'storemsav_featured_products_args' );
add_action( 'homepage',                                 'storefront_recent_products',                   40 );
add_action( 'storefront_recent_products_args',          'storemsav_recent_products_args' );
add_action( 'homepage',                                 'storemsav_best_selling_products',              60 );
add_action( 'homepage',                                 'storemsav_on_sale_products',                   70 );
add_action( 'homepage',                                 'storemsav_product_categories',                 80 );
add_action( 'homepage',                                 'storefront_homepage_content',                  90 );
