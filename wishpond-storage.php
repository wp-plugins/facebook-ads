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
  }
?>