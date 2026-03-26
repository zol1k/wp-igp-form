<?php
/**
 * Template Name: Cenová ponuka - Zvod - Typ
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
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Ausführung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Farbe</span>
                    </div>
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[28px] md:tw-text-[40px] tw-font-bold tw-mb-50">
                    2. Auswahl der Regenrinnensystem-Ausführung
                </h1>

                <!-- Podnadpis -->
                <p class="tw-text-center tw-text-[18px] tw-font-semibold tw-mb-30">
                    Wählen Sie die Ausführung des Regenrinnensystem:
                </p>

                <!-- Cards grid -->
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-24 tw-mb-50 tw-max-w-[700px] tw-mx-auto">
                    <?php $items = get_field('items'); ?>
                    <?php foreach($items as $item) : ?>
                        <div class="tw-relative tw-border-2 tw-border-neutral-200 tw-rounded-8 tw-p-24 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-colors" onclick="selectVersion('<?= $item['title'] ?>')">
                            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full">
                                <div class="tw-w-full tw-relative tw-aspect-square tw-mb-12">
                                    <img src="<?= $item['image']['url']; ?>" alt="<?= $item['title'] ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                </div>
                                <h3 class="tw-text-[20px] tw-font-bold tw-text-center"><?= $item['title'] ?></h3>
                            </div>
                            <div class="checkmark tw-opacity-0 tw-absolute tw-top-12 tw-right-12 tw-w-24 tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all" data-version="<?= $item['title'] ?>">
                                <svg class="tw-w-16 tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="error-message" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Version des Ablaufsystems auswählen</div>

                <!-- Navigation buttons -->
                <div class="tw-border-t tw-border-neutral-300 tw-pt-40 tw-flex tw-justify-between tw-items-center tw-mt-50">
                    <button onclick="goBack()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border tw-border-black tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-neutral-100 tw-transition-all tw-flex tw-items-center tw-gap-10">
                        <svg class="tw-w-20 tw-h-20 tw-mr-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Zurück
                    </button>

                    <button onclick="validateAndContinue()" class="tw-pl-24 tw-pr-20 tw-py-8 tw-bg-white tw-border-2 tw-border-primary-900 tw-rounded-12 tw-text-black tw-font-bold tw-text-[16px] hover:tw-bg-primary-900 hover:tw-text-white tw-transition-all tw-flex tw-items-center tw-gap-10">
                        Weiter
                        <svg class="tw-w-20 tw-h-20 tw-ml-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    // Function to select version
    function selectVersion(version) {
        // Remove selection from all cards
        document.querySelectorAll('[data-version]').forEach(element => {
            const card = element.closest('.tw-relative');
            card.classList.remove('tw-border-primary-900');
            card.classList.add('tw-border-neutral-200');
            element.classList.add('tw-opacity-0');
            element.classList.remove('tw-opacity-100');
        });
        
        // Add selection to clicked card
        const selectedCheckmark = document.querySelector(`[data-version="${version}"]`);
        const selectedCard = selectedCheckmark.closest('.tw-relative');
        selectedCard.classList.remove('tw-border-neutral-200');
        selectedCard.classList.add('tw-border-primary-900');
        selectedCheckmark.classList.remove('tw-opacity-0');
        selectedCheckmark.classList.add('tw-opacity-100');
        
        // Save to sessionStorage
        sessionStorage.setItem('zvodVersion', version);
        console.log('session stored zvodVersion:', version);
        
        // Hide error message if visible
        const errorElement = document.getElementById('error-message');
        if (errorElement) {
            errorElement.classList.add('tw-hidden');
        }
    }

    // Function to validate and continue
    function validateAndContinue() {
        const selectedVersion = sessionStorage.getItem('zvodVersion');
        
        if (!selectedVersion) {
            // Show error message
            const errorElement = document.getElementById('error-message');
            errorElement.classList.remove('tw-hidden');
            errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
        
        // Navigate to next page
        window.location.href = '/angebot/dachrinnensystem-farbe/';
    }

    // Function to go back
    function goBack() {
        window.location.href = '/angebot/berechnung/';
    }

    // Restore selection on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedVersion = sessionStorage.getItem('zvodVersion');
        if (savedVersion) {
            const checkmark = document.querySelector(`[data-version="${savedVersion}"]`);
            if (checkmark) {
                const card = checkmark.closest('.tw-relative');
                card.classList.remove('tw-border-neutral-200');
                card.classList.add('tw-border-primary-900');
                checkmark.classList.remove('tw-opacity-0');
                checkmark.classList.add('tw-opacity-100');
            }
        }
    });
</script>

<?php get_footer(); ?>