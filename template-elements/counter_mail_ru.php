<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?><!-- Rating@Mail.ru counter -->
<script type="text/javascript">
  var _tmr = window._tmr || (window._tmr = []);
  _tmr.push({id: "<?php echo StoreMsavCounters::get_instance()->mailru_id; ?>", type: "pageView", start: (new Date()).getTime()});
  (function (d, w, id) {
    if (d.getElementById(id)) return;
    var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
    ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
    var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
    if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
  })(document, window, "topmailru-code");
</script><noscript><div>
		<img src="//top-fwz1.mail.ru/counter?id=<?php echo StoreMsavCounters::get_instance()->mailru_id; ?>;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
	</div></noscript>
<!-- //Rating@Mail.ru counter -->
