<?php
/**
 * Template Name: Cenová ponuka – Klimatizácia rozcestník
 *
 * URL: /cenova-ponuka-rozcestnik/cenova-ponuka-klimatizacie/
 *
 * Sekcia 1 — tabuľka tried (ACF repeater "aircondproducts")
 *   • Stĺpce = triedy (Základ, Komfort, Pokročilá, Prémiová + Individuálna ponuka)
 *   • Klik "Mám záujem" uloží vybranú triedu do sessionStorage
 *     a odskroluje na sekciu 2
 *   • Klik "Kontaktovať" presmeruje na pre-formular
 *
 * Sekcia 2 — porovnanie produktov danej triedy
 *   • Viditeľná, keď je v sessionStorage "trieda" ALEBO URL param ?trieda=
 *   • Produkty sa berú z ACF relationship fieldu "aircondproducts_related"
 *   • Klik "Mám záujem" uloží produkt a presmeruje na formular
 *
 * ACF repeater field:  aircondproducts
 *   Subfields:
 *     title    (Text)
 *     class    (Text)
 *     control  (Text) — ovládanie lamiel
 *     filter   (Text) — pokročilé filtre
 *     design   (Text) — moderný dizajn
 *     price    (Text) — orientačná cena "od X €"
 *     related  (Relationship, Post Object) — priradené produkty
 *     featured (True/False) — populárna?
 */

defined( 'ABSPATH' ) || exit;

get_header();
igp_render_header();

// ── ACF data ─────────────────────────────────────────────────────────────────
$classes = [];
if ( function_exists('get_field') && have_rows('aircondproducts') ) {
    while ( have_rows('aircondproducts') ) {
        the_row();
        $classes[] = [
            'title'    => get_sub_field('title'),
            'class'    => get_sub_field('class'),
            'control'  => get_sub_field('control'),
            'filter'   => get_sub_field('filter'),
            'design'   => get_sub_field('design'),
            'price'    => get_sub_field('price'),
            'related'  => get_sub_field('related') ?: [],
            'featured' => get_sub_field('featured'),
        ];
    }
}

// Fallback / demo data when ACF is not set up yet
if ( empty($classes) ) {
    $classes = [
        [
            'title'    => 'Základ',
            'class'    => 'ZÁKLAD',
            'control'  => 'Horizontálne',
            'filter'   => false,
            'design'   => false,
            'price'    => 'od 800 €',
            'related'  => [],
            'featured' => false,
        ],
        [
            'title'    => 'Komfort',
            'class'    => 'KOMFORT',
            'control'  => 'Horizontálne i vertikálne',
            'filter'   => false,
            'design'   => false,
            'price'    => 'od 1 000 €',
            'related'  => [],
            'featured' => false,
        ],
        [
            'title'    => 'Pokročilá',
            'class'    => 'POKROČILÁ',
            'control'  => 'Horizontálne i vertikálne',
            'filter'   => true,
            'design'   => false,
            'price'    => 'od 1 200 €',
            'related'  => [],
            'featured' => true,
        ],
        [
            'title'    => 'Prémiová',
            'class'    => 'PRÉMIOVÁ',
            'control'  => 'Horizontálne i vertikálne',
            'filter'   => true,
            'design'   => true,
            'price'    => 'od 2 000 €',
            'related'  => [],
            'featured' => false,
        ],
    ];
}

$total_cols = count($classes) + 1; // +1 pre Individuálnu ponuku

// ── Produkty z ACF related postov (pre JS) ───────────────────────────────────
// Pre každú triedu zozbiera dáta z priradených product postov.
// Fieldy na product poste: price, power, efficiency, noise, featured (True/False)
// Obrázok = featured image postu.
$products_by_slug = [];
foreach ( $classes as $cls ) {
    $slug     = sanitize_title( $cls['title'] );
    $products = [];
    foreach ( $cls['related'] as $post ) {
        if ( ! $post ) continue;
        $pid        = is_object( $post ) ? $post->ID : (int) $post;
        $products[] = [
            'id'       => $pid,
            'name'     => get_the_title( $pid ),
            'price'    => (string) ( get_field( 'aircond-price-calc',      $pid ) ?: '' ),
            'power'    => (string) ( get_field( 'aircond-power-calc',      $pid ) ?: '' ),
            'eff'      => (string) ( get_field( 'aircond-efficiency-calc', $pid ) ?: '' ),
            'noise'    => (string) ( get_field( 'aircond-noise-calc',      $pid ) ?: '' ),
            'img'      => (string) ( get_the_post_thumbnail_url( $pid, 'medium' ) ?: '' ),
            'featured' => (bool)     get_field( 'aircond-featured-calc',   $pid ),
        ];
    }
    $products_by_slug[ $slug ] = $products;
}
?>

