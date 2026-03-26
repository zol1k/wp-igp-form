<?php
/**
 * Template Name: Cenová ponuka - Sendvič - Farba
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
                        <div class="tw-text-[14px] tw-text-neutral-600 tw-mb-8" style="display:none;">Krok 5 z 5</div>
                        <div class="tw-text-[20px] tw-font-bold tw-text-primary-900">Farbe</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
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

                    <!-- Krok 2 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/sandwichpaneele-typ/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Verwendung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/sandwichpaneele-isoliermaterial/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Isoliermaterial</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 4 - Dokončený -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/sandwichpaneele-dicke/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Dicke</span>
                    </div>

                    <!-- <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            5
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Farbe</span>
                    </div> -->
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[20px] md:tw-text-[28px] lg:tw-text-[40px] tw-font-bold tw-mb-24 md:tw-mb-50">
                    5. Farba sendvičového panela
                </h1>

                <!-- Výber farby -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 tw-gap-8 md:tw-gap-12 lg:tw-gap-16">
                        <?php 
                        $colors = get_field('colors');
                        if ($colors) :
                            foreach ($colors as $color_post) :
                                $color_name = get_the_title($color_post->ID);
                                $ral_code = get_field('ral', $color_post->ID);
                                $color_hex = get_field('color', $color_post->ID);
                                $in_stock = get_field('stock', $color_post->ID);
                                
                                // Build display name with RAL if available
                                $display_name = $color_name;
                                if (!empty($ral_code)) {
                                    $display_name .= ' ' . $ral_code;
                                }
                                
                                // Determine if color needs border (light colors)
                                $needs_border = in_array(strtolower($color_hex), ['#ffffff', '#f1ece1']);
                        ?>
                        <div class="color-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-6 md:tw-p-10 lg:tw-p-12 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all tw-flex tw-flex-col tw-items-center tw-min-h-[120px] md:tw-min-h-[140px] lg:tw-min-h-[160px]"
                             data-color="<?php echo esc_attr($display_name); ?>"
                             <?php if ($in_stock) : ?>data-stock="true"<?php endif; ?>
                             onclick="selectColor(this)">
                            <?php if ($in_stock) : ?>
                            <div class="tw-absolute tw-top-4 md:tw-top-6 lg:tw-top-8 tw-left-4 md:tw-left-6 lg:tw-left-8 tw-px-4 md:tw-px-5 lg:tw-px-6 tw-py-1 md:tw-py-1.5 lg:tw-py-2 tw-bg-primary-900 tw-text-white tw-text-[10px] md:tw-text-[11px] lg:tw-text-[13px] tw-font-bold tw-uppercase tw-rounded-4">SKLADOM</div>
                            <?php endif; ?>
                            <?php if (has_post_thumbnail($color_post->ID)) : ?>
                                <div class="tw-w-full tw-aspect-square tw-rounded-6 md:tw-rounded-8 tw-mb-4 md:tw-mb-6 lg:tw-mb-8 tw-overflow-hidden<?php if ($needs_border) echo ' tw-border tw-border-neutral-300'; ?>">
                                    <?php echo get_the_post_thumbnail($color_post->ID, 'medium', array('class' => 'tw-w-full tw-h-full tw-object-cover')); ?>
                                </div>
                            <?php else : ?>
                                <div class="tw-w-full tw-aspect-square tw-rounded-6 md:tw-rounded-8 tw-mb-4 md:tw-mb-6 lg:tw-mb-8 <?php if ($needs_border) echo ' tw-border tw-border-neutral-300'; ?>" style="background-color: <?php echo esc_attr($color_hex); ?>;"></div>
                            <?php endif; ?>
                            <div class="tw-text-[11px] md:tw-text-[13px] lg:tw-text-[16px] tw-font-bold tw-text-center tw-leading-tight"><?php echo esc_html($color_name); ?></div>
                            <?php if (!empty($ral_code)) : ?>
                                <div class="tw-text-[11px] md:tw-text-[13px] lg:tw-text-[16px] tw-text-center tw-leading-[130%]"><?php echo esc_html($ral_code); ?></div>
                            <?php endif; ?>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-4 md:tw-top-6 lg:tw-top-8 tw-right-4 md:tw-right-6 lg:tw-right-8 tw-w-16 md:tw-w-18 lg:tw-w-20 tw-h-16 md:tw-h-18 lg:tw-h-20 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                <svg class="tw-w-10 md:tw-w-11 lg:tw-w-12 tw-h-10 md:tw-h-11 lg:tw-h-12 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <div id="color-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Farbe des Panels auswählen</div>
                </div>

                <!-- Doplňujúce info -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <h2 style="margin: 100px 0 50px 0;" class="tw-text-center tw-text-[20px] md:tw-text-[25px] tw-font-bold tw-mb-50 fusion-responsive-typography-calculated">Hier können Sie ergänzende Informationen angeben</h2>
                    <div class="tw-mb-16">
                        <label for="dodatocneInfo" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4">Nachricht für uns:</label>
                        <textarea 
                            id="dodatocneInfo" 
                            rows="4" 
                            class="tw-w-full tw-px-16 tw-py-12 tw-border tw-border-neutral-300 tw-rounded-8 tw-text-[16px] focus:tw-border-primary-900 focus:tw-outline-none"
                            placeholder=""></textarea>
                    </div>
                </div>

                <!-- Priložiť súbor -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <h2 class="tw-text-[18px] tw-font-bold tw-mb-16">Anhang / Datei einfügen</h2>
                    <div class="tw-mb-8">
                        <label for="fileUpload" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4 tw-bg-e">Datei auswählen (jpg, pdf, doc):</label>
                        <div class="tw-flex tw-items-center tw-gap-12 tw-rounded-8 tw-w-full tw-bg-neutral-100 tw-p-2">
                            <label for="fileUpload" class="tw-inline-flex tw-mb-0 tw-items-center tw-gap-8 tw-px-20 tw-py-10 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-8 tw-text-[14px] tw-font-bold tw-cursor-pointer hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all">
                                <svg class="tw-w-16 tw-h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Auswählen
                            </label>
                            <input type="file" id="fileUpload" accept=".jpg,.jpeg,.pdf,.doc,.docx" class="tw-hidden" onchange="handleFileSelect(this)" />
                            <span id="fileName" class="tw-text-[16px] tw-text-black tw-font-medium">Keine Datei ausgewählt</span>
                            <button id="removeFile" onclick="removeFile()" class="tw-hidden tw-p-8 tw-bg-error-500 tw-text-white tw-rounded-8 tw-transition-all hover:tw-bg-error-600" title="Entfernen">
                                <svg class="tw-w-16 tw-h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="tw-text-[14px] tw-text-neutral-600">Bitte fügen Sie eine beliebige Datei bis zu einer Größe von 5 MB bei, die uns bei einer genaueren Preiskalkulation hilft. Vielen Dank.</div>
                </div>

                <!-- Oddelovacia čiara a tlačidlá -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-20 md:tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-10">
                            <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndSubmit()" class="tw-flex tw-items-center tw-gap-10 tw-px-28 tw-py-10 tw-bg-[#00a516] tw-border-2 tw-border-[#00a516] tw-rounded-12 tw-text-white tw-font-bold tw-text-[16px] hover:tw-bg-white hover:tw-text-[#008a13] tw-transition-all">
                            Anfrage absenden
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
// Helper function to get Google Analytics client ID from _ga cookie
function getGACookie() {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith('_ga=')) {
            const value = cookie.substring(4);
            // _ga cookie format: GA1.1.XXXXXXXXXX.XXXXXXXXXX – strip the GA1.x. prefix
            const match = value.match(/GA\d+\.\d+\.(.+)/);
            return match ? match[1] : value;
        }
    }
    return '';
}

function selectColor(element) {
    document.getElementById('color-error').classList.add('tw-hidden');

    // Reset
    document.querySelectorAll('.color-card').forEach(card => {
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
    const color = element.getAttribute('data-color');
    const stock = element.getAttribute('data-stock') === 'true';
    sessionStorage.setItem('sendvicColor', color);
    console.log('session stored sendvicColor:', color);
}

function handleFileSelect(input) {
    const fileName = input.files[0] ? input.files[0].name : 'Keine Datei ausgewählt';
    document.getElementById('fileName').textContent = fileName;
    
    if (input.files[0]) {
        sessionStorage.setItem('sendvicFileName', fileName);
        console.log('session stored sendvicFileName:', fileName);
        document.getElementById('removeFile').classList.remove('tw-hidden');
    } else {
        sessionStorage.removeItem('sendvicFileName');
        document.getElementById('removeFile').classList.add('tw-hidden');
    }
}

function removeFile() {
    const fileInput = document.getElementById('fileUpload');
    fileInput.value = '';
    document.getElementById('fileName').textContent = 'Keine Datei ausgewählt';
    document.getElementById('removeFile').classList.add('tw-hidden');
    sessionStorage.removeItem('sendvicFileName');
}

function saveTextarea() {
    const textarea = document.getElementById('dodatocneInfo');
    sessionStorage.setItem('sendvicInfo', textarea.value);
    console.log('session stored sendvicInfo:', textarea.value);
}

document.addEventListener('DOMContentLoaded', function() {
    // Restore color
    const savedColor = sessionStorage.getItem('sendvicColor');
    if (savedColor) {
        const card = document.querySelector(`[data-color="${savedColor}"]`);
        if (card) selectColor(card);
    }

    // Restore textarea
    const savedInfo = sessionStorage.getItem('sendvicInfo');
    if (savedInfo) {
        document.getElementById('dodatocneInfo').value = savedInfo;
    }

    // Restore file name
    const savedFileName = sessionStorage.getItem('sendvicFileName');
    if (savedFileName) {
        document.getElementById('fileName').textContent = savedFileName;
        document.getElementById('removeFile').classList.remove('tw-hidden');
    }

    // Save textarea on input
    document.getElementById('dodatocneInfo').addEventListener('input', saveTextarea);
});

async function validateAndSubmit() {
    const color = sessionStorage.getItem('sendvicColor');
    if (!color) {
        document.getElementById('color-error').classList.remove('tw-hidden');
        const el = document.getElementById('color-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    // Disable button to prevent double submission
    const button = event.target;
    button.disabled = true;
    button.innerHTML = '<span>Senden...</span>';

    // Prepare form data
    const formData = new FormData();
    formData.append('action', 'send_sendvic_quote');
    formData.append('nonce', '<?php echo wp_create_nonce("sendvic_quote_nonce"); ?>');
    
    // Add contact data
    formData.append('priezvisko', sessionStorage.getItem('priezvisko') || '');
    formData.append('telKontakt', sessionStorage.getItem('telKontakt') || '');
    formData.append('email', sessionStorage.getItem('email') || '');
    formData.append('pobocka', sessionStorage.getItem('pobocka') || '');
    formData.append('pobocka_email', sessionStorage.getItem('pobocka_email') || '');
    formData.append('selectedProduct', sessionStorage.getItem('selectedProduct') || '');
    formData.append('selectedProductName', sessionStorage.getItem('selectedProductName') || '');
    
    // Add sendvic data
    formData.append('sendvicUsage', sessionStorage.getItem('sendvicUsage') || '');
    formData.append('sendvicInsulation', sessionStorage.getItem('sendvicInsulation') || '');
    formData.append('sendvicThickness', sessionStorage.getItem('sendvicThickness') || '');
    formData.append('sendvicColor', sessionStorage.getItem('sendvicColor') || '');
    formData.append('sendvicInfo', sessionStorage.getItem('sendvicInfo') || '');
    formData.append('sendvicFileName', sessionStorage.getItem('sendvicFileName') || '');
    
    // Add Google Analytics ID
    formData.append('ga_id', getGACookie());
    
    // Add file if uploaded
    const fileInput = document.getElementById('fileUpload');
    if (fileInput && fileInput.files[0]) {
        formData.append('file', fileInput.files[0]);
    }

    try {
        const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Push GTM tracking event
            if (result.data && result.data.gtm_tracking) {
                window.dataLayer = window.dataLayer || [];
                const trackingData = result.data.gtm_tracking;
                trackingData.eventLabel = window.location.href;
                window.dataLayer.push(trackingData);
            }
            // Redirect to thank you page
            window.location.href = '/dakujeme-sendvic/';
        } else {
            alert('Fehler beim Senden: ' + (result.data?.message || 'Unbekannter Fehler'));
            button.disabled = false;
            button.innerHTML = 'Anfrage absenden <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Fehler beim Senden požiadavky');
        button.disabled = false;
        button.innerHTML = 'Anfrage absenden <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
    }
}

function goBack() {
    window.location.href = '/angebot/sandwichpaneele-dicke/';
}
</script>

<?php get_footer(); ?>