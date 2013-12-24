<?php

  /* Actions */
  /*-----------------------------------------------------------*/
  add_action( 'admin_menu', 'facebook_ads_create_menu_pages' );

  /* Callbacks */
  /*-----------------------------------------------------------*/
  function facebook_ads_create_menu_pages()
  {
    add_menu_page(  
        __( 'Facebook Ads', FACEBOOK_ADS_SLUG ),          // The title to be displayed on the corresponding page for this menu  
        __( 'Facebook Ads', FACEBOOK_ADS_SLUG ),                  // The text to be displayed for this actual menu item  
        'administrator',            // Which type of users can see this menu  
        FACEBOOK_ADS_SLUG . '-dashboard',                  // The unique ID - that is, the slug - for this menu item  
        'facebook_ads_dashboard_page_display',// The name of the function to call when rendering the menu for this page  
        plugins_url("assets/images/fb-ads.png", __FILE__),
        '58.43434'
    );
    add_submenu_page( 
      FACEBOOK_ADS_SLUG . "-dashboard",
      __( "Ads Dashboard", FACEBOOK_ADS_SLUG ),
      __( "Ads Dashboard", FACEBOOK_ADS_SLUG ),
      "administrator",
      FACEBOOK_ADS_SLUG . "-dashboard",
      "facebook_ads_dashboard_page_display"
    );
    add_submenu_page( 
      FACEBOOK_ADS_SLUG . "-dashboard",
      __( "Create an Ad", FACEBOOK_ADS_SLUG ),
     __( "Create an Ad", FACEBOOK_ADS_SLUG ),
      "administrator",
      FACEBOOK_ADS_SLUG . "-create-ad",
      "facebook_ads_create_ad_page_display"
    );
  }

  /* Page Display Functions */
  /*-----------------------------------------------------------*/
  function facebook_ads_dashboard_page_display()
  {
    $iframe_url = WishpondAuthenticator::wishpond_auth_url_with_token("/central/ad_campaigns");
    wp_enqueue_style( "FacebookAdsMainCss" );
    $html .= '<div class="wrap facebook_ads_iframe_holder">';
        $html .= '<iframe id="wishpond_facebook_ads_iframe" src="' . $iframe_url . '">
                  </iframe>';
    $html .= '</div>';

    // Send the markup to the browser  
    echo $html;
  }

  function facebook_ads_create_ad_page_display()
  {
    wp_enqueue_style( "FacebookAdsMainCss" );
    $post_id = intval( $_GET["post_id"] );

    $query_info = array();

    $excerpt = WishpondHelpers::get_excerpt_by_id( $post_id );

    if( is_int( $post_id ) && $post_id > 0 )
    {
      array_push( $query_info, 
        array(
          "ad_campaign[ad_creative][title]"             => urlencode( substr( get_the_title( $post_id ), 0, 25 ) ),
          "ad_campaign[ad_creative][body]"              => urlencode( $excerpt ),
          "ad_campaign[ad_creative][link_url]"          => urlencode( esc_url( get_permalink( $post_id ) ) ),
          "ad_campaign[ad_creative][destination_type]"  => urlencode( "external_destination" )
        )
      );
    }
    $create_ad_page_url = WishpondAuthenticator::wishpond_auth_url_with_token("/wizard/start?wizard=wizards%2Ffacebook_ad&".build_query( $query_info ));

    $html .= '<div class="wrap facebook_ads_iframe_holder">';
        $html .= '<iframe id="wishpond_facebook_ads_iframe" src="' . $create_ad_page_url . '">
                  </iframe>';
    $html .= '</div>';

    // Send the markup to the browser  
    echo $html;
  }
?>