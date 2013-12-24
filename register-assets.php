<?php
  /* Actions */
  /*-----------------------------------------------------------*/
  add_action('admin_init', 'facebook_ads_init');


  /* Callbacks */
  /*-----------------------------------------------------------*/
  function facebook_ads_init() {
    wp_register_style("FacebookAdsMainCss", plugins_url("assets/css/facebook-ads-main.css", __FILE__));
  }
?>