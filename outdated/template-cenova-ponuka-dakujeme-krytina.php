<?php
/**
 * Template Name: Cenová ponuka - Ďakujeme - Krytina
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

    <section class="tw-pt-[150px] tw-pb-24 md:tw-pb-50">
        <div class="container">
            <div class="tw-max-w-[1100px] tw-mx-auto tw-text-center">
                <h1 class="tw-text-primary-900 tw-font-bold tw-text-[32px] md:tw-text-[48px] tw-leading-[115%] tw-mb-30 md:tw-mb-50">
                    Vielen Dank für das Ausfüllen
                </h1>
                <div class="tw-text-black tw-text-[18px] md:tw-text-[22px] tw-leading-[150%] tw-mb-16 [&_a]:tw-font-bold [&_a]:hover:tw-text-black [&_a]:tw-text-black [&_a]:tw-underline [&_a]:hover:tw-underline hover:tw-no-underline"><?= the_content() ?></div>
            </div>
        </div>
    </section>

</main>

<script>
// Vymazanie všetkých údajov z cenového formulára zo sessionStorage
document.addEventListener('DOMContentLoaded', function() {
    const keysToClear = [
        // Základné
        'selectedProduct', 'selectedProductName',
        'meno', 'priezvisko', 'email', 'telKontakt', 'pobocka', 'pobocka_email',
        
        // Strecha
        'roofType', 'plocha', 'zameranie',
        
        // Krytina
        'coveringType', 'coveringTitle',
        'coveringSubtype', 'coveringSubtypeTitle',
        
        // Úprava a farba
        'krytinaUprava',
        'krytinaColor',
        'krytinaOdkapovySystem',
        'krytinaInfo',
        'krytinaFileName'
    ];
    
    keysToClear.forEach(key => sessionStorage.removeItem(key));
});
</script>

<?php get_footer(); ?>