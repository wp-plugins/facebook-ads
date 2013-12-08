<?php
  /* Actions */
  /*-----------------------------------------------------------*/
  add_action( 'admin_init', 'facebook_ads_init' );


  /* Callbacks */
  /*-----------------------------------------------------------*/
  function facebook_ads_init()
  {
    wp_register_style( "FacebookAdsMainCss", plugins_url("assets/css/facebook-ads-main.css", __FILE__) );
    wp_register_script( "FacebookAdsMainJS", plugins_url("assets/js/facebook-ads-main.js", __FILE__) );
  }
?>