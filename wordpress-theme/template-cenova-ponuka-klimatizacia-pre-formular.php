<?php
/**
 * Template Name: Cenová ponuka – Klimatizácia pre-formular
 *
 * URL: /kalkulacia/klimatizacie-formular
 *
 * One-page formular pre výber Individuálnej ponuky.
 * Po odoslaní uloží všetky hodnoty do sessionStorage a presmeruje
 * na vyhodnotenie (/kalkulacia/klimatizácie-vyhodnotenie).
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
    <a href="<?php echo esc_url( home_url('/kalkulacia/klimatizacie') ); ?>"
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
        <div id="pf-rozmer" class="igp-option-group row g-3 mb-2">
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
        <div id="pf-priprava" class="igp-option-group row g-3 mb-2">
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
                    <span class="igp-card-sublabel">(priložte prílohu v ďalšom kroku)</span>
                </div>
            </div>
        </div>

        <!-- ── Filtrácia ──────────────────────────────────────────────────── -->
        <p class="igp-question-label">Filtrácia</p>
        <div id="pf-filtracia" class="igp-option-group row g-3 mb-2">
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

        <!-- ── Polia len pre individuálnu ponuku ─────────────────────────── -->
        <div id="pf-individual-fields" class="igp-hidden">

        <!-- ── Farebné prevedenie ──────────────────────────────────────────── -->
        <p class="igp-question-label">Farebné prevedenie</p>
        <div id="pf-farba" class="igp-option-group row g-3 mb-2">
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
        <div id="pf-vyuzitie" class="igp-option-group row g-3 mb-2">
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
        <div id="pf-prevedenie" class="igp-option-group row g-3 mb-2">
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

        </div><!-- /#pf-individual-fields -->

        <!-- ── Odoslanie ──────────────────────────────────────────────────── -->
        <div class="igp-form-nav mt-4">
            <a href="<?php echo esc_url( home_url('/kalkulacia/klimatizacie') ); ?>"
               class="fusion-button button-flat fusion-button-default-size button-default fusion-button-default button-4">Späť</a>
            <button type="button"
                    class="fusion-button button-flat fusion-button-default-size button-default fusion-button-default button-4"
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

    // Zobraziť polia pre individuálnu ponuku len keď bola zvolená individuálna trieda
    if ( IGPForm.get('is_individual') == 1 ) {
        document.getElementById('pf-individual-fields').classList.remove('igp-hidden');
    }

    // Clear validation highlight when a card is selected inside a group
    document.getElementById('igp-preformular').addEventListener('click', function(e) {
        var card = e.target.closest('.igp-option-card');
        if (card) {
            var group = card.closest('.igp-option-group');
            if (group) group.classList.remove('igp-group-error');
        }
    });
});

/**
 * Validates that all groups have a selection, then navigates to vyhodnotenie.
 * Invalid groups get a red outline; clears on next card selection via delegation.
 */
function igpPFPokracovat() {
    var isIndividual = IGPForm.get('is_individual') == 1;
    var groups = [
        { id: 'pf-rozmer',     key: 'preformular_rozmer'     },
        { id: 'pf-priprava',   key: 'preformular_priprava'   },
        { id: 'pf-filtracia',  key: 'preformular_filtracia'  },
    ];
    if ( isIndividual ) {
        groups.push(
            { id: 'pf-farba',      key: 'preformular_farba'      },
            { id: 'pf-vyuzitie',   key: 'preformular_vyuzitie'   },
            { id: 'pf-prevedenie', key: 'preformular_prevedenie' }
        );
    }

    var firstError = null;
    groups.forEach(function(g) {
        var el = document.getElementById(g.id);
        if ( ! IGPForm.get(g.key) ) {
            el.classList.add('igp-group-error');
            if ( ! firstError ) firstError = el;
        } else {
            el.classList.remove('igp-group-error');
        }
    });

    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        console.warn('[IGP] Pre-formulár — chýba výber v skupine:', firstError.id);
        return;
    }

    IGPForm.sendGA('pf_continue', {});
    window.location.href = '<?php echo esc_js( home_url('/kalkulacia/klimatizácie-vyhodnotenie') ); ?>';
}
</script>

<?php get_footer(); ?>
