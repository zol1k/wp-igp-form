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

// ─── Capture and log wp_mail failures ────────────────────────────────────────
add_action( 'wp_mail_failed', function ( $wp_error ) {
    if ( defined('WP_DEBUG_LOG') && WP_DEBUG_LOG ) {
        error_log( '[IGP Mail Error] ' . implode( ' | ', $wp_error->get_error_messages() ) );
    }
    // Store last error so the AJAX handler can return it
    update_option( 'igp_last_mail_error', $wp_error->get_error_message(), false );
} );

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

    // ── Fire action so functions.php (or any plugin) can handle CRM/integrations
    do_action( 'igp_form_submitted', $meno, $mobil, $email, $adresa, $poznamka, $ga_id, $session_data );

    // ── Build email body ──────────────────────────────────────────────────────
    $recipient_email = [
        'm.zoldos@gmail.com',
        'liska@inetgap.sk',
        'ponuky@mallayslovakia.sk',
        // 'dalsi@email.sk',
    ];
    $subject = 'Nová žiadosť o klimatizáciu – ' . $meno;

    // Session keys to skip (contact duplicates + internal slugs)
    $igp_skip_keys = [
        'igp_vyhodnotenie_meno', 'igp_vyhodnotenie_adresa', 'igp_vyhodnotenie_psc',
        'igp_vyhodnotenie_mobil', 'igp_vyhodnotenie_email', 'igp_vyhodnotenie_poznamka',
        'igp_vyber_triedy_slug', 'igp_vyber_produktu_id',
    ];

    // Human-readable labels
    $igp_key_labels = [
        'igp_vyber_triedy'           => 'Trieda klimatizácie',
        'igp_vyber_triedy_cena'      => 'Cena triedy',
        'igp_vyber_produktu_nazov'   => 'Vybraný produkt',
        'igp_vyber_produktu_cena'    => 'Cena produktu',
        'igp_preformular_rozmer'     => 'Veľkosť priestoru',
        'igp_preformular_priprava'   => 'Príprava rozvodov',
        'igp_preformular_filtracia'  => 'Filtrácia',
        'igp_preformular_farba'      => 'Farba',
        'igp_preformular_vyuzitie'   => 'Využitie',
        'igp_preformular_prevedenie' => 'Prevedenie',
    ];

    // Build config rows HTML
    $igp_config_rows = '';
    foreach ( $session_data as $k => $v ) {
        if ( in_array( $k, $igp_skip_keys, true ) ) continue;
        if ( ! isset( $igp_key_labels[ $k ] ) ) continue;
        if ( $v === '' ) continue;
        $igp_config_rows .= '<tr>'
            . '<td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;vertical-align:top;">' . esc_html( $igp_key_labels[ $k ] ) . '</td>'
            . '<td style="padding:8px 0;font-size:14px;font-weight:600;color:#111827;">' . esc_html( $v ) . '</td>'
            . '</tr>';
    }

    $body = '<!DOCTYPE html>
<html lang="sk">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#F3F4F6;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#F3F4F6;padding:32px 0;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;max-width:600px;width:100%;">

  <!-- Hlavička -->
  <tr>
    <td style="background:#000000;padding:28px 32px;">
      <p style="margin:0;font-size:11px;color:rgba(255,255,255,0.7);letter-spacing:0.1em;text-transform:uppercase;">Mallay Slovakia</p>
      <h1 style="margin:6px 0 0;font-size:20px;color:#ffffff;font-weight:700;">Nová žiadosť o cenovú ponuku</h1>
      <p style="margin:4px 0 0;font-size:13px;color:rgba(255,255,255,0.85);">Klimatizácia</p>
    </td>
  </tr>

  <!-- Kontaktné údaje -->
  <tr>
    <td style="padding:28px 32px 20px;">
      <p style="margin:0 0 14px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9CA3AF;">Kontaktné údaje</p>
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;">Meno a priezvisko</td>
          <td style="padding:8px 0;font-size:14px;font-weight:600;color:#111827;">' . esc_html( $meno ) . '</td>
        </tr>
        <tr>
          <td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;">Adresa realizácie</td>
          <td style="padding:8px 0;font-size:14px;font-weight:600;color:#111827;">' . esc_html( $adresa ) . ( $psc ? ', ' . esc_html( $psc ) : '' ) . '</td>
        </tr>
        <tr>
          <td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;">Mobil</td>
          <td style="padding:8px 0;font-size:14px;font-weight:600;color:#111827;">' . esc_html( $mobil ) . '</td>
        </tr>
        <tr>
          <td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;">E-mail</td>
          <td style="padding:8px 0;font-size:14px;font-weight:600;color:#111827;">' . esc_html( $email ) . '</td>
        </tr>
        ' . ( $poznamka ? '<tr>
          <td style="padding:8px 16px 8px 0;color:#6B7280;font-size:14px;white-space:nowrap;vertical-align:top;">Poznámka</td>
          <td style="padding:8px 0;font-size:14px;color:#374151;">' . nl2br( esc_html( $poznamka ) ) . '</td>
        </tr>' : '' ) . '
      </table>
    </td>
  </tr>

  <!-- Oddelovač -->
  <tr><td style="padding:0 32px;"><hr style="border:none;border-top:1px solid #E5E7EB;margin:0;"></td></tr>

  <!-- Konfigurácia -->
  <tr>
    <td style="padding:20px 32px 28px;">
      <p style="margin:0 0 14px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9CA3AF;">Konfigurácia</p>
      <table cellpadding="0" cellspacing="0" width="100%">
        ' . ( $igp_config_rows ?: '<tr><td style="font-size:14px;color:#9CA3AF;">—</td></tr>' ) . '
      </table>
    </td>
  </tr>

  <!-- Päta -->
  <tr>
    <td style="background:#F9FAFB;padding:16px 32px;border-top:1px solid #E5E7EB;">
      <p style="margin:0;font-size:12px;color:#9CA3AF;">Automaticky vygenerovaná správa z formulára na mallayslovakia.sk</p>
    </td>
  </tr>

