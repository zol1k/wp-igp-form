<?php
/**
 * Template Name: Cenová ponuka - Krytina - Typ
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

    <section class="tw-pt-[80px] md:tw-pt-[120px] lg:tw-pt-[150px] tw-pb-24 md:tw-pb-50">
        <div class="container">
            <div class="tw-max-w-[1200px] tw-mx-auto">
                
                <!-- Progress stepper -->
                <!-- Mobile version -->
                <div class="tw-block lg:tw-hidden tw-mb-40">
                    <div class="tw-text-center tw-mb-16">
                        <div class="tw-text-[14px] tw-text-neutral-600 tw-mb-8" style="display:none;">Krok 2 z 4</div>
                        <div class="tw-text-[20px] tw-font-bold tw-text-primary-900">Typ strechy</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
                    </div>
                </div>

                <!-- Desktop version -->
                <div class="tw-hidden lg:tw-flex tw-items-center tw-justify-center tw-mb-40 tw-gap-8">
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
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Auswahl der Eindeckung</span>
                    </div>
                    
                    <!-- <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div> -->
                    
                    <!-- Krok 3 -->
                    <!-- <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Výber krytiny</span>
                    </div> -->
                    
                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>
                    
                    <!-- Krok 3 -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Oberflächenbehandlung</span>
                    </div>
                    
                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>
                    
                    <!-- Krok 4 -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            4
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Farbe</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[20px] md:tw-text-[28px] lg:tw-text-[40px] tw-font-bold tw-mb-24 md:tw-mb-50">
                    2. Bestimmen Sie den Dachtyp und seine Spezifikationen
                </h1>

                <!-- Typológia strechy -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <div class="tw-mb-16">
                        <h2 class="tw-text-[20px] tw-font-bold tw-mb-4">Dachtypologie:</h2>
                        <p class="tw-text-[14px] tw-text-neutral-600">Wählen Sie Ihren Dachtyp aus</p>
                    </div>

                    <?php
                    // Get roof typology items from ACF
                    $typology_items = get_field('typology');
                    ?>

                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-4 tw-gap-6 md:tw-gap-16">
                        <?php if ($typology_items && is_array($typology_items)) :
                            foreach ($typology_items as $item) :
                                $title = !empty($item['title']) ? $item['title'] : '';
                                $image = !empty($item['image']) ? $item['image'] : '';
                                
                                // Get image URL
                                $image_url = '';
                                if (is_array($image)) {
                                    $image_url = !empty($image['url']) ? $image['url'] : '';
                                } elseif (is_numeric($image)) {
                                    $image_url = wp_get_attachment_url($image);
                                } else {
                                    $image_url = $image;
                                }
                                
                        ?>
                        <div class="roof-type-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-roof-type="<?php echo esc_attr(sanitize_title($title)); ?>"
                             onclick="selectRoofType(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-rounded-8 md:tw-rounded-12 tw-p-8 md:tw-p-12 lg:tw-p-16 tw-bg-neutral-100 tw-mb-8 md:tw-mb-10 lg:tw-mb-12">
                                    <div class="tw-w-full tw-relative tw-aspect-square">
                                        <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                        <?php endif; ?>
                                    </div>
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
                    </div>
                    <div id="roof-type-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen den Dachtyp auswählen</div>
                </div>

                <!-- Približná plocha -->
                <label class="tw-block tw-mb-4 tw-font-bold tw-text-[16px]">Ungefähre Fläche (m²):</label>
                <div class="tw-grid md:tw-grid-cols-2 tw-gap-16 md:tw-gap-20 tw-mb-50">
                    <div>

                        <input type="text" id="plocha" placeholder="Geben Sie die Fläche in m² ein"class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" />
                    </div>
                    <label class="tw-text-[16px] tw-text-black tw-font-medium tw-leading-[130%] tw-flex tw-gap-6 tw-items-start">
                        <input type="checkbox" name="zameranie" id="zameranie" class="tw-w-20 tw-h-20 tw-mt-4 tw-cursor-pointer">
                        <div>Ich kenne die Maße nicht, ich bitte um ein Aufmaß durch einen MASLEN-Mitarbeiter <br><span class="tw-text-primary-900 tw-text-[14px]">(Das Aufmaß ist kostenlos und unverbindlich)</span></div>
                    </label>
                </div>

                <!-- Typ krytiny -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <div class="tw-mb-16">
                        <h2 class="tw-text-[20px] tw-font-bold tw-mb-4">Eindeckungsart:</h2>
                        <p class="tw-text-[14px] tw-text-neutral-600">Wählen Sie die Eindeckungstypologie aus</p>
                    </div>

                    <?php
                    // Get covering types from ACF
                    $covering_types = get_field('covering_types');
                    ?>

                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-4 tw-gap-6 md:tw-gap-16">
                        <?php if ($covering_types && is_array($covering_types)) :
                            foreach ($covering_types as $type) :
                                $title = !empty($type['title']) ? $type['title'] : '';
                                $image = !empty($type['image']) ? $type['image'] : '';
                                $subtypes = !empty($type['subtypes']) ? $type['subtypes'] : array();
                                
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
                        <div class="covering-type-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-covering-type="<?php echo esc_attr($slug); ?>"
                             data-covering-title="<?php echo esc_attr($title); ?>"
                             data-has-subtypes="<?php echo $has_subtypes ? 'true' : 'false'; ?>"
                             onclick="selectCoveringType(this)">
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
                        <!-- <div class="covering-type-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-covering-type="Neviem"
                             data-covering-title="Neviem, chcem poradiť"
                             data-has-subtypes="false"
                             onclick="selectCoveringType(this)">
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
                    <div id="covering-type-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Art der Abdeckung auswählen</div>
                </div>

                <!-- Podtypy krytín - dynamické sekcie -->
                <?php if ($covering_types && is_array($covering_types)) :
                    foreach ($covering_types as $type) :
                        $title = !empty($type['title']) ? $type['title'] : '';
                        $subtypes = !empty($type['subtypes']) ? $type['subtypes'] : array();
                        $slug = sanitize_title($title);
                        
                        if (!empty($subtypes) && is_array($subtypes) && count($subtypes) > 0) :
                ?>
                <div class="subtype-section tw-mb-20 md:tw-mb-50 tw-hidden" id="subtypes-<?php echo esc_attr($slug); ?>" data-parent="<?php echo esc_attr($slug); ?>">
                    <div class="tw-mb-16">
                        <h2 class="tw-text-[20px] tw-font-bold tw-mb-4"><?php echo esc_html($title); ?>:</h2>
                        <!-- <p class="tw-text-[14px] tw-text-neutral-600">Vyberte konkrétny produkt</p> -->
                    </div>

                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-4 tw-gap-8 md:tw-gap-6 lg:tw-gap-16">
                        <?php foreach ($subtypes as $subtype) :
                            $subtype_title = !empty($subtype['title']) ? $subtype['title'] : '';
                            $subtype_description = !empty($subtype['description']) ? $subtype['description'] : '';
                            $subtype_image = !empty($subtype['image']) ? $subtype['image'] : '';
                            $subtype_price = !empty($subtype['price']) ? intval($subtype['price']) : 0;
                            
                            // Get image URL
                            $subtype_image_url = '';
                            if (is_array($subtype_image)) {
                                $subtype_image_url = !empty($subtype_image['url']) ? $subtype_image['url'] : '';
                            } elseif (is_numeric($subtype_image)) {
                                $subtype_image_url = wp_get_attachment_url($subtype_image);
                            } else {
                                $subtype_image_url = $subtype_image;
                            }
                            
                            $subtype_slug = sanitize_title($subtype_title);
                        ?>
                        <div class="subtype-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                             data-subtype="<?php echo esc_attr($subtype_slug); ?>"
                             data-subtype-title="<?php echo esc_attr($subtype_title); ?>"
                             onclick="selectSubtype(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-w-full tw-relative tw-aspect-square tw-mb-8 md:tw-mb-10 lg:tw-mb-12">
                                    <?php if ($subtype_image_url) : ?>
                                    <img src="<?php echo esc_url($subtype_image_url); ?>" alt="<?php echo esc_attr($subtype_title); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                    <?php endif; ?>
                                </div>
                                <h3 class="tw-text-[13px] md:tw-text-[15px] lg:tw-text-[16px] tw-font-bold"><?php echo esc_html($subtype_title); ?></h3>
                                <div class="empty:tw-hidden tw-text-center tw-text-[12px] tw-text-neutral-600 tw-pt-6 tw-leading-[125%]"><?php echo esc_html($subtype_description); ?></div>
                                
                                <!-- ?php if ($subtype_price > 0) : ?>
                                <div class="tw-flex tw-items-center tw-justify-center tw-gap-4 tw-pt-6">
                                    ?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="tw-text-[18px] ?php echo $i <= $subtype_price ? 'tw-text-primary-900' : 'tw-text-neutral-300'; ?> tw-font-medium">€</span>
                                    ?php endfor; ?>
                                </div>
                                <div class="tw-text-center tw-text-[10px] tw-text-neutral-600">Cenová hladina</div>
                                ?php endif; ?> -->
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
                <div class="tw-border-t tw-border-neutral-300 tw-pt-20 md:tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-12 md:tw-pl-20 tw-pr-16 md:tw-pr-24 tw-py-6 md:tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-8 md:tw-gap-10">
                            <svg class="tw-w-16 md:tw-w-20 tw-h-16 md:tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndContinue()" class="tw-pl-16 md:tw-pl-24 tw-pr-12 md:tw-pr-20 tw-py-6 md:tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-8 md:tw-gap-10">
                            Weiter
                            <svg class="tw-w-16 md:tw-w-20 tw-h-16 md:tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
// Funkcia pre výber typu strechy
function selectRoofType(element) {
    // Skry error
    document.getElementById('roof-type-error').classList.add('tw-hidden');
    
    // Odstráň výber zo všetkých kariet
    document.querySelectorAll('.roof-type-card').forEach(card => {
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
    const roofType = element.getAttribute('data-roof-type');
    sessionStorage.setItem('roofType', roofType);
    console.log('session stored roofType:', roofType);
}

// Funkcia pre výber typu krytiny
function selectCoveringType(element) {
    // Skry error
    document.getElementById('covering-type-error').classList.add('tw-hidden');
    
    // Odstráň výber zo všetkých kariet
    document.querySelectorAll('.covering-type-card').forEach(card => {
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
    const coveringType = element.getAttribute('data-covering-type');
    const coveringTitle = element.getAttribute('data-covering-title');
    const hasSubtypes = element.getAttribute('data-has-subtypes') === 'true';
    
    sessionStorage.setItem('coveringType', coveringType);
    console.log('session stored coveringType:', coveringType);
    sessionStorage.setItem('coveringTitle', coveringTitle);
    console.log('session stored coveringTitle:', coveringTitle);
    
    // Skry všetky sekcie podtypov
    document.querySelectorAll('.subtype-section').forEach(section => {
        section.classList.add('tw-hidden');
    });
    
    // Vymaž vybraný podtyp
    sessionStorage.removeItem('coveringSubtype');
    sessionStorage.removeItem('coveringSubtypeTitle');
    
    // Ak má podtypy, zobraz príslušnú sekciu
    if (hasSubtypes) {
        const subtypeSection = document.getElementById('subtypes-' + coveringType);
        if (subtypeSection) {
            subtypeSection.classList.remove('tw-hidden');
            // Scroll k sekcii podtypov
            setTimeout(() => {
                subtypeSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300);
        }
    }
}

// Funkcia pre výber podtypu
function selectSubtype(element) {
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
    const subtype = element.getAttribute('data-subtype');
    const subtypeTitle = element.getAttribute('data-subtype-title');
    sessionStorage.setItem('coveringSubtype', subtype);
    console.log('session stored coveringSubtype:', subtype);
    sessionStorage.setItem('coveringSubtypeTitle', subtypeTitle);
    console.log('session stored coveringSubtypeTitle:', subtypeTitle);
}

// Funkcia pre uloženie plochy
document.addEventListener('DOMContentLoaded', function() {
    const plochaInput = document.getElementById('plocha');
    const zameranieCheckbox = document.getElementById('zameranie');
    
    // Načítaj uloženú hodnotu
    const savedPlocha = sessionStorage.getItem('plocha');
    if (savedPlocha) {
        plochaInput.value = savedPlocha;
    }
    
    // Ukladaj pri každej zmene
    plochaInput.addEventListener('input', function() {
        sessionStorage.setItem('plocha', this.value);
        console.log('session stored plocha:', this.value);
    });

    // Načítaj a ulož checkbox "zameranie"
    if (zameranieCheckbox) {
        const savedZameranie = sessionStorage.getItem('zameranie');
        if (savedZameranie !== null) {
            zameranieCheckbox.checked = savedZameranie === '1';
        }
        zameranieCheckbox.addEventListener('change', function() {
            sessionStorage.setItem('zameranie', this.checked ? '1' : '0');
            console.log('session stored zameranie:', this.checked ? '1' : '0');
        });
    }
    
    // Načítaj vybraný typ strechy
    const savedRoofType = sessionStorage.getItem('roofType');
    if (savedRoofType) {
        const roofCard = document.querySelector(`[data-roof-type="${savedRoofType}"]`);
        if (roofCard) {
            selectRoofType(roofCard);
        }
    }
    
    // Načítaj vybraný typ krytiny
    const savedCoveringType = sessionStorage.getItem('coveringType');
    if (savedCoveringType) {
        // Ulož si podtyp pred volaním selectCoveringType (ktorý ho vymaže)
        const savedSubtype = sessionStorage.getItem('coveringSubtype');
        const savedSubtypeTitle = sessionStorage.getItem('coveringSubtypeTitle');
        
        const coveringCard = document.querySelector(`[data-covering-type="${savedCoveringType}"]`);
        if (coveringCard) {
            selectCoveringType(coveringCard);
            
            // Obnov podtyp späť do sessionStorage (selectCoveringType ho vymazal)
            if (savedSubtype) {
                sessionStorage.setItem('coveringSubtype', savedSubtype);
                console.log('session stored coveringSubtype (restored):', savedSubtype);
                if (savedSubtypeTitle) {
                    sessionStorage.setItem('coveringSubtypeTitle', savedSubtypeTitle);
                    console.log('session stored coveringSubtypeTitle (restored):', savedSubtypeTitle);
                }
                
                // Počkaj na zobrazenie sekcie a vyber podtyp
                let attempts = 0;
                const maxAttempts = 10;
                const trySelectSubtype = setInterval(() => {
                    attempts++;
                    const subtypeCard = document.querySelector(`[data-subtype="${savedSubtype}"]`);
                    
                    if (subtypeCard && subtypeCard.offsetParent !== null) {
                        // Karta existuje a je viditeľná
                        selectSubtype(subtypeCard);
                        clearInterval(trySelectSubtype);
                    } else if (attempts >= maxAttempts) {
                        // Dali sme tomu dosť pokusov
                        clearInterval(trySelectSubtype);
                    }
                }, 100);
            }
        }
    }
});

// Validačná funkcia
function validateAndContinue() {
    let isValid = true;
    let firstErrorElement = null;
    
    // Skontroluj typ strechy
    const roofType = sessionStorage.getItem('roofType');
    if (!roofType) {
        isValid = false;
        const errorEl = document.getElementById('roof-type-error');
        errorEl.classList.remove('tw-hidden');
        if (!firstErrorElement) firstErrorElement = errorEl;
    }
    
    // Skontroluj typ krytiny
    const coveringType = sessionStorage.getItem('coveringType');
    if (!coveringType) {
        isValid = false;
        const errorEl = document.getElementById('covering-type-error');
        errorEl.classList.remove('tw-hidden');
        if (!firstErrorElement) firstErrorElement = errorEl;
    }
    
    // Ak typ krytiny je "Neviem", preskoč kontrolu podtypu a presmeruj
    if (coveringType === 'Neviem') {
        if (isValid) {
            window.location.href = '/angebot/verkleidungen-oberflache/';
        }
        return;
    }
    
    // Skontroluj či má vybraný typ podtypy
    if (coveringType) {
        const selectedCard = document.querySelector(`[data-covering-type="${coveringType}"]`);
        const hasSubtypes = selectedCard ? selectedCard.getAttribute('data-has-subtypes') === 'true' : false;
        
        if (hasSubtypes) {
            const subtype = sessionStorage.getItem('coveringSubtype');
            if (!subtype) {
                isValid = false;
                const errorEl = document.getElementById('subtype-error-' + coveringType);
                if (errorEl) {
                    errorEl.classList.remove('tw-hidden');
                    if (!firstErrorElement) firstErrorElement = errorEl;
                }
            }
        }
    }
    
    // Ak je všetko OK, presmeruj na ďalší krok
    if (isValid) {
        window.location.href = '/angebot/verkleidungen-oberflache/';
    } else {
        // Scrolluj k prvému erroru
        if (firstErrorElement) {
            firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Funkcia späť
function goBack() {
    window.location.href = '/angebot/berechnung/';
}
</script>

<?php get_footer(); ?>