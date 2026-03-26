<?php
/**
 * Template Name: Cenova ponuka
 *
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) { ?>
    
	<?php while ( have_posts() ) { ?>
	 
		<?php the_post(); ?>

		<main id="content" data-sticky-container="">
			<?php get_template_part('loop-breadcrumbs'); ?>
			<?php get_template_part( 'loop-cenova-ponuka' ); ?>
		</main>

	<?php } // end while
   ?>
    
<?php } else { ?>
    
<?php } // end if ?>

<?php get_footer(); ?>