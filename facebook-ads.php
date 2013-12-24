<?php
  /**
   * Plugin Name: Facebook Ads
   * Plugin URI: http://wishpond.com
   * Description: This plugin lets you create Ads on Facebook that drive new customers. Promote your posts and pages on Facebook directly from your Wordpress admin.
   * Version: 1.1
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
  define('WISHPOND_SITE_URL', "https://www.wishpond.com");
  define('WISHPOND_SIGNUP_URL', WISHPOND_SITE_URL . "/central/merchant_signups/new/");

  # Used for authenticating every request, and redirecting to the proper location on central
  define('WISHPOND_FACEBOOK_ADS_AUTH_WITH_TOKEN_URL', WISHPOND_SITE_URL."/auth_with_wordpress");
  define('WISHPOND_FACEBOOK_ADS_GET_AUTH_TOKEN_URL', WISHPOND_SITE_URL.'/get_wordpress_auth_token');

  /*
  * Wishpond Ads
  */
  if ( ! defined( 'FACEBOOK_ADS_DIR' ) )
  {
    define( 'FACEBOOK_ADS_DIR', plugin_dir_path( __FILE__ ) );
  }
  if ( ! defined( 'FACEBOOK_ADS_SLUG' ) )
  {
    define( 'FACEBOOK_ADS_SLUG', "facebook-ads" );
  }
  if ( ! defined( 'FACEBOOK_ADS_ADMIN_EMAIL' ) )
  {
    define( 'FACEBOOK_ADS_ADMIN_EMAIL', FACEBOOK_ADS_SLUG."-admin-email" );
  }
  if ( ! defined( 'FACEBOOK_ADS_FIRST_VISIT' ) )
  {
    define( 'FACEBOOK_ADS_FIRST_VISIT', FACEBOOK_ADS_SLUG."-first-visit" );
  }

  /*
  * Authentication Keys
  */
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_MASTER_TOKEN' ) )
  {
    define('WISHPOND_FACEBOOK_ADS_MASTER_TOKEN', 'wishpond_facebook_ads_master_token');
  }
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_AUTH_TOKEN' ) )
  {
    define('WISHPOND_FACEBOOK_ADS_AUTH_TOKEN', 'wishpond_facebook_ads_auth_token');
  }
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_AUTH_TOKEN_EXPIRY' ) )
  {
    define('WISHPOND_FACEBOOK_ADS_AUTH_TOKEN_EXPIRY', 'wishpond_facebook_ads_auth_token_expiry');
  }
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_AUTH_TOKEN_TTL' ) )
  {
    define( 'WISHPOND_FACEBOOK_ADS_AUTH_TOKEN_TTL', 300 ); // 5 minutes time to live - ttl on server = around 7 minutes
  }

  /*
  * List & Load plugin files
  */
  $PLUGIN_FILES = array(
    "wishpond-storage.php",
    "wishpond-helpers.php",
    "wishpond-key.php",
    "wishpond-authenticator.php",
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