<?php
/**
 * Template Name: Cenová ponuka – Hlavný rozcestník
 *
 * URL: /kalkulacia         (alebo ako je nastavené v WP)
 * Zobrazuje 3 dlaždice: Klimatizácia, Tepelné čerpadlo, Chcete poradiť.
 * Klik na TČ vyvolá informačný modal (sekcia v rekonštrukcii).
 */

defined( 'ABSPATH' ) || exit;

get_header();
igp_render_header();  // z loader.php
?>

<div class="igp-page-container" style="max-width:960px;">

    <!-- Nadpis stránky -->
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:var(--igp-navy);font-size:1.9rem;">
            Aký konfigurátor chcete využiť?
        </h1>
        <p class="text-muted">
            Vyberte si typ zariadenia alebo nás kontaktujte pre poradenstvo
        </p>
    </div>

    <!-- 3 hero dlaždice -->
    <div class="row g-4 justify-content-center">

        <!-- Klimatizácia -->
        <div class="col-12 col-md-4">
            <a href="<?php echo esc_url( home_url('/kalkulacia-klimatizacia') ); ?>"
               class="igp-hero-tile igp-tile-blue text-decoration-none"
               onclick="IGPForm.sendGA('rozcestnik_click', {tile:'klimatizacia'})">
                <div class="igp-tile-icon-wrap">
                    <i class="bi bi-snow2"></i>
                </div>
                <div class="igp-tile-title">Klimatizácia</div>
                <div class="igp-tile-desc">Efektívne chladenie a vykurovanie vášho priestoru</div>
            </a>
        </div>

        <!-- Tepelné čerpadlo — v rekonštrukcii -->
        <div class="col-12 col-md-4">
            <div class="igp-hero-tile igp-tile-orange"
                 role="button"
                 tabindex="0"
                 id="tc-tile"
                 onclick="document.getElementById('igp-tc-modal').classList.add('active')"
                 onkeydown="if(event.key==='Enter') document.getElementById('igp-tc-modal').classList.add('active')">
                <div class="igp-tile-icon-wrap">
                    <i class="bi bi-fire"></i>
                </div>
                <div class="igp-tile-title">Tepelné čerpadlo</div>
                <div class="igp-tile-desc">Ekologické a úsporné vykurovanie vášho domu</div>
            </div>
        </div>

        <!-- Chcete poradiť? -->
        <div class="col-12 col-md-4">
            <div class="igp-hero-tile igp-tile-green">
                <div class="igp-tile-icon-wrap">
                    <i class="bi bi-telephone"></i>
                </div>
                <div class="igp-tile-title">Chcete poradiť?</div>
                <div class="igp-tile-desc">Zavolajte nám a radi vám pomôžeme</div>
                <a href="tel:+421918973772"
                   class="igp-tile-phone-btn mt-3"
                   onclick="IGPForm.sendGA('rozcestnik_phone_click', {})">
                    +421 918 973 772
                </a>
            </div>
        </div>

    </div><!-- /row -->

    <!-- Debug panel (vidí sa len počas vývoja, v produkcii odstrániť) -->
    <div class="igp-debug-wrap mt-4">
        <div class="igp-debug-heading">🛠 SessionStorage — aktuálne hodnoty</div>
        <div id="igp-debug-panel"></div>
    </div>

</div><!-- /igp-page-container -->

<!-- ── Modal: Tepelné čerpadlo v rekonštrukcii ─────────────────────────────── -->
<div class="igp-modal-overlay" id="igp-tc-modal"
     role="dialog" aria-modal="true" aria-labelledby="tc-modal-title">
    <div class="igp-modal-box">
        <div class="igp-modal-icon">🚧</div>
        <h5 class="fw-bold mb-2" id="tc-modal-title">
            Táto sekcia je v rekonštrukcii
        </h5>
        <p class="text-muted mb-4">
            Konfigurátor tepelných čerpadiel momentálne pripravujeme.
            V prípade záujmu nás prosím kontaktujte telefonicky.
        </p>
        <a href="tel:+421918973772"
           class="igp-btn-primary d-block text-center mb-3">
            +421 918 973 772
        </a>
        <button class="igp-btn-outline w-100"
                onclick="document.getElementById('igp-tc-modal').classList.remove('active')">
            Zavrieť
        </button>
    </div>
</div>

<?php get_footer(); ?>