</table>
</td></tr>
</table>
</body>
</html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $meno . ' <' . $email . '>',
    ];

    // Set From address via filter — avoids conflict with PHPMailer's setFrom()
    $igp_from_email = 'no-reply@mallayslovakia.sk';
    $igp_from_name  = 'Mallay Slovakia';
    $set_from_email = function() use ( $igp_from_email ) { return $igp_from_email; };
    $set_from_name  = function() use ( $igp_from_name  ) { return $igp_from_name;  };
    add_filter( 'wp_mail_from',      $set_from_email );
    add_filter( 'wp_mail_from_name', $set_from_name  );

    // ── Handle optional file attachment ───────────────────────────────────────
    $attachments   = [];
    $tmp_copy_path = '';

    if ( ! empty( $_FILES['fotka']['tmp_name'] ) && $_FILES['fotka']['error'] === UPLOAD_ERR_OK ) {
        $allowed_mime_types = [ 'image/jpeg', 'image/png', 'image/webp', 'image/gif', 'application/pdf' ];
        $max_bytes          = 8 * 1024 * 1024; // 8 MB

        $file_size = (int) $_FILES['fotka']['size'];
        $file_mime = mime_content_type( $_FILES['fotka']['tmp_name'] );

        if ( $file_size > $max_bytes ) {
            wp_send_json_error( [ 'message' => 'Súbor je príliš veľký (max 8 MB).' ], 422 );
        }

        if ( ! in_array( $file_mime, $allowed_mime_types, true ) ) {
            wp_send_json_error( [ 'message' => 'Nepodporovaný formát súboru.' ], 422 );
        }

        // wp_mail needs a real path — copy tmp file before PHP cleans it up
        $upload_dir    = wp_upload_dir();
        $ext           = pathinfo( sanitize_file_name( $_FILES['fotka']['name'] ), PATHINFO_EXTENSION );
        $safe_ext      = preg_replace( '/[^a-z0-9]/i', '', $ext );
        $tmp_copy_path = trailingslashit( $upload_dir['basedir'] ) . 'igp-tmp-' . wp_generate_password( 12, false ) . '.' . $safe_ext;

        if ( move_uploaded_file( $_FILES['fotka']['tmp_name'], $tmp_copy_path ) ) {
            $attachments[] = $tmp_copy_path;
        }
    }

    // Clear any previous error stored from wp_mail_failed
    delete_option( 'igp_last_mail_error' );

    $sent = wp_mail( $recipient_email, $subject, $body, $headers, $attachments );

    // Clean up the temporary attachment copy
    if ( $tmp_copy_path && file_exists( $tmp_copy_path ) ) {
        wp_delete_file( $tmp_copy_path );
    }

    remove_filter( 'wp_mail_from',      $set_from_email );
    remove_filter( 'wp_mail_from_name', $set_from_name  );

    if ( $sent ) {
        wp_send_json_success( [ 'message' => 'Ďakujeme! Budeme vás čoskoro kontaktovať.' ] );
    } else {
        $mail_error = get_option( 'igp_last_mail_error', '' );
        $debug_msg  = $mail_error
            ? 'Odoslanie zlyhalo: ' . $mail_error
            : 'Odoslanie zlyhalo. Skontrolujte SMTP nastavenia servera (WP Mail SMTP plugin).';
        wp_send_json_error( [ 'message' => $debug_msg ], 500 );
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
