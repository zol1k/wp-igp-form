<?php
/**
 * Template Name: Cenová ponuka - Lemovanie - Typ
 *
 */
?>
<?php get_header() ?>

<main id="content">

    <section class="tw-py-50 md:tw-pb-100">
        <div class="container">
            <div class="tw-max-w-[1200px] tw-mx-auto">
                <!-- Progress stepper -->
                <div class="tw-flex tw-items-center tw-justify-center tw-mb-40 tw-gap-8">
                    <!-- Krok 1 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/berechnung/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Produktauswahl</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 2 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            2
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">MATERIAL</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - kliknuteľný s validáciou -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[14px] md:tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Farbe</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[28px] md:tw-text-[40px] tw-font-bold tw-mb-50">
                    2. Materialauswahl
                </h1>

                <!-- Typ -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <div class="tw-mb-16">
                        <h2 class="tw-text-[20px] tw-font-bold tw-mb-4">Wählen Sie das Material der Einfassung:</h2>
                    </div>

                    <?php
                    // Get massgefertigte types from ACF
                    $massgefertigte_types = get_field('items');
                    ?>

                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-4 tw-gap-6 md:tw-gap-16">
                        <?php if ($massgefertigte_types && is_array($massgefertigte_types)) :
                            foreach ($massgefertigte_types as $type) :
                                $title = !empty($type['type']) ? $type['type'] : '';
                                $image = !empty($type['image']) ? $type['image'] : '';
                                $subtypes = !empty($type['subitems']) ? $type['subitems'] : array();
                                
                                // Get image URL
                                $image_url = '';
                                if (is_array($image)) {
                                    $image_url = !empty($image['url']) ? $image['url'] : '';
                                } elseif (is_numeric($image)) {
                                    $image_url = wp_get_attachment_url($image);
                                } else {
                                    $image_url = $image;
                                }
                                
                                // Create slug from title for data attribute
                                $slug = sanitize_title($title);
                                $has_subtypes = !empty($subtypes) && is_array($subtypes) && count($subtypes) > 0;
                        ?>
                        <div class="massgefertigte-type-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-massgefertigte-type="<?php echo esc_attr($slug); ?>"
                             data-massgefertigte-title="<?php echo esc_attr($title); ?>"
                             data-has-subtypes="<?php echo $has_subtypes ? 'true' : 'false'; ?>"
                             onclick="selectType(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-w-full tw-relative tw-aspect-square">
                                    <?php if ($image_url) : ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                    <?php endif; ?>
                                </div>
                                <h3 class="tw-text-[13px] md:tw-text-[15px] lg:tw-text-[16px] tw-font-bold"><?php echo esc_html($title); ?></h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 md:tw-top-10 lg:tw-top-12 tw-right-8 md:tw-right-10 lg:tw-right-12 tw-w-20 md:tw-w-22 lg:tw-w-24 tw-h-20 md:tw-h-22 lg:tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-12 md:tw-w-14 lg:tw-w-16 tw-h-12 md:tw-h-14 lg:tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <?php 
                            endforeach;
                        endif;
                        ?>

                        <!-- Neviem chcem poradiť - hardcoded -->
                        <!-- <div class="massgefertigte-type-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-massgefertigte-type="Neviem"
                             data-massgefertigte-title="Neviem, chcem poradiť"
                             data-has-subtypes="false"
                             onclick="selectmassgefertigteType(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-w-full tw-relative tw-aspect-square">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/cenova-ponuka/otaznik.png" alt="Neviem chcem poradiť" class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[13px] md:tw-text-[15px] lg:tw-text-[16px] tw-font-bold">Neviem<br> chcem poradiť</h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 md:tw-top-10 lg:tw-top-12 tw-right-8 md:tw-right-10 lg:tw-right-12 tw-w-20 md:tw-w-22 lg:tw-w-24 tw-h-20 md:tw-h-22 lg:tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-12 md:tw-w-14 lg:tw-w-16 tw-h-12 md:tw-h-14 lg:tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div> -->
                    </div>
                    <div id="massgefertigte-type-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Art der Abdeckung auswählen</div>
                </div>



                <!-- Podtypy krytín - dynamické sekcie -->
                <?php if ($massgefertigte_types && is_array($massgefertigte_types)) :
                    foreach ($massgefertigte_types as $type) :
                        $title = !empty($type['type']) ? $type['type'] : '';
                        $subtypes = !empty($type['subitems']) ? $type['subitems'] : array();
                        $slug = sanitize_title($title);
                        
                        if (!empty($subtypes) && is_array($subtypes) && count($subtypes) > 0) :
                ?>
                <div class="subtype-section tw-mb-20 md:tw-mb-50 tw-hidden" id="subtypes-<?php echo esc_attr($slug); ?>" data-parent="<?php echo esc_attr($slug); ?>">
                    <div class="tw-mb-16">
                        <h2 class="tw-text-[20px] tw-font-bold tw-mb-4"><?php echo esc_html($title); ?>:</h2>
                        <!-- <p class="tw-text-[14px] tw-text-neutral-600">Vyberte konkrétny produkt</p> -->
                    </div>

                    <div class="tw-grid tw-grid-cols-5 md:tw-grid-cols-5 tw-gap-8 md:tw-gap-6 lg:tw-gap-16">
                        <?php foreach ($subtypes as $subtype) :
                            $subtype_title = !empty($subtype['title']) ? $subtype['title'] : '';
                            $subtype_thickness = !empty($subtype['thickness']) ? $subtype['thickness'] : '';
                            $subtype_description = !empty($subtype['description']) ? $subtype['description'] : '';
                            $subtype_slug = sanitize_title($subtype_thickness);
                        ?>
                        <div style="padding: 30px 0 30px 0" class="subtype-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-related-type="<?php echo esc_attr($slug); ?>"
                             data-massgefertigte-subtype="<?php echo esc_attr($subtype_slug); ?>"
                             data-massgefertigte-subtype-title="<?php echo esc_attr($subtype_thickness); ?>"
                             onclick="selectSubtype(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <h3 class="tw-text-[13px] md:tw-text-[15px] lg:tw-text-[16px] tw-font-bold"><?php echo esc_html($subtype_title); ?></h3>
                                <p class="tw-text-[11px] md:tw-text-[13px] lg:tw-text-[14px] tw-font-bold"><?php echo esc_html($subtype_thickness); ?></p>
                                <div class="empty:tw-hidden tw-text-center tw-text-[12px] tw-text-neutral-600 tw-pt-6 tw-leading-[125%]"><?php echo esc_html($subtype_description); ?></div>
                                
                                <?php if ($subtype_price > 0) : ?>
                                <div class="tw-flex tw-items-center tw-justify-center tw-gap-4 tw-pt-6">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="tw-text-[18px] <?php echo $i <= $subtype_price ? 'tw-text-primary-900' : 'tw-text-neutral-300'; ?> tw-font-medium">€</span>
                                    <?php endfor; ?>
                                </div>
                                <div class="tw-text-center tw-text-[10px] tw-text-neutral-600">Cenová hladina</div>
                                <?php endif; ?>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 md:tw-top-10 lg:tw-top-12 tw-right-8 md:tw-right-10 lg:tw-right-12 tw-w-20 md:tw-w-22 lg:tw-w-24 tw-h-20 md:tw-h-22 lg:tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-12 md:tw-w-14 lg:tw-w-16 tw-h-12 md:tw-h-14 lg:tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="subtype-error-<?php echo esc_attr($slug); ?>" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen einen Untertyp der Abdeckung auswählen</div>
                </div>
                <?php 
                        endif;
                    endforeach;
                endif;
                ?>


                <!-- Oddelovacia čiara a tlačidlá -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-10">
                            <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndContinue()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-10">
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
// Funkcia pre výber typu krytiny
function selectType(element) {
    // Skry error
    document.getElementById('massgefertigte-type-error').classList.add('tw-hidden');
    
    // Odstráň výber zo všetkých kariet
    document.querySelectorAll('.massgefertigte-type-card').forEach(card => {
        card.classList.remove('tw-border-primary-900');
        card.classList.add('tw-border-neutral-200');
        card.querySelector('.checkmark').classList.add('tw-opacity-0');
        card.querySelector('.checkmark').classList.remove('tw-opacity-100');
    });
    
    // Pridaj výber na kliknutú kartu
    element.classList.remove('tw-border-neutral-200');
    element.classList.add('tw-border-primary-900');
    element.querySelector('.checkmark').classList.remove('tw-opacity-0');
    element.querySelector('.checkmark').classList.add('tw-opacity-100');
    
    // Ulož do sessionStorage
    const massgefertigteType = element.getAttribute('data-massgefertigte-type');

    const massgefertigteTitle = element.getAttribute('data-massgefertigte-title');
    const hasSubtypes = element.getAttribute('data-has-subtypes') === 'true';
    
    sessionStorage.setItem('massgefertigteType', massgefertigteType);
    sessionStorage.setItem('massgefertigteTitle', massgefertigteTitle);
    console.log("sessionStorage massgefertigteType:", massgefertigteType);
    console.log("sessionStorage massgefertigteTitle:", massgefertigteTitle);

    // Skry všetky sekcie podtypov
    document.querySelectorAll('.subtype-section').forEach(section => {
        section.classList.add('tw-hidden');
    });

    // Ak má podtypy, zobraz príslušnú sekciu
    if (hasSubtypes) {
        const subtypeSection = document.getElementById('subtypes-' + massgefertigteType);
        if (subtypeSection) {
            subtypeSection.classList.remove('tw-hidden');
            // ak subpodtyp nieje viditelny(je sucastou schovaneho subtype), Vymaž sessionStorage pre podtyp a scrollni k sekcii
            // Scroll k sekcii podtypov
            setTimeout(() => {
                subtypeSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300);
        }
    }
}


// Funkcia pre výber podtypu
function selectSubtype(element) {

    sessionStorage.removeItem('massgefertigteSubtype');
    sessionStorage.removeItem('massgefertigteSubtypeTitle');

    // Nájdi parent sekciu
    const parentSection = element.closest('.subtype-section');
    const parentId = parentSection ? parentSection.getAttribute('data-parent') : '';
    
    // Skry error pre túto sekciu
    if (parentId) {
        const errorEl = document.getElementById('subtype-error-' + parentId);
        if (errorEl) {
            errorEl.classList.add('tw-hidden');
        }
    }
    
    // Odstráň výber zo všetkých kariet v tejto sekcii
    if (parentSection) {
        parentSection.querySelectorAll('.subtype-card').forEach(card => {
            card.classList.remove('tw-border-primary-900');
            card.classList.add('tw-border-neutral-200');
            card.querySelector('.checkmark').classList.add('tw-opacity-0');
            card.querySelector('.checkmark').classList.remove('tw-opacity-100');
        });
    }
    
    // Pridaj výber na kliknutú kartu
    element.classList.remove('tw-border-neutral-200');
    element.classList.add('tw-border-primary-900');
    element.querySelector('.checkmark').classList.remove('tw-opacity-0');
    element.querySelector('.checkmark').classList.add('tw-opacity-100');
    
    // Ulož do sessionStorage
    const subtype = element.getAttribute('data-massgefertigte-subtype');
    const subtypeTitle = element.getAttribute('data-massgefertigte-subtype-title');
    sessionStorage.setItem('massgefertigteSubtype', subtype);
    sessionStorage.setItem('massgefertigteSubtypeTitle', subtypeTitle);
    console.log("sessionStorage massgefertigteSubtype:", subtype);
    console.log("sessionStorage massgefertigteSubtypeTitle:", subtypeTitle);
}


document.addEventListener('DOMContentLoaded', function() {
    const savedType = sessionStorage.getItem('massgefertigteType');
    if (savedType) {
        console.log("Saved massgefertigteType found in sessionStorage:", savedType);
        const typeCard = document.querySelector(`[data-massgefertigte-type="${savedType}"]`);
        if (typeCard) selectType(typeCard);
    }

    const savedSub = sessionStorage.getItem('massgefertigteSubtype');
    const subCard = document.querySelector(`[data-massgefertigte-subtype="${savedSub}"][data-related-type="${savedType}"]`);

    if (savedType && savedSub && subCard) {
        // find element with matching data-massgefertigte-subtype attribute and data-related-type attribute that matches savedType
        selectSubtype(subCard);
        console.log("Selected subtype card based on sessionStorage:", subCard);
    } else {
        console.log("No saved subtype or type found in sessionStorage, or matching card not found. Clearing subtype from sessionStorage.");
        sessionStorage.removeItem('massgefertigteSubtype');
        sessionStorage.removeItem('massgefertigteSubtypeTitle');
    }
});

function validateAndContinue() {
    const type = sessionStorage.getItem('massgefertigteType');
    if (!type) {
        document.getElementById('type-error').classList.remove('tw-hidden');
        document.getElementById('type-error').scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    if (type === 'Trapézové plechy') {
        const sub = sessionStorage.getItem('massgefertigteSubtype');
        if (!sub) {
            document.getElementById('subtype-error').classList.remove('tw-hidden');
            document.getElementById('subtype-error').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
    }

    window.location.href = '/angebot/massgefertigte-kantteile-farbe/';
}

function goBack() {
    window.location.href = '/angebot/berechnung/';
}
</script>

<?php get_footer(); ?>