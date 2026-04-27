<?php
/**
 * Template Name: Cenová ponuka – Klimatizácia vyhodnotenie
 *
 * URL: /kalkulacia/klimatizácie-vyhodnotenie
 *
 * Finálna stránka konfiguračního procesu.
 *
 * Zobrazuje:
 *   1. Súhrn odporúčaného produktu (z sessionStorage)
 *   2. Kontaktný formulár (meno, adresa, PSČ, mobil, email, poznámka)
 *
 * Po odoslaní:
 *   - Formular dáta + všetky igp_ sessionStorage hodnoty sa pošlú
 *     cez AJAX na wp_ajax_igp_submit_form (loader.php)
 *   - Zobrazí sa potvrdzovacie hlásenie
 *   - Odošle sa GA event
 */

defined( 'ABSPATH' ) || exit;

get_header();
igp_render_header();
?>

<div class="igp-page-container">

    <!-- Späť na formular -->
    <a href="<?php echo esc_url( home_url('/kalkulacia/klimatizacie-formular') ); ?>"
       class="igp-btn-outline mb-4 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Späť
    </a>

    <!-- ── Odporúčaný produkt (z sessionStorage) ─────────────────────────── -->
    <div class="igp-recommendation-card mb-4 igp-hidden" id="cf-product-card">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-7">
                <h3 class="igp-rec-title" id="cf-product-name">Načítavam...</h3>
                <p class="igp-rec-desc" id="vy-produkt-popis">
                    Klimatizácia je diskrétna nástenná jednotka, ktorá ponúka
                    vysokú energetickú účinnosť, tichú prevádzku a pokročilé funkcie
                    čistenia vzduchu, vďaka čomu je obľúbenou voľbou do domácností
                    a kancelárií.
                </p>
                <div class="igp-rec-price-label mt-3">Odhadovaná cena:</div>
                <div>
                    <span class="igp-rec-price" id="cf-product-price">–</span>
                    <span class="igp-rec-price-unit ms-1">s DPH</span>
                </div>
            </div>
            <div class="col-12 col-md-5 text-center">
                <img id="cf-product-img" src="" alt="Klimatizácia"
                     style="max-height:170px;object-fit:contain;background:rgba(255,255,255,.6);
                            border-radius:8px;width:100%;">
            </div>
        </div>
    </div><!-- /produkt -->

    <!-- ── Kontaktný formulár ─────────────────────────────────────────────── -->
    <div id="cf-form-wrap" style="max-width:560px;margin:0 auto;">

        <form id="igp-vyhodnotenie-form" novalidate>

            <!-- Meno a priezvisko -->
            <div class="mb-3">
                <label for="cf-meno" class="form-label fw-semibold">
                    Meno a priezvisko <span class="text-danger">*</span>
                </label>
                <input type="text" id="cf-meno" name="meno"
                       class="form-control igp-input"
                       placeholder="Ján Novák"
                       required
                       oninput="IGPForm.save('cf_meno', this.value)">
            </div>

            <!-- Adresa realizácie -->
            <div class="mb-3">
                <label for="cf-adresa" class="form-label fw-semibold">
                    Adresa realizácie <span class="text-danger">*</span>
                </label>
                <input type="text" id="cf-adresa" name="adresa"
                       class="form-control igp-input"
                       placeholder="Ulica 123, Mesto"
                       required
                       oninput="IGPForm.save('cf_adresa', this.value)">
            </div>

            <!-- PSČ -->
            <div class="mb-3">
                <label for="cf-psc" class="form-label fw-semibold">
                    PSČ <span class="text-danger">*</span>
                </label>
                <input type="text" id="cf-psc" name="psc"
                       class="form-control igp-input"
                       placeholder="012 34"
                       maxlength="10"
                       required
                       oninput="IGPForm.save('cf_psc', this.value)">
            </div>

            <!-- Mobil -->
            <div class="mb-3">
                <label for="cf-mobil" class="form-label fw-semibold">
                    Mobil <span class="text-danger">*</span>
                </label>
                <input type="tel" id="cf-mobil" name="mobil"
                       class="form-control igp-input"
                       placeholder="+421 XXX XXX XXX"
                       required
                       oninput="IGPForm.save('cf_mobil', this.value)">
            </div>

            <!-- E-mail -->
            <div class="mb-3">
                <label for="cf-email" class="form-label fw-semibold">
                    E-mail <span class="text-danger">*</span>
                </label>
                <input type="email" id="cf-email" name="email"
                       class="form-control igp-input"
                       placeholder="jan.novak@email.sk"
                       required
                       oninput="IGPForm.save('cf_email', this.value)">
            </div>

            <!-- Poznámka (voliteľné) -->
            <div class="mb-3">
                <label for="cf-poznamka" class="form-label fw-semibold">
                    Poznámka <span class="text-muted fw-normal">(voliteľné)</span>
                </label>
                <textarea id="cf-poznamka" name="poznamka"
                          class="form-control igp-input"
                          rows="4"
                          placeholder="Tu môžete vpísať poznámku napr. aj s informáciou kedy vás môžeme kontaktovať…."
                          oninput="IGPForm.save('cf_poznamka', this.value)"></textarea>
            </div>

            <!-- Príloha (voliteľné) -->
            <div class="mb-4">
                <label for="cf-fotka" class="form-label fw-semibold">
                    Príloha <span class="text-muted fw-normal">(voliteľné)</span>
                </label>
                <p class="text-muted small mb-2">
                    Môžete priložiť fotku, náčrt alebo iný dokument, ktorý nám pomôže lepšie pochopiť vašu situáciu.
                </p>
                <input type="file" id="cf-fotka" name="fotka"
                       class="form-control igp-input"
                       accept="image/*,.pdf"
                       aria-describedby="cf-fotka-help">
                <div id="cf-fotka-help" class="form-text">
                    Povolené formáty: JPG, PNG, WEBP, PDF. Max. veľkosť: 8 MB.
                </div>
            </div>

            <!-- GDPR súhlas -->
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" id="cf-gdpr" name="gdpr"
                           class="form-check-input" required>
                    <label for="cf-gdpr" class="form-check-label" style="font-size:0.875rem;">
                        Súhlasím s
                        <a href="<?php echo esc_url( home_url('/ochrana-osobnych-udajov/') ); ?>"
                           target="_blank" rel="noopener">podmienkami ochrany osobných údajov</a>
                        <span class="text-danger">*</span>
                    </label>
                </div>
            </div>

            <!-- Error / success hlásenie -->
            <div id="cf-feedback" class="alert d-none mb-3" role="alert"></div>

            <!-- Odoslať tlačidlo -->
            <button type="submit" id="cf-submit-btn"
                    class="fusion-button button-flat fusion-button-default-size button-default fusion-button-default button-4 igp-btn-primary w-100 py-3"
                    style="font-size:1rem;">
                Odoslať
            </button>

        </form><!-- /#igp-vyhodnotenie-form -->

    </div><!-- /#cf-form-wrap -->

    <!-- Debug panel -->
    <div class="igp-debug-wrap mt-4">
        <div class="igp-debug-heading">🛠 SessionStorage — aktuálne hodnoty</div>
        <div id="igp-debug-panel"></div>
    </div>

