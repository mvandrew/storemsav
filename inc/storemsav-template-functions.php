<?php
/**
 * Store MSAV theme functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( !function_exists('storemsav_before_site') ) {
	/**
	 * Before Site Hook
	 *
	 * @return void
	 */
	function storemsav_before_site() {

		StoreMsavCounters::get_instance()->yandex_metrika_code();
		StoreMsavCounters::get_instance()->google_analytics_code();
		StoreMsavCounters::get_instance()->mailru_counter_code();

		// storemsav_before_site
	}
}


if ( ! function_exists( 'storemsav_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since       2.2.4.1
   *
	 * @return      void
	 */
	function storemsav_credit() {
		?>
		<div class="site-info">
      <?php

      // Display Copyright Section
      if ( StoreMsav::get_instance()->show_copyright ) {

        $date = new DateTime();
        $cur_year = $date->format( 'Y' );

        echo '<div class="footer-credit">';
	      if ( $cur_year == StoreMsav::get_instance()->copyright_year ) {
		      printf( __('&copy; %1$s &mdash; <a href="%2$s">%3$s</a>, All Rights Reserved.', 'storemsav'),
              $cur_year,
              home_url(),
              StoreMsav::get_instance()->copyright_owner
          );
	      } else {
		      printf( __('&copy; %1$s-%2$s &mdash; <a href="%3$s">%4$s</a>, All Rights Reserved.', 'storemsav'),
              StoreMsav::get_instance()->copyright_year,
              $cur_year,
              home_url(),
              StoreMsav::get_instance()->copyright_owner
          );
	      }
	      echo '</div>';

      } else {
        echo esc_html(
		      apply_filters(
			      'storemsav_copyright_text',
			      $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' )
		      )
	      );
      }

			// Display Powered Section
			if ( !StoreMsav::get_instance()->hide_powered_link && apply_filters( 'storemsav_credit_link', true ) ) {
				printf(
					'<div class="footer-credit">' . esc_attr__( '%1$s modified by %2$s.', 'storemsav' ) . '</div>',
					'Store MSAV',
					sprintf(
						'<a href="http://www.msav.ru" title="%1$s" rel="author">%1$s</a>',
						esc_attr__( 'Andrey Mishchenko', 'storemsav' )
					)
				);
			}

			// Display Designed Site Link
			if ( StoreMsav::get_instance()->show_design_site_link ) {
			  printf(
			    '<div class="footer-credit"><a href="%1$s" title="%2$s" rel="author">%2$s</a>&nbsp;%3$s</div>',
          StoreMsav::get_instance()->design_site_url,
          StoreMsav::get_instance()->design_site_label,
          StoreMsav::get_instance()->design_site_alias
        );
      }

			?>
		</div><!-- .site-info -->
		<?php

		// storemsav_credit
	}
}


if ( ! function_exists( 'storemsav_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since       2.2.4.1
   *
	 * @return      void
	 */
	function storemsav_site_branding() {

	  echo '<div class="site-branding">';
	  storemsav_site_title_or_logo();
	  echo '</div>';

	  // storemsav_site_branding
	}
}

if ( ! function_exists( 'storemsav_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since       2.2.4.1
	 * @param       bool $echo Echo the string or return it.
   *
	 * @return      string
	 */
	function storemsav_site_title_or_logo( $echo = true ) {

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {

		  $logo = get_custom_logo();
			$html = $logo; // Removed H1 tag

		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {

			// Copied from jetpack_the_site_logo() function.
			$logo    = site_logo()->logo;
			$logo_id = get_theme_mod( 'custom_logo' ); // Check for WP 4.5 Site Logo
			$logo_id = $logo_id ? $logo_id : $logo['id']; // Use WP Core logo if present, otherwise use Jetpack's.
			$size    = site_logo()->theme_size();
			$html    = sprintf( '<a href="%1$s" class="site-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image(
					$logo_id,
					$size,
					false,
					array(
						'class'     => 'site-logo attachment-' . $size,
						'data-size' => $size,
						'itemprop'  => 'logo'
					)
				)
			);

			$html = apply_filters( 'jetpack_the_site_logo', $html, $logo, $size );

		} else {

			$tag = 'div'; // Removed H1 tag

			$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) .'>';

			if ( '' !== get_bloginfo( 'description' ) ) {
				$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
			}
		}

		if ( $echo ) {
		  echo $html;
    }

	  return $html;

		// storemsav_site_title_or_logo
	}
}


if ( !function_exists('storemsav_single_post_posted_on_html') ) {
	/**
   * Filtered posted date string
   *
   * @since       2.2.4.1
	 * @param       $output string
   *
   * @return      string
	 */
  function storemsav_single_post_posted_on_html( $output ) {

    if ( StoreMsav::get_instance()->hide_post_date ) {
      $output = '';
    }

    return $output;

    // storemsav_single_post_posted_on_html
  }
}


if ( !function_exists('storemsav_the_author_posts_link') ) {
	/**
   * Filtered post author link
   *
	 * @param $output string
	 *
	 * @return string
	 */
  function storemsav_the_author_posts_link( $output ) {

    return $output;

    // storemsav_the_author_posts_link
  }
}


if ( ! function_exists( 'storemsav_post_meta' ) ) {
	/**
	 * Display the post meta
   *
   * @since       2.2.4.1
	 *
	 * @return      void
	 */
	function storemsav_post_meta() {

	  echo '<aside class="entry-meta">';

	  // Hide category and tag text for pages on Search.
	  if ( 'post' == get_post_type() ) {

	    /**
	     * Hide post author
	     */
	    if ( ! StoreMsav::get_instance()->hide_post_author ) {
		    echo '<div class="entry-meta-item author">';
		    echo get_avatar( get_the_author_meta( 'ID' ), 128 );
		    echo '<div class="label">' . esc_attr( __( 'Written by', 'storemsav' ) ) . '</div>';
		    the_author_posts_link();
		    echo '</div>';
	    }

	    /**
	     * Translators: used between list items, there is a space after the comma
	     */
	    $categories_list = get_the_category_list( __( ', ', 'storemsav' ) );

	    if ( $categories_list ) {
		    echo '<div class="entry-meta-item cat-links">';
		    echo '<div class="label">' . esc_attr( __( 'Posted in', 'storemsav' ) ) . '</div>';
		    echo wp_kses_post( $categories_list );
		    echo '</div>';
		    // End if categories.
	    }

	    /**
	     * Translators: used between list items, there is a space after the comma
	     */
	    $tags_list = get_the_tag_list( '', __( ', ', 'storemsav' ) );

	    if ( $tags_list ) {
		    echo '<div class="entry-meta-item tags-links">'
		         . '<div class="label">' . esc_attr( __( 'Tagged', 'storemsav' ) ) . '</div>'
		         . wp_kses_post( $tags_list )
		         . '</div>';
		    // End if $tags_list.
	    }

	    // End if 'post' == get_post_type()
    }

    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
	    echo '<div class="entry-meta-item comments-link">'
	         . '<div class="label">' . esc_attr( __( 'Comments', 'storemsav' ) ) . '</div>'
	         . '<span class="comments-link">';
	    comments_popup_link( __( 'Leave a comment', 'storemsav' ), __( '1 Comment', 'storefront' ), __( '% Comments', 'storemsav' ) );
	    echo '</span>'
           . '</div>'
	         . '</aside>';
    }

    // storemsav_post_meta
	}
}


if ( !function_exists('storemsav_footer_widgets') ) {
	/**
	 * Display the footer widget regions.
   *
   * @since       2.2.4.1
   *
   * @return      void
	 */
  function storemsav_footer_widgets() {

    if ( is_active_sidebar('footer-full-width') ) {
      echo '<div class="block footer-widget-full-width">';
      dynamic_sidebar( 'footer-full-width' );
      echo '</div>';
    }

    // storemsav_footer_widgets
  }
}



if ( ! function_exists( 'storemsav_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @var         string $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses        has_post_thumbnail()
	 * @uses        the_post_thumbnail
	 * @param       string $size the post thumbnail size.
	 * @since       2.2.4.1
   * @return      void
	 */
	function storemsav_post_thumbnail( $size = 'full' ) {

	  if ( has_post_thumbnail() && is_single() ) {
	    // Display post thumbnail without a post link
			the_post_thumbnail( $size );
		} elseif ( has_post_thumbnail() ) {
	    printf( '<a href="%s" rel="bookmark">', esc_url(get_permalink()) );
	    the_post_thumbnail( $size );
	    echo '</a>';
    }

		// storemsav_post_thumbnail
	}
}

if ( ! function_exists( 'storemsav_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 *
     * @see WC_Shortcodes::sale_products()
     * @see storefront_do_shortcode()
     *
	 * @param array $args the product section args.
	 * @since  1.1.5
	 * @return void
	 */
	function storemsav_on_sale_products( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storemsav_on_sale_products_args', array(
				'limit'     => 8,
				'columns'   => 4,
				'title'     => __( 'On Sale', 'storefront' ),
				'orderby'   => 'rand'
			) );

			$shortcode_content = storefront_do_shortcode( 'sale_products', apply_filters( 'storefront_on_sale_products_shortcode_args', array(
				'per_page'  => intval( $args['limit'] ),
				'columns'   => intval( $args['columns'] ),
				'orderby'   => $args['orderby']
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-on-sale-products" aria-label="' . esc_attr__( 'On Sale Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_on_sale_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_on_sale_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_on_sale_products' );

				echo '</section>';

			}
		}
	} // storemsav_on_sale_products
}


if ( ! function_exists( 'storemsav_best_selling_products' ) ) {
	/**
	 * Display Best Selling Products
	 * Hooked into the `homepage` action in the homepage template
	 *
     * @see WC_Shortcodes::best_selling_products()
     * @see storefront_do_shortcode()
     *
	 * @since 1.1.5
	 * @param array $args the product section args.
	 * @return void
	 */
	function storemsav_best_selling_products( $args ) {
		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storemsav_best_selling_products_args', array(
				'limit'     => 4,
				'columns'   => 4,
				'title'	    => esc_attr__( 'Best Sellers', 'storemsav' ),
				'orderby'   => 'rand'
			) );

			$shortcode_content = storefront_do_shortcode( 'best_selling_products', apply_filters( 'storefront_best_selling_products_shortcode_args', array(
				'per_page'  => intval( $args['limit'] ),
				'columns'   => intval( $args['columns'] ),
				'orderby'   => $args['orderby']
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-best-selling-products" aria-label="' . esc_attr__( 'Best Selling Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_best_selling_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_best_selling_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_best_selling_products' );

				echo '</section>';

			}
		}
	} // storemsav_best_selling_products
}


if ( ! function_exists( 'storemsav_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 *
     * @see WC_Shortcodes::product_categories()
     * @see storefront_do_shortcode()
     *
	 * @since  1.1.5
	 * @param array $args the product section args.
	 * @return void
	 */
	function storemsav_product_categories( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_product_categories_args', array(
				'limit' 			=> 9,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> __( 'Shop by Category', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'product_categories', apply_filters( 'storefront_product_categories_shortcode_args', array(
				'number'  => intval( $args['limit'] ),
				'columns' => intval( $args['columns'] ),
				'orderby' => esc_attr( $args['orderby'] ),
				'parent'  => esc_attr( $args['child_categories'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns product categories
			 */
			if ( false !== strpos( $shortcode_content, 'product-category' ) ) {

				echo '<section class="storefront-product-section storefront-product-categories" aria-label="' . esc_attr__( 'Product Categories', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_product_categories' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_product_categories_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_product_categories' );

				echo '</section>';

			}
		}
	} // storemsav_product_categories
}