<?php
/**
 * Template Name: Cenová ponuka – Klimatizácia pre-formular
 *
 * URL: /kalkulacia-klimatizacia-pre-formular
 *
 * One-page formular pre výber Individuálnej ponuky.
 * Po odoslaní uloží všetky hodnoty do sessionStorage a presmeruje
 * na hlavný formular (/kalkulacia-klimatizacia-formular?krok=1).
 *
 * Polia:
 *   Rozmer miestnosti  (radio dlaždice)
 *   Predpríprava       (radio dlaždice)
 *   Filtrácia          (radio dlaždice)
 *   Farebné prevedenie (radio dlaždice)
 *   Využitie           (radio dlaždice)
 *   Prevedenie         (radio dlaždice)
 */

defined( 'ABSPATH' ) || exit;

get_header();
igp_render_header();
?>

<div class="igp-page-container">

    <!-- Späť link -->
    <a href="<?php echo esc_url( home_url('/kalkulacia-klimatizacia') ); ?>"
       class="igp-btn-outline mb-4 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Späť na výber triedy
    </a>

    <h1 class="igp-step-heading mb-1">
        Individuálna ponuka — základné parametre
    </h1>
    <p class="igp-step-subheading mb-4">
        Vyplňte tento rýchly dotazník a my vám pripravíme ponuku šitú na mieru.
    </p>

    <form id="igp-preformular" novalidate>

        <!-- ── Rozmer miestnosti ──────────────────────────────────────────── -->
        <p class="igp-question-label">Rozmer miestnosti</p>
        <div id="pf-rozmer" class="row g-3 mb-2">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="do25m2">
                    <i class="bi bi-house igp-card-icon"></i>
                    <span class="igp-card-label">Jedna miestnosť do 25 m²</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="25-50m2">
                    <i class="bi bi-house-door igp-card-icon"></i>
                    <span class="igp-card-label">Jedna miestnosť 25–50 m²</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="multisplit">
                    <i class="bi bi-buildings igp-card-icon"></i>
                    <span class="igp-card-label">Viac uzavretých miestností</span>
                    <span class="igp-card-sublabel">(multisplit riešenie)</span>
                </div>
            </div>
        </div>

        <!-- ── Predpríprava ───────────────────────────────────────────────── -->
        <p class="igp-question-label">Predpríprava</p>
        <div id="pf-priprava" class="row g-3 mb-2">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="nie">
                    <i class="bi bi-x-circle igp-card-icon"></i>
                    <span class="igp-card-label">Nie nemám</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="ano">
                    <i class="bi bi-check-circle igp-card-icon"></i>
                    <span class="igp-card-label">Mám rozvody v stene</span>
                    <span class="igp-card-sublabel">(pošli fotku)</span>
                </div>
            </div>
        </div>

        <!-- ── Filtrácia ──────────────────────────────────────────────────── -->
        <p class="igp-question-label">Filtrácia</p>
        <div id="pf-filtracia" class="row g-3 mb-2">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="zakladny">
                    <i class="bi bi-funnel igp-card-icon"></i>
                    <span class="igp-card-label">Stačí základný filter</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="alergik">
                    <i class="bi bi-heart-pulse igp-card-icon"></i>
                    <span class="igp-card-label">Som alergik / astmatik</span>
                </div>
            </div>
        </div>

        <!-- ── Farebné prevedenie ──────────────────────────────────────────── -->
        <p class="igp-question-label">Farebné prevedenie</p>
        <div id="pf-farba" class="row g-3 mb-2">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="biela">
                    <i class="bi bi-circle-fill igp-card-icon" style="color:#D1D5DB;"></i>
                    <span class="igp-card-label">Biela</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="iny">
                    <i class="bi bi-palette igp-card-icon"></i>
                    <span class="igp-card-label">Čierna / tmavomodrá / strieborná / červená…</span>
                </div>
            </div>
        </div>

        <!-- ── Využitie ───────────────────────────────────────────────────── -->
        <p class="igp-question-label">Využitie</p>
        <div id="pf-vyuzitie" class="row g-3 mb-2">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="chladenie-prechodne">
                    <i class="bi bi-thermometer-half igp-card-icon"></i>
                    <span class="igp-card-label">Chladenie v lete / prikurovanie v prechodnom období</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="hlavny-zdroj">
                    <i class="bi bi-fire igp-card-icon"></i>
                    <span class="igp-card-label">Ako hlavný zdroj v zime</span>
                </div>
            </div>
        </div>

        <!-- ── Prevedenie ─────────────────────────────────────────────────── -->
        <p class="igp-question-label">Prevedenie</p>
        <div id="pf-prevedenie" class="row g-3 mb-2">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="basic">
                    <i class="bi bi-star igp-card-icon"></i>
                    <span class="igp-card-label">Základ</span>
                    <span class="igp-card-sublabel">(Basic)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="comfort">
                    <i class="bi bi-star-half igp-card-icon"></i>
                    <span class="igp-card-label">Komfort</span>
                    <span class="igp-card-sublabel">(Comfort)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="advanced">
                    <i class="bi bi-star-fill igp-card-icon"></i>
                    <span class="igp-card-label">Pokročilá</span>
                    <span class="igp-card-sublabel">(Advanced)</span>
                </div>
            </div>
        </div>

        <!-- ── Odoslanie ──────────────────────────────────────────────────── -->
        <div class="igp-form-nav mt-4">
            <a href="<?php echo esc_url( home_url('/kalkulacia-klimatizacia') ); ?>"
               class="igp-btn-outline">Späť</a>
            <button type="button"
                    class="igp-btn-primary"
                    onclick="igpPFPokracovat()">
                Pokračovať
            </button>
        </div>

    </form><!-- /#igp-preformular -->

    <!-- Debug panel -->
    <div class="igp-debug-wrap mt-4">
        <div class="igp-debug-heading">🛠 SessionStorage — aktuálne hodnoty</div>
        <div id="igp-debug-panel"></div>
    </div>

