<?php
require_once get_stylesheet_directory() . '/igp-form/php/loader.php';

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


function custom_post_info() {
    ob_start();
    ?>
    <div class="article-info">
      <span class="badge">Novinka</span>
      <span class="category">
        • <?php echo get_the_category_list(', '); ?>
      </span>
      <span class="reading-time">
        • <?php
          $content = get_post_field('post_content', get_the_ID());
          $word_count = str_word_count(strip_tags($content));
          $reading_time = ceil($word_count / 500);
          echo $reading_time . ' minút čítania';
        ?>
      </span>
      <span class="date">| <?php echo get_the_date(); ?></span>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('post_info', 'custom_post_info');

// Prefix /blog/ jen pro články
add_filter('post_link', function ($permalink, $post) {
    if ($post instanceof WP_Post && $post->post_type === 'post') {
        return home_url(user_trailingslashit('blog/' . $post->post_name));
    }
    return $permalink;
}, 10, 2);

// Rewrite pravidlo pro /blog/slug/ -> single post
add_action('init', function () {
    add_rewrite_rule('^blog/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
}, 10);

// 301 z /slug/ na /blog/slug/, pokud existuje post se stejným slugem
add_action('template_redirect', function () {
    if (is_admin() || is_preview() || (defined('REST_REQUEST') && REST_REQUEST) || is_feed()) {
        return;
    }

    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    // už jsme na /blog/... nebo na kořeni
    if ($path === '' || strpos($path, 'blog/') === 0) return;

    // Pokud existuje článek s tímto pathem, přesměruj
    $maybe_post = get_page_by_path($path, OBJECT, 'post');
    if ($maybe_post instanceof WP_Post && $maybe_post->post_type === 'post') {
        $target = home_url(user_trailingslashit('blog/' . $maybe_post->post_name));
        // ochrana proti smyčce
        if (trailingslashit(home_url($path)) !== trailingslashit($target)) {
            wp_redirect($target, 301);
            exit;
        }
    }
});

function acf_load_products_dynamic_shortcode() {
    $post_id = get_the_ID();
    $values = get_field('productsdynfields', $post_id);

    if (empty($values)) {
        return '<p>Nezadefinovane parametre.</p>';
    }

    if (!is_array($values)) {
        $values = [$values];
    }

    $output = '';
    foreach ($values as $val) {
        $val = trim($val);
        if (!$val) continue;

        $output .= do_shortcode('[igp-list-cpt-by-fields ' . $val . ']');
    }

    return $output;
}
add_shortcode('acf-load-products-dynamic', 'acf_load_products_dynamic_shortcode');


/**
 * Send IGP configurator form submissions to Laravel Lead API.
 * Triggered via do_action('igp_form_submitted') in loader.php (AJAX handler),
 * called on submit from template-cenova-ponuka-klimatizacia-vyhodnotenie.php.
 */
add_action( 'igp_form_submitted', 'mallay_send_igp_lead_to_crm', 10, 7 );

function mallay_send_igp_lead_to_crm( $meno, $mobil, $email, $adresa, $poznamka, $ga_id, $session_data ) {
    if ( ! defined('LEAD_API_BASE_URL') || ! defined('LEAD_API_TOKEN') ) return;

    $produkt_typ = $session_data['igp_produkt_typ'] ?? 'klimatizacia';

    if ( $produkt_typ === 'cerpadlo' ) {
        // TODO: prispôsobiť payload pre tepelné čerpadlá (iné session kľúče, quote_type atď.)
        $payload = [
            'full_name'       => $meno,
            'phone'           => $mobil,
            'email'           => $email,
            'quote_type'      => $produkt_typ,
            'object_type'     => $session_data['igp_preformular_rozmer'] ?? '',
            'city'            => $adresa,
            'additional_info' => $poznamka,
            'ga_id'           => $ga_id ?: null,
        ];
    } else {
        // klimatizacia (default)
        $payload = [
            'full_name'       => $meno,
            'phone'           => $mobil,
            'email'           => $email,
            'quote_type'      => $produkt_typ,
            'object_type'     => $session_data['igp_preformular_rozmer'] ?? '',
            'city'            => $adresa,
            'additional_info' => $poznamka,
            'ga_id'           => $ga_id ?: null,
        ];
    }

    $response = wp_remote_post( LEAD_API_BASE_URL . 'leads', [
        'method'  => 'POST',
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'X-API-Token'  => LEAD_API_TOKEN,
        ],
        'body'    => wp_json_encode( $payload ),
        'timeout' => 10,
    ]);

    if ( is_wp_error( $response ) ) {
        error_log( '[IGP CRM] API error: ' . $response->get_error_message() );
        return;
    }

    $code = wp_remote_retrieve_response_code( $response );
    if ( $code >= 400 ) {
        error_log( sprintf( '[IGP CRM] HTTP %d: %s', $code, wp_remote_retrieve_body( $response ) ) );
    }
}


add_filter( 'wp_mail_charset', function() {
    return 'UTF-8';
});

add_filter( 'wp_mail_content_type', function() {
    return 'text/html; charset=UTF-8';
});

/**
 * Send Avada Fusion Form submissions to Laravel Lead API.
 */
add_action( 'fusion_form_submission_data', 'mallay_send_lead_to_crm', 10, 2 );

function mallay_send_lead_to_crm( $fusion_submission, $form_id ) {
    error_log('fusion_form_submission hook started form id ' . $form_id );
    if($form_id !== 2428) return;
    error_log('mallay_send_lead_to_crm start');
	// Normalize submitted data array.
    $fusion_submission_data = $fusion_submission['data'];
	

    
    error_log('fusion_form_submission data: ' . print_r($fusion_submission_data, true));
    


    if (!empty($_COOKIE['_ga'])) {

        $ga_cookie = sanitize_text_field($_COOKIE['_ga']);

        // Match GA1.X.1234567890.1709051234
        if (preg_match('/GA\d\.\d\.(\d+\.\d+)/', $ga_cookie, $matches)) {
            $client_id = $matches[1];
        }else{
            $client_id = '';
        }
    }

	$payload = [
		'full_name'       => $fusion_submission_data['first_name'] ?? '',
		'phone'           => $fusion_submission_data['telephone'] ?? '',
		'email'           => $fusion_submission_data['your_email'] ?? '',
		'quote_type'         => $fusion_submission_data['sluzba_o_ktoru_mate_zaujem'] ?? '',
		'object_type'     => $fusion_submission_data['typ_priestoru'] ?? '',
		'city'            => $fusion_submission_data['vasa_lokalita'] ?? '',
		'additional_info' => $fusion_submission_data['sprava'] ?? '',
        'ga_id'           => $client_id ?? null,
	];

    //error_log('fusion_form_submission payload: ' . print_r($payload, true));

	// Basic guard to avoid firing on completely empty payloads.
	if ( empty( $payload['full_name'] ) && empty( $payload['email'] ) && empty( $payload['phone'] ) ) {
		return;
	}

	// Adjust this if your Laravel app lives on a different base URL.
	$api_url =  LEAD_API_BASE_URL . 'leads';

	$api_token = defined( 'LEAD_API_TOKEN' ) ? LEAD_API_TOKEN : '';

    error_log('fusion_form_submission URL: ' . $api_url);

	$args = [
		'method'  => 'POST',
		'headers' => [
			'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
			'X-API-Token'  => $api_token,
		],
		'body'    => wp_json_encode( $payload ),
		'timeout' => 10,
	];

    //error_log('fusion_form_submission args: ' . print_r($args, true));

	$response = wp_remote_post( $api_url, $args );

    error_log('fusion_form_submission response: ' . print_r($response, true));

	if ( is_wp_error( $response ) ) {
		error_log( 'Lead CRM API error: ' . $response->get_error_message() );
		return;
	}

	$code = wp_remote_retrieve_response_code( $response );
	if ( $code >= 400 ) {
		error_log(
			sprintf(
				'Lead CRM API HTTP error %d: %s',
				$code,
				wp_remote_retrieve_body( $response )
			)
		);
	}
}