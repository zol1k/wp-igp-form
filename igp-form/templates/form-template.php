<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<form class="igp-form container" id="igp-form">
  <div class="igp-step" data-step="1">
    <?php $igp_current_step = 1; include __DIR__ . '/parts/form-header.php'; ?>
    <h2>Krok 1: Základné parametre miestnosti (Výpočet výkonu)</h2>
    <p>Tu si robíme základný prehľad vašej nehnuteľnosti</p>

    <h3>Aký typ priestoru chcete klimatizovať?</h3>
    <div class="row igp-cards">
      <div class="col-12 col-md-4 mb-3">
        <label class="igp-card card p-3 h-100 text-center">
          <input type="radio" name="space_type" value="byt" hidden>
          <div class="card-body">Byt</div>
        </label>
      </div>
      <div class="col-12 col-md-4 mb-3">
        <label class="igp-card card p-3 h-100 text-center">
          <input type="radio" name="space_type" value="dom" hidden>
          <div class="card-body">Rodinný dom</div>
        </label>
      </div>
      <div class="col-12 col-md-4 mb-3">
        <label class="igp-card card p-3 h-100 text-center">
          <input type="radio" name="space_type" value="komercny" hidden>
          <div class="card-body">Komerčný priestor</div>
        </label>
      </div>
    </div>

    <h3>Zateplenie a okná</h3>
    <div class="row igp-cards">
      <div class="col-12 col-md-6 mb-3">
        <label class="igp-card card p-3 h-100 text-center">
          <input type="radio" name="insulation" value="old" hidden>
          <div class="card-body">Staršia stavba / Nezateplené</div>
        </label>
      </div>
      <div class="col-12 col-md-6 mb-3">
        <label class="igp-card card p-3 h-100 text-center">
          <input type="radio" name="insulation" value="new" hidden>
          <div class="card-body">Novostavba / Zateplené</div>
        </label>
      </div>
    </div>

    <div class="igp-actions d-grid gap-2 d-sm-flex justify-content-between">
      <button type="button" class="btn btn-outline-secondary igp-prev">Späť</button>
      <button type="button" class="btn btn-primary igp-next">Pokračovať</button>
    </div>
  </div>

  <div class="igp-step" data-step="2">
    <?php $igp_current_step = 2; include __DIR__ . '/parts/form-header.php'; ?>
    <h2>Krok 2: Typ riešenia</h2>
    <p>Split vs. Multi-split</p>
    <div class="igp-actions d-flex justify-content-between">
      <button type="button" class="btn btn-outline-secondary igp-prev">Späť</button>
      <button type="button" class="btn btn-primary igp-next">Pokračovať</button>
    </div>
  </div>

  <div class="igp-step" data-step="3">
    <?php $igp_current_step = 3; include __DIR__ . '/parts/form-header.php'; ?>
    <h2>Krok 3: Funkcie a využitie</h2>
    <div class="igp-actions d-flex justify-content-between">
      <button type="button" class="btn btn-outline-secondary igp-prev">Späť</button>
      <button type="button" class="btn btn-primary igp-next">Pokračovať</button>
    </div>
  </div>

  <div class="igp-step" data-step="4">
    <?php $igp_current_step = 4; include __DIR__ . '/parts/form-header.php'; ?>
    <h2>Krok 4: Dizajn a rozpočet</h2>
    <div class="igp-actions">
      <button type="button" class="btn btn-outline-secondary igp-prev">Späť</button>
      <button type="button" class="btn btn-primary igp-next">Pokračovať</button>
    </div>
  </div>

  <div class="igp-step" data-step="5">
    <?php $igp_current_step = 5; include __DIR__ . '/parts/form-header.php'; ?>
    <h2>Krok 5: Zhrnutie</h2>
    <p>Prehľad konfigurácie</p>
    <div class="igp-actions d-flex justify-content-between">
      <button type="button" class="btn btn-outline-secondary igp-prev">Späť</button>
      <button type="submit" class="btn btn-success">Odoslať</button>
    </div>
  </div>
  
</form>
