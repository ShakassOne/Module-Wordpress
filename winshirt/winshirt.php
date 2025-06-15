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

/**
 * Ajoute le menu WinShirt dans l'admin WordPress.
 */
function winshirt_register_admin_menu() {
    add_menu_page(
        'WinShirt',
        'WinShirt',
        'manage_options',
        'winshirt-dashboard',
        'winshirt_render_dashboard',
        'dashicons-tshirt',
        25
    );
}
add_action('admin_menu', 'winshirt_register_admin_menu');

/**
 * Affiche la page de tableau de bord temporaire.
 */
function winshirt_render_dashboard() {
    echo '<div class="wrap">';
    echo '<h1>Tableau de bord WinShirt</h1>';
    echo '<p>Bienvenue dans le plugin de personnalisation produit avec loterie. L’interface arrive bientôt !</p>';
    echo '</div>';
}
