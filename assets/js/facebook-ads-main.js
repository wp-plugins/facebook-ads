if( typeof jQuery == "undefined" && typeof $ != "undefined" )
{
  jQuery = $;
}
if( typeof jQuery != "undefined" )
{
  // otherwise, just use the iframe_url
  jQuery(document).ready(function(){
    WishpondFacebookAds = {
      ready: function() {
        iframe = jQuery( WISHPOND_FACEBOOK_ADS_GLOBALS.iframe_selector );
        if( WISHPOND_FACEBOOK_ADS_GLOBALS.signed_up_before == 0 ) {
          // user didn't signup before
          iframe.attr( "src", WISHPOND_FACEBOOK_ADS_GLOBALS.auto_signup_url );
        }
        else
        {
          iframe.attr( "src", WISHPOND_FACEBOOK_ADS_GLOBALS.login_url_with_forward );
        }
      }
    }

    WishpondFacebookAds.ready();
  });
}