<div class="igp-page-container" style="max-width:1100px;">

    <!-- Nadpis -->
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:var(--igp-navy);font-size:2rem;">
            Vyberte si ideálnu klímu
        </h1>
        <p class="text-muted mx-auto" style="max-width:580px;">
            Porovnajte technologické úrovne klimatizácií a nájdite riešenie,
            ktoré presne vyhovuje vašim potrebám a rozpočtu.
        </p>
    </div>

    <!-- ─────────────────────── SEKCIA 1 — Výber triedy ──────────────────── -->
    <div id="igp-triedy-sekcia">
        <div class="igp-compare-wrap mb-5">
            <table class="igp-compare-table">
                <thead>
                    <tr>
                        <!-- Riadok nadpisov stĺpcov -->
                        <th style="width:160px;">Porovnanie</th>
                        <?php foreach ( $classes as $i => $cls ) : ?>
                            <th class="<?php echo $cls['featured'] ? 'igp-col-popular-wrap' : ''; ?>">
                                <?php if ( $cls['featured'] ) : ?>
                                    <span class="igp-popular-badge">Populárna</span>
                                <?php endif; ?>
                                <span class="igp-class-name"><?php echo esc_html( $cls['class'] ); ?></span>
                                <span class="igp-class-price"><?php echo esc_html( $cls['price'] ); ?></span>
                            </th>
                        <?php endforeach; ?>
                        <!-- Individuálna ponuka -->
                        <th>
                            <span class="igp-class-name">INDIVIDUÁLNA PONUKA</span>
                            <span class="igp-class-individual">Na mieru</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Riadok: Energetická účinnosť -->
                    <tr>
                        <td>Energetická účinnosť<br><small class="text-muted">chladenia / kúrenia</small></td>
                        <?php
                        $efficiency_map = ['A++ / A+', 'A++ / A++', 'A+++ / A++', 'A+++ / A+++'];
                        foreach ( $classes as $i => $cls ) :
                        ?>
                            <td class="<?php echo $cls['featured'] ? 'igp-col-popular' : ''; ?>">
                                <?php echo esc_html( $efficiency_map[$i] ?? '–' ); ?>
                            </td>
                        <?php endforeach; ?>
                        <td><span class="igp-check-no"><i class="bi bi-dash-lg"></i></span></td>
                    </tr>

                    <!-- Riadok: Ovládanie lamiel -->
                    <tr>
                        <td>Ovládanie lamiel</td>
                        <?php foreach ( $classes as $i => $cls ) : ?>
                            <td class="<?php echo $cls['featured'] ? 'igp-col-popular' : ''; ?>">
                                <?php if ( ! empty( $cls['control'] ) ) : ?>
                                    <?php echo esc_html( $cls['control'] ); ?>
                                <?php else : ?>
                                    <span class="igp-check-no"><i class="bi bi-dash-lg"></i></span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td><span class="igp-check-no"><i class="bi bi-dash-lg"></i></span></td>
                    </tr>

                    <!-- Riadok: Pokročilé filtre -->
                    <tr>
                        <td>Pokročilé filtre</td>
                        <?php foreach ( $classes as $i => $cls ) : ?>
                            <td class="<?php echo $cls['featured'] ? 'igp-col-popular' : ''; ?>">
                                <?php if ( $cls['filter'] ) : ?>
                                    <span class="igp-check-yes"><i class="bi bi-check-circle-fill"></i></span>
                                    <small class="ms-1">Áno</small>
                                <?php else : ?>
                                    <span class="igp-check-no"><i class="bi bi-x-lg"></i></span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td><span class="igp-check-no"><i class="bi bi-dash-lg"></i></span></td>
                    </tr>

                    <!-- Riadok: Moderný dizajn -->
                    <tr>
                        <td>Moderný dizajn</td>
                        <?php foreach ( $classes as $i => $cls ) : ?>
                            <td class="<?php echo $cls['featured'] ? 'igp-col-popular' : ''; ?>">
                                <?php if ( $cls['design'] ) : ?>
                                    <span class="igp-check-yes"><i class="bi bi-check-circle-fill"></i></span>
                                    <small class="ms-1">Áno</small>
                                <?php else : ?>
                                    <span class="igp-check-no"><i class="bi bi-x-lg"></i></span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td><span class="igp-check-no"><i class="bi bi-dash-lg"></i></span></td>
                    </tr>

                    <!-- Riadok: Tlačidlá akcií -->
                    <tr>
                        <td></td>
                        <?php foreach ( $classes as $i => $cls ) : ?>
                            <td class="<?php echo $cls['featured'] ? 'igp-col-popular' : ''; ?>">
                                <?php
                                $classSlug = sanitize_title( $cls['title'] );
                                $btnClass  = $cls['featured'] ? 'igp-btn-primary' : 'igp-btn-outline';
                                $btnLabel  = $cls['featured'] ? 'VYBRAŤ'         : 'Mám záujem';
                                ?>
                                <button type="button"
                                        class="<?php echo esc_attr($btnClass); ?> w-100"
                                        onclick="igpVyberTriedu(
                                            '<?php echo esc_js( $cls['title'] ); ?>',
                                            '<?php echo esc_js( $cls['price'] ); ?>',
                                            '<?php echo esc_js( $classSlug ); ?>'
                                        )">
                                    <?php echo esc_html( $btnLabel ); ?>
                                </button>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a href="<?php echo esc_url( home_url('/cenova-ponuka-rozcestnik/cenova-ponuka-klimatizacie-formular/') ); ?>"
                               class="igp-btn-outline w-100 text-center"
                               onclick="IGPForm.save('vyber_triedy','individual'); IGPForm.sendGA('rozcestnik_individual_click',{});">
                                Kontaktovať
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Prečo si vybrať montáž od nás
        <div class="row align-items-center g-4 mb-5">
            <div class="col-12 col-md-6">
                <h2 class="fw-bold mb-3" style="color:var(--igp-navy);">Prečo si vybrať montáž od nás?</h2>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div style="width:40px;height:40px;background:var(--igp-primary-bg);border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-shield-check text-primary"></i>
                    </div>
                    <div>
                        <strong>Máme za sebou už tisícku montáží</strong>
                        <p class="text-muted small mb-0">Overte si recenzie na Google. Nie je nič horšie ako odflaknutá montáž a nespoľahlivý servis. Toto vás s nami určite nečaká.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3">
                    <div style="width:40px;height:40px;background:var(--igp-primary-bg);border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-award text-primary"></i>
                    </div>
                    <div>
                        <strong>Predĺžená záruka 5 rokov</strong>
                        <p class="text-muted small mb-0">Veríme značkám s ktorými spolupracujeme, aj preto vám ponúkame predĺženú ochranu bez skrytých poplatkov.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div style="height:220px;background:linear-gradient(135deg,#c7d7f0,#8ca9d6);border-radius:16px;"></div>
            </div>
        </div> -->
    </div><!-- /#igp-triedy-sekcia -->

    <!-- ─────────────────────── SEKCIA 2 — Porovnanie produktov ──────────── -->
    <div id="igp-produkty-sekcia" class="igp-hidden">

        <h2 class="fw-bold mb-2" style="font-size:1.8rem;color:var(--igp-navy);">
            Odporúčané klimatizácie a ich porovnanie
        </h2>
        <p class="text-muted mb-4" style="max-width:620px;">
            Máme za sebou tisícky montáží a prevádzkovania klimatizácií po celom Slovensku.
            Vieme čo je dobré a kvalitné. Aj preto si vám dovoľujeme odporúčiť tieto klimatizácie.
            V prípade záujmu kliknite na mám záujem.
        </p>

        <!-- Produkty + porovnanie parametrov — vykresľuje sa JS ako jednotná tabuľka -->
        <div id="igp-produkty-container" class="mb-5">
            <p class="text-muted fst-italic">Načítavam produkty...</p>
        </div>

    </div><!-- /#igp-produkty-sekcia -->

    <!-- Debug panel -->
    <div class="igp-debug-wrap">
        <div class="igp-debug-heading">🛠 SessionStorage — aktuálne hodnoty</div>
        <div id="igp-debug-panel"></div>
    </div>

