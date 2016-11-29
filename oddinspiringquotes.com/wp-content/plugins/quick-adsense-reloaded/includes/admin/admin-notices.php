<?php
/**
 * Admin Notices
 *
 * @package     QUADS
 * @subpackage  Admin/Notices
 * @copyright   Copyright (c) 2015, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.9
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) )
    exit;

/**
 * Admin Messages
 *
 * @since 2.2.3
 * @global $mashsb_options Array of all the MASHSB Options
 * @return void
 */
function quads_admin_messages() {
    global $quads_options;

    if( !current_user_can( 'update_plugins' ) ){
        return;
    }
    
    quads_theme_notice();

    //quads_plugin_deactivated_notice();
    
    $install_date = get_option( 'quads_install_date' );
    $display_date = date( 'Y-m-d h:i:s' );
    $datetime1 = new DateTime( $install_date );
    $datetime2 = new DateTime( $display_date );
    $diff_intrval = round( ($datetime2->format( 'U' ) - $datetime1->format( 'U' )) / (60 * 60 * 24) );
    if( $diff_intrval >= 7 && get_option( 'quads_rating_div' ) == "no" ) {
        echo '<div class="quads_fivestar updated" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);background-color:white;">
    	<p>Awesome, you\'ve been using <strong>WP QUADS</strong> for more than 1 week. <br> May i ask you to give it a <strong>5-star rating</strong> on Wordpress? </br>
        This will help to spread its popularity and to make this plugin a better one.
        <br><br>Your help is much appreciated. Thank you very much,<br> ~René Hermenau
        <ul>
            <li><a href="https://wordpress.org/support/plugin/quick-adsense-reloaded/reviews/?filter=5#new-post" class="thankyou" target="_new" title="Ok, you deserved it" style="font-weight:bold;">Ok, you deserved it</a></li>
            <li><a href="javascript:void(0);" class="quadsHideRating" title="I already did" style="font-weight:bold;">I already did</a></li>
            <li><a href="javascript:void(0);" class="quadsHideRating" title="No, not good enough" style="font-weight:bold;">No, not good enough, i do not like to rate it!</a></li>
        </ul>
    </div>
    <script>
    jQuery( document ).ready(function( $ ) {

    jQuery(\'.quadsHideRating\').click(function(){
        var data={\'action\':\'quads_hide_rating\'}
             jQuery.ajax({
        
        url: "' . admin_url( 'admin-ajax.php' ) . '",
        type: "post",
        data: data,
        dataType: "json",
        async: !0,
        success: function(e) {
            if (e=="success") {
               jQuery(\'.quads_fivestar\').slideUp(\'fast\');
			   
            }
        }
         });
        })
    
    });
    </script>
    ';
    }
}

add_action( 'admin_notices', 'quads_admin_messages' );


/* Hide the rating div
 * 
 * @subpackage  Admin/Notices
 * @copyright   Copyright (c) 2016, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.9
 * 
 * @return json string
 * 
 */

function quads_hide_rating_div() {
    update_option( 'quads_rating_div', 'yes' );
    echo json_encode( array("success") );
    exit;
}
add_action( 'wp_ajax_quads_hide_rating', 'quads_hide_rating_div' );


/**
 * Show a message when pro or free plugin become disabled
 * 
 * @return void
 * @not used
 */
function quads_plugin_deactivated_notice() {
    if( false !== ( $deactivated_notice_id = get_transient( 'quads_deactivated_notice_id' ) ) ) {
        if( '1' === $deactivated_notice_id ) {
            $message = __( "WP QUADS and WP QUADS Pro cannot be activated both. We've automatically deactivated WP QUADS.", 'wpstg' );
        } else {
            $message = __( "WP QUADS and WP QUADS Pro cannot be activated both. We've automatically deactivated WP QUADS Pro.", 'wpstg' );
        }
        ?>
        <div class="updated notice is-dismissible" style="border-left: 4px solid #ffba00;">
            <p><?php echo esc_html( $message ); ?></p>
        </div> <?php
        delete_transient( 'quads_deactivated_notice_id' );
    }
}

/**
 * This notice is shown for user of the bimber and bunchy theme
 * 
 * Not used at the moment
 */
function quads_theme_notice(){
    
    $show_notice = get_option('quads_show_theme_notice');
    
        if( false !== $show_notice && 'no' !== $show_notice )  {
            $message = __( '<strong>Now is your chance to extend the <strong>' . quads_is_commercial_theme(). '</strong> theme with <strong>WP QUADS PRO!</strong> Save time and earn more - Bring your AdSense earnings to next level. <a href="http://wpquads.com?utm_campaign=adminnotice&utm_source=admin_notice&utm_medium=admin&utm_content=bimber_upgrade_notice" target="_blank"> Purchase Now</a> or <a href="http://wpquads.com?utm_campaign=free_plugin&utm_source=admin_notice&utm_medium=admin&utm_content=bimber_upgrade_notice" target="_blank">Get Details</a></strong>', 'quick-adsense-reloaded' );
        ?>
        <div class="updated notice is-dismissible" style="border-left: 4px solid #ffba00;">
            <p><?php echo $message; ?></p>
        </div> <?php
        update_option ('quads_show_theme_notice', 'no');
    }
}
