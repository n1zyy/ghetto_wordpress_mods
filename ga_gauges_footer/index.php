<?php
/*
Plugin Name: n1zyy.com Site Tracking Code
Plugin URI: http://blogs.n1zyy.com
Description: Please keep enabled for statistics
Author: Matt
Version: 1.0
Author URI: http://blogs.n1zyy.com
 */

add_action('wp_head', 'header_insert_insert_code');

function header_insert_insert_code()
{
$ga = <<<EOF
<!-- test -->
<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
        <script type="text/javascript">
try {
        var pageTracker = _gat._getTracker("UA-319326-3");
        pageTracker._trackPageview();
} catch(err) {}</script>
<!-- End Google Analytics -->
EOF;

$q = <<<EOF
<!-- Quantcast tracking for blogs.n1zyy.com -->
<!-- Start Quantcast tag -->
<script type="text/javascript">
_qoptions={
        qacct:"p-b5Sv_dFEn3bcE"
};
</script>
        <script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>
<noscript>
<img src="http://pixel.quantserve.com/pixel/p-b5Sv_dFEn3bcE.gif" style="display: none;" border="0" height="1" width="1" alt="Quantcast"/>
</noscript>
<!-- End Quantcast tag -->
EOF;

$cb = <<<EOF
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
EOF;

//echo "$cb\n$ga\n$q\n";
echo "$ga";
}

add_action('wp_footer', 'footer_insert_code');
function footer_insert_code()
{
$gauges = <<<EOF
<!-- gaug.es support: see Matt for access -->
<script type="text/javascript">
  var _gauges = _gauges || [];
  (function() {
    var t   = document.createElement('script');
    t.type  = 'text/javascript';
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '4fbaea57f5a1f56c9d000016');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>
<!-- / gaug.es -->
EOF;
echo "$gauges";
}
?>