</div><!-- /igp-page-container -->

<!-- ── Inline JS pre túto stránku ─────────────────────────────────────────── -->
<script>
// ACF produkty odovzdané z PHP — kľúč = slug triedy
var igpProductsBySlug = <?php echo wp_json_encode( $products_by_slug ); ?>;
</script>
<script>
/**
 * Zavolaný po kliknutí "Mám záujem / VYBRAŤ" v tabuľke tried.
 * Uloží vybranú triedu, odskroluje na sekciu 2 a vykreslí produkty z ACF.
 */
function igpVyberTriedu(title, price, slug) {
    IGPForm.save('vyber_triedy',       title);
    IGPForm.save('vyber_triedy_cena',  price);
    IGPForm.save('vyber_triedy_slug',  slug);
    IGPForm.sendGA('rozcestnik_trieda_click', { trieda: title });

    // Zobraziť sekciu 2 a skryť tabuľku tried
    document.getElementById('igp-produkty-sekcia').classList.remove('igp-hidden');

    // Scroll na sekciu 2
    document.getElementById('igp-produkty-sekcia').scrollIntoView({
        behavior: 'smooth', block: 'start'
    });

    // Renderovanie produktov z PHP dát (odovzdané cez wp_localize_script / data atribút)
    igpRenderProdukty(slug);
}

