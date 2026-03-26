<?php

// function loadCssJs(){
// 	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/new.js', array(), 1.2, true);
// 	wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/tailwind.css', false, 2.9, 'all');
// }
// add_action('wp_enqueue_scripts','loadCssJs');

function loadCssJs(){

    $current_url = $_SERVER['REQUEST_URI'];

    if (strpos($current_url, '/angebot/') !== false) {
        wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/new.js', array(), 1.2, true);
        wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/tailwind.css', false, 2.9, 'all');
    }
}
add_action('wp_enqueue_scripts', 'loadCssJs');


function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

// Modify permalinks for custom post types
add_filter('post_type_link', 'custom_permalinks', 10, 3);

function custom_permalinks($permalink, $post, $leavename) {
    global $wp_rewrite;

    if (!$wp_rewrite->using_permalinks()) {
        return $permalink;
    }

    // Apply changes to specific CPTs only
    $cpts = ['maslen_dachpfannen', 'maslen_trapezprofile', 'maslen_sandwichpanel', 'maslen_unklassifizie'];
    if (!in_array($post->post_type, $cpts)) {
        return $permalink;
    }

    return home_url("/produkte/{$post->post_name}/");
}

// Add custom rewrite rules
add_action('init', 'custom_rewrite_rules');

function custom_rewrite_rules() {
    // CPT single page
    add_rewrite_rule(
        'produkte/([^/]+)(?:/([0-9]+))?/?$',
        'index.php?post_type[]=maslen_dachpfannen&post_type[]=maslen_trapezprofile&post_type[]=maslen_sandwichpanel&post_type[]=maslen_unklassifizie&name=$matches[1]&page=$matches[2]',
        'top'
    );
}

