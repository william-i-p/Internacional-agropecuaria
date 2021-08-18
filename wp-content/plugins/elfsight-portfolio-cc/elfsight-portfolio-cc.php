<?php
/*
Plugin Name: Elfsight Portfolio CC
Description: Show your works and projects in details and attract new clients.
Plugin URI: https://elfsight.com/portfolio-widget/codecanyon/?utm_source=markets&utm_medium=codecanyon&utm_campaign=portfolio&utm_content=plugin-site
Version: 1.1.3
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=portfolio&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');

$elfsight_portfolio_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_portfolio_config = json_decode(file_get_contents($elfsight_portfolio_config_path), true);

new ElfsightPortfolioPlugin(
    array(
        'name' => esc_html__('Portfolio'),
        'description' => esc_html__('Show your works and projects in details and attract new clients.'),
        'slug' => 'elfsight-portfolio',
        'version' => '1.1.3',
        'text_domain' => 'elfsight-portfolio',
        'editor_settings' => $elfsight_portfolio_config['settings'],
        'editor_preferences' => $elfsight_portfolio_config['preferences'],

        'plugin_name' => esc_html__('Elfsight Portfolio'),
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),
        'menu_icon' => plugins_url('assets/img/menu-icon.svg', __FILE__),

        'update_url' => esc_url('https://a.elfsight.com/updates/v1/'),
        'product_url' => esc_url('https://1.envato.market/0K3MR'),
        'helpscout_plugin_id' => 110718
    )
);

?>
