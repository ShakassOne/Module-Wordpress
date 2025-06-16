<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register WinShirt admin menu page.
 */
function winshirt_register_admin_menu() {
    add_menu_page(
        __( 'WinShirt', 'winshirt' ),
        __( 'WinShirt', 'winshirt' ),
        'manage_options',
        'winshirt',
        'winshirt_render_dashboard',
        'dashicons-tshirt',
        25
    );
}
add_action( 'admin_menu', 'winshirt_register_admin_menu' );

/**
 * Render the admin dashboard page.
 */
function winshirt_render_dashboard() {
    $template = WINSHIRT_PATH . 'templates/dashboard.php';
    if ( file_exists( $template ) ) {
        include $template;
    }
}