// Flush rewrite rules upon theme switch or plugin activation
function flush_rewrite_rules_on_activation() {
    custom_rewrite_rules();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_rewrite_rules_on_activation');


function include_bootstrap_selectpicker() {
    ob_start();
    ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Selectpicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Selectpicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    <!-- Initialize Selectpicker -->
    <script>
    jQuery(document).ready(function() {
        jQuery('.selectpicker').selectpicker();
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('include_bootstrap_selectpicker', 'include_bootstrap_selectpicker');




/**
 * HTML Email Template pre cenové ponuky
 * Univerzálna funkcia pre pekné zobrazenie emailov
 */
function maslen_email_template($subject, $sections) {
    $html = '
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . esc_html($subject) . '</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
                background-color: #f4f4f4;
                line-height: 1.6;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            .email-wrapper {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .email-header {
                background-color: #e2001a;
                color: #ffffff;
                padding: 30px 20px;
                text-align: center;
            }
            .email-header h1 {
                margin: 0;
                font-size: 24px;
                font-weight: 600;
            }
            .email-body {
                padding: 30px 20px;
            }
            .section {
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 2px solid #e5e7eb;
            }
            .section:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }
            .section-title {
                color: #171717;
                font-size: 18px;
                font-weight: 600;
                margin: 0 0 15px 0;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .field {
                display: block;
                padding-bottom: 8px;
            }
            .field-label {
                font-weight: 600;
                color: #374151;
                display: block;
                margin-bottom: 4px;
                font-size: 14px;
            }
            .field-value {
                color: #6b7280;
                display: block;
                font-size: 15px;
                word-wrap: break-word;
                word-break: break-word;
            }
            .email-footer {
                background-color: #f9fafb;
                padding: 20px;
                text-align: center;
                color: #6b7280;
                font-size: 12px;
            }
            .attachment-notice {
                background-color: #fef3c7;
                border-left: 4px solid #f59e0b;
                padding: 12px 16px;
                margin-top: 20px;
                border-radius: 4px;
            }
            .attachment-notice strong {
                color: #92400e;
            }

            /* Mobile optimalizácia */
            @media only screen and (max-width: 600px) {
                .email-wrapper {
                    margin: 10px;
                    border-radius: 4px;
                }
                .email-header {
                    padding: 24px 16px;
                }
                .email-header h1 {
                    font-size: 20px;
                }
                .email-body {
                    padding: 20px 16px;
                }
                .section {
                    margin-bottom: 24px;
                    padding-bottom: 16px;
                }
                .section-title {
                    font-size: 16px;
                    margin-bottom: 12px;
                }
                .field {
                    padding: 6px 0;
                    margin-bottom: 14px;
                }
                .field-label {
                    font-size: 13px;
                    margin-bottom: 5px;
                }
                .field-value {
                    font-size: 14px;
                    line-height: 1.5;
                }
                .email-footer {
                    padding: 16px;
                    font-size: 11px;
                }
                .attachment-notice {
                    padding: 10px 12px;
                    font-size: 13px;
                }
            }

            /* Extra malé mobily */
            @media only screen and (max-width: 400px) {
                .email-wrapper {
                    margin: 5px;
                }
                .email-header h1 {
                    font-size: 18px;
                }
                .section-title {
                    font-size: 15px;
                }
            }
        </style>
    </head>
    <body>
        <div class="email-wrapper">
            <div class="email-header">
                <h1>' . esc_html($subject) . '</h1>
            </div>
            <div class="email-body">';

    // Pridaj sekcie
    foreach ($sections as $section) {
        $html .= '<div class="section">';
        $html .= '<h2 class="section-title">' . esc_html($section['title']) . '</h2>';

        foreach ($section['fields'] as $field) {
            if (!empty($field['value'])) {
                $html .= '<div class="field">';
                $html .= '<span class="field-label">' . esc_html($field['label']) . ':</span>';
                $html .= '<span class="field-value">' . nl2br(esc_html($field['value'])) . '</span>';
                $html .= '</div>';
            }
        }

        $html .= '</div>';
    }

    $html .= '
            </div>
            <div class="email-footer">
                <p>© ' . date('Y') . ' maslen.at</p>
            </div>
        </div>
    </body>
    </html>';

    return $html;
}

// AJAX handler pre odoslanie trapez cenové ponuky
add_action('wp_ajax_send_trapez_quote', 'handle_trapez_quote_submission');
add_action('wp_ajax_nopriv_send_trapez_quote', 'handle_trapez_quote_submission');

// AJAX handler pre odoslanie krytiny cenové ponuky
add_action('wp_ajax_send_krytina_quote', 'handle_krytina_quote_submission');
add_action('wp_ajax_nopriv_send_krytina_quote', 'handle_krytina_quote_submission');

// AJAX handler pre odoslanie sendvič cenové ponuky
add_action('wp_ajax_send_sendvic_quote', 'handle_sendvic_quote_submission');
add_action('wp_ajax_nopriv_send_sendvic_quote', 'handle_sendvic_quote_submission');

// AJAX handler pre odoslanie zvodového systému cenové ponuky
add_action('wp_ajax_send_zvod_quote', 'handle_zvod_quote_submission');
add_action('wp_ajax_nopriv_send_zvod_quote', 'handle_zvod_quote_submission');

// AJAX handler pre odoslanie plotových lamelov cenové ponuky
add_action('wp_ajax_send_lemovanie_quote', 'handle_lemovanie_quote_submission');
add_action('wp_ajax_nopriv_send_lemovanie_quote', 'handle_lemovanie_quote_submission');


function handle_trapez_quote_submission() {
    // Skip nonce verification for now to debug
    // check_ajax_referer('sendvic_quote_nonce', 'nonce');

    // Get form data from POST with isset checks
    $priezvisko = isset($_POST['priezvisko']) ? sanitize_text_field($_POST['priezvisko']) : '';
    $telKontakt = isset($_POST['telKontakt']) ? sanitize_text_field($_POST['telKontakt']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $pobocka = isset($_POST['pobocka']) ? sanitize_text_field($_POST['pobocka']) : '';
    $pobocka_email = isset($_POST['pobocka_email']) ? sanitize_email($_POST['pobocka_email']) : '';
    $selectedProduct = isset($_POST['selectedProduct']) ? sanitize_text_field($_POST['selectedProduct']) : '';
    $selectedProductName = isset($_POST['selectedProductName']) ? sanitize_text_field($_POST['selectedProductName']) : '';

    // Get trapez data with isset checks
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
    $subType = isset($_POST['subType']) ? sanitize_text_field($_POST['subType']) : '';
    $color = isset($_POST['color']) ? sanitize_text_field($_POST['color']) : '';
    $info = isset($_POST['info']) ? sanitize_textarea_field($_POST['info']) : '';
    $file = isset($_POST['file']) ? sanitize_text_field($_POST['file']) : '';
    $odkapovySystem = isset($_POST['odkapovySystem']) ? sanitize_text_field($_POST['odkapovySystem']) : 'Nein';
    $ga_id = isset($_POST['ga_id']) ? sanitize_text_field($_POST['ga_id']) : '';

    // Prepare email content
    $to = array('ulicny@maslen.at');

    // Pridaj email pobočky ak je zadaný
    // if (!empty($pobocka_email)) {
    //     // Redirect maslentn@maslen.sk to fodrek@maslen.sk
    //     if ($pobocka_email === 'maslentn@maslen.sk') {
    //         $to[] = 'fodrek@maslen.sk';
    //     } else {
    //         $to[] = $pobocka_email;
    //     }
    // }

    $subject = 'Neues Preisangebot - Trapezbleche';

    // Priprav sekcie pre email template
    $sections = array(
        array(
            'title' => 'Kontaktdaten',
            'fields' => array(
                array('label' => 'Name', 'value' => $priezvisko),
                array('label' => 'Telefonnummer', 'value' => $telKontakt),
                array('label' => 'Email', 'value' => $email),
                array('label' => 'PLZ der Realisierung', 'value' => $pobocka ? $pobocka : 'Nicht registriert')
            )
        ),
        array(
            'title' => 'Produkt',
            'fields' => array(
                array('label' => 'Ausgewähltes Produkt', 'value' => $selectedProductName)
            )
        ),
        array(
            'title' => 'Trapezbleche - Spezifikation',
            'fields' => array(
                array('label' => 'Gebäudetyp', 'value' => $type),
                array('label' => 'Trapezprofile für das:', 'value' => $subType),
                array('label' => 'Blechfarbe', 'value' => $color),
                array('label' => 'Dachentwässerungssystem', 'value' => $odkapovySystem),
            )
        )
    );

    // Pridaj doplňujúce informácie ak existujú
    if (!empty($info)) {
        $sections[] = array(
            'title' => 'Weitere Informationen',
            'fields' => array(
                array('label' => 'Bericht', 'value' => $info),
                array('label' => 'Hochgeladene Datei', 'value' => $nahranySubor)
            )
        );
    }

    // Generuj HTML email
    $message = maslen_email_template($subject, $sections);

    // Nastavenia pre HTML email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: maslen.at <no-reply@maslen.at>'
    );

    // Handle file attachment
    $attachments = array();
    if (!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    // Pridaj Reply-To header
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    // Send email with better error handling
    try {
        $sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Clean up uploaded file
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                @unlink($attachment);
            }
        }

        if ($sent) {
            // Prepare lead data for Laravel API
            // $lead_data = array(
            //     'full_name' => $priezvisko,
            //     'email' => $email,
            //     'phone' => $telKontakt,
            //     'product' => $selectedProductName ?: 'Sendvičové panely',
            //     'product_id' => !empty($selectedProduct) ? intval($selectedProduct) : null,
            //     'ga_id' => $ga_id,
            //     'branch' => $pobocka ? get_the_title($pobocka) : null,
            //     'branch_email' => $pobocka_email,
            //     'quote_type' => 'sendvic',
            //     'quote_data' => array(
            //         'usage' => $sendvicUsage,
            //         'insulation' => $sendvicInsulation,
            //         'thickness' => $sendvicThickness,
            //         'color' => $sendvicColor,
            //     ),
            //     'additional_info' => $sendvicInfo,
            //     'has_attachment' => !empty($attachments),
            // );

            // Send to Laravel API (non-blocking, log errors if any)
            // $api_response = maslen_send_lead_to_api($lead_data);
            // if (is_wp_error($api_response)) {
            //     error_log('Failed to send lead to API: ' . $api_response->get_error_message());
            // }

            wp_send_json_success(array(
                'message' => 'E-Mail erfolgreich versendet',
                'gtm_tracking' => array(
                    'event' => 'track',
                    'eventCategory' => 'lead',
                    'eventAction' => 'contactForm_kalkulacia',
                    'eventLabel' => ''
                ),
                'debug' => array(
                    'to' => $to,
                    'has_attachment' => !empty($attachments)
                )
            ));
        } else {
            // Get more detailed error
            global $phpmailer;
            $error_message = 'Fehler beim Senden der E-Mail';
            if (isset($phpmailer) && isset($phpmailer->ErrorInfo)) {
                $error_message .= ': ' . $phpmailer->ErrorInfo;
            }
            console_log('Email sending failed: ' . $error_message);
            wp_send_json_error(array(
                'message' => $error_message,
                'debug' => array(
                    'to' => $to,
                    'subject' => $subject,
                    'has_data' => !empty($priezvisko)
                )
            ));
        }
    } catch (Exception $e) {
        console_log('Exception occurred: ' . $e->getMessage());
        wp_send_json_error(array(
            'message' => 'Exception: ' . $e->getMessage()
        ));
    }
}

function handle_krytina_quote_submission() {
    // Get form data from POST
    $produkt = isset($_POST['produkt']) ? sanitize_text_field($_POST['produkt']) : 'Krytina';
    $meno = isset($_POST['meno']) ? sanitize_text_field($_POST['meno']) : '';
    $priezvisko = isset($_POST['priezvisko']) ? sanitize_text_field($_POST['priezvisko']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $telefon = isset($_POST['telefon']) ? sanitize_text_field($_POST['telefon']) : '';
    $pobocka = isset($_POST['pobocka']) ? sanitize_text_field($_POST['pobocka']) : '';
    $pobocka_email = isset($_POST['pobocka_email']) ? sanitize_email($_POST['pobocka_email']) : '';

    // Údaje o streche
    $typStrechy = isset($_POST['typStrechy']) ? sanitize_text_field($_POST['typStrechy']) : '';
    $plocha = isset($_POST['plocha']) ? sanitize_text_field($_POST['plocha']) : '';
    $zameranie = isset($_POST['zameranie']) ? sanitize_text_field($_POST['zameranie']) : 'Nie';

    // Údaje o krytine
    $typKrytiny = isset($_POST['typKrytiny']) ? sanitize_text_field($_POST['typKrytiny']) : '';
    $podtypKrytiny = isset($_POST['podtypKrytiny']) ? sanitize_text_field($_POST['podtypKrytiny']) : '';

    // Povrchová úprava
    $povrchovaUprava = isset($_POST['povrchovaUprava']) ? sanitize_text_field($_POST['povrchovaUprava']) : '';

    // Farba a doplnky
    $farba = isset($_POST['farba']) ? sanitize_text_field($_POST['farba']) : '';
    $odkapovySystem = isset($_POST['odkapovySystem']) ? sanitize_text_field($_POST['odkapovySystem']) : 'Nie';
    $dodatocneInfo = isset($_POST['dodatocneInfo']) ? sanitize_textarea_field($_POST['dodatocneInfo']) : '';
    $nahranySubor = isset($_POST['nahranySubor']) ? sanitize_text_field($_POST['nahranySubor']) : 'Nie';
    $ga_id = isset($_POST['ga_id']) ? sanitize_text_field($_POST['ga_id']) : '';

    // Prepare email recipients
    $to = array('ulicny@maslen.at');

    // Pridaj email pobočky ak je zadaný
    // if (!empty($pobocka_email)) {
    //     // Redirect maslentn@maslen.sk to fodrek@maslen.sk
    //     if ($pobocka_email === 'maslentn@maslen.sk') {
    //         $to[] = 'fodrek@maslen.sk';
    //     } else {
    //         $to[] = $pobocka_email;
    //     }
    // }

    $subject = 'Neues Preisangebot - Dach- und Fassadenverkleidungen';

    // Priprav sekcie pre email template
    $sections = array(
        array(
            'title' => 'Kontaktdaten',
            'fields' => array(
                array('label' => 'Meno', 'value' => $meno),
                array('label' => 'Priezvisko', 'value' => $priezvisko),
                array('label' => 'Email', 'value' => $email),
                array('label' => 'Telefonnummer', 'value' => $telefon),
                array('label' => 'PLZ der Realisierung', 'value' => $pobocka ? $pobocka : 'Nicht registriert')
            )
        ),
        array(
            'title' => 'Produkt',
            'fields' => array(
                array('label' => 'Ausgewähltes Produkt', 'value' => $produkt)
            )
        ),
        array(
            'title' => 'Bestimmen Sie den Dachtyp und seine Spezifikationen',
            'fields' => array(
                array('label' => 'Dachtypologie', 'value' => $typStrechy),
                array('label' => 'Ungefähre Fläche', 'value' => $plocha ? $plocha . ' m²' : 'Nicht registriert'),
                array('label' => 'Ich kenne die Maße nicht, ich bitte um ein Aufmaß durch einen MASLEN-Mitarbeiter', 'value' => $zameranie)
            )
        ),
        array(
            'title' => 'Dachspezifikation',
            'fields' => array(
                array('label' => 'Dachspezifikation', 'value' => $typKrytiny),
                array('label' => 'Glatte Eindeckungstypen', 'value' => $podtypKrytiny ? $podtypKrytiny : 'Nie je vybraný'),
                array('label' => 'Oberflächenbehandlung', 'value' => $povrchovaUprava),
                array('label' => 'Farbe', 'value' => $farba)
            )
        ),
        array(
            'title' => 'Doplnky',
            'fields' => array(
                array('label' => 'Ich wünsche auch ein Angebot für das Dachrinnensystem', 'value' => $odkapovySystem),
                array('label' => 'Hochgeladene Datei', 'value' => $nahranySubor)
            )
        )
    );

    // Pridaj doplňujúce informácie ak existujú
    if (!empty($dodatocneInfo)) {
        $sections[] = array(
            'title' => 'Weitere Informationen',
            'fields' => array(
                array('label' => 'Bericht', 'value' => $dodatocneInfo)
            )
        );
    }

    // Generuj HTML email
    $message = maslen_email_template($subject, $sections);

    // Nastavenia pre HTML email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: maslen.at <no-reply@maslen.at>'
    );

    // Handle file attachment
    $attachments = array();
    if (!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    // Pridaj Reply-To header
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    // Send email with better error handling
    try {
        $sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Clean up uploaded file
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                @unlink($attachment);
            }
        }

        if ($sent) {
            // // Prepare lead data for Laravel API
            // $lead_data = array(
            //     'full_name' => trim($meno . ' ' . $priezvisko),
            //     'email' => $email,
            //     'phone' => $telefon,
            //     'product' => $produkt,
            //     'product_id' => null,
            //     'ga_id' => $ga_id,
            //     'branch' => $pobocka ? get_the_title($pobocka) : null,
            //     'branch_email' => $pobocka_email,
            //     'quote_type' => 'krytina',
            //     'quote_data' => array(
            //         'typ_strechy' => $typStrechy,
            //         'plocha' => $plocha,
            //         'zameranie' => $zameranie,
            //         'typ_krytiny' => $typKrytiny,
            //         'podtyp_krytiny' => $podtypKrytiny,
            //         'povrchova_uprava' => $povrchovaUprava,
            //         'farba' => $farba,
            //         'odkapovy_system' => $odkapovySystem,
            //     ),
            //     'additional_info' => $dodatocneInfo,
            //     'has_attachment' => !empty($attachments),
            // );

            // // Send to Laravel API (non-blocking, log errors if any)
            // $api_response = maslen_send_lead_to_api($lead_data);
            // if (is_wp_error($api_response)) {
            //     error_log('Failed to send lead to API: ' . $api_response->get_error_message());
            // }

            wp_send_json_success(array(
                'message' => 'E-Mail erfolgreich versendet',
                'gtm_tracking' => array(
                    'event' => 'track',
                    'eventCategory' => 'lead',
                    'eventAction' => 'contactForm_kalkulacia',
                    'eventLabel' => ''
                ),
                'debug' => array(
                    'to' => $to,
                    'has_attachment' => !empty($attachments)
                )
            ));
        } else {
            // Get more detailed error
            global $phpmailer;
            $error_message = 'Fehler beim Senden der E-Mail';
            if (isset($phpmailer) && isset($phpmailer->ErrorInfo)) {
                $error_message .= ': ' . $phpmailer->ErrorInfo;
            }
            wp_send_json_error(array(
                'message' => $error_message,
                'debug' => array(
                    'to' => $to,
                    'subject' => $subject,
                    'has_data' => !empty($priezvisko)
                )
            ));
        }
    } catch (Exception $e) {
        wp_send_json_error(array(
            'message' => 'Error: ' . $e->getMessage()
        ));
    }
}

function handle_sendvic_quote_submission() {
    // Skip nonce verification for now to debug
    // check_ajax_referer('sendvic_quote_nonce', 'nonce');

    // Get form data from POST with isset checks
    $priezvisko = isset($_POST['priezvisko']) ? sanitize_text_field($_POST['priezvisko']) : '';
    $telKontakt = isset($_POST['telKontakt']) ? sanitize_text_field($_POST['telKontakt']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $pobocka = isset($_POST['pobocka']) ? sanitize_text_field($_POST['pobocka']) : '';
    $pobocka_email = isset($_POST['pobocka_email']) ? sanitize_email($_POST['pobocka_email']) : '';
    $selectedProduct = isset($_POST['selectedProduct']) ? sanitize_text_field($_POST['selectedProduct']) : '';
    $selectedProductName = isset($_POST['selectedProductName']) ? sanitize_text_field($_POST['selectedProductName']) : '';

    // Get sendvic data with isset checks
    $sendvicUsage = isset($_POST['sendvicUsage']) ? sanitize_text_field($_POST['sendvicUsage']) : '';
    $sendvicInsulation = isset($_POST['sendvicInsulation']) ? sanitize_text_field($_POST['sendvicInsulation']) : '';
    $sendvicThickness = isset($_POST['sendvicThickness']) ? sanitize_text_field($_POST['sendvicThickness']) : '';
    $sendvicColor = isset($_POST['sendvicColor']) ? sanitize_text_field($_POST['sendvicColor']) : '';
    $sendvicInfo = isset($_POST['sendvicInfo']) ? sanitize_textarea_field($_POST['sendvicInfo']) : '';
    $sendvicFileName = isset($_POST['sendvicFileName']) ? sanitize_text_field($_POST['sendvicFileName']) : '';
    $ga_id = isset($_POST['ga_id']) ? sanitize_text_field($_POST['ga_id']) : '';

    // Prepare email content
    $to = array('ulicny@maslen.at');

    // Pridaj email pobočky ak je zadaný
    // if (!empty($pobocka_email)) {
    //     // Redirect maslentn@maslen.sk to fodrek@maslen.sk
    //     if ($pobocka_email === 'maslentn@maslen.sk') {
    //         $to[] = 'fodrek@maslen.sk';
    //     } else {
    //         $to[] = $pobocka_email;
    //     }
    // }

    $subject = 'Neues Preisangebot - Sandwichpaneele';

    // Priprav sekcie pre email template
    $sections = array(
        array(
            'title' => 'Kontaktdaten',
            'fields' => array(
                array('label' => 'Name', 'value' => $priezvisko),
                array('label' => 'Telefonnummer', 'value' => $telKontakt),
                array('label' => 'Email', 'value' => $email),
                array('label' => 'PLZ der Realisierung', 'value' => $pobocka ? $pobocka : 'Nicht registriert')
            )
        ),
        array(
            'title' => 'Produkt',
            'fields' => array(
                array('label' => 'Ausgewähltes Produkt', 'value' => $selectedProductName)
            )
        ),
        array(
            'title' => 'Spezifikation',
            'fields' => array(
                array('label' => 'Verwendung', 'value' => $sendvicUsage),
                array('label' => 'Isoliermaterial', 'value' => $sendvicInsulation),
                array('label' => 'Dicke', 'value' => $sendvicThickness)
                #array('label' => 'Farba', 'value' => $sendvicColor)
            )
        )
    );

    // Pridaj doplňujúce informácie ak existujú
    if (!empty($sendvicInfo)) {
        $sections[] = array(
            'title' => 'Weitere Informationen',
            'fields' => array(
                array('label' => 'Bericht', 'value' => $sendvicInfo)
            )
        );
    }

    // Generuj HTML email
    $message = maslen_email_template($subject, $sections);

    // Nastavenia pre HTML email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: maslen.at <no-reply@maslen.at>'
    );

    // Handle file attachment
    $attachments = array();
    if (!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    // Pridaj Reply-To header
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    // Send email with better error handling
    try {
        $sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Clean up uploaded file
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                @unlink($attachment);
            }
        }

        if ($sent) {
            // Prepare lead data for Laravel API
            // $lead_data = array(
            //     'full_name' => $priezvisko,
            //     'email' => $email,
            //     'phone' => $telKontakt,
            //     'product' => $selectedProductName ?: 'Sendvičové panely',
            //     'product_id' => !empty($selectedProduct) ? intval($selectedProduct) : null,
            //     'ga_id' => $ga_id,
            //     'branch' => $pobocka ? get_the_title($pobocka) : null,
            //     'branch_email' => $pobocka_email,
            //     'quote_type' => 'sendvic',
            //     'quote_data' => array(
            //         'usage' => $sendvicUsage,
            //         'insulation' => $sendvicInsulation,
            //         'thickness' => $sendvicThickness,
            //         'color' => $sendvicColor,
            //     ),
            //     'additional_info' => $sendvicInfo,
            //     'has_attachment' => !empty($attachments),
            // );

            // // Send to Laravel API (non-blocking, log errors if any)
            // $api_response = maslen_send_lead_to_api($lead_data);
            // if (is_wp_error($api_response)) {
            //     error_log('Failed to send lead to API: ' . $api_response->get_error_message());
            // }

            wp_send_json_success(array(
                'message' => 'E-Mail erfolgreich versendet',
                'gtm_tracking' => array(
                    'event' => 'track',
                    'eventCategory' => 'lead',
                    'eventAction' => 'contactForm_kalkulacia',
                    'eventLabel' => ''
                ),
                'debug' => array(
                    'to' => $to,
                    'has_attachment' => !empty($attachments)
                )
            ));
        } else {
            // Get more detailed error
            global $phpmailer;
            $error_message = 'Fehler beim Senden der E-Mail';
            if (isset($phpmailer) && isset($phpmailer->ErrorInfo)) {
                $error_message .= ': ' . $phpmailer->ErrorInfo;
            }
            wp_send_json_error(array(
                'message' => $error_message,
                'debug' => array(
                    'to' => $to,
                    'subject' => $subject,
                    'has_data' => !empty($priezvisko)
                )
            ));
        }
    } catch (Exception $e) {
        wp_send_json_error(array(
            'message' => 'Exception: ' . $e->getMessage()
        ));
    }
}

function handle_zvod_quote_submission() {
    // Skip nonce verification for now to debug
    // check_ajax_referer('zvod_quote_nonce', 'nonce');

    // Get form data from POST with isset checks
    $priezvisko = isset($_POST['priezvisko']) ? sanitize_text_field($_POST['priezvisko']) : '';
    $telKontakt = isset($_POST['telKontakt']) ? sanitize_text_field($_POST['telKontakt']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $pobocka = isset($_POST['pobocka']) ? sanitize_text_field($_POST['pobocka']) : '';
    $pobocka_email = isset($_POST['pobocka_email']) ? sanitize_email($_POST['pobocka_email']) : '';
    $selectedProduct = isset($_POST['selectedProduct']) ? sanitize_text_field($_POST['selectedProduct']) : '';
    $selectedProductName = isset($_POST['selectedProductName']) ? sanitize_text_field($_POST['selectedProductName']) : '';

    // Get zvod data with isset checks
    $zvodVersion = isset($_POST['zvodVersion']) ? sanitize_text_field($_POST['zvodVersion']) : '';
    $zvodColor = isset($_POST['zvodColor']) ? sanitize_text_field($_POST['zvodColor']) : '';
    $zvodInfo = isset($_POST['zvodInfo']) ? sanitize_textarea_field($_POST['zvodInfo']) : '';
    $zvodFileName = isset($_POST['zvodFileName']) ? sanitize_text_field($_POST['zvodFileName']) : '';
    $ga_id = isset($_POST['ga_id']) ? sanitize_text_field($_POST['ga_id']) : '';

    // Prepare email content
    $to = array('ulicny@maslen.at');

    // Pridaj email pobočky ak je zadaný
    // if (!empty($pobocka_email)) {
    //     // Redirect maslentn@maslen.sk to fodrek@maslen.sk
    //     if ($pobocka_email === 'maslentn@maslen.sk') {
    //         $to[] = 'fodrek@maslen.sk';
    //     } else {
    //         $to[] = $pobocka_email;
    //     }
    // }

    $subject = 'Neues Preisangebot - Regenrinnensystem';

    // Priprav sekcie pre email template
    $sections = array(
        array(
            'title' => 'Kontaktdaten',
            'fields' => array(
                array('label' => 'Name', 'value' => $priezvisko),
                array('label' => 'Telefonnummer', 'value' => $telKontakt),
                array('label' => 'Email', 'value' => $email),
                array('label' => 'PLZ der Realisierung', 'value' => $pobocka ? $pobocka : 'Nicht registriert')
            )
        ),
        array(
            'title' => 'Produkt',
            'fields' => array(
                array('label' => 'Ausgewähltes Produkt', 'value' => $selectedProductName)
            )
        ),
        array(
            'title' => 'Regenrinnensystem - Spezifikation',
            'fields' => array(
                array('label' => 'Typ', 'value' => $zvodVersion),
                array('label' => 'Farbe', 'value' => $zvodColor)
            )
        )
    );

    // Pridaj doplňujúce informácie ak existujú
    if (!empty($zvodInfo)) {
        $sections[] = array(
            'title' => 'Weitere Informationen',
            'fields' => array(
                array('label' => 'Bericht', 'value' => $zvodInfo)
            )
        );
    }

    // Generuj HTML email
    $message = maslen_email_template($subject, $sections);

    // Nastavenia pre HTML email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: maslen.at <no-reply@maslen.at>'
    );

    // Handle file attachment
    $attachments = array();
    if (!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    // Pridaj Reply-To header
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    // Send email with better error handling
    try {
        $sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Clean up uploaded file
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                @unlink($attachment);
            }
        }

        if ($sent) {
            // Prepare lead data for Laravel API
            // $lead_data = array(
            //     'full_name' => $priezvisko,
            //     'email' => $email,
            //     'phone' => $telKontakt,
            //     'product' => $selectedProductName ?: 'Zvodový systém',
            //     'product_id' => !empty($selectedProduct) ? intval($selectedProduct) : null,
            //     'ga_id' => $ga_id,
            //     'branch' => $pobocka ? get_the_title($pobocka) : null,
            //     'branch_email' => $pobocka_email,
            //     'quote_type' => 'zvod',
            //     'quote_data' => array(
            //         'version' => $zvodVersion,
            //         'color' => $zvodColor,
            //     ),
            //     'additional_info' => $zvodInfo,
            //     'has_attachment' => !empty($attachments),
            // );

            // // Send to Laravel API (non-blocking, log errors if any)
            // $api_response = maslen_send_lead_to_api($lead_data);
            // if (is_wp_error($api_response)) {
            //     error_log('Failed to send lead to API: ' . $api_response->get_error_message());
            // }

            wp_send_json_success(array(
                'message' => 'E-Mail erfolgreich versendet',
                'gtm_tracking' => array(
                    'event' => 'track',
                    'eventCategory' => 'lead',
                    'eventAction' => 'contactForm_kalkulacia',
                    'eventLabel' => ''
                ),
                'debug' => array(
                    'to' => $to,
                    'has_attachment' => !empty($attachments)
                )
            ));
        } else {
            // Get more detailed error
            global $phpmailer;
            $error_message = 'Fehler beim Senden der E-Mail';
            if (isset($phpmailer) && isset($phpmailer->ErrorInfo)) {
                $error_message .= ': ' . $phpmailer->ErrorInfo;
            }
            wp_send_json_error(array(
                'message' => $error_message,
                'debug' => array(
                    'to' => $to,
                    'subject' => $subject,
                    'has_data' => !empty($priezvisko)
                )
            ));
        }
    } catch (Exception $e) {
        wp_send_json_error(array(
            'message' => 'Exception: ' . $e->getMessage()
        ));
    }
}
    
    // // Údaje o type
    // formData.append('type', sessionStorage.getItem('massgefertigteoTitle') || '');
    // formData.append('thickness', sessionStorage.getItem('massgefertigteSubtypeTitle') || '');
    // formData.append('zameranie', sessionStorage.getItem('zameranie') === '1' ? 'Yes' : 'No');
    
    // // Údaje o krytine
    // formData.append('typKrytiny', sessionStorage.getItem('coveringTitle') || '');
    // formData.append('podtypKrytiny', sessionStorage.getItem('coveringSubtypeTitle') || '');

    
    // // Farba a doplnky
    // formData.append('farba', sessionStorage.getItem('massgefertigteColor') || '');
function handle_lemovanie_quote_submission() {
    // Skip nonce verification for now to debug
    // check_ajax_referer('zvod_quote_nonce', 'nonce');

    // Get form data from POST with isset checks
    $priezvisko = isset($_POST['priezvisko']) ? sanitize_text_field($_POST['priezvisko']) : '';
    $telKontakt = isset($_POST['telefon']) ? sanitize_text_field($_POST['telefon']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $pobocka = isset($_POST['pobocka']) ? sanitize_text_field($_POST['pobocka']) : '';
    $pobocka_email = isset($_POST['pobocka_email']) ? sanitize_email($_POST['pobocka_email']) : '';
    $selectedProduct = isset($_POST['selectedProduct']) ? sanitize_text_field($_POST['selectedProduct']) : '';
    $selectedProductName = isset($_POST['selectedProductName']) ? sanitize_text_field($_POST['selectedProductName']) : '';

    // Get zvod data with isset checks
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
    $thickness = isset($_POST['thickness']) ? sanitize_text_field($_POST['thickness']) : '';
    $farba = isset($_POST['farba']) ? sanitize_textarea_field($_POST['farba']) : '';
    //$zvodFileName = isset($_POST['nahranySubor']) ? sanitize_text_field($_POST['nahranySubor']) : '';
    $info = isset($_POST['info']) ? sanitize_textarea_field($_POST['info']) : '';
    $ga_id = isset($_POST['ga_id']) ? sanitize_text_field($_POST['ga_id']) : '';

    // Prepare email content
    $to = array('ulicny@maslen.at');

    // Pridaj email pobočky ak je zadaný
    // if (!empty($pobocka_email)) {
    //     // Redirect maslentn@maslen.sk to fodrek@maslen.sk
    //     if ($pobocka_email === 'maslentn@maslen.sk') {
    //         $to[] = 'fodrek@maslen.sk';
    //     } else {
    //         $to[] = $pobocka_email;
    //     }
    // }

    $subject = 'Neues Preisangebot - Maßgefertigte Kantteile';

    // Priprav sekcie pre email template
    $sections = array(
        array(
            'title' => 'Kontaktdaten',
            'fields' => array(
                array('label' => 'Name', 'value' => $priezvisko),
                array('label' => 'Telefonnummer', 'value' => $telKontakt),
                array('label' => 'Email', 'value' => $email),
                array('label' => 'PLZ der Realisierung', 'value' => $pobocka ? $pobocka : 'Nicht registriert')
            )
        ),
        array(
            'title' => 'Produkt',
            'fields' => array(
                array('label' => 'Ausgewähltes Produkt', 'value' => $selectedProductName)
            )
        ),
        array(
            'title' => 'Maßgefertigte Kantteile - Spezifikation',
            'fields' => array(
                array('label' => 'Material', 'value' => $type),
                array('label' => 'Dicke', 'value' => $thickness),
                array('label' => 'Farbe', 'value' => $farba)
            )
        )
    );

    // Pridaj doplňujúce informácie ak existujú
    if (!empty($info)) {
        $sections[] = array(
            'title' => 'Weitere Informationen',
            'fields' => array(
                array('label' => 'Bericht', 'value' => $info)
            )
        );
    }

    // Generuj HTML email
    $message = maslen_email_template($subject, $sections);

    // Nastavenia pre HTML email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: maslen.at <no-reply@maslen.at>'
    );

    // Handle file attachment
    $attachments = array();
    if (!empty($_FILES['file']['name'])) {
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            $attachments[] = $movefile['file'];
        }
    }

    // Pridaj Reply-To header
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    // Send email with better error handling
    try {
        $sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Clean up uploaded file
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                @unlink($attachment);
            }
        }

        if ($sent) {
            // Prepare lead data for Laravel API
            // $lead_data = array(
            //     'full_name' => $priezvisko,
            //     'email' => $email,
            //     'phone' => $telKontakt,
            //     'product' => $selectedProductName ?: 'Zvodový systém',
            //     'product_id' => !empty($selectedProduct) ? intval($selectedProduct) : null,
            //     'ga_id' => $ga_id,
            //     'branch' => $pobocka ? get_the_title($pobocka) : null,
            //     'branch_email' => $pobocka_email,
            //     'quote_type' => 'zvod',
            //     'quote_data' => array(
            //         'version' => $zvodVersion,
            //         'color' => $zvodColor,
            //     ),
            //     'additional_info' => $zvodInfo,
            //     'has_attachment' => !empty($attachments),
            // );

            // // Send to Laravel API (non-blocking, log errors if any)
            // $api_response = maslen_send_lead_to_api($lead_data);
            // if (is_wp_error($api_response)) {
            //     error_log('Failed to send lead to API: ' . $api_response->get_error_message());
            // }

            wp_send_json_success(array(
                'message' => 'E-Mail erfolgreich versendet',
                'gtm_tracking' => array(
                    'event' => 'track',
                    'eventCategory' => 'lead',
                    'eventAction' => 'contactForm_kalkulacia',
                    'eventLabel' => ''
                ),
                'debug' => array(
                    'to' => $to,
                    'has_attachment' => !empty($attachments)
                )
            ));
        } else {
            // Get more detailed error
            global $phpmailer;
            $error_message = 'Fehler beim Senden der E-Mail';
            if (isset($phpmailer) && isset($phpmailer->ErrorInfo)) {
                $error_message .= ': ' . $phpmailer->ErrorInfo;
            }
            wp_send_json_error(array(
                'message' => $error_message,
                'debug' => array(
                    'to' => $to,
                    'subject' => $subject,
                    'has_data' => !empty($priezvisko)
                )
            ));
        }
    } catch (Exception $e) {
        wp_send_json_error(array(
            'message' => 'Exception: ' . $e->getMessage()
        ));
    }
}



