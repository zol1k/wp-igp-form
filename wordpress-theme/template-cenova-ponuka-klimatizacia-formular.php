<?php
/**
 * Template Name: Cenová ponuka – Klimatizácia formular
 *
 * URL: /kalkulacia-klimatizacia-formular?krok=1..5
 *
 * 5-krokový formular pre konfiguráciu klimatizácie.
 * Aktuálny krok sa určuje z URL parametra ?krok=N (default: 1).
 * JavaScript (form.js) riadi zobrazenie panelov, ukladanie
 * a browser history (pushState).
 *
 * Krok 1 — Základné parametre miestnosti (typ priestoru, zateplenie, orientácia)
 * Krok 2 — Typ riešenia (Single-split / Multi-split, miestnosti, príprava)
 * Krok 3 — Funkcie a využitie (ako, zdravie, wifi)
 * Krok 4 — Dizajn a rozpočet
 * Krok 5 — Zhrnutie (odporúčaná klimatizácia + CTA)
 */

defined( 'ABSPATH' ) || exit;

// Aktuálny krok z URL – sanitizovaný na číslo 1–5
$current_step = max( 1, min( 5, (int) ( $_GET['krok'] ?? 1 ) ) );

get_header();

$steps = igp_formular_steps();   // z loader.php
igp_render_header( $steps, $current_step );

$base_url      = get_permalink();
$formular_url  = home_url('/kalkulacia-klimatizacia-formular');
$vyhodnotenie_url = home_url('/kalkulacia-klimatizacia-vyhodnotenie');
?>

