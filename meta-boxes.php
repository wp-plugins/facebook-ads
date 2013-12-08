<?php

  /* Actions */
  /*-----------------------------------------------------------*/
  add_action( 'add_meta_boxes', 'facebook_ads_add_custom_boxes' );

  /* Callbacks */
  /*-----------------------------------------------------------*/
  function facebook_ads_add_custom_boxes()
  {
    $screens = array( 'post', 'page' );

      foreach ( $screens as $screen )
      {
        add_meta_box(
              'facebook-ads-custom-box-bottom',
              __( "Facebook Ads", FACEBOOK_ADS_SLUG ),
              'facebook_ads_bottom_custom_box',
              $screen
          );
      }

      foreach ( $screens as $screen )
      {
        add_meta_box (
            'facebook-ads-custom-box-side',
            __( "Facebook Ads", FACEBOOK_ADS_SLUG ),
            'facebook_ads_side_custom_box',
            $screen,
            'side',
            'high'
          );
      }
  }

  /* Helpers */
  /*-----------------------------------------------------------*/

  /**
   * Prints the box content.
   * 
   * @param WP_Post $post The object for the current post/page.
   */
  function facebook_ads_bottom_custom_box( $post )
  {
    $linkdata = array(
      'create' => array (
        'link_name' => __( 'Create a Facebook Ad for this ' . $post->post_type, FACEBOOK_ADS_SLUG ),
        'link_url' => admin_url( "admin.php?page=" . FACEBOOK_ADS_SLUG . "-create-ad&amp;post_id=" . $post->ID )
        ),
      'manage' => array (
        'link_name' => __( "Ads Dashboard", FACEBOOK_ADS_SLUG ),
        'link_url' => admin_url( "admin.php?page=" . FACEBOOK_ADS_SLUG . "-dashboard" )
      ),
    );

    echo "<a href='" . $linkdata["create"]["link_url"] . "' class='button'>" . $linkdata["create"]["link_name"] . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href='" . $linkdata["manage"]["link_url"] . "'>" . $linkdata["manage"]["link_name"] . "</a>";
  }

  /**
   * Prints the box content.
   * 
   * @param WP_Post $post The object for the current post/page.
   */
  function facebook_ads_side_custom_box( $post )
  {
    $linkdata = array(
      'create' => array (
        'link_name' => __( 'Create a Facebook Ad for this ' . $post->post_type, FACEBOOK_ADS_SLUG ),
        'link_url' => admin_url( "admin.php?page=" . FACEBOOK_ADS_SLUG . "-create-ad&amp;post_id=" . $post->ID )
        ),
      'manage' => array (
        'link_name' => __( "Ads Dashboard", FACEBOOK_ADS_SLUG ),
        'link_url' => admin_url( "admin.php?page=" . FACEBOOK_ADS_SLUG . "-dashboard" )
      ),
    );

    echo "<a href='" . $linkdata["create"]["link_url"] . "' class='button'>" . $linkdata["create"]["link_name"] . "</a><br/><br/>";
    echo "<a href='" . $linkdata["manage"]["link_url"] . "'>" . $linkdata["manage"]["link_name"] . "</a>";
  }
?>