<?php
/**
 * Plugin Name: WinShirt
 * Description: Personnalisation textile et loterie.
 * Version: 0.1.0
 * Author: Shakass
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin path and URL constants for easy includes and assets.
if ( ! defined( 'WINSHIRT_PATH' ) ) {
    define( 'WINSHIRT_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WINSHIRT_URL' ) ) {
    define( 'WINSHIRT_URL', plugin_dir_url( __FILE__ ) );
}

// Include core plugin files.
require_once WINSHIRT_PATH . 'includes/admin-menu.php';
require_once WINSHIRT_PATH . 'includes/mockup-generator.php';

