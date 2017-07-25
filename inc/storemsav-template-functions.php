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