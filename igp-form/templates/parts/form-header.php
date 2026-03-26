<?php
if ( ! defined( 'ABSPATH' ) ) {
    // file may be included in non-WP contexts during development
}

$step = isset($igp_current_step) ? intval($igp_current_step) : 1;
$labels = array(
    1 => 'Parametre miestnosti',
    2 => 'Typ riešenia',
    3 => 'Funkcie a využitie',
    4 => 'Dizajn a rozpočet',
    5 => 'Zhrnutie',
);
?>
<div class="igp-steps d-flex justify-content-center mb-4">
  <?php for ($i = 1; $i <= 5; $i++): ?>
    <?php $active = ($i === $step) ? ' active' : ''; ?>
    <div class="igp-step-indicator mx-2<?php echo $active; ?>" aria-current="<?php echo $i === $step ? 'step' : 'false'; ?>">
      <?php echo $i; ?>
    </div>
  <?php endfor; ?>
</div>
<div class="text-center mb-3">
  <h4 class="mb-0"><?php echo esc_html( $labels[$step] ?? 'Krok ' . $step ); ?></h4>
</div>