<div class="igp-page-container" id="igp-formular" data-current="<?php echo esc_attr( $current_step ); ?>">

    <!-- ═══════════════════════ KROK 1 ═══════════════════════════════════════ -->
    <div class="igp-step-panel <?php echo $current_step !== 1 ? 'igp-hidden' : ''; ?>"
         data-krok="1">

        <h2 class="igp-step-heading">
            <strong class="igp-step-strong">Krok 1:</strong>
            Základné parametre miestnosti (Výpočet výkonu)
        </h2>
        <p class="igp-step-subheading">Tu si robíme základný prehľad vašej nehnuteľnosti</p>

        <!-- Typ priestoru -->
        <p class="igp-question-label">Aký typ priestoru chcete klimatizovať?</p>
        <div id="k1-typ" class="row g-3">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="byt">
                    <i class="bi bi-building igp-card-icon"></i>
                    <span class="igp-card-label">Byt</span>
                    <!-- Conditional extra field — vidí sa len po výbere -->
                    <div class="igp-card-extra igp-hidden" id="k1-poschodie-wrap">
                        <input type="number"
                               id="k1-poschodie"
                               class="form-control igp-input mt-2"
                               placeholder="Poschodie"
                               min="0"
                               oninput="IGPForm.save('krok1_poschodie', this.value)">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="rodinny-dom">
                    <i class="bi bi-house-door igp-card-icon"></i>
                    <span class="igp-card-label">Rodinný dom</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="komercny">
                    <i class="bi bi-shop igp-card-icon"></i>
                    <span class="igp-card-label">Komerčný priestor</span>
                </div>
            </div>
        </div>

        <!-- Zateplenie a okná -->
        <p class="igp-question-label">Zateplenie a okná:</p>
        <div id="k1-zateplenie" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="stara-stavba">
                    <i class="bi bi-wind igp-card-icon"></i>
                    <span class="igp-card-label">Staršia stavba / Nezateplené</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="novostavba">
                    <i class="bi bi-stars igp-card-icon"></i>
                    <span class="igp-card-label">Novostavba / Rekonštrukcia / Zateplené</span>
                </div>
            </div>
        </div>

        <!-- Orientácia okien -->
        <p class="igp-question-label">Na ktorú svetovú stranu sú orientované okná?</p>
        <div id="k1-orientacia" class="row g-3">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="sever-vychod">
                    <i class="bi bi-snow igp-card-icon"></i>
                    <span class="igp-card-label">Sever / Východ</span>
                    <span class="igp-card-sublabel">(Chladnejšia)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="juh-zapad">
                    <i class="bi bi-brightness-high igp-card-icon"></i>
                    <span class="igp-card-label">Juh / Západ</span>
                    <span class="igp-card-sublabel">(Teplejšia ☀)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="neviem">
                    <i class="bi bi-question-circle igp-card-icon"></i>
                    <span class="igp-card-label">Neviem</span>
                </div>
            </div>
        </div>

        <div class="igp-form-nav">
            <a href="<?php echo esc_url( home_url('/kalkulacia-klimatizacia') ); ?>"
               class="igp-btn-outline">Späť</a>
            <button type="button" class="igp-btn-primary"
                    onclick="igpKrokNext(1)">Pokračovať</button>
        </div>
    </div><!-- /krok 1 -->

    <!-- ═══════════════════════ KROK 2 ═══════════════════════════════════════ -->
    <div class="igp-step-panel <?php echo $current_step !== 2 ? 'igp-hidden' : ''; ?>"
         data-krok="2">

        <h2 class="igp-step-heading">
            <strong class="igp-step-strong">Krok 2:</strong>
            Typ riešenia (Split vs. Multi-split)
        </h2>
        <p class="igp-step-subheading">Špecifikujte miestnosti a ich parametre</p>

        <!-- Počet miestností -->
        <p class="igp-question-label">Koľko miestností chcete klimatizovať?</p>
        <div id="k2-typ-riesenia" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="jedna">
                    <i class="bi bi-door-open igp-card-icon"></i>
                    <span class="igp-card-label">
                        Jednu miestnosť <span class="igp-card-sublabel d-inline">(Single-split)</span>
                    </span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="viac">
                    <i class="bi bi-layers igp-card-icon"></i>
                    <span class="igp-card-label">
                        Dve a viac uzavretých miestností
                        <span class="igp-card-sublabel d-inline">(Multi-split riešenie)</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Conditional: Jedna miestnosť -->
        <div id="k2-jedna-wrap" class="igp-hidden mt-3">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="igp-question-label">Aká je plocha miestnosti v m²?</label>
                    <input type="number" id="k2-plocha"
                           class="form-control igp-input"
                           placeholder="Napr. 25" min="1" step="1"
                           oninput="IGPForm.save('krok2_plocha', this.value)">
                </div>
                <div class="col-12 col-md-6">
                    <label class="igp-question-label">Aká je výška stropu v m?</label>
                    <input type="number" id="k2-vyska"
                           class="form-control igp-input"
                           placeholder="Napr. 2.7" min="1" step="0.1"
                           oninput="IGPForm.save('krok2_vyska', this.value)">
                </div>
            </div>
        </div>

        <!-- Conditional: Dve a viac miestností -->
        <div id="k2-viac-wrap" class="igp-hidden mt-3">

            <!-- Máte projekt domu? -->
            <p class="igp-question-label">Máte projekt domu?</p>
            <div id="k2-projekt" class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <div class="igp-option-card" data-value="ano">
                        <i class="bi bi-check-circle igp-card-icon"></i>
                        <span class="igp-card-label">Áno</span>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="igp-option-card" data-value="nie">
                        <i class="bi bi-x-circle igp-card-icon"></i>
                        <span class="igp-card-label">Nie</span>
                    </div>
                </div>
            </div>

            <!-- Zoznam miestností -->
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="igp-question-label mb-0">Pridajte miestnosti:</p>
                <button type="button" class="igp-btn-primary"
                        style="padding:8px 20px;font-size:.85rem;"
                        onclick="igpAddRoom()">
                    + Pridať miestnosť
                </button>
            </div>
            <div id="igp-rooms-container"></div>
        </div>

        <!-- Príptrava na klimatizáciu -->
        <p class="igp-question-label mt-4">Máte prípravu na klimatizáciu? (Rozvody v stene)</p>
        <div id="k2-priprava" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="ano">
                    <i class="bi bi-check-circle igp-card-icon"></i>
                    <span class="igp-card-label">Áno</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="nie">
                    <i class="bi bi-x-circle igp-card-icon"></i>
                    <span class="igp-card-label">Nie</span>
                    <span class="igp-card-sublabel">(Bude potrebná kompletná montáž vrátane líšt a prierazov)</span>
                </div>
            </div>
        </div>

        <div class="igp-form-nav">
            <button type="button" class="igp-btn-outline"
                    onclick="IGPForm.goToStep(1)">Späť</button>
            <button type="button" class="igp-btn-primary"
                    onclick="igpKrokNext(2)">Pokračovať</button>
        </div>
    </div><!-- /krok 2 -->

    <!-- ═══════════════════════ KROK 3 ═══════════════════════════════════════ -->
    <div class="igp-step-panel <?php echo $current_step !== 3 ? 'igp-hidden' : ''; ?>"
         data-krok="3">

        <h2 class="igp-step-heading">
            <strong class="igp-step-strong">Krok 3:</strong>
            Funkcie a využitie (Komfort)
        </h2>
        <p class="igp-step-subheading">Tu budeme filtrovať modely podľa preferovanej výbavy.</p>

        <!-- Ako plánujete využívať -->
        <p class="igp-question-label">Ako plánujete klimatizáciu využívať?</p>
        <div id="k3-vyuzitie" class="row g-3">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="len-chladenie">
                    <i class="bi bi-snow igp-card-icon"></i>
                    <span class="igp-card-label">Len na chladenie v lete</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="chladenie-prikurovanie">
                    <i class="bi bi-thermometer-half igp-card-icon"></i>
                    <span class="igp-card-label">Na chladenie a prikurovanie v prechodnom období</span>
                    <span class="igp-card-sublabel">(jar/jeseň)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="hlavny-zdroj-zima">
                    <i class="bi bi-fire igp-card-icon"></i>
                    <span class="igp-card-label">Ako hlavný zdroj kúrenia v zime</span>
                </div>
            </div>
        </div>

        <!-- Zdravie a vzduch -->
        <p class="igp-question-label">Máte špeciálne požiadavky na zdravie a vzduch?</p>
        <div id="k3-zdravie" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="zakladny-filter">
                    <i class="bi bi-funnel igp-card-icon"></i>
                    <span class="igp-card-label">Nie, stačí základný filter</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="alergik">
                    <i class="bi bi-heart-pulse igp-card-icon"></i>
                    <span class="igp-card-label">Som alergik / astmatik</span>
                    <span class="igp-card-sublabel">(Vyžaduje ionizátor a filter)</span>
                </div>
            </div>
        </div>

        <!-- Wi-Fi -->
        <p class="igp-question-label">Požadujete ovládanie cez Wi-Fi?</p>
        <div id="k3-wifi" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="ano-wifi">
                    <i class="bi bi-wifi igp-card-icon"></i>
                    <span class="igp-card-label">Áno, chcem ovládať klímu cez mobil</span>
                    <span class="igp-card-sublabel">(Odkiaľkoľvek)</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="nie-ovladac">
                    <i class="bi bi-phone igp-card-icon"></i>
                    <span class="igp-card-label">Nie, stačí mi diaľkový ovládač</span>
                </div>
            </div>
        </div>

        <div class="igp-form-nav">
            <button type="button" class="igp-btn-outline"
                    onclick="IGPForm.goToStep(2)">Späť</button>
            <button type="button" class="igp-btn-primary"
                    onclick="igpKrokNext(3)">Pokračovať</button>
        </div>
    </div><!-- /krok 3 -->

    <!-- ═══════════════════════ KROK 4 ═══════════════════════════════════════ -->
    <div class="igp-step-panel <?php echo $current_step !== 4 ? 'igp-hidden' : ''; ?>"
         data-krok="4">

        <h2 class="igp-step-heading">
            <strong class="igp-step-strong">Krok 4:</strong>
            Dizajn a rozpočet
        </h2>
        <p class="igp-step-subheading">Finálny filter.</p>

        <!-- Dizajn -->
        <p class="igp-question-label">Aký dizajn preferujete?</p>
        <div id="k4-dizajn" class="row g-3">
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="biela-klasicka">
                    <i class="bi bi-palette igp-card-icon"></i>
                    <span class="igp-card-label">Klasická biela</span>
                    <span class="igp-card-sublabel">(Nenápadná)</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="igp-option-card" data-value="dizajnova">
                    <i class="bi bi-brush igp-card-icon"></i>
                    <span class="igp-card-label">Dizajnová</span>
                    <span class="igp-card-sublabel">(Akákoľvek RAL)</span>
                </div>
            </div>
        </div>

        <!-- Cenová predstava -->
        <p class="igp-question-label">Aká je vaša cenová predstava?</p>
        <div id="k4-rozpocet" class="row g-3">
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="ekonomicka">
                    <i class="bi bi-graph-down-arrow igp-card-icon"></i>
                    <span class="igp-card-label">Ekonomická trieda</span>
                    <span class="igp-card-sublabel">(Pomer cena/výkon)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="stredna">
                    <i class="bi bi-currency-euro igp-card-icon"></i>
                    <span class="igp-card-label">Stredná trieda</span>
                    <span class="igp-card-sublabel">(Kvalita a tichý chod)</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="igp-option-card" data-value="premiova">
                    <i class="bi bi-trophy igp-card-icon"></i>
                    <span class="igp-card-label">Prémiová trieda</span>
                    <span class="igp-card-sublabel">(Špičkové technológie)</span>
                </div>
            </div>
        </div>

        <div class="igp-form-nav">
            <button type="button" class="igp-btn-outline"
                    onclick="IGPForm.goToStep(3)">Späť</button>
            <button type="button" class="igp-btn-primary"
                    onclick="igpKrokNext(4)">Pokračovať</button>
        </div>
    </div><!-- /krok 4 -->

    <!-- ═══════════════════════ KROK 5 — Zhrnutie ════════════════════════════ -->
    <div class="igp-step-panel <?php echo $current_step !== 5 ? 'igp-hidden' : ''; ?>"
         data-krok="5">

        <h2 class="igp-step-heading mb-4">Vaša ideálna klimatizácia:</h2>

        <!-- Odporúčaný produkt — data sa načítajú z sessionStorage -->
        <div class="igp-recommendation-card mb-4">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-7">
                    <h3 class="igp-rec-title" id="k5-produkt-nazov">
                        <?php /* Naplnené JavaScriptom z sessionStorage */ ?>
                        Odporúčaná klimatizácia
                    </h3>
                    <p class="igp-rec-desc" id="k5-produkt-popis">
                        Klimatizácia je diskrétna nástenná jednotka, ktorá ponúka
                        vysokú energetickú účinnosť, tichú prevádzku a pokročilé funkcie
                        čistenia vzduchu.
                    </p>
                    <div class="igp-rec-price-label mt-3">Odhadovaná cena:</div>
                    <div class="igp-rec-price" id="k5-produkt-cena">–</div>
                    <small class="igp-rec-price-unit">s DPH</small>
                </div>
                <div class="col-12 col-md-5 text-center">
                    <img id="k5-produkt-img"
                         src=""
                         alt="Klimatizácia"
                         style="max-height:160px;object-fit:contain;background:rgba(255,255,255,.6);border-radius:8px;width:100%;">
                </div>
            </div>
        </div>

        <!-- CTA tlačidlá -->
        <div class="d-grid gap-3 mb-4" style="max-width:500px;margin:0 auto;">
            <a href="<?php echo esc_url( $vyhodnotenie_url ); ?>"
               class="igp-btn-primary text-center py-3"
               onclick="IGPForm.sendGA('formular_continue_to_vyhodnotenie', {})">
                Chcem spracovať presnú kalkuláciu
            </a>
            <p class="text-muted small text-center mb-0">
                Po kliknutí na tlačidlo budete kontaktovaný s cieľom spresnenia cenovej ponuky
                a dohodnutia termínu obhliadky.
            </p>
            <button type="button"
                    class="igp-btn-outline text-center"
                    onclick="igpKopirovatKalkulaciu()">
                <i class="bi bi-clipboard me-1"></i> Kopírovať kalkuláciu
            </button>
        </div>

        <div class="igp-form-nav">
            <button type="button" class="igp-btn-outline"
                    onclick="IGPForm.goToStep(4)">Späť</button>
            <span></span>
        </div>
    </div><!-- /krok 5 -->

    <!-- Debug panel -->
    <div class="igp-debug-wrap mt-4">
        <div class="igp-debug-heading">🛠 SessionStorage — aktuálne hodnoty</div>
        <div id="igp-debug-panel"></div>
    </div>

