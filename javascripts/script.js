'use strict';

/**
 * Main theme script
 *
 * @author Andrey Mishchenko
 * @since 1.2.1
 */
(function ($) {

  $(document).ready(function () {
    /**
     * Match Height the product blocks
     */
    $('a.woocommerce-LoopProduct-link').matchHeight();
  });
})(jQuery);