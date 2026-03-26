<?php
/**
 * Template Name: Cenová ponuka - Sendvič - Izolácia
 *
 */
?>
<script>
// Získanie typu použitia zo sessionStorage pre PHP
var sendvicUsageType = sessionStorage.getItem('sendvicUsage') || '';
</script>
<?php get_header() ?>

<style>
    .map-footer, footer, .post-header, .pre-header, .primary-menu, .header-right, #toggle-menu, .sticky-footer-menu {
        display: none !important;
    }
    .main-header {
        padding: 0 !important;
    }
</style>

<main id="">

    <section class="tw-pt-[100px] md:tw-pt-[120px] lg:tw-pt-[150px] tw-pb-24 md:tw-pb-50">
        <div class="container">
            <div class="tw-max-w-[1200px] tw-mx-auto">

                <!-- Progress stepper -->
                <!-- Mobile version -->
                <div class="tw-block lg:tw-hidden tw-mb-20 md:tw-mb-40">
                    <div class="tw-text-center tw-mb-12">
                        <div class="tw-text-[12px] md:tw-text-[14px] tw-text-neutral-600 tw-mb-4" style="display:none;">Krok 3 z 5</div>
                        <div class="tw-text-[16px] md:tw-text-[20px] tw-font-bold tw-text-primary-900">Isoliermaterial</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
                    </div>
                </div>

                <!-- Desktop version -->
                <div class="tw-hidden lg:tw-flex tw-items-center tw-justify-center tw-mb-40 tw-gap-8">
                    <!-- Krok 1 - Dokončený - kliknuteľný späť -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/berechnung/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Produktauswahl</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 2 - Dokončený - kliknuteľný späť -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/sandwichpaneele-typ/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Verwendung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Isoliermaterial</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 4 - kliknuteľný s validáciou -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            4
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Dicke</span>
                    </div>

                    <!-- <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div> -->

                    <!-- Krok 5 -->
                    <!-- <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            5
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Farbe</span>
                    </div> -->
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[20px] md:tw-text-[28px] lg:tw-text-[40px] tw-font-bold tw-mb-24 md:tw-mb-50">
                    3. Isoliermaterial
                </h1>

                <!-- Výber izolačného materiálu -->
                <div class="tw-mb-24 md:tw-mb-50">
                    <div class="tw-mb-12 md:tw-mb-16">
                        <h2 class="tw-text-[16px] md:tw-text-[20px] tw-font-bold tw-mb-4">Vyberte použitý izolačný materiál</h2>
                    </div>

                    <div class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6 md:tw-gap-16 lg:tw-gap-20" id="insulation-grid">
                        <?php $items = get_field('items'); ?>
                        <?php if ($items) : foreach($items as $item) : 
                            // Získaj typy použitia pre túto izoláciu (repeater)
                            $compatible_types_repeater = isset($item['compatible_types']) ? $item['compatible_types'] : array();
                            
                            // Extrahuj názvy typov z repeatera
                            $compatible_types = array();
                            if (!empty($compatible_types_repeater) && is_array($compatible_types_repeater)) {
                                foreach ($compatible_types_repeater as $type_item) {
                                    if (!empty($type_item['type'])) {
                                        $compatible_types[] = trim($type_item['type']);
                                    }
                                }
                            }
                            
                            // Vytvor data atribút s typmi
                            $types_json = !empty($compatible_types) ? json_encode(array_values($compatible_types)) : '[]';
                        ?>
                            <div class="insulation-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                                data-insulation="<?php echo esc_attr($item['title']); ?>"
                                data-compatible-types='<?php echo $types_json; ?>'
                                onclick="selectInsulation(this)">
                                <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                    <div class="tw-w-full tw-relative tw-aspect-square tw-mb-8 md:tw-mb-12">
                                        <?php 
                                        $image_url = is_array($item['image']) ? $item['image']['url'] : $item['image'];
                                        ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                        <?php if(!empty($item['icon']) && $item['icon']) : ?>
                                            <div class="tw-absolute tw-z-10 tw-bottom-8 md:tw-bottom-12 lg:tw-bottom-20 tw-left-1/2 -tw-translate-x-1/2">
                                                <svg style="width: 16px; height: 19px;" class="md:tw-w-[21px] md:tw-h-[24px]" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 21 24">
                                                    <defs>
                                                        <style>
                                                        .cls-1 {
                                                            fill: none;
                                                        }

                                                        .cls-2 {
                                                            fill: #e51e24;
                                                        }

                                                        .cls-3 {
                                                            clip-path: url(#clippath);
                                                        }
                                                        </style>
                                                        <clipPath id="clippath">
                                                        <rect class="cls-1" width="21" height="24"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g class="cls-3">
                                                        <path class="cls-2" d="M15.83,18.88c-1.25,1.59-2.84,2.76-4.61,3.72-.53.29-.96.25-1.47-.02-4.09-2.13-6.54-5.55-7.63-9.93-.48-1.93-.57-3.97-.84-5.95-.04-.32,0-.58.41-.69,3.11-.79,5.86-2.31,8.42-4.21.11-.08.22-.15.27-.19,1.65.98,3.18,2,4.81,2.83,1.27.64,2.67,1.03,4,1.57.21.09.5.35.5.53-.07,4.49-1,8.73-3.87,12.35ZM20.93,5.58c0-.41-.2-.52-.54-.59-1.9-.38-3.7-1.05-5.37-2.03C13.46,2.04,11.97,1.02,10.39,0c-.15.11-.37.29-.6.46C7.02,2.62,4.01,4.29.54,5c-.46.09-.46.36-.47.71C0,8.63.34,11.49,1.28,14.26c1.52,4.5,4.35,7.84,8.72,9.79.26.12.66.14.92.02,3.16-1.38,5.63-3.54,7.33-6.55,2.09-3.71,2.77-7.74,2.68-11.95Z"></path>
                                                        <path class="cls-2" d="M9.82,21.5c.47.25.87.28,1.36.02,1.57-.85,2.98-1.89,4.12-3.27H5.7c1.09,1.3,2.46,2.39,4.12,3.25Z"></path>
                                                        <path class="cls-2" d="M13.24,8.31s.01.07.02.09c0,.04.01.08.02.11,0,.05.01.09.02.14,0,.03,0,.05.01.08.02.14.03.29.04.44.01.29,0,.58-.02.87-.02.23-.06.45-.11.68,0,0-.05.29-.09.44,0-.02-.01-.06-.02-.08,0-.03-.01-.07-.02-.1-.01-.06-.03-.13-.05-.19-.03-.12-.07-.25-.11-.37-.1-.3-.23-.59-.35-.88-.12-.28-.23-.55-.36-.83-.12-.26-.31-.49-.43-.76-.01-.03-.03-.06-.04-.09-.37-.89-.1-1.91.24-2.81-.95.51-1.83,1.17-2.48,2.03-.65.86-1.07,1.92-1.03,3-.43-.41-.61-1.04-.48-1.62-.59.71-1.13,1.47-1.49,2.32-.35.85-.5,1.81-.3,2.7.28,1.25,1.2,2.27,2.28,2.95-.13-.48-.26-.97-.25-1.46,0-.5.16-1.01.53-1.35.07.49.41.93.86,1.12-.21-.77-.16-1.61.15-2.35s.87-1.36,1.57-1.75c-.17.6-.11,1.26.18,1.81.23.43.58.79.78,1.24.41.91.09,1.99-.41,2.85,1.42-.6,2.64-1.84,2.92-3.35.1-.55.08-1.11-.03-1.66-.06-.32-.15-.63-.27-.93-.31-.82-.78-1.58-1.28-2.3Z"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="tw-text-[13px] md:tw-text-[16px] lg:tw-text-[18px] tw-mb-0 tw-font-medium tw-leading-tight"><?php echo esc_html($item['title']); ?></h3>
                                </div>
                                <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 tw-right-8 md:tw-top-12 md:tw-right-12 tw-w-20 tw-h-20 md:tw-w-24 md:tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                    <svg class="tw-w-12 tw-h-12 md:tw-w-16 md:tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                    <div id="insulation-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen das Isolationsmaterial auswählen</div>
                </div>

                <!-- Oddelovacia čiara a tlačidlá -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-20 md:tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-12 tw-pr-16 md:tw-pl-20 md:tw-pr-24 tw-py-6 md:tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-8 md:tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-6 md:tw-gap-10">
                            <svg class="tw-w-16 tw-h-16 md:tw-w-20 md:tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndContinue()" class="tw-pl-16 tw-pr-12 md:tw-pl-24 md:tw-pr-20 tw-py-6 md:tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-8 md:tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-6 md:tw-gap-10">
                            Weiter
                            <svg class="tw-w-16 tw-h-16 md:tw-w-20 md:tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
// Filtrovanie izolácií podľa typu použitia
function filterInsulations() {
    const usageType = sessionStorage.getItem('sendvicUsage');
    const cards = document.querySelectorAll('.insulation-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const compatibleTypes = JSON.parse(card.getAttribute('data-compatible-types') || '[]');
        
        // Ak nie sú definované žiadne typy, zobraz kartu (pre spätnu kompatibilitu)
        // Alebo ak zvolený typ je v kompatibilných typoch
        if (compatibleTypes.length === 0 || !usageType || compatibleTypes.includes(usageType)) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Ak nie sú žiadne viditeľné izolácie, zobraz všetky
    if (visibleCount === 0) {
        cards.forEach(card => card.style.display = '');
    }
}

function selectInsulation(element) {
    document.getElementById('insulation-error').classList.add('tw-hidden');

    // Reset
    document.querySelectorAll('.insulation-card').forEach(card => {
        card.classList.remove('tw-border-primary-900');
        card.classList.add('tw-border-neutral-200');
        card.querySelector('.checkmark').classList.add('tw-opacity-0');
        card.querySelector('.checkmark').classList.remove('tw-opacity-100');
    });

    // Select
    element.classList.remove('tw-border-neutral-200');
    element.classList.add('tw-border-primary-900');
    element.querySelector('.checkmark').classList.remove('tw-opacity-0');
    element.querySelector('.checkmark').classList.add('tw-opacity-100');

    // Save
    const insulation = element.getAttribute('data-insulation');
    sessionStorage.setItem('sendvicInsulation', insulation);
    console.log('session stored sendvicInsulation:', insulation);
}

document.addEventListener('DOMContentLoaded', function() {
    // Najprv filtruj izolácie
    filterInsulations();
    
    // Potom obnov výber ak existuje
    const savedInsulation = sessionStorage.getItem('sendvicInsulation');
    if (savedInsulation) {
        const card = document.querySelector(`[data-insulation="${savedInsulation}"]`);
        if (card && card.style.display !== 'none') {
            selectInsulation(card);
        } else if (card && card.style.display === 'none') {
            // Ak uložená izolácia už nie je kompatibilná, vymaž ju
            sessionStorage.removeItem('sendvicInsulation');
        }
    }
});

function validateAndContinue() {
    const insulation = sessionStorage.getItem('sendvicInsulation');
    if (!insulation) {
        document.getElementById('insulation-error').classList.remove('tw-hidden');
        const el = document.getElementById('insulation-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    window.location.href = '/angebot/sandwichpaneele-dicke/';
}

function goBack() {
    window.location.href = '/angebot/sandwichpaneele-typ/';
}
</script>

<?php get_footer(); ?>