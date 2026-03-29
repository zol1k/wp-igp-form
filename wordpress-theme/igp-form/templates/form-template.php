<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$igp_step_labels = array(
    1 => array( 'label' => 'Parametre miestnosti', 'sub' => 'Výpočet výkonu' ),
    2 => array( 'label' => 'Typ riešenia',          'sub' => 'Split vs. Multi-split' ),
    3 => array( 'label' => 'Funkcie a využitie',     'sub' => 'Komfort' ),
    4 => array( 'label' => 'Dizajn a rozpočet',      'sub' => 'Finálny výber' ),
    5 => array( 'label' => 'Zhrnutie',               'sub' => 'Prehľad konfigurácie' ),
);

$igp_total_steps = count( $igp_step_labels );
?>
<form class="igp-form" id="igp-form" novalidate>

  <!-- Krok 1 -->
  <div class="igp-step" data-step="1">
    <?php $igp_current_step = 1; include __DIR__ . '/parts/form-header.php'; ?>
    <div class="igp-step-body">
      <h2>Krok 1: <span>Základné parametre miestnosti (Výpočet výkonu)</span></h2>
      <p class="igp-step-desc">Tu si robíme základný prehľad vašej nehnuteľnosti</p>

      <div class="igp-group" data-name="space_type">
        <h3>Aký typ priestoru chcete klimatizovať?</h3>
        <div class="igp-cards">
          <label class="igp-card">
            <input type="radio" name="space_type" value="byt" hidden>
            <span class="igp-card-label">Byt</span>
          </label>
          <label class="igp-card">
            <input type="radio" name="space_type" value="dom" hidden>
            <span class="igp-card-label">Rodinný dom</span>
          </label>
          <label class="igp-card">
            <input type="radio" name="space_type" value="komercny" hidden>
            <span class="igp-card-label">Komerčný priestor</span>
          </label>
        </div>
      </div>

      <div class="igp-group" data-name="insulation">
        <h3>Zateplenie a okná:</h3>
        <div class="igp-cards">
          <label class="igp-card">
            <input type="radio" name="insulation" value="old" hidden>
            <span class="igp-card-label">Staršia stavba / Nezateplené</span>
          </label>
          <label class="igp-card">
            <input type="radio" name="insulation" value="new" hidden>
            <span class="igp-card-label">Novostavba / Rekonštrukcia / Zateplené</span>
          </label>
        </div>
      </div>

      <div class="igp-group" data-name="orientation">
        <h3>Na ktorú svetovú stranu sú orientované okná?</h3>
        <div class="igp-cards">
          <label class="igp-card">
            <input type="radio" name="orientation" value="sever" hidden>
            <span class="igp-card-label">Sever / Východ</span>
            <span class="igp-card-sub">(Chladnejšia)</span>
          </label>
          <label class="igp-card">
            <input type="radio" name="orientation" value="juh" hidden>
            <span class="igp-card-label">Juh / Západ</span>
            <span class="igp-card-sub">(Teplejšia)</span>
          </label>
          <label class="igp-card">
            <input type="radio" name="orientation" value="neviem" hidden>
            <span class="igp-card-label">Neviem</span>
          </label>
        </div>
      </div>
    </div>
    <div class="igp-actions">
      <button type="button" class="igp-btn igp-prev">Späť</button>
      <button type="button" class="igp-btn igp-btn--primary igp-next">Pokračovať</button>
    </div>
  </div>

  <!-- Krok 2 -->
  <div class="igp-step" data-step="2">
    <?php $igp_current_step = 2; include __DIR__ . '/parts/form-header.php'; ?>
    <div class="igp-step-body">
      <h2>Krok 2: <span>Typ riešenia (Split vs. Multi-split)</span></h2>
      <p class="igp-step-desc">Tu zisťujeme, koľko jednotiek a s akým výkonom budete potrebovať</p>

      <div class="igp-group" data-name="rooms">
        <h3>Koľko miestností chcete klimatizovať?</h3>
        <div class="igp-cards">
          <label class="igp-card">
            <input type="radio" name="rooms" value="single" hidden>
            <span class="igp-card-label">Jednu miestnosť <small>(Single-split)</small></span>
          </label>
          <label class="igp-card">
            <input type="radio" name="rooms" value="multi" hidden>
            <span class="igp-card-label">Dve a viac uzavretých miestností <small>(Multi-split riešenie)</small></span>
          </label>
        </div>
      </div>
    </div>
    <div class="igp-actions">
      <button type="button" class="igp-btn igp-prev">Späť</button>
      <button type="button" class="igp-btn igp-btn--primary igp-next">Pokračovať</button>
    </div>
  </div>

  <!-- Krok 3 -->
  <div class="igp-step" data-step="3">
    <?php $igp_current_step = 3; include __DIR__ . '/parts/form-header.php'; ?>
    <div class="igp-step-body">
      <h2>Krok 3: <span>Funkcie a využitie</span></h2>
    </div>
    <div class="igp-actions">
      <button type="button" class="igp-btn igp-prev">Späť</button>
      <button type="button" class="igp-btn igp-btn--primary igp-next">Pokračovať</button>
    </div>
  </div>

  <!-- Krok 4 -->
  <div class="igp-step" data-step="4">
    <?php $igp_current_step = 4; include __DIR__ . '/parts/form-header.php'; ?>
    <div class="igp-step-body">
      <h2>Krok 4: <span>Dizajn a rozpočet</span></h2>
    </div>
    <div class="igp-actions">
      <button type="button" class="igp-btn igp-prev">Späť</button>
      <button type="button" class="igp-btn igp-btn--primary igp-next">Pokračovať</button>
    </div>
  </div>

  <!-- Krok 5 -->
  <div class="igp-step" data-step="5">
    <?php $igp_current_step = 5; include __DIR__ . '/parts/form-header.php'; ?>
    <div class="igp-step-body">
      <h2>Krok 5: <span>Zhrnutie</span></h2>
      <p class="igp-step-desc">Prehľad konfigurácie</p>
    </div>
    <div class="igp-actions">
      <button type="button" class="igp-btn igp-prev">Späť</button>
      <button type="submit" class="igp-btn igp-btn--success">Odoslať</button>
    </div>
  </div>

</form>
