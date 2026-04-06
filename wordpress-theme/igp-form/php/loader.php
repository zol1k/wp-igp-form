<?php
/**
 * IGP Form — WordPress Loader
 * ============================
 * Enqueues Bootstrap 5, Bootstrap Icons, and the IGP form assets.
 * Also defines shared helper functions used by all templates.
 *
 * Usage in functions.php:
 *   require_once get_stylesheet_directory() . '/igp-form/php/loader.php';
 */

defined('ABSPATH') || exit;

// ─── Asset registration & enqueueing ─────────────────────────────────────────

/**
 * Register all IGP form assets.
 * Hooked to wp_enqueue_scripts; fires only when the current page uses
 * one of the IGP page templates.
 */
function igp_enqueue_assets() {
    // Only load on IGP templates (template slug starts with "template-cenova-ponuka")
    $template = get_page_template_slug();
    if ( strpos( $template, 'template-cenova-ponuka' ) === false ) {
        return;
    }

    $theme_uri = get_stylesheet_directory_uri();

    // Bootstrap 5.3 CSS
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [],
        '5.3.3'
    );

    // Bootstrap Icons 1.11
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        [],
        '1.11.3'
    );

    // Inter font from Google Fonts
    wp_enqueue_style(
        'igp-inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap',
        [],
        null
    );

    // IGP custom styles
    wp_enqueue_style(
        'igp-form-css',
        $theme_uri . '/igp-form/css/form.css',
        [ 'bootstrap', 'bootstrap-icons' ],
        filemtime( get_stylesheet_directory() . '/igp-form/css/form.css' )
    );

    // Bootstrap 5.3 JS (bundle with Popper)
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );

    // IGP form JS
    wp_enqueue_script(
        'igp-form-js',
        $theme_uri . '/igp-form/js/form.js',
        [ 'bootstrap' ],
        filemtime( get_stylesheet_directory() . '/igp-form/js/form.js' ),
        true
    );

    // Pass WordPress AJAX URL and nonce to JS
    wp_localize_script( 'igp-form-js', 'igpConfig', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'igp_form_nonce' ),
    ]);
}
add_action( 'wp_enqueue_scripts', 'igp_enqueue_assets' );

// ─── AJAX form submission handler ────────────────────────────────────────────

/**
 * Handle the final form submission (from the Vyhodnotenie page).
 * Accessible for both logged-in and logged-out users.
 */
add_action( 'wp_ajax_igp_submit_form',        'igp_handle_form_submission' );
add_action( 'wp_ajax_nopriv_igp_submit_form', 'igp_handle_form_submission' );

function igp_handle_form_submission() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'igp_form_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Neplatný bezpečnostný token.' ], 403 );
    }

    // ── Sanitise contact fields ───────────────────────────────────────────────
    $meno    = sanitize_text_field( wp_unslash( $_POST['meno']    ?? '' ) );
    $adresa  = sanitize_text_field( wp_unslash( $_POST['adresa']  ?? '' ) );
    $psc     = sanitize_text_field( wp_unslash( $_POST['psc']     ?? '' ) );
    $mobil   = sanitize_text_field( wp_unslash( $_POST['mobil']   ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['email']   ?? '' ) );
    $poznamka = sanitize_textarea_field( wp_unslash( $_POST['poznamka'] ?? '' ) );

    // Validate required fields
    if ( empty( $meno ) || empty( $mobil ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Prosím vyplňte všetky povinné polia.' ], 422 );
    }

    // ── Collect igp_ session data passed from front-end ──────────────────────
    $session_data = [];
    foreach ( $_POST as $key => $value ) {
        if ( strpos( $key, 'igp_' ) === 0 ) {
            $session_data[ sanitize_key( $key ) ] = sanitize_textarea_field( wp_unslash( $value ) );
        }
    }

    $ga_id = sanitize_text_field( wp_unslash( $_POST['ga_id'] ?? '' ) );

    // ── Build email body ──────────────────────────────────────────────────────
    $admin_email = get_option( 'admin_email' );
    $subject     = 'Nová kalkulácia klimatizácie – ' . $meno;

    $body  = "Nová žiadosť o cenovú ponuku klimatizácie\n";
    $body .= "=========================================\n\n";
    $body .= "Meno a priezvisko : {$meno}\n";
    $body .= "Adresa realizácie : {$adresa}\n";
    $body .= "PSČ               : {$psc}\n";
    $body .= "Mobil             : {$mobil}\n";
    $body .= "E-mail            : {$email}\n";
    $body .= "Poznámka          : {$poznamka}\n\n";
    $body .= "Konfigurácia formulára\n";
    $body .= "----------------------\n";
    foreach ( $session_data as $k => $v ) {
        $body .= str_pad( $k, 36 ) . ": {$v}\n";
    }
    if ( $ga_id ) {
        $body .= "\nGA Client ID      : {$ga_id}\n";
    }

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $meno . ' <' . $email . '>',
    ];

    $sent = wp_mail( $admin_email, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => 'Ďakujeme! Budeme vás čoskoro kontaktovať.' ] );
    } else {
        wp_send_json_error( [ 'message' => 'Odoslanie zlyhalo. Skúste to prosím neskôr.' ], 500 );
    }
}

