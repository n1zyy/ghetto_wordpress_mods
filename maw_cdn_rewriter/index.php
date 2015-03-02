<?php
/**
 * @package maw_cdn_rewriter
 * @version 0.0
 */
/*
Plugin Name: MAW CDN Rewriter
Plugin URI: http://blogs.n1zyy.com/
Description: Tailored for blogs.n1zyy.com; rewrite static content to use a CDN for faster loading.
Author: Matt Wagner
Version: 0.0
Author URI: http://ma.ttwagner.com/
*/

function sub_cdn($content='') {
    ob_start(function($content){
      $source = '/http:\/\/blogs.n1zyy.com\/(\w+)\/wp-content/';
      $rep = '//d1uwqsybio33ca.cloudfront.net/$1/wp-content';
      $f = preg_replace($source, $rep, $content);

      $source = '/http:\/\/blogs.n1zyy.com/';
      $rep = '';
      return preg_replace($source, $rep, $f);
    });

    //return preg_replace($source, $rep, $content);
}

add_action('template_redirect', 'sub_cdn');

?>