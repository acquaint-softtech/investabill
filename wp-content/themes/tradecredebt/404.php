<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<section class="Section404">
    <div class="container">
        <div class="imgBox col-lg-6 col-md-8 text-center">
            <img src="<?php echo get_template_directory_uri(); ?>/images/404.png" class="img-fluid" />
        </div>
    </div>
</section>

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
