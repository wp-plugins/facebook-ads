<?php
  /**
   * Plugin Name: Facebook Ads
   * Plugin URI: http://wishpond.com
   * Description: This plugins lets you easily create facebook ads directly from your Wordpress instance using the Wishpond Facebook Ads interface to automatically optimize your ads with the knowledge of social media experts.
   * Version: 1.0
   * Author: Wishpond
   * Text Domain: facebook-ads
   * Author URI: http://wishpond.com
   * License: GNU General Public License version 2.0 (GPL-2.0)
   */

  /*  Copyright 2013 Wishpond  ( email : support@wishpond.com )

      This program is free software; you can redistribute it and/or modify
      it under the terms of the GNU General Public License, version 2, as 
      published by the Free Software Foundation.

      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
      GNU General Public License for more details.

      You should have received a copy of the GNU General Public License
      along with this program; if not, write to the Free Software
      Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */

  /*
  * Wishpond Globals
  */
  define('WISHPOND_SITE_URL', 'https://www.wishpond.com/');
  define('WISHPOND_LOGIN_URL', WISHPOND_SITE_URL . "session/new?i=" . urlencode( WISHPOND_SITE_URL . "/login" ));
  define('WISHPOND_AUTO_SIGNUP_URL', WISHPOND_SITE_URL . "central/merchant_signups/new?");
  /*
  * Wishpond Ads
  */
  define('WISHPOND_FACEBOOK_ADS_VERIFY_SIGNUP_URL', WISHPOND_SITE_URL . "central/dashboard");
  define('WISHPOND_FACEBOOK_ADS_SIGNUP_OPTION', "wishpond_facebook_ads_signup_option");

  define('WISHPOND_', WISHPOND_SITE_URL . "central/dashboard");
  define( 'FACEBOOK_ADS_DIR', plugin_dir_path( __FILE__ ) );
  define( 'FACEBOOK_ADS_SLUG', "facebook-ads" );

  /*
  * List & Load plugin files
  */
  $PLUGIN_FILES = array(
    "wishpond-storage.php",
    "wishpond-helpers.php",
    "register-assets.php",
    "menu.php",
    "meta-boxes.php"
  );

  foreach( $PLUGIN_FILES as $file )
  {
    load_file( $file );
  }

  function load_file( $file )
  {
    include_once FACEBOOK_ADS_DIR . $file;
  }
?>