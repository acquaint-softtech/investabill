<?php 
/*
Template Name: Tradecredebt FAQs
*/
get_header();
?>

<?php
    if( get_field( 'banner' ) ){ ?>    
    <!-- slider -->
        <section class="sliderImg banner">
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
            <?php if ( get_field( 'banner_bullets' ) ) : 
                ?>
                <div class="banner-box">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                
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
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/ship-icon-new.png" class="img-fluid" />
                                                <?php echo $banner_bullets['left_bullets']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner-bullets right">
                                    <?php if(get_field( 'banner_right_title' )) {?>
                                    <div class="banner-bullets-title">
                                        
                                        <h2> <?php echo get_field( 'banner_right_title' ); ?> </h2>                                           
                                    </div>
                                    <?php } ?>
                                   <?php foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>
                                        <?php if( $banner_bullets['right_bullets'] ): ?>
                                            <div class="banner-bullets-list">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/ship-icon-new.png" class="img-fluid" />
                                                <?php echo $banner_bullets['right_bullets']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <!-- //end -->
    <?php 
    }
    ?>
<section class="section1">
    <div class="container">
    	<div class="">
    		<div class="top-part">
    		<?php if(get_field('heading')) {
    			echo '<h1>'.get_field('heading').'</h1>';
    		}?>
    		
    		<?php if(get_field('faq_description')) {
    			echo get_field('faq_description');
    		}?>
    		</div>

    	<?php if( get_field('faqs') ) {
    		$faqss = get_field('faqs');
    		?>	
    		<div class="mb-6 accordionBox col-md-12 px-0">
    			<?php 
				foreach ($faqss as $key => $faqs) {
					$faqsTitle = $faqs['faq_title'];

					echo '<h3 class="titleHead mb-3 ">'.$faqsTitle.'</h3>';
					echo '<div class="accordion" id="accordionExample'.$key.'">';
    					foreach ($faqs['faqs_content'] as $k => $faq) {

    						echo'<div class="card">';
                                if($faq['question']){

                                    echo '<div class="card-header" id="heading'.$key.'_'.$k.'">
                                        <h2 class="mb-0">
                                            <button type="button" class="btn btn-link" data-toggle="collapse"
                                                data-target="#FAQ'.$key.'_'.$k.'" aria-expanded="true"><i class="fa fa-chevron-down"></i>'.$faq['question'].'</button>
                                        </h2>
                                    </div>';

                                }
                                if($faq['answer']){
                                    echo '<div id="FAQ'.$key.'_'.$k.'" class="collapse" aria-labelledby="heading'.$key.'_'.$k.'" data-parent="#accordionExample'.$key.'"> <div class="card-body"> '.$faq['answer'].'</div></div>';
        	                    }
	                        echo '</div>';
                        }
					echo '</div>';
				}
    			?>	
    		</div>
    	<?php } ?>	
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function () {
        jQuery(".collapse.show").each(function () {
            jQuery(this).prev(".card-header").find(".fa").addClass("fa-chevron-up").removeClass("fa-chevron-down");
        });

        jQuery(".collapse").on('show.bs.collapse', function () {
            jQuery(this).prev(".card-header").find(".fa").removeClass("fa-chevron-down").addClass("fa-chevron-up");
        }).on('hide.bs.collapse', function () {
            jQuery(this).prev(".card-header").find(".fa").removeClass("fa-chevron-up").addClass("fa-chevron-down");
        });
    });
</script>
<?php get_footer(); ?>