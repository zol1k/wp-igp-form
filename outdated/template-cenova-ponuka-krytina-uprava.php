<?php
/**
 * Template Name: Cenová ponuka - Krytina - Úprava
 *
 */
?>
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
                <div class="tw-block lg:tw-hidden tw-mb-40">
                    <div class="tw-text-center tw-mb-16">
                        <div class="tw-text-[14px] tw-text-neutral-600 tw-mb-8" style="display:none;">Krok 3 z 4</div>
                        <div class="tw-text-[20px] tw-font-bold tw-text-primary-900">Oberflächenbehandlung</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
                    </div>
                </div>

                <!-- Desktop version -->
                <div class="tw-hidden lg:tw-flex tw-items-center tw-justify-center tw-mb-40 tw-gap-8">
                    <!-- Krok 1 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/berechnung/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Produktauswahl</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 2 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/verkleidungen-typ/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Auswahl der Eindeckung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Oberflächenbehandlung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 4 - Neaktívny -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-60 tw-transition-opacity tw-opacity-40" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-500 tw-font-bold tw-text-[14px]">
                            4
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-neutral-500 tw-uppercase">Farbe</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[20px] md:tw-text-[28px] lg:tw-text-[40px] tw-font-bold tw-mb-24 md:tw-mb-50">
                    3. Oberflächenbehandlung
                </h1>

                <!-- Label -->
                <h2 class="tw-text-[18px] tw-font-bold tw-mb-20">Oberflächenbehandlung:</h2>

                <!-- Výber povrchových úprav -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <?php
                    // Get surface treatments from ACF
                    $surface_items = get_field('items');
                    ?>

                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-6 tw-gap-6 md:tw-gap-16" id="uprava-grid">
                        <?php if ($surface_items && is_array($surface_items)) :
                            foreach ($surface_items as $item) :
                                $title = $item['title'] ?? '';
                                $description = $item['description'] ?? '';
                                $image = $item['image'] ?? null;
                                $compatible_types = $item['compatible_types'] ?? [];
                                
                                // Build compatible types string for data attribute
                                $compatible_types_json = '';
                                if (!empty($compatible_types) && is_array($compatible_types)) {
                                    $types_array = array_map(function($type_item) {
                                        // Use sanitize_title to get the slug (like esc_attr($slug))
                                        return sanitize_title($type_item['type'] ?? '');
                                    }, $compatible_types);
                                    $compatible_types_json = json_encode($types_array);
                                } else {
                                    // Empty array means compatible with all
                                    $compatible_types_json = json_encode([]);
                                }
                                
                                if (empty($title)) continue;
                                ?>
                                <div class="uprava-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-12 tw-p-16 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all tw-flex tw-flex-col tw-items-center tw-min-h-[180px]"
                                    data-uprava="<?php echo esc_attr($title); ?>"
                                    data-compatible-types='<?php echo esc_attr($compatible_types_json); ?>'
                                    onclick="selectUprava(this)">
                                    <?php if ($image) : ?>
                                    <div class="tw-w-full tw-relative tw-aspect-square tw-rounded-8 tw-mb-12 tw-overflow-hidden">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                    </div>
                                    <?php endif; ?>
                                    <div class="tw-text-[16px] tw-font-bold tw-text-center"><?php echo esc_html($title); ?></div>
                                    <?php if ($description) : ?>
                                    <div class="tw-text-[14px] tw-text-center tw-text-neutral-600 tw-leading-[130%]"><?php echo esc_html($description); ?></div>
                                    <?php endif; ?>
                                    <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 tw-right-8 tw-w-20 tw-h-20 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                        <svg class="tw-w-12 tw-h-12" fill="none" stroke="white" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                        
                        <!-- Neviem, chcem poradiť - vždy zobrazená -->
                        <div class="uprava-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-12 tw-p-16 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all tw-flex tw-flex-col tw-items-center tw-min-h-[180px]"
                             data-uprava="Neviem"
                             onclick="selectUprava(this)">
                            <div class="tw-w-full tw-relative tw-aspect-square tw-rounded-8 tw-mb-12 tw-overflow-hidden">
                                <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/otaznik.png" alt="Neviem chcem poradiť" class="tw-w-full tw-h-full tw-object-contain" />
                            </div>
                            <div class="tw-text-[16px] tw-font-bold tw-text-center">Ich weiß nicht</div>
                            <div class="tw-text-[14px] tw-text-center tw-text-neutral-600 tw-leading-[130%]">Beratung erwünscht</div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 tw-right-8 tw-w-20 tw-h-20 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-12 tw-h-12" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div id="uprava-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen sich für ein Finish entscheiden</div>
                    <div id="no-compatible-warning" class="tw-hidden tw-text-warning-600 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-warning-100">Für die gewählte Belagsart sind keine Ausführungen verfügbar.</div>
                </div>

                <!-- Oddelovacia čiara a tlačidlá -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-20 md:tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-12 md:tw-pl-20 tw-pr-16 md:tw-pr-24 tw-py-6 md:tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-8 md:tw-gap-10">
                            <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndContinue()" class="tw-pl-16 md:tw-pl-24 tw-pr-12 md:tw-pr-20 tw-py-6 md:tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-8 md:tw-gap-10">
                            Weiter
                            <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
