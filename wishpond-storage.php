<?php
  /**
   * Used to store information and extract information from wordpress
   */
  class WishpondStorage
  {
    public static function add( $name, $value, $autoload = 'no' )
    {
      add_option( $name, $value, '', $autoload );
    }

    public static function get( $name, $default = false )
    {
      return get_option( $name, $default );
    }

    public static function delete( $name )
    {
      delete_option( $name );
    }

    public static function get_admin_email()
    {
      return WishpondStorage::get( 'admin_email' );
    }

    public static function set_first_visit()
    {
      self::disable_first_visit();
      add_option( FACEBOOK_ADS_FIRST_VISIT, true );
    }

    public static function is_first_visit()
    {
      return get_option( FACEBOOK_ADS_FIRST_VISIT );
    }

    public static function disable_first_visit()
    {
      delete_option( FACEBOOK_ADS_FIRST_VISIT );
    }
  }
?>