// ─── Helper: Shared page header markup ───────────────────────────────────────

/**
 * Echo the shared IGP page header (logo bar + optional step indicator).
 *
 * @param array $steps      Array of ['title' => ..., 'subtitle' => ...] — omit for no steps
 * @param int   $currentStep 1-based step number (default 0 = no indicator)
 */
function igp_render_header( array $steps = [], int $currentStep = 0 ): void {
    echo '<header class="igp-header">';
    // Logo — replace src with your actual logo path
    echo '<a href="' . esc_url( home_url('/') ) . '">';
    echo   '<span class="igp-logo-text">MALLAY <small style="font-weight:400;font-size:.55em;">SLOVAKIA</small></span>';
    echo '</a>';
    echo '</header>';

    if ( ! empty( $steps ) ) {
        igp_render_step_indicator( $steps, $currentStep );
    }
}

/**
 * Echo the step indicator bar.
 *
 * @param array $steps       Array of ['title' => ..., 'subtitle' => ...]
 * @param int   $currentStep 1-based active step
 */
function igp_render_step_indicator( array $steps, int $currentStep ): void {
    echo '<div class="igp-steps">';
    foreach ( $steps as $i => $step ) {
        $num        = $i + 1;
        $stateClass = '';
        if ( $num < $currentStep )  $stateClass = 'completed';
        if ( $num === $currentStep ) $stateClass = 'active';

        echo '<div class="igp-step-item ' . esc_attr( $stateClass ) . '" data-step="' . esc_attr( $num ) . '">';
        echo   '<div class="igp-step-circle">';
        echo     '<span class="igp-step-num">'   . esc_html( $num ) . '</span>';
        echo     '<span class="igp-step-check"><i class="bi bi-check-lg"></i></span>';
        echo   '</div>';
        echo   '<div class="igp-step-labels">';
        echo     '<span class="igp-step-title">'    . esc_html( $step['title'] )    . '</span>';
        echo     '<span class="igp-step-subtitle">' . esc_html( $step['subtitle'] ) . '</span>';
        echo   '</div>';
        echo '</div>';
    }
    echo '</div>';
}

/**
 * Echo the shared form navigation footer (Späť / Pokračovať buttons).
 *
 * @param int    $currentStep
 * @param int    $totalSteps
 * @param string $baseUrl      URL of the formular page (without krok param)
 */
function igp_render_form_nav( int $currentStep, int $totalSteps, string $baseUrl ): void {
    $prevStep = $currentStep - 1;
    $nextStep = $currentStep + 1;

    echo '<div class="igp-form-nav">';

    // Späť
    if ( $currentStep > 1 ) {
        $prevUrl = add_query_arg( 'krok', $prevStep, $baseUrl );
        echo '<a href="' . esc_url( $prevUrl ) . '" class="igp-btn-outline" onclick="igpSave(\'last_step\',' . esc_js( $prevStep ) . ')">Späť</a>';
    } else {
        echo '<span></span>';
    }

    // Pokračovať / Odoslať
    if ( $currentStep < $totalSteps ) {
        $nextUrl = add_query_arg( 'krok', $nextStep, $baseUrl );
        echo '<a href="' . esc_url( $nextUrl ) . '" class="igp-btn-primary" onclick="igpSave(\'last_step\',' . esc_js( $nextStep ) . ')">Pokračovať</a>';
    } else {
        // Last step — handled by the template itself
        echo '<button type="submit" class="igp-btn-primary">Odoslať</button>';
    }

    echo '</div>';
}

/**
 * Return the five standard formular step definitions.
 *
 * @return array
 */
function igp_formular_steps(): array {
    return [
        [ 'title' => 'Parametre miestnosti', 'subtitle' => 'Výpočet výkonu'         ],
        [ 'title' => 'Typ riešenia',         'subtitle' => 'Split vs. Multi-split'   ],
        [ 'title' => 'Funkcie a využitie',   'subtitle' => 'Komfort'                 ],
        [ 'title' => 'Dizajn a rozpočet',    'subtitle' => 'Finálny výber'           ],
        [ 'title' => 'Zhrnutie',             'subtitle' => 'Prehľad konfigurácie'    ],
    ];
}
