<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register mockup settings.
 */
function winshirt_register_mockup_settings() {
    register_setting( 'winshirt_mockup_options', 'winshirt_mockup_image' );
    register_setting( 'winshirt_mockup_options', 'winshirt_mockup_colors' );
}
add_action( 'admin_init', 'winshirt_register_mockup_settings' );

/**
 * Add submenu page for mockups.
 */
function winshirt_register_mockup_submenu() {
    add_submenu_page(
        'winshirt',
        __( 'Mockup Generator', 'winshirt' ),
        __( 'Mockup Generator', 'winshirt' ),
        'manage_options',
        'winshirt-mockups',
        'winshirt_render_mockup_page'
    );
}
add_action( 'admin_menu', 'winshirt_register_mockup_submenu' );

/**
 * Enqueue admin assets.
 */
function winshirt_mockup_admin_assets( $hook ) {
    if ( $hook !== 'toplevel_page_winshirt' && $hook !== 'winshirt_page_winshirt-mockups' ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script( 'winshirt-mockup', WINSHIRT_URL . 'assets/js/mockup-generator.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'winshirt_mockup_admin_assets' );

/**
 * Render mockup settings page.
 */
function winshirt_render_mockup_page() {
    $image  = get_option( 'winshirt_mockup_image', '' );
    $colors = get_option( 'winshirt_mockup_colors', '' );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Mockup Generator', 'winshirt' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'winshirt_mockup_options' );
            do_settings_sections( 'winshirt_mockup_options' );
            ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="winshirt_mockup_image"><?php esc_html_e( 'Base PNG Image', 'winshirt' ); ?></label>
                    </th>
                    <td>
                        <input type="text" id="winshirt_mockup_image" name="winshirt_mockup_image" value="<?php echo esc_attr( $image ); ?>" class="regular-text" />
                        <button type="button" class="button" id="winshirt_mockup_image_button"><?php esc_html_e( 'Select Image', 'winshirt' ); ?></button>
                        <?php if ( $image ) : ?>
                            <div><img id="winshirt_mockup_image_preview" src="<?php echo esc_url( $image ); ?>" style="max-width:150px;" /></div>
                        <?php else : ?>
                            <div><img id="winshirt_mockup_image_preview" style="max-width:150px; display:none;" /></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="winshirt_mockup_colors"><?php esc_html_e( 'HEX Colors', 'winshirt' ); ?></label>
                    </th>
                    <td>
                        <textarea id="winshirt_mockup_colors" name="winshirt_mockup_colors" rows="5" cols="30" class="large-text code"><?php echo esc_textarea( $colors ); ?></textarea>
                        <p class="description"><?php esc_html_e( 'Enter colors separated by comma or space.', 'winshirt' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <h2><?php esc_html_e( 'Preview', 'winshirt' ); ?></h2>
        <div id="winshirt_mockup_result" style="display:flex; gap:10px; flex-wrap: wrap;"></div>
    </div>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#winshirt_mockup_image_button').on('click', function(e){
            e.preventDefault();
            if(frame){
                frame.open();
                return;
            }
            frame = wp.media({
                title: '<?php echo esc_js( __( 'Select or Upload PNG', 'winshirt' ) ); ?>',
                button: { text: '<?php echo esc_js( __( 'Use this image', 'winshirt' ) ); ?>' },
                multiple: false
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#winshirt_mockup_image').val(attachment.url);
                $('#winshirt_mockup_image_preview').attr('src', attachment.url).show();
                $(document).trigger('winshirtImageSelected');
            });
            frame.open();
        });
    });
    </script>
    <?php
}
