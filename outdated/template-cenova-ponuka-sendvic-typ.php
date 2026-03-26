<?php
/**
 * Template Name: Cenová ponuka - Sendvič - Typ
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
                <div class="tw-block lg:tw-hidden tw-mb-20 md:tw-mb-40">
                    <div class="tw-text-center tw-mb-12">
                        <div class="tw-text-[12px] md:tw-text-[14px] tw-text-neutral-600 tw-mb-4" style="display:none;">Krok 2 z 5</div>
                        <div class="tw-text-[16px] md:tw-text-[20px] tw-font-bold tw-text-primary-900">Verwendung</div>
                    </div>
                    <div class="tw-flex tw-gap-4 tw-justify-center">
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-primary-900"></div>
                        <div class="tw-w-full tw-max-w-[40px] tw-h-6 tw-rounded-full tw-bg-neutral-300"></div>
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

                    <!-- Krok 2 - Aktívny -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border-2 tw-border-primary-900 tw-flex tw-items-center tw-justify-center tw-text-primary-900 tw-font-bold tw-text-[14px]">
                            2
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-bold tw-text-primary-900 tw-uppercase">Verwendung</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 3 - kliknuteľný s validáciou -->
                    <div class="tw-flex tw-items-center tw-cursor-pointer hover:tw-opacity-80 tw-transition-opacity" onclick="validateAndContinue()">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            3
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Isoliermaterial</span>
                    </div>

                    <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <!-- Krok 4 -->
                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            4
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Dicke</span>
                    </div>

                    <!-- <div class="tw-w-40 tw-h-1 tw-bg-neutral-300"></div>

                    <div class="tw-flex tw-items-center">
                        <div class="tw-w-32 tw-h-32 tw-rounded-full tw-border tw-border-neutral-300 tw-flex tw-items-center tw-justify-center tw-text-neutral-400 tw-font-bold tw-text-[14px]">
                            5
                        </div>
                        <span class="tw-ml-8 tw-text-[16px] tw-font-medium tw-text-neutral-400 tw-uppercase">Farbe</span>
                    </div> -->
                </div>

                <!-- Nadpis -->
                <h1 class="tw-text-center tw-text-[20px] md:tw-text-[28px] lg:tw-text-[40px] tw-font-bold tw-mb-24 md:tw-mb-50">
                    2. Verwendung des Sandwichelements
                </h1>

                <!-- Výber použitia -->
                <div class="tw-mb-24 md:tw-mb-50">
                    <div class="tw-mb-12 md:tw-mb-16">
                        <h2 class="tw-text-[16px] md:tw-text-[20px] tw-font-bold tw-mb-4">Wählen Sie die Verwendungsart aus:</h2>
                    </div>

                    <div class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-6 md:tw-gap-16 lg:tw-gap-20">
                        <?php $items = get_field('items'); ?>
                        <?php if ($items) : foreach($items as $item) : ?>
                            <div class="usage-card tw-relative tw-bg-white tw-border-2 tw-border-neutral-200 tw-rounded-8 md:tw-rounded-12 tw-p-12 md:tw-p-16 lg:tw-p-20 tw-cursor-pointer hover:tw-border-primary-900 tw-transition-all"
                                data-usage="<?php echo esc_attr($item['title']); ?>"
                                onclick="selectUsage(this)">
                                <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                                    <div class="tw-w-full tw-relative tw-aspect-square tw-mb-8 md:tw-mb-12">
                                        <?php 
                                        $image_url = is_array($item['image']) ? $item['image']['url'] : $item['image'];
                                        ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="tw-w-full tw-h-full tw-object-contain" />
                                    </div>
                                    <h3 class="tw-text-[12px] md:tw-text-[14px] lg:tw-text-[16px] tw-font-medium tw-mb-0 tw-leading-tight"><?php echo esc_html($item['title']); ?></h3>
                                </div>
                                <div class="checkmark tw-opacity-0 tw-absolute tw-top-8 tw-right-8 md:tw-top-12 md:tw-right-12 tw-w-20 tw-h-20 md:tw-w-24 md:tw-h-24 tw-bg-primary-900 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-transition-all">
                                    <svg class="tw-w-12 tw-h-12 md:tw-w-16 md:tw-h-16 tw-text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                    <div id="usage-error" class="tw-hidden tw-text-error-500 tw-text-[14px] md:tw-text-[16px] tw-mt-8 tw-font-medium tw-px-8 tw-py-4 tw-rounded-8 tw-bg-error-500/10">Sie müssen die Art der Nutzung auswählen</div>
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
// Výber použitia
function selectUsage(element) {
    document.getElementById('usage-error').classList.add('tw-hidden');

    // Zruš predchádzajúci výber
    document.querySelectorAll('.usage-card').forEach(card => {
        card.classList.remove('tw-border-primary-900');
        card.classList.add('tw-border-neutral-200');
        card.querySelector('.checkmark').classList.add('tw-opacity-0');
        card.querySelector('.checkmark').classList.remove('tw-opacity-100');
    });

    // Označ aktuálny
    element.classList.remove('tw-border-neutral-200');
    element.classList.add('tw-border-primary-900');
    element.querySelector('.checkmark').classList.remove('tw-opacity-0');
    element.querySelector('.checkmark').classList.add('tw-opacity-100');

    // Ulož do sessionStorage
    const usage = element.getAttribute('data-usage');
    sessionStorage.setItem('sendvicUsage', usage);
    console.log('session stored sendvicUsage:', usage);
}

// Načítanie stavu
document.addEventListener('DOMContentLoaded', function() {
    const savedUsage = sessionStorage.getItem('sendvicUsage');
    if (savedUsage) {
        const card = document.querySelector(`[data-usage="${savedUsage}"]`);
        if (card) selectUsage(card);
    }
});

// Validácia a presmerovanie
function validateAndContinue() {
    const usage = sessionStorage.getItem('sendvicUsage');
    if (!usage) {
        document.getElementById('usage-error').classList.remove('tw-hidden');
        const el = document.getElementById('usage-error');
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    // Pokračovanie na ďalší krok
    window.location.href = '/angebot/sandwichpaneele-isoliermaterial/';
}

function goBack() {
    window.location.href = '/angebot/berechnung/';
}
</script>

<?php get_footer(); ?>