</div><!-- /#igp-formular -->

<!-- ── Inline JS pre tento template ───────────────────────────────────────── -->
<script>
// ─── Krok 1 — inicializácia ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {

    // Krok 1 — typ priestoru (s conditional fieldom pre Byt)
    IGPForm.initCards('#k1-typ', 'krok1_typ', {
        gaEvent: 'formular_k1_typ',
        onChange: function (value) {
            var wrap = document.getElementById('k1-poschodie-wrap');
            if (value === 'byt') {
                wrap.classList.remove('igp-hidden');
                // Obnov uloženú hodnotu
                var saved = IGPForm.get('krok1_poschodie');
                if (saved) document.getElementById('k1-poschodie').value = saved;
            } else {
                wrap.classList.add('igp-hidden');
            }
        }
    });

    // Ak bol byt vybraný skôr, ukáž poschodie field
    if (IGPForm.get('krok1_typ') === 'byt') {
        document.getElementById('k1-poschodie-wrap').classList.remove('igp-hidden');
        var savedPoschodie = IGPForm.get('krok1_poschodie');
        if (savedPoschodie) document.getElementById('k1-poschodie').value = savedPoschodie;
    }

    IGPForm.initCards('#k1-zateplenie', 'krok1_zateplenie', { gaEvent: 'formular_k1_zateplenie' });
    IGPForm.initCards('#k1-orientacia', 'krok1_orientacia', { gaEvent: 'formular_k1_orientacia' });

    // ─── Krok 2 — inicializácia ────────────────────────────────────────────
    IGPForm.initCards('#k2-typ-riesenia', 'krok2_typ_riesenia', {
        gaEvent: 'formular_k2_typ',
        onChange: function (value) {
            var jednaWrap = document.getElementById('k2-jedna-wrap');
            var viacWrap  = document.getElementById('k2-viac-wrap');
            jednaWrap.classList.toggle('igp-hidden', value !== 'jedna');
            viacWrap.classList.toggle('igp-hidden',  value !== 'viac');
            if (value === 'viac') {
                // Inicializuj projekt výber a obnov miestnosti
                IGPForm.initCards('#k2-projekt', 'krok2_projekt', { gaEvent: 'formular_k2_projekt' });
                IGPForm.restoreRooms();
            }
        }
    });

    // Obnov stav ak sme sa sem vrátili
    var savedTyp = IGPForm.get('krok2_typ_riesenia');
    if (savedTyp === 'jedna') {
        document.getElementById('k2-jedna-wrap').classList.remove('igp-hidden');
        var sp = IGPForm.get('krok2_plocha');
        var sv = IGPForm.get('krok2_vyska');
        if (sp) document.getElementById('k2-plocha').value = sp;
        if (sv) document.getElementById('k2-vyska').value  = sv;
    }
    if (savedTyp === 'viac') {
        document.getElementById('k2-viac-wrap').classList.remove('igp-hidden');
        IGPForm.initCards('#k2-projekt', 'krok2_projekt', { gaEvent: 'formular_k2_projekt' });
        IGPForm.restoreRooms();
    }

    IGPForm.initCards('#k2-priprava', 'krok2_priprava', { gaEvent: 'formular_k2_priprava' });

    // ─── Krok 3 ────────────────────────────────────────────────────────────
    IGPForm.initCards('#k3-vyuzitie', 'krok3_vyuzitie', { gaEvent: 'formular_k3_vyuzitie' });
    IGPForm.initCards('#k3-zdravie',  'krok3_zdravie',  { gaEvent: 'formular_k3_zdravie'  });
    IGPForm.initCards('#k3-wifi',     'krok3_wifi',     { gaEvent: 'formular_k3_wifi'     });

    // ─── Krok 4 ────────────────────────────────────────────────────────────
    IGPForm.initCards('#k4-dizajn',   'krok4_dizajn',   { gaEvent: 'formular_k4_dizajn'   });
    IGPForm.initCards('#k4-rozpocet', 'krok4_rozpocet', { gaEvent: 'formular_k4_rozpocet' });

    // ─── Krok 5 — naplniť z sessionStorage ────────────────────────────────
    if (document.querySelector('[data-krok="5"]')) {
        var nazov = IGPForm.get('vyber_produktu_nazov');
        var cena  = IGPForm.get('vyber_produktu_cena');
        var img   = IGPForm.get('vyber_produktu_img');
        if (nazov) document.getElementById('k5-produkt-nazov').textContent = nazov;
        if (cena)  document.getElementById('k5-produkt-cena').textContent  = cena;
        if (img)   document.getElementById('k5-produkt-img').src           = img;
    }
});

