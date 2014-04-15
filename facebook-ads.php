<?php
  /**
   * Plugin Name: Facebook Ads
   * Plugin URI: http://corp.wishpond.com/facebook-ads-tool/
   * Description: Creating Facebook Ads from your Wordpress has never been easier.
   * Version: 1.1
   * Author: Wishpond
   * Text Domain: facebook-ads
   * Author URI: http://corp.wishpond.com
   * License: GNU General Public License version 2.0 (GPL-2.0)
   */

  /*  Copyright 2014 Wishpond  ( email : support@wishpond.com )

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

  if ( ! defined( 'WISHPOND_SITE_URL' ) )
  {
    define('WISHPOND_SITE_URL', "https://www.wishpond.com");
  }
  
  if ( ! defined( 'WISHPOND_SIGNUP_URL' ) )
  {
    define('WISHPOND_SIGNUP_URL', WISHPOND_SITE_URL . "/central/merchant_signups/new/");
  }

  # Used for authenticating every request, and redirecting to the proper location on central
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_AUTH_WITH_TOKEN_URL' ) )
  {
    define('WISHPOND_FACEBOOK_ADS_AUTH_WITH_TOKEN_URL', WISHPOND_SITE_URL . "/central/sessions/auth_with_wordpress");
  }
  
  if ( ! defined( 'WISHPOND_FACEBOOK_ADS_GET_AUTH_TOKEN_URL' ) )
  {
    define('WISHPOND_FACEBOOK_ADS_GET_AUTH_TOKEN_URL', WISHPOND_SITE_URL.'/central/sessions/get_wordpress_auth_token');
  }

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
    /* What we use to store options in wordpress */
    "wishpond-storage.php",
    "wishpond-helpers.php",
    /* A pseudo-model used for authentication */
    "wishpond-key.php",
    /* The class that performs the authentication */
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