// /**
//  * Send lead data to Laravel CRM API
//  *
//  * @param array $lead_data Lead data to send
//  * @return array|WP_Error Response from API or error
//  */
// function maslen_send_lead_to_api($lead_data) {
//     // Get API configuration from WordPress options or use defaults
//     $api_url = LEAD_API_URL;
//     $api_token = LEAD_API_TOKEN;

//     // Prepare request arguments
//     $args = array(
//         'method' => 'POST',
//         'timeout' => 15,
//         'headers' => array(
//             'Content-Type' => 'application/json',
//             'Accept' => 'application/json',
//             'Authorization' => 'Bearer ' . $api_token,
//         ),
//         'body' => json_encode($lead_data),
//     );

//     // Make API request
//     $response = wp_remote_request($api_url, $args);

//     // Check for errors
//     if (is_wp_error($response)) {
//         error_log('Maslen API Error: ' . $response->get_error_message());
//         return $response;
//     }

//     $response_code = wp_remote_retrieve_response_code($response);
//     $response_body = wp_remote_retrieve_body($response);

//     if ($response_code >= 200 && $response_code < 300) {
//         return json_decode($response_body, true);
//     } else {
//         error_log('Maslen API Error: HTTP ' . $response_code . ' - ' . $response_body);
//         return new WP_Error('api_error', 'API request failed with status ' . $response_code, array('status' => $response_code));
//     }
// }