</div><!-- /igp-page-container -->

<!-- ── Inline JS ──────────────────────────────────────────────────────────── -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ─── Typ produktu (pre CRM rozlíšenie) ────────────────────────────────
    IGPForm.save('produkt_typ', 'klimatizacia');

    // ─── Naplniť produkt z sessionStorage ─────────────────────────────────
    var nazov = IGPForm.get('vyber_produktu_nazov');
    var cena  = IGPForm.get('vyber_produktu_cena');
    var img   = IGPForm.get('vyber_produktu_img');
    if (nazov) document.getElementById('cf-product-name').textContent = nazov;
    if (cena)  document.getElementById('cf-product-price').textContent  = cena;
    if (img && img !== '')   document.getElementById('cf-product-img').src = img;

    // ─── Obnov uložené kontaktné údaje ────────────────────────────────────
    var fields = {
        'cf-meno':     'cf_meno',
        'cf-adresa':   'cf_adresa',
        'cf-psc':      'cf_psc',
        'cf-mobil':    'cf_mobil',
        'cf-email':    'cf_email',
        'cf-poznamka': 'cf_poznamka',
    };
    Object.keys(fields).forEach(function (elId) {
        var saved = IGPForm.get(fields[elId]);
        if (saved) {
            var el = document.getElementById(elId);
            if (el) el.value = saved;
        }
    });

    // ─── Odoslanie formulára cez AJAX ──────────────────────────────────────
    var form      = document.getElementById('igp-vyhodnotenie-form');
    var submitBtn = document.getElementById('cf-submit-btn');
    var feedback  = document.getElementById('cf-feedback');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Základná validácia
        var meno   = document.getElementById('cf-meno').value.trim();
        var adresa = document.getElementById('cf-adresa').value.trim();
        var psc    = document.getElementById('cf-psc').value.trim();
        var mobil  = document.getElementById('cf-mobil').value.trim();
        var email  = document.getElementById('cf-email').value.trim();

        if (!meno || !adresa || !psc || !mobil || !email) {
            showFeedback('Prosím vyplňte všetky povinné polia.', 'danger');
            return;
        }
        // Simple email format check
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showFeedback('Zadajte platný e-mail.', 'danger');
            return;
        }
        // GDPR check
        if (!document.getElementById('cf-gdpr').checked) {
            showFeedback('Prosím potvrďte súhlas s ochranou osobných údajov.', 'danger');
            return;
        }
        // File size check (max 8 MB)
        var fotkaInput = document.getElementById('cf-fotka');
        if (fotkaInput && fotkaInput.files.length > 0) {
            if (fotkaInput.files[0].size > 8 * 1024 * 1024) {
                showFeedback('Súbor je príliš veľký. Maximálna povolená veľkosť je 8 MB.', 'danger');
                return;
            }
        }

        submitBtn.disabled    = true;
        submitBtn.textContent = 'Odosiela sa…';

        // Zostavenie FormData
        var formData = IGPForm.buildFormData(new FormData(form));
        formData.append('action',  'igp_submit_form');
        formData.append('nonce',   (window.igpConfig || {}).nonce || '');

        fetch((window.igpConfig || {}).ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body:   formData,
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data.success) {
                showFeedback(data.data.message || 'Ďakujeme! Budeme vás čoskoro kontaktovať.', 'success');
                form.reset();
                IGPForm.clearAll();
                submitBtn.disabled    = true;
                submitBtn.textContent = 'Odoslané ✓';
                IGPForm.sendGA('form_submitted', {
                    email: email,
                    produkt: IGPForm.get('vyber_produktu_nazov') || '',
                });
            } else {
                showFeedback(data.data.message || 'Odoslanie zlyhalo. Skúste to opäť.', 'danger');
                submitBtn.disabled    = false;
                submitBtn.textContent = 'Odoslať';
            }
        })
        .catch(function () {
            showFeedback('Nastala chyba pri odoslaní. Skúste to prosím neskôr.', 'danger');
            submitBtn.disabled    = false;
            submitBtn.textContent = 'Odoslať';
        });
    });

    /**
     * Show a Bootstrap-style alert in #cf-feedback.
     * @param {string} msg   Message text
     * @param {string} type  'success' | 'danger' | 'warning'
     */
    function showFeedback(msg, type) {
        feedback.className     = 'alert alert-' + type;
        feedback.textContent   = msg;
        feedback.classList.remove('d-none');
        feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>

<?php get_footer(); ?>
