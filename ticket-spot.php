<?php
/**
 * Plugin Name: Ticket Spot
 * Plugin URI:  https://github.com/Ticket-Spot/wordpress-app
 * Description: Calendars, ticketing, and automation to manage your events from start to finish.
 * Version:     1.0.1
 * Author:      Ticket Spot
 * Author URI:  https://www.ticketspot.io
 * Text Domain: ticket-spot
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('TICKET_SPOT_VERSION_NUM'))     define('TICKET_SPOT_VERSION_NUM', '1.0.0'); // Plugin version constant

/**
 * Add plugin version to database
 *
 * @refer https://codex.wordpress.org/Creating_Tables_with_Plugins#Adding_an_Upgrade_Function
 * @since 0.1.0
 */
update_option('abl_ticket_spot_version', TICKET_SPOT_VERSION_NUM);  // Change this to add_option if a release needs to check installed version.

// If this file is called directly, abort.
if (!defined('WPINC'))
{
    die;
}

/**
 * Enqueue widget script.
 */
function ticket_spot_widget_script()
{
    $js_to_load = 'https://api.ticketspot.io/script';
    wp_enqueue_script('ticket_spot_widget_script', esc_url($js_to_load), '', time() , true);
}

add_action('wp_head', 'ticket_spot_widget_script');

add_action('admin_enqueue_scripts', function ($hook)
{
    // only load scripts on dashboard and settings page
    global $ticketspot_settings_page;
    if ($hook != 'index.php' && $hook != $ticketspot_settings_page)
    {
        return;
    }
   
    $js_to_load = plugins_url('assets/app.js', __FILE__);
    
    wp_enqueue_script('ticket_spot_react', $js_to_load, '', time() , true);

});

add_action('admin_menu', function ()
{
    global $ticketspot_settings_page;
    $ticketspot_settings_page = add_options_page('Ticket Spot Settings', 'Ticket Spot', 'manage_options', 'ticket-spot-settings', 'ticket_spot_settings_do_page');
    // Draw the menu page itself
    function ticket_spot_settings_do_page()
    {
?>
	  <div id="ticket-spot-settings"></div>
	  <?php
    }

    // add link to settings on plugin page (next to "Deactivate")
    add_filter('plugin_action_links_' . plugin_basename(__FILE__) , function ($links)
    {
        $settings_link = '<a href="options-general.php?page=ticket-spot-settings">' . __('Settings') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    });
});

function ticket_spot_footer_text($default)
{
    // Retun default on non-plugin pages
    $screen = get_current_screen();
    if ($screen->id !== "settings_page_ticket-spot-settings")
    {
        return $default;
    }

    $ticketspot_footer_text = sprintf(__('Like this plugin? Please leave a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating to support continued development. Thanks!', 'ticket-spot') , 'https://wordpress.org/support/plugin/ticket-spot/reviews/?rate=5#new-post');

    return $ticketspot_footer_text;
}

function ticket_spot_sess_start()
{
    if (!session_id()) session_start();
}
add_action('init', 'ticket_spot_sess_start');

add_filter('admin_footer_text', 'ticket_spot_footer_text');

function ticket_spot_shortcode($atts)
{
    $a = shortcode_atts( array(
		'widget_id' => '',
	), $atts );

    $message = "<ticket-spot id='{$a['widget_id']}' />";

    return $message;
}
// register shortcode
add_shortcode('ticket_spot', 'ticket_spot_shortcode');


