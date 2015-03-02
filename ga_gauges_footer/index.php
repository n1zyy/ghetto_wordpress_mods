<?php
/*
Plugin Name: n1zyy.com Site Tracking Code
Plugin URI: http://blogs.n1zyy.com
Description: Please keep enabled for statistics
Author: Matt
Version: 1.0
Author URI: http://blogs.n1zyy.com
 */



// This calls wp_head to insert code into the header.
// Note that there's an analagous wp_footer for stuff
// that isn't async.


// Add our custom action to the chain:
add_action('wp_head', 'header_insert_insert_code');


// And our custom method:
function header_insert_insert_code()
{
$ga = <<<EOF
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

echo "$ga";
}


?>