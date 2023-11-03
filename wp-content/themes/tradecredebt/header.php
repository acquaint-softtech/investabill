<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
		<meta name="google-site-verification" content="w8xuao-jSMMLmsYxr69l4oMkXNQ0e7icUeSy3mSVlQI" />
		<?php /*?>
        <!-- Google Tag Manager -->
        <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K5QG9GX');</script> -->
        <!-- End Google Tag Manager -->
            
            
            <!-- Google tag (gtag.js) -->
<script async src=“https://www.googletagmanager.com/gtag/js?id=UA-55897872-2”></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(‘js’, new Date());
  gtag(‘config’, ‘UA-55897872-2’);
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({‘gtm.start’:
new Date().getTime(),event:‘gtm.js’});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=‘dataLayer’?‘&l=‘+l:‘’;j.async=true;j.src=
’https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,‘script’,‘dataLayer’,‘GTM-MMXV8ZF’);</script>
<!-- End Google Tag Manager -->
<?php */ ?>



<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-55897872-2"></script>
<script> window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-55897872-2');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MMXV8ZF');
</script>
<!-- End Google Tag Manager -->
    
    <link rel='stylesheet' type='text/css' href='https://p.visitorqueue.com/styles/96664562-cf43-4ef7-aab5-98b6eadd9bfd.css' id='vq-flick-styles'>
    <script>function vqTrackPc(){return 1;}</script><link rel='dns-prefetch' href='//t.visitorqueue.com' style='display: none !important;'>
    <link rel='preload' href='//t.visitorqueue.com/p/tracking.min.js?id=96664562-cf43-4ef7-aab5-98b6eadd9bfd' as='script' style='display: none !important;'/> 
    <script>function vqTrackId(){return '96664562-cf43-4ef7-aab5-98b6eadd9bfd';} (function(d, e) { var el = d.createElement(e); el.sa = function(an, av){this.setAttribute(an, av); return this;}; el.sa('id', 'vq_tracking').sa('src', '//t.visitorqueue.com/p/tracking.min.js?id='+vqTrackId()).sa('async', 1).sa('data-id', vqTrackId()); d.getElementsByTagName(e)[0].parentNode.appendChild(el); })(document, 'script'); </script>
		
       
	</head>
	<?php 
		$extraClasses = array();
		if( is_404() ){
			$extraClasses = array('Page404');
		}
		if( is_home() ){
			$extraClasses = array('homePage');	
		}
	?>

	<body <?php body_class( $extraClasses ); ?>>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5QG9GX"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

		<?php
		wp_body_open();
		?>
<style type="text/css">
            .simplybook-widget-button{
                    padding:10px !important;
                }
            .page-id-1198 .contact-detial-section .row.mx-auto{
                background: none;
             }   
        </style>
		    <!-- header -->
    <header>

        <div class="container">

            <div class="nav">
                <div class="nav_logo col-md-3 col-sm-12">
                	<a href="<?php echo get_site_url( );  ?>"><img src="<?php the_field('header_logo','option') ?>" height="65px" width="240px" alt="tradecredebt" class="img-fluid" /></a>
                </div>
                <div class="nav_menu col-md-7">
                	<div class="sm-device w-100">

						<?php if ( is_active_sidebar( 'top_link' ) ) : ?>
						<div id="primary-sidebar" class="book-now top" role="complementary">
							<?php dynamic_sidebar( 'top_link' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>

	                    <div class="nav_menu__button">
	                        <button class="btn_menu">
	                            <span></span>
	                        </button>
	                    </div>
                    </div>
                    <div class="nav_menu__menubar">
                    	<?php wp_nav_menu(array('theme_location' => 'primary','menu_class' => 'menu', 'menu' => 'Main Menu','container' =>'' )); ?>
                    
                    </div>
                </div>

            </div>
        </div>
		
		
    </header>
			<!--Rates Bar-->
		<div class="rates-bar">
			<div class="rates-container">
				<div class="demand-rate">
					<a href="<?php echo home_url(); ?>/investors/investor-returns/">
					<span><?php echo get_option( 'demand_title' ); ?></span> <?php echo get_option( 'demand_value' ); ?>%
					<div class="popup-link">
						<?php echo get_option( 'demand_description' ); ?>
					</div>
					</a>
				</div>
				
				<div class="fixed-rate">
					<a href="<?php echo home_url(); ?>/investors/investor-returns/">
					<span><?php echo get_option( 'fixed_title' ); ?></span> <?php echo get_option( 'fixed_value' ); ?>%
					<div class="popup-link">
						<?php echo get_option( 'fixed_description' ); ?>
					</div>
					</a>
				</div>
				<div class="term-rate">
					<a href="<?php echo home_url(); ?>/investors/investor-returns/">
					<span><?php echo get_option( 'term_title' ); ?></span> <?php echo get_option( 'term_value' ); ?>%
					<div class="popup-link">
						<?php echo get_option( 'term_description' ); ?>
					</div>
					</a>
				</div>
			</div>
		</div>
     
	    <!-- //end -->
<div class="check123" style="display: none;">
    <?php

        echo str_replace('66', "", '66620056231');
      ?>
</div>
		<?php

		// Output the menu modal.
		// get_template_part( 'template-parts/modal-menu' );