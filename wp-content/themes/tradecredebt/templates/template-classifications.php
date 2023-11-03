<?php 
/*
Template Name: Tradecredebt Classifications
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
<section class="section1 classifications">
    <div class="container">
    	<div class="w-85">
           <?php if( get_field('classifications') ) {
                $classisicationss = get_field('classifications');
                ?>  
                <ol class="mb-5 col-md-10 px-0">
                    <?php 
                    foreach ($classisicationss as $key => $classisications) {
                        
                        $classisicationsTitle = $classisications['classification_title'];
                        echo '<li>'.$classisicationsTitle.'</li>';
                    }
                    ?>  
                </ol>
            <?php } ?>     
            
        </div>
    </div>
</section>
<?php get_footer(); ?>

