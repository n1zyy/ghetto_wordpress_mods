<?php
/**
 * @package h8spam
 */
/*
Plugin Name: h8spam
Plugin URI: http://ma.ttwagner.com/
Description: Experimental comment spam protection
Version: 0.0.1
Author: Matt Wagner
Author URI: http://ma.ttwagner.com/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('H8SPAM_VERSION', '0.0.1');
define('H8SPAM_PLUGIN_URL', plugin_dir_url( __FILE__ ));

function h8spam_fields($fields) {
  echo <<<EOF
<div style="display: none;">
 <input type="hidden" id="h8spam_f1" name="h8spam_f1" value="init">
</div>
<script type="text/javascript">
var f1 = document.getElementById('h8spam_f1');
f1.value = navigator.language;
</script>
EOF;
}

function h8spam_remote_post($comment_id, $comment) {
  //
  $resp = wp_remote_post('http://localhost:9292/api/comments', array(
          'method' => 'POST',
          'timeout' => 15,
          'redirection' => 2,
          'httpversion' => '1.0',
          'blocking' => true,
          'headers' => array(),
          'body' => array(
                     'wp_comment' => json_encode($comment),
                     'http_headers' => json_encode(apache_request_headers()),
                     'blog_id' => 'blogs.n1zyy.com'
                    ),
           'cookies' => array()
          ));
}

function h8spam_email($comment_id, $comment) {
$text = <<<EOF
A new comment has been submitted!

Username:   $comment->comment_author
Email:      $comment->comment_author_email
URL:        $comment->comment_author_url

IP address: $comment->user_ip
IP address: $comment->comment_as_submitted

IP address: {$comment_data["comment_as_submitted"]["user_ip"]}
User agent: {$comment_data["comment_as_submitted"]["user_agent"]}

EOF;
/*
{$comment_data["comment_content"]}

Akismet nonce: {$comment_data["akismet_comment_nonce"]}
Akismet result: {$comment_data["akismet_result"]}

HTTP headers:
EOF;
*/
$text .= json_encode(apache_request_headers());
$text .= "\n\n";
$text .= json_encode($comment);

	//mail('me@example.com', "New comment from pre_comment_approved", $text);
	return $approved;
}

add_action('comment_form_after_fields', 'h8spam_fields');
#add_action( 'wp_insert_comment' , 'h8spam_email' , 999, 2 );
add_action( 'wp_insert_comment' , 'h8spam_remote_post' , 999, 2 );
# Seems this only fires for logged-out users;
# http://wordpress.stackexchange.com/questions/24116/using-filter-to-add-additional-fields-to-comment-form
# covers logged-in too

?>