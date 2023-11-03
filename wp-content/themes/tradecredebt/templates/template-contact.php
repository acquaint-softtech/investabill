<?php 
/*
Template Name: Contact Us
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
                
                <video controls="" muted="true" autoplay="true" name="media" loop="" data-origwidth="0" data-origheight="0" style="width: 1903px;pointer-events: none;"><source src="<?php echo $BannerVideoURL; ?>" type="video/mp4"></video>
            
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
    			<?php if ( get_field( 'title_box_1' ) || get_field( 'content_box_1' ) || get_field( 'image_box_1' ) ) { ?>
				<div class="col-md-4 contact-box-main our-location">
                    <div class="contact-box-icon">
                        <img src="<?php echo get_field( 'image_box_1' ); ?>">
                    </div>
                    <div class="contac-ttl">
                        <h3><?php echo get_field( 'title_box_1' ); ?></h3>
                    </div>
                    <div class="contact-address">
                        <address><?php echo get_field( 'content_box_1' ); ?> </address>
                    </div>
                </div>
            	<?php } ?>
                

                <?php if ( get_field( 'title_box_2' ) || get_field( 'content_box_2' ) || get_field( 'image_box_2' ) ) { ?>
                <div class="col-md-4 contact-box-main call-us">
                    <div class="contact-box-icon">
                        <img src="<?php echo get_field( 'image_box_2' ); ?>">
                    </div>
                    <div class="contac-ttl">
                        <h3><?php echo get_field( 'title_box_2' ); ?></h3>
                    </div>
                    <div class="call-details">
                    	<?php 
                    	$contatc_nos = get_field( 'content_box_2' );
                    	foreach ($contatc_nos as $key => $contact_no) {
                    		echo '<span>'.$contact_no['contact_number'].'</span>';
                    	}
                    	?>
                    </div>
                </div>
            	<?php } ?>

                <?php if ( get_field( 'title_box_3' ) || get_field( 'content_box_3' ) || get_field( 'image_box_3' ) ) { ?>
                <div class="col-md-4 contact-box-main mail-us">
                    <div class="contact-box-icon">
                        <img src="<?php echo get_field( 'image_box_3' ); ?>">
                    </div>
                    <div class="contac-ttl">
                        <h3><?php echo get_field( 'title_box_3' ); ?></h3>
                    </div>
                    <div class="mail-details">
                        <span><a href="mailto:<?php echo get_field( 'content_box_3' );?>"><?php echo get_field( 'content_box_3' );?></a></span>
                    </div>
                </div>
            	<?php } ?>

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
    <?php if( get_field( 'map_location' ) ) { ?>
	<section class="section-main map-section mt-2">
        <div class="container">
			<div class="w-85">
	            <div class="row mx-auto">
	                <div class="map-location mt-2">
	                    <?php echo get_field( 'map_location' ); ?>
	                </div>
	            </div>
	        </div>
    	</div>
	</section>
    <!-- //end -->
	<?php } ?>
	


    <?php get_footer(); ?>
