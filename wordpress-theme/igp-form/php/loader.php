<?php
// Basic loader for igp-form (child theme)
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function igp_form_enqueue_assets() {
    $css_path = get_stylesheet_directory() . '/igp-form/css/form.css';
    $js_path  = get_stylesheet_directory() . '/igp-form/js/form.js';

    // Enqueue Bootstrap from CDN (used for layout/styling) + our form assets
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2' );

    if ( file_exists( $css_path ) ) {
        wp_enqueue_style( 'igp-form-style', get_stylesheet_directory_uri() . '/igp-form/css/form.css', array('bootstrap'), filemtime( $css_path ) );
    }

    // Load bootstrap bundle (includes Popper)
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true );

    if ( file_exists( $js_path ) ) {
        wp_enqueue_script( 'igp-form-js', get_stylesheet_directory_uri() . '/igp-form/js/form.js', array( 'jquery' ), filemtime( $js_path ), true );
        wp_localize_script( 'igp-form-js', 'igpFormData', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'igp_form_enqueue_assets' );

function igp_form_shortcode( $atts = array() ) {
    $atts = shortcode_atts( array(
        'step' => 1,
    ), $atts, 'igp_form' );

    ob_start();
    $template = get_stylesheet_directory() . '/igp-form/templates/form-template.php';
    if ( file_exists( $template ) ) {
        include $template;
    } else {
        echo '<p>Form template not found in igp-form/templates/</p>';
    }

    return ob_get_clean();
}
add_shortcode( 'igp_form', 'igp_form_shortcode' );
