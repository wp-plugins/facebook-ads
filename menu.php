<?php

  /* Actions */
  /*-----------------------------------------------------------*/
  add_action( 'admin_menu', 'facebook_ads_create_menu_pages' );

function my_action_callback() {
  global $wpdb; // this is how you get access to the database

  $whatever = intval( $_POST['whatever'] );

  $whatever += 10;

        echo $whatever;

  die(); // this is required to return a proper result
}

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
    $iframe_url = urlencode( WISHPOND_SITE_URL . "central/ad_campaigns" );

    set_javascript_globals( array( "iframe_url" => $iframe_url ) );
    wp_enqueue_script( "FacebookAdsMainJS" );
    wp_enqueue_style( "FacebookAdsMainCss" );
    $html .= '<div class="wrap facebook_ads_iframe_holder">';
        $html .= '<iframe id="wishpond_facebook_ads_iframe" src="">
                  </iframe>';
    $html .= '</div>';

    // Send the markup to the browser  
    echo $html;
  }

  function facebook_ads_create_ad_page_display()
  {
    $post_id = intval( $_GET["post_id"] );

    $query_info = array();

    $excerpt = WishpondHelpers::get_excerpt_by_id( $post_id );

    if( is_int( $post_id ) && $post_id > 0 )
    {
      array_push( $query_info, 
        array(
          "ad_campaign[ad_creative][title]"             => urlencode( get_the_title( $post_id ) ),
          "ad_campaign[ad_creative][body]"              => urlencode( $excerpt ),
          "ad_campaign[ad_creative][link_url]"          => urlencode( esc_url( get_permalink( $post_id ) ) ),
          "ad_campaign[ad_creative][destination_type]"  => urlencode( "external_destination" )
        )
      );
    }

    $iframe_url = urlencode( WISHPOND_SITE_URL . "wizard/start?wizard=wizards%2Ffacebook_ad&".build_query( $query_info ) );

    set_javascript_globals( array( "iframe_url" => $iframe_url ) );
    wp_enqueue_script( "FacebookAdsMainJS" );
    wp_enqueue_style( "FacebookAdsMainCss" );

    $html .= '<div class="wrap facebook_ads_iframe_holder">';
        $html .= '<iframe id="wishpond_facebook_ads_iframe" src="">
                  </iframe>';
    $html .= '</div>';

    // Send the markup to the browser  
    echo $html;
  }

  function set_javascript_globals( $globals )
  {
    $signed_up_before = ( WishpondStorage::get( WISHPOND_FACEBOOK_ADS_SIGNUP_OPTION ) == false) ? 0 : 1;
    $login_url = WISHPOND_LOGIN_URL . "&redirect_to=" . $globals["iframe_url"];
    $login_url = WishpondHelpers::add_wishpond_params($login_url);

    $auto_signup_url = WISHPOND_AUTO_SIGNUP_URL . "&redirect_to=" . $globals["iframe_url"];
    $auto_signup_url = WishpondHelpers::add_wishpond_params($auto_signup_url);

    $globals = array_merge( $globals, array(
      "login_url_with_forward"  => $login_url,
      "auto_signup_url"         => $auto_signup_url,
      "iframe_selector"         => "#wishpond_facebook_ads_iframe",
      "signed_up_before"        => $signed_up_before
    ) );
    echo "<script type='text/javascript'>";
    echo "WISHPOND_FACEBOOK_ADS_GLOBALS = {";
    $first = true;
    foreach($globals as $key => $value)
    {
      // output commas
      if( $first )
      {
        $first = false;
      }
      else
      {
        echo ",";
      }

      echo $key . ": ";

      // output booleans without quotes
      if( $value === false || $value === true )
      {
        echo $value . "\n";
      }
      else
      {
        echo "'". $value . "'\n"; 
      }
    }
    echo "}";
    echo "</script>";

    if( $signed_up_before == 0 )
    {
      WishpondStorage::add( WISHPOND_FACEBOOK_ADS_SIGNUP_OPTION, true );
    }
  }
?>