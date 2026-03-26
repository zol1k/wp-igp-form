<?php
/**
 * Template Name: Cenová ponuka - Kalkulácia
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
            <!-- Header s krokom 1 -->
            <div class="tw-max-w-[1200px] tw-mx-auto tw-mb-50">
                <div class="tw-flex tw-items-center tw-justify-center tw-mb-24">
                    <div class="tw-w-48 tw-h-48 tw-rounded-full tw-border tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[20px]">
                        1
                    </div>
                    <div class="tw-ml-16 tw-text-primary-900 tw-font-bold tw-text-[20px] md:tw-text-[24px] tw-uppercase">
                        PRODUKTAUSWAHL
                    </div>
                </div>
                
                <h1 class="tw-text-center tw-text-[24px] md:tw-text-[32px] tw-font-semibold tw-mb-30">
                    1. Wohin und an wen sollen wir das Angebot senden
                </h1>

                <!-- Kontaktný formulár -->
                <div style="border-width: 2px;" class="tw-max-w-[920px] tw-border tw-border-neutral-200 tw-mx-auto tw-bg-white tw-rounded-16 tw-shadow-elevation-1 tw-p-24 md:tw-p-40 tw-mb-50">
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-20">
                        <div>
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">Name: <span class="tw-text-primary-900">*</span></label>
                            <input style="" type="text" id="priezvisko" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required />
                            <div id="priezvisko-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div>
                        <div>
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">Telefonnummer: <span class="tw-text-primary-900">*</span></label>
                            <input style="" type="tel" id="telKontakt" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required />
                            <div id="telKontakt-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div>
                        <div>
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">E-mail: <span class="tw-text-primary-900">*</span></label>
                            <input style="" type="email" id="email" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required />
                            <div id="email-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div>
                        <div class="tw-relative">
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">PLZ der Realisierung: <span class="tw-text-primary-900">*</span></label>
                            <input style="" type="text" id="pobocka" maxlength="5" inputmode="numeric" pattern="[0-9]*" autocomplete="off" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required/>
                            <div id="pobocka-autocomplete" class="tw-absolute tw-z-50 tw-bg-white tw-border tw-border-neutral-200 tw-rounded-8 tw-shadow-elevation-1 tw-mt-2 tw-w-full tw-max-h-[300px] tw-overflow-y-auto tw-hidden"></div>
                            <div id="pobocka-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div>
                        <!-- <div class="tw-relative">
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">PLZ der Realisierung: <span class="tw-text-primary-900">*</span></label>
                            <input style="" type="text" id="psc" maxlength="5" inputmode="numeric" pattern="[0-9]*" autocomplete="off" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required oninput="handlePscInput(this)" />
                            <div id="psc-autocomplete" class="tw-absolute tw-z-50 tw-bg-white tw-border tw-border-neutral-200 tw-rounded-8 tw-shadow-elevation-1 tw-mt-2 tw-w-full tw-max-h-[300px] tw-overflow-y-auto tw-hidden"></div>
                            <div id="psc-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div> -->
                        <!-- <div class="tw-relative">
                            <label class="tw-block tw-mb-4 !tw-font-bold tw-text-[16px]">PLZ der Realisierung: <span class="tw-text-primary-900">*</span></label>
                            <select id="pobocka" class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 focus:tw-outline-none focus:tw-border-primary-900 tw-transition-all" required>
                                <option value="">Vyberte pobočku</option>
                                <?php
                                // $pobocky = get_posts(array(
                                //     'post_type' => 'kontakt',
                                //     'posts_per_page' => -1,
                                //     'orderby' => 'title',
                                //     'order' => 'ASC',
                                //     'meta_query' => array(
                                //         'relation' => 'AND',
                                //         array(
                                //             'key' => 'krajina',
                                //             'value' => 'slovensko',
                                //             'compare' => '='
                                //         ),
                                //         array(
                                //             'key' => 'pobocka',
                                //             'value' => 'zastupenie',
                                //             'compare' => '!='
                                //         )
                                //     )
                                // ));
                                // foreach ($pobocky as $pobocka) {
                                //     $pobocka_email = get_field('kontaktne_udaje', $pobocka->ID)['e-mail'];
                                //     echo '<option value="' . $pobocka->ID . '" data-email="' . esc_attr($pobocka_email) . '">' . esc_html($pobocka->post_title) . '</option>';
                                // }
                                ?>
                            </select>
                            <div id="pobocka-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Dieses Feld ist erforderlich.</div>
                        </div> -->
                    </div>
                </div>

                <!-- Výber produktov -->
                <div class="tw-mb-40">
                    <h2 class="tw-text-center tw-text-[24px] md:tw-text-[32px] tw-font-semibold tw-mb-30">
                        An welcher Produktart haben Sie Interesse?
                    </h2>
                    
                    <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-5 tw-gap-16 md:tw-gap-20 tw-max-w-[1100px] tw-mx-auto">
                        <!-- Produkt 1 -->
                        <div class="product-card tw-relative tw-bg-white tw-rounded-12 tw-border-2 tw-border-neutral-200 tw-p-16 md:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all" 
                             data-product-id="trapezbleche"
                             data-product-url="/angebot/trapezbleche-typ/"
                             onclick="selectProduct(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-mb-16 tw-w-full tw-aspect-square tw-relative">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/trapezbleche.png" 
                                         alt="Trapezbleche" 
                                         class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[12px] md:tw-text-[13px] tw-font-bold tw-leading-tight">
                                    Trapezbleche
                                </h3>
                            </div>
                            <!-- Checkmark ikona -->
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Produkt 2 -->
                        <div class="product-card tw-relative tw-bg-white tw-rounded-12 tw-border-2 tw-border-neutral-200 tw-p-16 md:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all" 
                             data-product-id="Dach-und-Fassadenverkleidungen"
                             data-product-url="/angebot/verkleidungen-typ/"
                             onclick="selectProduct(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-mb-16 tw-w-full tw-aspect-square tw-relative">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/fassadenverkleindungen.png" 
                                         alt="Dach-und-Fassadenverkleidungen" 
                                         class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[12px] md:tw-text-[13px] tw-font-bold tw-leading-tight">
                                    Dach- und Fassadenverkleidungen
                                </h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Produkt 3 -->
                        <div class="product-card tw-relative tw-bg-white tw-rounded-12 tw-border-2 tw-border-neutral-200 tw-p-16 md:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all" 
                             data-product-id="sandwichpaneele"
                             data-product-url="/angebot/sandwichpaneele-typ/"
                             onclick="selectProduct(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-mb-16 tw-w-full tw-aspect-square tw-relative">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/2.png" 
                                         alt="Sandwichpaneele" 
                                         class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[12px] md:tw-text-[13px] tw-font-bold tw-leading-tight">
                                    Sandwichpaneele
                                </h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Produkt 4 -->
                        <div class="product-card tw-relative tw-bg-white tw-rounded-12 tw-border-2 tw-border-neutral-200 tw-p-16 md:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all" 
                             data-product-id="dachrinnensystem"
                             data-product-url="/angebot/dachrinnensystem-typ/"
                             onclick="selectProduct(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-mb-16 tw-w-full tw-aspect-square tw-relative">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/3.png" 
                                         alt="Dachrinnensystem" 
                                         class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[12px] md:tw-text-[13px] tw-font-bold tw-leading-tight">
                                    Dachrinnensystem
                                </h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Produkt 5 -->
                        <div class="product-card tw-relative tw-bg-white tw-rounded-12 tw-border-2 tw-border-neutral-200 tw-p-16 md:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all" 
                             data-product-id="Massgefertigte-Kantteile"
                             data-product-url="/angebot/massgefertigte-kantteile-typ/"
                             onclick="selectProduct(this)">
                            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                <div class="tw-mb-16 tw-w-full tw-aspect-square tw-relative">
                                    <img src="<?= get_stylesheet_directory_uri() ?>/images/cenova-ponuka/massgefertigte-kantteile.jpg" 
                                         alt="Maßgefertigte Kantteile" 
                                         class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[12px] md:tw-text-[13px] tw-font-bold tw-leading-tight">
                                    Maßgefertigte Kantteile
                                </h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="selectedProductInfo" class="tw-hidden tw-max-w-[600px] tw-mx-auto tw-bg-neutral-50 tw-rounded-12 tw-p-24 tw-text-center">
                    <p class="tw-text-[16px] tw-text-neutral-700 mb-0">
                        Ausgewähltes Produkt: <span id="selectedProductName" class="tw-font-bold tw-text-primary-900"></span>
                    </p>
                </div>
                <div id="product-error" class="tw-hidden tw-text-error-500 tw-text-[16px] tw-text-center tw-font-medium">Sie müssen ein Produkt auswählen.</div>

                <div class="tw-mt-30 tw-mb-30 tw-border-t tw-border-neutral-300"></div>

                <div class="tw-flex tw-justify-end">
                    <button id="dalejeButton" onclick="validateAndRedirect()" class="tw-pl-16 md:tw-pl-24 tw-pr-12 md:tw-pr-20 tw-py-6 md:tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-12 tw-text-black tw-font-bold tw-text-[14px] md:tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-8 md:tw-gap-10">
                        Weiter
                        <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
// Funkcia pre výber produktu
function selectProduct(element) {
    const productError = document.getElementById('product-error').classList.add('tw-hidden');
    // Odstráň výber zo všetkých kariet
    document.querySelectorAll('.product-card').forEach(card => {
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
    
    // Získaj ID produktu a ulož do sessionStorage
    const productId = element.getAttribute('data-product-id');
    const productName = element.querySelector('h3').textContent;
    
    sessionStorage.setItem('selectedProduct', productId);
    console.log('session stored selectedProduct:', productId);

    sessionStorage.setItem('selectedProductName', productName);
    console.log('session stored selectedProductName:', productName);

    // Zobraz informáciu o vybranom produkte
    const infoDiv = document.getElementById('selectedProductInfo');
    const nameSpan = document.getElementById('selectedProductName');
    
    nameSpan.textContent = productName;
    infoDiv.classList.remove('tw-hidden');
}

// Funkcia pre uloženie hodnoty formulárového poľa
function saveFormField(fieldId) {
    const field = document.getElementById(fieldId);
    if (field) {
        const eventType = field.tagName === 'SELECT' ? 'change' : 'input';
        field.addEventListener(eventType, function() {
            sessionStorage.setItem(fieldId, this.value);
            console.log('session stored ' + fieldId + ':', this.value);
            // Pre select pobočky ulož aj email
            // if (fieldId === 'pobocka' && this.selectedOptions[0]) {
            //     const email = this.selectedOptions[0].getAttribute('data-email');
            //     sessionStorage.setItem('pobocka_email', email);
            // }
            const errorDiv = document.getElementById(fieldId + '-error');
            if (errorDiv && this.value.trim() !== '') {
                errorDiv.classList.add('tw-hidden');
                field.classList.remove('tw-border-error-500');
                field.classList.add('tw-border-neutral-300');
            }
        });
    }
}

// Validačná funkcia
function validateAndRedirect() {
    let isValid = true;
    
    // Pole s požadovanými inputmi
    const requiredFields = ['priezvisko', 'telKontakt', 'email', 'pobocka'];
    //const requiredFields = [];

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const errorDiv = document.getElementById(fieldId + '-error');
        if (!field.value.trim()) {
            isValid = false;
            errorDiv.classList.remove('tw-hidden');
            field.classList.remove('tw-border-neutral-300');
            field.classList.add('tw-border-error-500');
        } else {
            errorDiv.classList.add('tw-hidden');
            field.classList.remove('tw-border-error-500');
            field.classList.add('tw-border-neutral-300');
        }
    });
    
    // Skontroluj, či je vybraný produkt
    const selectedProduct = sessionStorage.getItem('selectedProduct');
    const productError = document.getElementById('product-error');
    
    if (!selectedProduct) {
        isValid = false;
        productError.classList.remove('tw-hidden');
    } else {
        productError.classList.add('tw-hidden');
    }
    
    // Ak je všetko validné, presmeruj
    if (isValid) {
        const productUrl = document.querySelector(`[data-product-id="${selectedProduct}"]`).getAttribute('data-product-url');
        if (productUrl) {
            window.location.href = productUrl;
        }
    } else {
        // Scrolluj k prvému chybnému poľu
        const firstError = document.querySelector('.tw-border-error-500');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Funkcia pre načítanie hodnoty formulárového poľa
function loadFormField(fieldId) {
    const field = document.getElementById(fieldId);
    const savedValue = sessionStorage.getItem(fieldId);
    if (field && savedValue) {
        field.value = savedValue;
    }
}



// Pri načítaní stránky skontroluj, či je niečo uložené v sessionStorage
document.addEventListener('DOMContentLoaded', function() {
    // Načítaj vybraný produkt
    const savedProduct = sessionStorage.getItem('selectedProduct');
    
    if (savedProduct) {
        // Nájdi a označ uložený produkt
        const productCard = document.querySelector(`[data-product-id="${savedProduct}"]`);
        if (productCard) {
            selectProduct(productCard);
        }
    }
    
    // Načítaj hodnoty formulára
    loadFormField('priezvisko');
    loadFormField('telKontakt');
    loadFormField('email');
    loadFormField('pobocka');
    
    // Nastav event listenery pre ukladanie hodnôt
    saveFormField('priezvisko');
    saveFormField('telKontakt');
    saveFormField('email');
    saveFormField('pobocka');
});
</script>

<?php get_footer(); ?>