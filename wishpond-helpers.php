<?php
  class WishpondHelpers
  {
    /* 
    * attempts to create an automatic account once for this wordpress installation
    * if Wishpond refuses the auto-signup and current user isn't logged in,
    * the default signup/login page will be displayed
    */
    public static function add_wishpond_params( $url )
    {
      if( WishpondStorage::get( WISHPOND_FACEBOOK_ADS_SIGNUP_OPTION ) == false )
      {
        $url = self::add_url_param( $url, "email", get_option( "admin_email" ) );
        $url = self::add_url_param( $url, "key", self::random_key() );
      }
      $url = self::add_url_param( $url, "referral", "wordpress" );
      $url = self::add_url_param( $url, "type", "wp_ads" );
      $url = self::add_url_param( $url, "utm_campaign", "ads" );
      $url = self::add_url_param( $url, "utm_source", "integration" );
      $url = self::add_url_param( $url, "utm_medium", "wordpress" );
      $url = self::add_url_param( $url, "from_corp", "true" );
      $url = self::add_url_param( $url, "autologin", "true" );
      $url = self::add_url_param( $url, "plain", "true" );
      return $url;
    }

    /* Gets a randomly generated string that can be used as a user key */
    public static function random_key()
    {
      $hashed_string  = urlencode( php_uname( "n" ) );
      $hashed_string .= site_url();
      $hashed_string .= self::get_random_string( mt_rand( 30,40 ) );
      $hashed_string .= microtime();
      $key = hash( 'sha512', $hashed_string );
      return substr( $key, mt_rand( 0,50 ), mt_rand( 30,50 ) );
    }

    /* Gets a randomly generated string */
    public static function get_random_string( $length=16 )
    {
      list( $usec, $sec ) = explode( ' ', microtime() );
      mt_srand( ( float ) $sec + ( (float ) $usec * 100000 ) );
      $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*():;{}[]|+=-_<>?/~`";//length:89
      $final_rand='';
      for( $i=0;$i<$length; $i++ )
      {
        $final_rand .= $chars[ mt_rand( 0,strlen($chars )-1)];
      }
      return $final_rand;
    }

    public static function get_excerpt_by_id( $post_id )
    {
      $the_post = get_post( $post_id ); //Gets post ID

      $the_excerpt = get_the_excerpt( $post_id );

      if( $the_excerpt == '' )
      {
        $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
      }

      $excerpt_length = 90; //Set excerpt length by string length

      $the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); //Strips tags and images

      $the_excerpt = substr( $the_excerpt, 0, $excerpt_length );

      return $the_excerpt;
    }

    public static function add_url_param( $url, $param, $value )
    {
      $position_of_question_mark = strpos( $url, "?" );

      // no question mark in url
      if( $position_of_question_mark == false )
      {
        $url .= "?";
      }
      // question mark not at end of url => some params already sent
      else if ( $position_of_question_mark < strlen( $url ) - 1 )
      {
        $url .= "&amp;";
      }

      $url .= urlencode( $param ) . "=" . urlencode( $value );
      return $url;
    }
  }
?>