</div><!-- /igp-page-container -->

<script>
// Inicializovanie option card skupín s ukladaním do sessionStorage
document.addEventListener('DOMContentLoaded', function() {
    IGPForm.initCards('#pf-rozmer',    'preformular_rozmer',    { gaEvent: 'pf_rozmer_click'    });
    IGPForm.initCards('#pf-priprava',  'preformular_priprava',  { gaEvent: 'pf_priprava_click'  });
    IGPForm.initCards('#pf-filtracia', 'preformular_filtracia', { gaEvent: 'pf_filtracia_click' });
    IGPForm.initCards('#pf-farba',     'preformular_farba',     { gaEvent: 'pf_farba_click'     });
    IGPForm.initCards('#pf-vyuzitie',  'preformular_vyuzitie',  { gaEvent: 'pf_vyuzitie_click'  });
    IGPForm.initCards('#pf-prevedenie','preformular_prevedenie',{ gaEvent: 'pf_prevedenie_click'});
});

/**
 * Validates that all groups have a selection, then navigates to the main formular.
 */
function igpPFPokracovat() {
    var groups = [
        { id: 'pf-rozmer',     key: 'preformular_rozmer',     label: 'Rozmer miestnosti' },
        { id: 'pf-priprava',   key: 'preformular_priprava',   label: 'Predpríprava'       },
        { id: 'pf-filtracia',  key: 'preformular_filtracia',  label: 'Filtrácia'          },
        { id: 'pf-farba',      key: 'preformular_farba',      label: 'Farebné prevedenie' },
        { id: 'pf-vyuzitie',   key: 'preformular_vyuzitie',   label: 'Využitie'           },
        { id: 'pf-prevedenie', key: 'preformular_prevedenie', label: 'Prevedenie'         },
    ];

    for (var i = 0; i < groups.length; i++) {
        if (!IGPForm.get(groups[i].key)) {
            alert('Prosím vyberte možnosť pre: ' + groups[i].label);
            document.getElementById(groups[i].id).scrollIntoView({ behavior: 'smooth' });
            return;
        }
    }

    IGPForm.sendGA('pf_continue', {});
    window.location.href = '<?php echo esc_js( home_url('/kalkulacia-klimatizacia-formular?krok=1') ); ?>';
}
</script>

<?php get_footer(); ?>
