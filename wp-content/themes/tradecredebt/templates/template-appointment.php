<?php 
/*
Template Name: Appointment
*/
get_header();
?>

    <!-- slider -->
    <?php if ( get_field( 'banner' ) ) : ?>
        <section class="sliderImg">
            <?php // $BannerUrl = wp_get_attachment_url( get_field( 'banner' ) ); ?>
            <!-- <img src="<?php //echo $BannerUrl; ?>" class="img-fluid" /> -->
            <?php 
                $isVideoBanner = get_field( 'video_or_image' );
                if($isVideoBanner){
                    $BannerVideoURL = get_field( 'banner_video' );
                }else{
                    $BannerUrl = wp_get_attachment_url( get_field( 'banner' ) );                
                }   
            ?>
            <?php if($isVideoBanner){ ?>
                
                <video controls="" autoplay="" name="media" loop="" data-origwidth="0" data-origheight="0" style="width: 1903px;pointer-events: none;"><source src="<?php echo $BannerVideoURL; ?>" type="video/mp4"></video>
            
            <?php }else{ ?>
                
                <img src="<?php echo $BannerUrl; ?>" class="img-fluid" />
            
            <?php } ?>
        </section>
    <?php endif; ?>
    <!-- //end -->

    <!-- 1 -->
    <section class="section1 contact-detial-section section-main">
        <div class="container">
        	<div class="w-85">
            <div class="row mx-auto">
            </div>
        </div>
        </div>
    </section>
    <!-- //end -->

    <!-- 2 -->
    <section class="section-main contact-form pt-0">
        <div class="container">
	    	<div class="w-85">
	        	<?php if( get_field( 'contact_form_title' ) ) { ?>
	            <div class="row ml-auto mr-auto">
	                <div class="contact-form-ttl mb-4">
	                    <h3><?php echo get_field( 'contact_form_title' ); ?></h3>
	                </div>
	            </div>
	        	<?php } ?>


	        	<?php if( get_field('contact_form_shortcode') ): ?>
	            <?php echo do_shortcode(''. get_field('contact_form_shortcode') .'' );?>
	        	<?php endif; ?>
			</div>
		</div>
    </section>
    
    

    <!-- map_location -->
    <section class="section-main map-section mt-2">
        <div class="container">
			<div class="w-85">
                <div class="row ml-auto mr-auto">
                    <div class="contact-form-ttl mb-4">
                        <h3>Book Your Appointment</h3>
                    </div>
                </div>
	            <div class="row mx-auto">
	                <div class="map-location-1 cal mt-2">
	                        <script>var widget = new SimplybookWidget({"widget_type":"iframe","url":"https:\/\/convertibill.simplybook.it","theme":"emeri","theme_settings":{"timeline_show_end_time":"0","timeline_modern_display":"as_slots","sb_base_color":"#0aceff","display_item_mode":"block","booking_nav_bg_color":"#ffffff","body_bg_color":"#ffffff","dark_font_color":"#333333","light_font_color":"#ffffff","sb_company_label_color":"#ffffff","hide_img_mode":"0","sb_busy":"#e8e8e8","sb_available":"#0aceff"},"timeline":"modern","datepicker":"inline_datepicker","is_rtl":false,"app_config":{"predefined":{"provider":"2","service":"2"}}});</script>
    
	                </div>
	            </div>
	        </div>
    	</div>
	</section>
    <!-- //end -->
	<?php //} ?>

    <?php get_footer(); ?>
