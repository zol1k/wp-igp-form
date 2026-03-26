<?php
/**
 * Template Name: Cenová ponuka - Lemovanie - Farba
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
                <!-- Mobile version - zobrazí sa len na malých obrazovkách -->
                <div class="tw-block lg:tw-hidden tw-mb-40">
                    <div class="tw-text-center tw-mb-16">
                        <div class="tw-text-[14px] tw-text-neutral-600 tw-mb-8" style="display:none;">Krok 3 z 3</div>
                        <div class="tw-text-[20px] tw-font-bold tw-text-primary-900">Farbe</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                    </div>
                </div>

                <!-- Desktop version - zobrazí sa len na väčších obrazovkách -->
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
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="window.location.href='/angebot/massgefertigte-kantteile-typ/'">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-bg-primary-900 tw-flex tw-items-center tw-justify-center tw-text-white tw-font-bold tw-text-[14px]">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Material</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Farbe</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[28px] md:tw-text-[40px] tw-font-bold tw-mb-50">
                    3. Farbe der Kantteile
                </h1>
                <h2 style="margin-bottom: 10px;" class="tw-text-[20px] md:tw-text-[25px] tw-font-bold tw-mb-50 fusion-responsive-typography-calculated">Wählen Sie die Blechfarbe aus:</h2>
                <p class="note" style="margin-bottom: 20px;">Die Zahl bei den Farben gibt die verfügbaren Materialstärken an.</p>
                <!-- Výber farby -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <?php
                    $items = get_field('items_pair');
                    $color_map = [];

                    if ($items && is_array($items)) {

                        ?><div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 tw-gap-8 md:tw-gap-12 lg:tw-gap-16"><?php 

                        foreach ($items as $item) {

                            $type = $item['type'] ?? '';
                            $colors = $item['colors'] ?? [];
                            $thicknessArray = $item['thickness'] ?? [];
                            echo '<!-- Type: ' . esc_html($type) . ' -->';
                            if (!$type || !$colors || !$thicknessArray) continue;
                            foreach ($colors as $color_post) {

                                $color_id = is_object($color_post) ? $color_post->ID : $color_post;
                                $color_name = get_the_title($color_post->ID);
                                $ral_code = get_field('ral', $color_post->ID);
                                $color_hex = get_field('color', $color_post->ID);

                                $display_name = $color_name;
                                if ($ral_code) $display_name .= ' ' . $ral_code;

                                $color_data = $color_map[$color_post->ID] ?? [];

                                ?>

                                <div style="display:none;" class="color-card tw-relative tw-bg-white tw-border-2 tw-rounded-8 md:tw-rounded-12 tw-p-6 md:tw-p-10 lg:tw-p-12 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all tw-flex tw-flex-col tw-items-center tw-min-h-[120px] md:tw-min-h-[140px] lg:tw-min-h-[160px] tw-border-neutral-200"
                                    data-type="<?php echo esc_attr($type); ?>"
                                    data-thickness-options="<?php echo esc_attr(implode(', ', $thicknessArray)); ?>"
                                    data-color="<?php echo esc_attr($display_name); ?>"
                                    data-map='<?php echo json_encode($color_data); ?>'
                                    onclick="selectColor(this)">

                                    <?php if (has_post_thumbnail($color_post->ID)) : ?>

                                        <div style="border: 1px solid #e6e6e6; border-radius: 7px;background-image: url('<?php echo esc_attr(get_the_post_thumbnail_url($color_post->ID, 'medium')); ?>'); background-size: cover; background-position: center;" class="tw-w-full tw-aspect-square tw-rounded-8 tw-mb-4 tw-overflow-hidden">
                                            <!-- List Thickness array and allign it nicely into middle. Make text visible on every background in this form [0.7]-->
                                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full">
                                                <?php foreach ($thicknessArray as $thick) : ?>
                                                    <span style="text-shadow: #000 1px 1px 4px;" class="tw-text-white tw-font-bold tw-text-[12px] md:tw-text-[14px] lg:tw-text-[16px] tw-px-2 tw-py-1 tw-bg-black/50 tw-rounded-4 tw-mb-1">[<?php echo esc_html($thick); ?>]</span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                    <?php else : ?>

                                        <div class="tw-w-full tw-aspect-square tw-rounded-8 tw-mb-4"
                                            style="border: 1px solid #e6e6e6; border-radius: 7px;background-color: <?php echo esc_attr($color_hex); ?>">
                                            <!-- List Thickness array and allign it nicely into middle. Make text visible on every background -->
                                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full">
                                                <?php foreach ($thicknessArray as $thick) : ?>
                                                    <span style="text-shadow: #000 1px 1px 4px;" class="tw-text-white tw-font-bold tw-text-[12px] md:tw-text-[14px] lg:tw-text-[16px] tw-px-2 tw-py-1 tw-bg-black/50 tw-rounded-4 tw-mb-1">[<?php echo esc_html($thick); ?>]</span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <div class="tw-text-[14px] tw-font-bold tw-text-center">
                                        <?php echo esc_html($color_name); ?>
                                    </div>

                                    <?php if ($ral_code): ?>

                                        <div class="tw-text-[13px] tw-text-center">
                                            <?php echo esc_html($ral_code); ?>
                                        </div>

                                    <?php endif; ?>
                                    <div class="checkmark tw-opacity-0 tw-absolute tw-top-4 md:tw-top-6 lg:tw-top-8 tw-right-4 md:tw-right-6 lg:tw-right-8 tw-w-16 md:tw-w-18 lg:tw-w-20 tw-h-16 md:tw-h-18 lg:tw-h-20 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                        <svg class="tw-w-10 md:tw-w-11 lg:tw-w-12 tw-h-10 md:tw-h-11 lg:tw-h-12" fill="none" stroke="white" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?></div><?php 
                    }
                    ?>
                    <div id="color-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Farbe des Bezugs auswählen</div>
                </div>

                <!-- Doplňujúce info -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <h2 style="margin: 100px 0 50px 0;" class="tw-text-center tw-text-[20px] md:tw-text-[25px] tw-font-bold tw-mb-50 fusion-responsive-typography-calculated">Hier können Sie ergänzende Informationen angeben</h2>

                    <div class="tw-mb-16">
                        <label for="dodatocneInfo" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4">Nachricht für uns (nähere Beschreibung des Daches, Maße und Sonstiges):</label>
                        <textarea 
                            id="dodatocneInfo"
                            rows="5"
                            class="tw-w-full tw-p-12 tw-border tw-border-neutral-300 tw-rounded-8 tw-text-[16px] focus:tw-outline-none focus:tw-border-primary-900"
                            placeholder="Geben Sie weitere Informationen ein..."></textarea>
                    </div>
                </div>

                <!-- Priložiť súbor -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <h2 class="tw-text-[18px] tw-font-bold tw-mb-16">Anhang / Datei einfügen</h2>
                    <div class="tw-mb-8">
                        <label for="fileUpload" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4 tw-bg-e">Datei auswählen (jpg, pdf, doc):</label>
                        <div class="tw-flex tw-items-center tw-gap-12 tw-rounded-8 tw-w-full tw-bg-neutral-100 tw-p-2">
                            <label for="fileUpload" class="tw-inline-flex tw-mb-0 tw-items-center tw-gap-8 tw-px-20 tw-py-10 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-8 tw-text-[14px] tw-font-bold tw-cursor-pointer hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all">
                                <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Auswählen
                            </label>
                            <input type="file" id="fileUpload" class="tw-hidden" accept=".jpg,.jpeg,.pdf,.doc,.docx" onchange="handleFileSelect(this)">
                            <span id="fileName" class="tw-text-[16px] tw-text-black tw-font-medium">Keine Datei ausgewählt</span>
                            <button id="removeFile" onclick="removeFile()" class="tw-hidden tw-ml-auto tw-px-12 tw-py-6 tw-bg-error-500 tw-text-white tw-rounded-8 tw-text-[14px] hover:tw-bg-error-600 tw-transition-all">Entfernen</button>
                        </div>
                    </div>
                    <div class="tw-text-[14px] tw-text-neutral-600">Bitte fügen Sie eine beliebige Datei bis zu einer Größe von 5 MB bei, die uns bei einer genaueren Preiskalkulation hilft. Vielen Dank.</div>
                </div>

                <!-- Oddelovacia čiara a tlačidlá -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-20 md:tw-pt-40">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <button onclick="goBack()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-10">
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Zurück
                        </button>

                        <button onclick="validateAndSubmit()" class="tw-flex tw-items-center tw-gap-10 tw-px-28 tw-py-10 tw-bg-[#00a516] tw-border-2 tw-border-[#00a516] tw-rounded-12 tw-text-white tw-font-bold tw-text-[16px] hover:tw-bg-white hover:tw-text-[#008a13] tw-transition-all">
                            Anfrage absenden
                            <svg class="tw-w-18 tw-h-18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            const match = value.match(/GA\d+\.\d+\.(.+)/);
            return match ? match[1] : value;
        }
    }
    return '';
}

function normalizeSlug(str) {
    if (!str) return '';
    return str.toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9-]/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
}

function filterColors() {

    let massgefertigteType = sessionStorage.getItem('massgefertigteTitle');
    console.log('Filtering colors for type:', massgefertigteType);

    let massgefertigteSubtype = sessionStorage.getItem('massgefertigteSubtypeTitle');
    console.log('Filtering colors for subtype:', massgefertigteSubtype);

    const cards = document.querySelectorAll('.color-card');

    cards.forEach(card => {

        let show = false;

        if (card.getAttribute('data-type') === massgefertigteType && 
            card.getAttribute('data-thickness-options').includes(massgefertigteSubtype)) {
            show = true;
        }

        card.style.display = show ? '' : 'none';
    });
}

function selectColor(element) {
    // Check if card is hidden
    if (element.style.display === 'none') {
        return;
    }
    document.getElementById('color-error').classList.add('tw-hidden');

    // Reset
    document.querySelectorAll('.color-card').forEach(card => {
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
    const color = element.getAttribute('data-color');
    sessionStorage.setItem('massgefertigteColor', color);
    console.log('session stored massgefertigteColor:', color);
}

function handleFileSelect(input) {
    const fileName = input.files[0] ? input.files[0].name : 'Keine Datei ausgewählt';
    document.getElementById('fileName').textContent = fileName;
    
    if (input.files[0]) {
        sessionStorage.setItem('massgefertigteFileName', fileName);
        document.getElementById('removeFile').classList.remove('tw-hidden');
    } else {
        sessionStorage.removeItem('massgefertigteFileName');
        document.getElementById('removeFile').classList.add('tw-hidden');
    }
}

function removeFile() {
    const fileInput = document.getElementById('fileUpload');
    fileInput.value = '';
    document.getElementById('fileName').textContent = 'Keine Datei ausgewählt';
    document.getElementById('removeFile').classList.add('tw-hidden');
    sessionStorage.removeItem('massgefertigteFileName');
}

function saveTextarea() {
    const textarea = document.getElementById('dodatocneInfo');
    sessionStorage.setItem('massgefertigteInfo', textarea.value);
    console.log('session stored massgefertigteInfo:', textarea.value);
}

document.addEventListener('DOMContentLoaded', function() {
    // Filter colors based on previous selections
    filterColors();

    // Restore checkbox
    const savedOdkapovySystem = sessionStorage.getItem('massgefertigteOdkapovySystem');
    if (savedOdkapovySystem === 'true') {
        document.getElementById('odkapovySystem').checked = true;
    }

    // Restore color
    const savedColor = sessionStorage.getItem('massgefertigteColor');
    if (savedColor) {
        const card = document.querySelector(`[data-color="${savedColor}"]`);
        if (card && card.style.display !== 'none') {
            selectColor(card);
        }
    }

    // Restore textarea
    const savedInfo = sessionStorage.getItem('massgefertigteInfo');
    if (savedInfo) {
        document.getElementById('dodatocneInfo').value = savedInfo;
    }

    // Restore file name
    const savedFileName = sessionStorage.getItem('massgefertigteFileName');
    if (savedFileName) {
        document.getElementById('fileName').textContent = savedFileName;
        document.getElementById('removeFile').classList.remove('tw-hidden');
    }

    // Save textarea on input
    document.getElementById('dodatocneInfo').addEventListener('input', saveTextarea);
});

async function validateAndSubmit() {
    const color = sessionStorage.getItem('massgefertigteColor');
    if (!color) {
        document.getElementById('color-error').classList.remove('tw-hidden');
        const el = document.getElementById('color-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    // Priprav data na odoslanie
    const formData = new FormData();
    formData.append('action', 'send_lemovanie_quote');
    
    // Kontaktné údaje
    formData.append('meno', sessionStorage.getItem('meno') || '');
    formData.append('priezvisko', sessionStorage.getItem('priezvisko') || '');
    formData.append('email', sessionStorage.getItem('email') || '');
    formData.append('telefon', sessionStorage.getItem('telKontakt') || '');
    formData.append('pobocka', sessionStorage.getItem('pobocka') || '');
    formData.append('pobocka_email', sessionStorage.getItem('pobocka_email') || '');
    formData.append('selectedProduct', sessionStorage.getItem('selectedProduct') || '');
    formData.append('selectedProductName', sessionStorage.getItem('selectedProductName') || '');
       
    // Údaje o type
    formData.append('type', sessionStorage.getItem('massgefertigteTitle') || '');
    formData.append('thickness', sessionStorage.getItem('massgefertigteSubtypeTitle') || '');
    // Farba a doplnky
    formData.append('farba', sessionStorage.getItem('massgefertigteColor') || '');

    //formData.append('odkapovySystem', sessionStorage.getItem('massgefertigteOdkapovySystem') === 'true' ? 'Yes' : 'No');
    formData.append('nahranySubor', sessionStorage.getItem('massgefertigteFileName') || 'Nie');
    formData.append('info', sessionStorage.getItem('massgefertigteInfo') || '');

    // Add Google Analytics ID
    formData.append('ga_id', getGACookie());
    
    // Pridaj súbor ak je vybraný
    const fileInput = document.getElementById('fileUpload');
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    }
    
    // Zobraz loading stav
    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<svg class="tw-animate-spin tw-h-20 tw-w-20 tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Senden...';
    
    try {
        const response = await fetch('/wp-admin/admin-ajax.php', {
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
            // Presmeruj na ďakovaciu stránku
            window.location.href = '/massgefertigte-kantteile-danke/';
        } else {
            alert('Fehler beim Senden: ' + (result.data?.message || 'Unbekannter Fehler'));
            button.disabled = false;
            button.innerHTML = originalText;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Beim Absenden des Formulars ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
        button.disabled = false;
        button.innerHTML = originalText;
    }
}

function goBack() {
    window.location.href = '/angebot/massgefertigte-kantteile-typ/';
}
</script>

<?php get_footer(); ?>