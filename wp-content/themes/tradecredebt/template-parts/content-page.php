
<link rel='stylesheet' href='https://unpkg.com/swiper/swiper-bundle.css'>

    <?php
    if( get_field( 'banner' ) ){ ?>    
    <!-- slider -->
    <!-- <section class="sliderImg">
        <img src="<?php //echo get_the_post_thumbnail_url('', 'full'); ?>" class="img-fluid" />
    </section> -->
    <!-- //end -->

    <!-- slider -->
        <section class="sliderImg banner ">
            <?php //$BannerUrl = wp_get_attachment_url( get_field( 'banner' ) ); ?>
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

            <?php // if ( get_field( 'banner_bullets' ) ) : 
                ?>
                <div class="banner-box">
                    <div class="container">
                        <div class="row">
                            <?php if( get_field( 'banner_left_title' ) || get_field( 'banner_bullets' )['left_bullets'] ) { ?>
                            <div class="col-md-6 left">
                                
                                <div class="banner-bullets left">
                                    <?php if(get_field( 'banner_left_title' )) {?>
                                    <div class="banner-bullets-title">

                                        <p class="banner-title"> <?php echo get_field( 'banner_left_title' ); ?> </p>                                           
                                    </div>
                                    <?php } ?>
                                    <?php 
                                    foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>
                                        <?php if( $banner_bullets['left_bullets'] ): ?>
                                            <div class="banner-bullets-list">
                                                <?php if($banner_bullets['left_bullet_link']) :?>
                                                    <a href="<?php echo $banner_bullets['left_bullet_link']['url']; ?>" alt="<?php echo $banner_bullets['left_bullet_link']['title']; ?>" title="<?php echo $banner_bullets['left_bullet_link']['title']; ?>">    
                                                <?php endif; ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/ship-icon-new.png" class="img-fluid" />
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
                                        
                                        <p class="banner-title"> <?php echo get_field( 'banner_right_title' ); ?> </p>                                           
                                    </div>
                                    <?php } ?>
                                   <?php foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>
                                        <?php if( $banner_bullets['right_bullets'] ): ?>
                                            <div class="banner-bullets-list">
                                                <?php if($banner_bullets['right_bullet_link']) :?>
                                                    <a href="<?php echo $banner_bullets['right_bullet_link']['url']; ?>" alt="<?php echo $banner_bullets['right_bullet_link']['title']; ?>" title="<?php echo $banner_bullets['right_bullet_link']['title']; ?>">    
                                                <?php endif; ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/ship-icon-new.png" class="img-fluid" />
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
    <section class="cmsSection1 cms section10 pb-3">
        <div class="container">

            <!--<h1 class="titleHead mb-3 mainTitle"> <?php the_title( ); ?></h1>-->
            <?php the_content();?>
            
        </div>
    </section>

        <!-- 10 -->
    <?php if ( get_field( 'staggered_title' ) || get_field( 's10_staggered_image_text' ) ) : ?>
        <section class="section10 cms">
            <div class="container">
                <?php if( get_field( 'staggered_title' ) ): ?>
                <div class="T">
                    <h2 class="titleHead mb-4 text-center"><?php echo get_field( 'staggered_title' ); ?> </h2>
                    <span></span>
                </div>
                <?php endif; ?>
                <?php if ( get_field( 's10_staggered_image_text' ) ): ?>
                    <?php $i=1; foreach (get_field( 's10_staggered_image_text' ) as $staggered) { 
                        $col_lg = 12;
                        if($staggered['image']){
                            $col_lg = 6;
                        } 
                        ?>
                        
                        <?php if( $staggered['image'] || $staggered['title'] || $staggered['description'] || $staggered['quote'] ):  ?>
                        <div class="row m-auto">

                            <?php if( $i%2 != 0 ): ?>
                            
                            <?php if( $staggered['image'] ): ?>

                                <div class="col-lg-6 p-0 img-div">
                                    <?php 
                                    // if( $staggered['call_to_action'] ) : 
                                    //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                    // endif;
                                    ?>
                                    <img src="<?php echo $staggered['image']['url']; ?>" alt="<?php echo $staggered['image']['alt']; ?>" class="img-fluid" />
                                    <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if( $staggered['title'] || $staggered['description'] || $staggered['quote'] ):  ?>
                                <div class="col-lg-<?php echo $col_lg; ?> p-0 text-div">
                                    <div class=" contBox pl">
                                        <?php if( $staggered['title'] ):  ?> 
                                            <?php 
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>
                                            <h3><?php echo $staggered['title']; ?></h3> 
                                            <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>

                                        <?php endif; ?>
                                        <?php if( $staggered['description'] ):  ?>
                                            <?php 
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>
                                            <p><?php echo $staggered['description']; ?></p> 
                                            <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>

                                        <?php endif; ?>
                                        
                                        <?php if( $staggered['quote'] ):  ?>
                                            <?php 
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>
                                            <div>
                                                <?php echo $staggered['quote']; ?>
                                            </div>
                                            <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>

                                        <?php endif; ?>


                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php else: ?>
                                <?php if( $staggered['title'] || $staggered['description'] || $staggered['quote'] ):  ?>
                                <div class="col-lg-<?php echo $col_lg; ?> p-0 text-div">
                                    <div class=" contBox pl txt-height">
                                        <?php if( $staggered['title'] ):  ?> 
                                            <?php 
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>
                                                <h3><?php echo $staggered['title']; ?></h3> 
                                            <?php // if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>


                                        <?php endif; ?>
                                        <?php if( $staggered['description'] ):  ?>
                                            <?php
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>    
                                            <p><?php echo $staggered['description']; ?></p> 
                                            <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>

                                        <?php endif; ?>
                                        
                                        <?php if( $staggered['quote'] ):  ?>
                                            <?php
                                            // if( $staggered['call_to_action'] ) : 
                                            //     echo '<a target="'.$staggered['call_to_action']['target'].'" href="'.$staggered['call_to_action']['url'].'">';
                                            // endif;
                                            ?>
                                            <div>
                                                <?php echo $staggered['quote']; ?>
                                            </div>
                                            <?php //if( $staggered['call_to_action'] ) : echo '</a>'; endif; ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if( $staggered['image'] ): ?>
                                    <div class="col-lg-6 p-0 img-div">
                                        <div class="img-height">
                                        <img src="<?php echo $staggered['image']['url']; ?>" alt="<?php echo $staggered['image']['alt']; ?>" class="img-fluid" />
                                        </div>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>
                            <?php else: ?>
                                <p class="empty-staggered"></p>
                            <?php endif; ?>    
                    <?php $i++; } ?>
                    

                <?php endif; ?>

            </div>

        </section>
    <?php endif; ?>
    
    	    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    
          <script id="rendered-js" >
// swiper    
var mySwiper = new Swiper('.swiper-container', {
  effect: 'fade',
  loop: true,
  speed: 1000,
  slidesPerView: 1,
pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: 'true'
   },
navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
   autoplay: {
   delay: 8000,
 },
});
//# sourceURL=pen.js
    </script>