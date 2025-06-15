<?php
/**
 * Plugin Name: WinShirt – Custom T-shirt & Lottery
 * Description: Personnalisation de T-shirt avec loteries intégrées pour WooCommerce.
 * Version: 1.0.0
 * Author: Alan / Shakass
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-routes.php';
require_once plugin_dir_path(__FILE__) . 'includes/personalization-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/stripe-integration.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-pages.php';
