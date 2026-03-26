<?php
/**
 * Template Name: Cenová ponuka - Plocha
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
                        <div class="tw-text-[14px] tw-text-neutral-600 tw-mb-8" style="display:none;">Krok 2 z 2</div>
                        <div class="tw-text-[20px] tw-font-bold tw-text-primary-900">Kontakt</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
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

                    <!-- Krok 2 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            2
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Kontakt</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[28px] md:tw-text-[40px] tw-font-bold tw-mb-50">
                    2. Kontaktujte nášho špečialistu
                </h1>
                <?php $contact = get_field('contact', 'options') ?>
                <!-- Podnadpis -->
                <div class="tw-text-center tw-text-neutral-600 tw-text-[16px] tw-mb-40 tw-max-w-[800px] tw-mx-auto"><?= $contact['description'] ?></div>

                <!-- Špecialista -->
                <div class="tw-mx-auto tw-max-w-[780px] tw-mb-50">
                    <div class="tw-grid lg:tw-grid-cols-2 tw-gap-30 lg:tw-gap-80">
                        <div class="tw-relative tw-w-full tw-aspect-[4/3] tw-max-w-[600px] tw-mx-auto">
                            <img src="<?= $contact['image']['url'] ?>" alt="<?= $contact['name'] ?>" class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-10 tw-object-cover tw-object-center tw-rounded-[16px]">
                        </div>
                        <div>
                            <h3 class="tw-mb-30">Špecializovaný kontakt</h3>
                            <h3 class="tw-mb-10 tw-text-[#E4001B]"><?= $contact['name'] ?></h3>
                            <div class="tw-text-[22px] tw-mb-20"><?= $contact['function'] ?></div>
                            <a href="tel:<?= $contact['tel'] ?>" class="!tw-text-black tw-flex tw-max-w-fit md:tw-text-[20px]"><?= $contact['tel'] ?></a>
                            <a href="mailto:<?= $contact['email'] ?>" class="!tw-text-black tw-flex tw-max-w-fit md:tw-text-[20px]"><?= $contact['email'] ?></a>
                        </div>
                    </div>
                </div>
                    
                <!-- Alternatíva -->
                <div class="tw-text-center tw-text-[18px] tw-font-bold tw-mb-30">
                    Zavolajte alebo vyplňte kontaktný formulár
                </div>

                <!-- Doplňujúce info -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <div>
                        <label for="dodatocneInfo" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4">Nachricht für uns: <span class="tw-text-error-500">*</span></label>
                        <textarea 
                            id="dodatocneInfo"
                            name="dodatocneInfo"
                            rows="5"
                            class="tw-w-full tw-border tw-border-neutral-300 tw-rounded-8 tw-px-16 tw-py-12 tw-text-[16px] focus:tw-outline-none focus:tw-border-primary-900"
                            placeholder=""></textarea>
                    </div>
                    <div id="info-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Musíte vyplniť správu</div>
                </div>

                <!-- Priložiť súbor -->
                <div class="tw-mb-20 md:tw-mb-50">
                    <h2 class="tw-text-[18px] tw-font-bold tw-mb-16">Anhang / Datei einfügen</h2>
                    <div class="tw-mb-8">
                        <label for="fileUpload" class="tw-block tw-text-[16px] tw-font-medium tw-mb-4">Datei auswählen (jpg, pdf, doc):</label>
                        <div class="tw-flex tw-items-center tw-gap-12 tw-rounded-8 tw-w-full tw-bg-neutral-100 tw-p-2">
                            <label for="fileUpload" class="tw-cursor-pointer tw-mb-0 tw-px-20 tw-py-8 tw-bg-white tw-border tw-border-primary-900 tw-rounded-8 tw-text-primary-900 tw-font-bold tw-text-[14px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-8">
                                <svg class="tw-w-20 tw-h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                VYBRAŤ
                            </label>
                            <span id="fileName" class="tw-text-[16px] tw-text-black tw-font-medium">Keine Datei ausgewählt</span>
                            <button id="removeFile" onclick="removeFile()" class="tw-hidden tw-px-12 tw-py-6 tw-bg-error-500 tw-text-white tw-rounded-8 tw-text-[14px] tw-font-semibold hover:tw-bg-error-600 tw-transition-colors">
                                Entfernen
                            </button>
                            <input type="file" id="fileUpload" name="fileUpload" accept=".jpg,.jpeg,.pdf,.doc,.docx" onchange="handleFileSelect(this)" class="tw-hidden">
                        </div>
                    </div>
                    <div class="tw-text-[14px] tw-text-neutral-600">Bitte fügen Sie eine beliebige Datei bis zu einer Größe von 5 MB bei, die uns bei einer genaueren Preiskalkulation hilft. Vielen Dank.</div>
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
            const match = value.match(/GA\d+\.\d+\.(.+)/);
            return match ? match[1] : value;
        }
    }
    return '';
}

function handleFileSelect(input) {
    const fileName = input.files[0] ? input.files[0].name : 'Keine Datei ausgewählt';
    document.getElementById('fileName').textContent = fileName;
    
    if (input.files[0]) {
        sessionStorage.setItem('plochaFileName', fileName);
        console.log('session stored plochaFileName:', fileName);
        document.getElementById('removeFile').classList.remove('tw-hidden');
    } else {
        sessionStorage.removeItem('plochaFileName');
        document.getElementById('removeFile').classList.add('tw-hidden');
    }
}

function removeFile() {
    const fileInput = document.getElementById('fileUpload');
    fileInput.value = '';
    document.getElementById('fileName').textContent = 'Keine Datei ausgewählt';
    document.getElementById('removeFile').classList.add('tw-hidden');
    sessionStorage.removeItem('plochaFileName');
}

function saveTextarea() {
    const textarea = document.getElementById('dodatocneInfo');
    sessionStorage.setItem('plochaInfo', textarea.value);
    console.log('session stored plochaInfo:', textarea.value);
}

document.addEventListener('DOMContentLoaded', function() {
    // Restore textarea
    const savedInfo = sessionStorage.getItem('plochaInfo');
    if (savedInfo) {
        document.getElementById('dodatocneInfo').value = savedInfo;
    }

    // Restore file name
    const savedFileName = sessionStorage.getItem('plochaFileName');
    if (savedFileName) {
        document.getElementById('fileName').textContent = savedFileName;
        document.getElementById('removeFile').classList.remove('tw-hidden');
    }

    // Save textarea on input
    document.getElementById('dodatocneInfo').addEventListener('input', saveTextarea);
});

async function validateAndSubmit() {
    const info = sessionStorage.getItem('plochaInfo') || document.getElementById('dodatocneInfo').value;
    
    if (!info || info.trim() === '') {
        document.getElementById('info-error').classList.remove('tw-hidden');
        const el = document.getElementById('info-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    // Hide error if visible
    document.getElementById('info-error').classList.add('tw-hidden');

    // Priprav data na odoslanie
    const formData = new FormData();
    formData.append('action', 'send_plocha_quote');
    
    // Kontaktné údaje
    formData.append('priezvisko', sessionStorage.getItem('priezvisko') || '');
    formData.append('telKontakt', sessionStorage.getItem('telKontakt') || '');
    formData.append('email', sessionStorage.getItem('email') || '');
    formData.append('pobocka', sessionStorage.getItem('pobocka') || '');
    formData.append('pobocka_email', sessionStorage.getItem('pobocka_email') || '');
    formData.append('selectedProduct', sessionStorage.getItem('selectedProduct') || '');
    formData.append('selectedProductName', sessionStorage.getItem('selectedProductName') || '');
    
    // Hydroizolácie špecifikácia
    formData.append('plochaInfo', sessionStorage.getItem('plochaInfo') || document.getElementById('dodatocneInfo').value);
    formData.append('plochaFileName', sessionStorage.getItem('plochaFileName') || '');
    
    // Add Google Analytics ID
    formData.append('ga_id', getGACookie());
    
    // Pridaj súbor ak je vybratý
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
            window.location.href = '/dakujeme-plocha/';
        } else {
            alert('Chyba pri odosielaní: ' + (result.data?.message || 'Neznáma chyba'));
            button.disabled = false;
            button.innerHTML = originalText;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Chyba pri odosielaní formulára. Skúste to prosím znova.');
        button.disabled = false;
        button.innerHTML = originalText;
    }
}

function goBack() {
    window.location.href = '/angebot/berechnung/';
}
</script>

<?php get_footer(); ?>