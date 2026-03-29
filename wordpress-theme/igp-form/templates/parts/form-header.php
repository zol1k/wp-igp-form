<?php
if ( ! defined( 'ABSPATH' ) ) {
    // dev context – ok
}

$step   = isset( $igp_current_step ) ? intval( $igp_current_step ) : 1;
$config = isset( $igp_step_labels ) ? $igp_step_labels : array(
    1 => array( 'label' => 'Parametre miestnosti', 'sub' => 'Výpočet výkonu' ),
    2 => array( 'label' => 'Typ riešenia',          'sub' => 'Split vs. Multi-split' ),
    3 => array( 'label' => 'Funkcie a využitie',     'sub' => 'Komfort' ),
    4 => array( 'label' => 'Dizajn a rozpočet',      'sub' => 'Finálny výber' ),
    5 => array( 'label' => 'Zhrnutie',               'sub' => 'Prehľad konfigurácie' ),
);
$total = count( $config );
?>
<div class="igp-progress">
  <?php $idx = 0; foreach ( $config as $i => $item ) :
    $idx++;
    $state = ( $i < $step ) ? 'is-done' : ( ( $i === $step ) ? 'is-active' : '' );
  ?>
    <div class="igp-progress-item <?php echo esc_attr( $state ); ?>"
         aria-current="<?php echo ( $i === $step ) ? 'step' : 'false'; ?>">
      <div class="igp-progress-circle">
        <?php if ( $i < $step ) : ?>
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php else : ?>
          <?php echo intval( $i ); ?>
        <?php endif; ?>
      </div>
      <span class="igp-progress-label"><?php echo esc_html( $item['label'] ); ?></span>
      <span class="igp-progress-sub"><?php echo esc_html( $item['sub'] ); ?></span>
    </div>
    <?php if ( $idx < $total ) : ?>
      <div class="igp-progress-connector<?php echo ( $i < $step ) ? ' is-done' : ''; ?>"></div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
