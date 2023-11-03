<?php 
/*
Template Name: Download PDF
*/
get_header();
?>

<!-- Display none -->
<section class="section1 download-pdf" style="display: none">
	<div class="container">
		<div class="text-center">
			<div class="col-md-9 m-auto">
			<?php 
				// if( $_GET['your-name'] && $_GET['your-email'] && $_GET['tel-number'] ) { 
					if(get_field('dp_description')) {
					
						echo get_field('dp_description');
					}
				
					if(get_field('pdf_file')) { 

						$pdf = get_field('pdf_file');
						echo '<a download href="'.$pdf['url'].'" target="_blank" class="btn btn-org"> Download PDF </a>';
					}
				// }else{
				// 	echo '<p>Something wrong!</p>';
				// }
			 ?>
			</div>
		</div>
	</div>
</section>
<?php
    if( get_field( 'banner' ) ){ ?>    
    <!-- slider -->
    <!-- <section class="sliderImg">
        <img src="<?php //echo get_the_post_thumbnail_url('', 'full'); ?>" class="img-fluid" />
    </section> -->
    <!-- //end -->

    <!-- slider -->
        <section class="sliderImg banner ">
            <?php $BannerUrl = wp_get_attachment_url( get_field( 'banner' ) ); ?>
            <img src="<?php echo $BannerUrl; ?>" class="img-fluid" />
            <?php // if ( get_field( 'banner_bullets' ) ) : 
                ?>
                <div class="banner-box" style="display: none;">
                    <div class="container">
                        <div class="row">
                            <?php if( get_field( 'banner_left_title' ) || get_field( 'banner_bullets' )['left_bullets'] ) { ?>
                            <div class="col-md-6 left">
                                
                                <div class="banner-bullets left">
                                    <?php if(get_field( 'banner_left_title' )) {?>
                                    <div class="banner-bullets-title">

                                        <h2> <?php echo get_field( 'banner_left_title' ); ?> </h2>                                           
                                    </div>
                                    <?php } ?>
                                    <?php 
                                    foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>
                                        <?php if( $banner_bullets['left_bullets'] ): ?>
                                            <div class="banner-bullets-list">
                                                <?php if($banner_bullets['left_bullet_link']) :?>
                                                    <a href="<?php echo $banner_bullets['left_bullet_link']['url']; ?>" alt="<?php echo $banner_bullets['left_bullet_link']['title']; ?>" title="<?php echo $banner_bullets['left_bullet_link']['title']; ?>">    
                                                <?php endif; ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/banner-bull.png" class="img-fluid" />
                                                <?php echo $banner_bullets['left_bullets']; ?>
                                                <?php if($banner_bullets['left_bullet_link']) :?>
                                                    </a>    
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if( get_field( 'banner_right_title' ) || get_field( 'banner_bullets' )['right_bullets'] ) { ?>
                            <div class="col-md-6 right">
                                <div class="banner-bullets right">
                                    <?php if(get_field( 'banner_right_title' )) {?>
                                    <div class="banner-bullets-title">
                                        
                                        <h2> <?php echo get_field( 'banner_right_title' ); ?> </h2>                                           
                                    </div>
                                    <?php } ?>
                                   <?php foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>
                                        <?php if( $banner_bullets['right_bullets'] ): ?>
                                            <div class="banner-bullets-list">
                                                <?php if($banner_bullets['right_bullet_link']) :?>
                                                    <a href="<?php echo $banner_bullets['right_bullet_link']['url']; ?>" alt="<?php echo $banner_bullets['right_bullet_link']['title']; ?>" title="<?php echo $banner_bullets['right_bullet_link']['title']; ?>">    
                                                <?php endif; ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/banner-bull.png" class="img-fluid" />
                                                <?php echo $banner_bullets['right_bullets']; ?>
                                                <?php if($banner_bullets['right_bullet_link']) :?>
                                                    </a>    
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php // endif; ?>
        </section>
    <!-- //end -->
    <?php 
    }
    ?>

<!-- 1 -->
    <section class="pdf_page">
        <div class="container">
            <!-- <div class="w-85"> -->
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="pdfImg">

                        	<!-- title -->
                        	<?php
                        		if(get_field('dp_title')) {
					
									echo '<h2>'.get_field('dp_title').'</h2>';
								}
                        	?>
                            <!-- Description -->
                            <?php
                            	if(get_field('dp_description')) {
					
									echo get_field('dp_description');
								}
                            ?>    
                            
                            <!-- PDF Image Middel -->
                            <?php
                        	if(get_field('pdf_image')){
                        		if(get_field('pdf_file')){
                        			echo '<a href="'.get_field('pdf_file')['url'].'">';
                        		}
                        		echo '<img src="'.get_field('pdf_image').'"
                                class="img-fluid py-2" />';	
                                if(get_field('pdf_file')){
                        			echo '</a>';
                        		}
                        	}
                            ?>
                            
                            <?php
                            	if(get_field('pdf_file')) { 

									$pdf = get_field('pdf_file');
									echo '<a download href="'.$pdf['url'].'" target="_blank" class="btn btn-org"> Download Techniques ebook </a>';
								}
                            ?>	
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-md-4">
                    <div class="box">
                        <div class="PDFform">
                        	<!-- Sidebar Title -->
                        	<?php
                        	if(get_field('form_title')){
                        		echo '<h3>'.get_field('form_title').' <span data-toggle="tooltip" title="A credebt® facility is trade finance that replaces bank lending"><span class="tooltip_icon">?</span></span> </h3>';
                        	}
                        	?>
                        	<!-- Right Side - Contact Form -->
                            <?php if( get_field('right_contact_form_shortcode') ): ?>
                            	<?php echo do_shortcode(''. get_field('right_contact_form_shortcode') .'' );?>
                            <?php endif; ?>

                            <?php if( get_field('below_form_text') ): ?>
                            	<?php echo get_field('below_form_text');?>
                            <?php endif; ?>

                            <!-- <h6>Call <a href="#">01 685-3672</a> for assistance/advice</h6> -->
                        </div>
                    </div>
                    <?php if( get_field('sidebar_last_section_text') ): ?>
                    	<div class="box">
	                        <div class="cont">
	                            <p><?php echo get_field('sidebar_last_section_text');?></p>
	                        </div>
	                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            <!-- </div> -->
        </div>
    </section>

<?php get_footer(); ?>