/**
 * Vykreslí produkty pre vybranú triedu ako jednotnú zarovnanú tabuľku.
 * Cards produktov sú v thead, parametre v tbody — stĺpce sa vždy zarovnajú.
 */
function igpRenderProdukty(slug) {
    var container = document.getElementById('igp-produkty-container');

    // Produkty z ACF pre danú triedu; fallback na prázdne pole
    var products = (igpProductsBySlug && igpProductsBySlug[slug] && igpProductsBySlug[slug].length)
        ? igpProductsBySlug[slug]
        : [];

    if ( ! products.length ) {
        container.innerHTML = '<p class="text-muted fst-italic">Pre túto triedu zatiaľ nie sú priradené produkty.</p>';
        return;
    }

    var params = [
        { label: 'Chladiaci výkon',     key: 'power' },
        { label: 'Trieda efektívnosti', key: 'eff',   highlight: true },
        { label: 'Hlučnosť',            key: 'noise' },
    ];

    // Jednotná tabuľka — product cards v thead, parametre v tbody
    var minW = 160 + products.length * 190;
    var html = '<div class="igp-compare-wrap">';
    html += '<table class="igp-param-table" style="min-width:' + minW + 'px;">';

    // ── thead: product card columns ──────────────────────────────────────
    html += '<thead><tr>';
    html += '<th style="min-width:160px;background:#F1F5F9;">POROVNÁVANÉ PARAMETRE</th>';
    products.forEach(function(p) {
        html += '<th style="background:#fff;vertical-align:top;padding:16px 14px;min-width:190px;border-bottom:2px solid var(--igp-border);">';
        html += '<div class="igp-product-col-inner">';
        if (p.featured) {
            html += '<span class="igp-nas-tip-badge">Náš tip</span>';
        }
        html += '<img src="' + (p.img || '') + '" alt="' + p.name + '">';
        html += '<span class="igp-product-col-name">' + p.name + '</span>';
        html += '<span class="igp-product-col-price">' + p.price + '</span>';
        html += '<button type="button" class="' + (p.featured ? 'igp-btn-primary' : 'igp-btn-outline') + ' w-100"';
        html += ' onclick="igpVyberProdukt(' + p.id + ',\'' + p.name.replace(/'/g, "\\'") + '\',\'' + p.price + '\')">Mám záujem</button>';
        html += '</div></th>';
    });
    html += '</tr></thead>';

    // ── tbody: param rows ────────────────────────────────────────────────
    html += '<tbody>';
    params.forEach(function(row) {
        html += '<tr><td style="font-weight:500;color:#4B5563;">' + row.label + '</td>';
        products.forEach(function(p) {
            var val = p[row.key] || '—';
            var cls = (row.highlight && p.featured) ? ' class="igp-param-highlight"' : '';
            html += '<td' + cls + '>' + val + '</td>';
        });
        html += '</tr>';
    });
    html += '</tbody></table></div>';

    container.innerHTML = html;
    console.log('[IGP] igpRenderProdukty — vykreslených produktov:', products.length);
}

/**
 * Uloží vybraný produkt do sessionStorage a presmeruje na formular.
 */
function igpVyberProdukt(id, name, price) {
    IGPForm.save('vyber_produktu_id',    id);
    IGPForm.save('vyber_produktu_nazov', name);
    IGPForm.save('vyber_produktu_cena',  price);
    IGPForm.sendGA('rozcestnik_produkt_click', { produkt: name, cena: price });

    window.location.href = '<?php echo esc_js( home_url('/cenova-ponuka-rozcestnik/cenova-ponuka-klimatizacie-formular/') ); ?>';
}

// Obnoviť sekciu produktov, ak bola trieda uložená z predchádzajúcej návštevy
document.addEventListener('DOMContentLoaded', function() {
    var savedSlug = IGPForm.get('vyber_triedy_slug');
    if (savedSlug) {
        document.getElementById('igp-produkty-sekcia').classList.remove('igp-hidden');
        igpRenderProdukty(savedSlug);
    }
});
</script>

<?php get_footer(); ?>