// ─── Validácia a prechod na ďalší krok ─────────────────────────────────────

/**
 * Validuje povinné polia aktuálneho kroku a presunie sa na nasledujúci.
 * @param {number} krok - číslo aktuálneho kroku
 */
function igpKrokNext(krok) {
    var required = {
        1: [
            { key: 'krok1_typ',        label: 'Typ priestoru'    },
            { key: 'krok1_zateplenie', label: 'Zateplenie a okná'},
            { key: 'krok1_orientacia', label: 'Orientácia okien' },
        ],
        2: [
            { key: 'krok2_typ_riesenia', label: 'Typ riešenia'         },
            { key: 'krok2_priprava',     label: 'Príptrava na klimatizáciu' },
        ],
        3: [
            { key: 'krok3_vyuzitie', label: 'Ako plánujete využívať' },
            { key: 'krok3_zdravie',  label: 'Zdravie a vzduch'        },
            { key: 'krok3_wifi',     label: 'Wi-Fi ovládanie'         },
        ],
        4: [
            { key: 'krok4_dizajn',   label: 'Dizajn'   },
            { key: 'krok4_rozpocet', label: 'Rozpočet' },
        ],
    };

    var fields = required[krok] || [];
    for (var i = 0; i < fields.length; i++) {
        if (!IGPForm.get(fields[i].key)) {
            alert('Prosím vyberte možnosť pre: ' + fields[i].label);
            return;
        }
    }

    // Extra validácia krok 2 — jedna miestnosť
    if (krok === 2 && IGPForm.get('krok2_typ_riesenia') === 'jedna') {
        if (!IGPForm.get('krok2_plocha')) {
            alert('Prosím zadajte plochu miestnosti.');
            return;
        }
    }

    IGPForm.save('last_step', krok + 1);
    IGPForm.sendGA('formular_krok_next', { from_krok: krok });
    IGPForm.goToStep(krok + 1);
}

// ─── Kopírovanie kalkulácie ─────────────────────────────────────────────────

function igpKopirovatKalkulaciu() {
    var all  = IGPForm.getAll();
    var text = 'Klimatizácia kalkulácia\n========================\n';
    Object.keys(all).forEach(function (k) {
        var v = all[k];
        text += k + ': ' + (typeof v === 'object' ? JSON.stringify(v) : v) + '\n';
    });

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function () {
            alert('Kalkulácia skopírovaná do clipboardu!');
        });
    } else {
        // Fallback pre staré prehliadače
        var ta = document.createElement('textarea');
        ta.value = text;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        alert('Kalkulácia skopírovaná!');
    }
    IGPForm.sendGA('formular_copy_calculation', {});
}
</script>

<?php get_footer(); ?>
