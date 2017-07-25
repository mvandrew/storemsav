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