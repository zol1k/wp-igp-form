<?php
/**
 * Template Name: Cenová ponuka - Ďakujeme - Plocha
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
    document.addEventListener('DOMContentLoaded', function() {
        sessionStorage.removeItem('plochaInfo');
        sessionStorage.removeItem('plochaFileName');
        
        sessionStorage.removeItem('priezvisko');
        sessionStorage.removeItem('telKontakt');
        sessionStorage.removeItem('email');
        sessionStorage.removeItem('pobocka');
        sessionStorage.removeItem('pobocka_email');
        sessionStorage.removeItem('selectedProduct');
        sessionStorage.removeItem('selectedProductName');
    });
</script>

<?php get_footer(); ?>