function selectUprava(element) {
    document.getElementById('uprava-error').classList.add('tw-hidden');

    // Reset
    document.querySelectorAll('.uprava-card').forEach(card => {
        card.classList.remove('tw-border-primary-900', 'tw-bg-primary-900/[0.02]');
        card.classList.add('tw-border-neutral-200');
        card.querySelector('.checkmark').classList.add('tw-opacity-0');
        card.querySelector('.checkmark').classList.remove('tw-opacity-100');
    });

    // Select
    element.classList.remove('tw-border-neutral-200');
    element.classList.add('tw-border-primary-900', 'tw-bg-primary-900/[0.02]');
    element.querySelector('.checkmark').classList.remove('tw-opacity-0');
    element.querySelector('.checkmark').classList.add('tw-opacity-100');

    // Save
    const uprava = element.getAttribute('data-uprava');
    sessionStorage.setItem('krytinaUprava', uprava);
    console.log('session stored krytinaUprava:', uprava);
}

document.addEventListener('DOMContentLoaded', function() {
    // Filter cards based on compatibility
    filterCompatibleCards();
    
    // Restore selection
    const savedUprava = sessionStorage.getItem('krytinaUprava');
    if (savedUprava) {
        const card = document.querySelector(`[data-uprava="${savedUprava}"]`);
        if (card && !card.classList.contains('tw-hidden')) {
            selectUprava(card);
        }
    }
});

function filterCompatibleCards() {
    // Get selected type from previous step
    const coveringSubtype = sessionStorage.getItem('coveringSubtype');
    const coveringType = sessionStorage.getItem('coveringType');
    const coveringTitle = sessionStorage.getItem('coveringTitle');
    console.log('Filtering cards with coveringType:', coveringType, 'coveringSubtype:', coveringSubtype, 'coveringTitle:', coveringTitle);
    
    // Check if "Neviem" was selected in previous step
    const isNeviem = (coveringType && coveringType.toLowerCase().includes('neviem')) || 
                     (coveringSubtype && coveringSubtype.toLowerCase().includes('neviem'));
    
    // Use subtype if available, otherwise use main type, otherwise use title
    const selectedType = coveringSubtype || coveringType || coveringTitle;
    
    const cards = document.querySelectorAll('.uprava-card');
    let visibleCount = 0;
    
    // If "Neviem" was selected, show all cards
    if (isNeviem) {
        cards.forEach(card => {
            card.classList.remove('tw-hidden');
            visibleCount++;
        });
        return;
    }
    
    cards.forEach(card => {
        const uprava = card.getAttribute('data-uprava');
        
        // Always show "Neviem" card
        if (uprava && uprava.toLowerCase() === 'neviem') {
            card.classList.remove('tw-hidden');
            visibleCount++;
            return;
        }
        
        const compatibleTypesAttr = card.getAttribute('data-compatible-types');
        
        if (!compatibleTypesAttr) {
            card.classList.add('tw-hidden');
            return;
        }

        try {
            //added as echo esc_attr($slug);
            const compatibleTypes = JSON.parse(compatibleTypesAttr);
            
            // If empty array, hide the card
            if (!compatibleTypes || compatibleTypes.length === 0) {
                card.classList.add('tw-hidden');
                return;
            }
            
            // Check if selected type matches any compatible type
            const isCompatible = compatibleTypes.some(type => {
                const normalizedCompatible = type.toLowerCase().trim();
                const normalizedSelected = selectedType ? selectedType.toLowerCase().trim() : '';
                return normalizedCompatible === normalizedSelected;
            });
            
            if (isCompatible) {
                card.classList.remove('tw-hidden');
                visibleCount++;
            } else {
                card.classList.add('tw-hidden');
            }
        } catch (e) {
            card.classList.add('tw-hidden');
        }
    });
    
    // Show warning if no compatible cards found
    const warningEl = document.getElementById('no-compatible-warning');
    if (warningEl) {
        if (visibleCount === 0) {
            warningEl.classList.remove('tw-hidden');
        } else {
            warningEl.classList.add('tw-hidden');
        }
    }
}

function validateAndContinue() {
    const uprava = sessionStorage.getItem('krytinaUprava');
    if (!uprava) {
        document.getElementById('uprava-error').classList.remove('tw-hidden');
        const el = document.getElementById('uprava-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    window.location.href = '/angebot/verkleidungen-farbe/';
}

function goBack() {
    window.location.href = '/angebot/verkleidungen-typ/';
}
</script>

<?php get_footer(); ?>