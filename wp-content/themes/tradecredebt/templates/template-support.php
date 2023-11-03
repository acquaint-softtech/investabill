<?php 
/*
Template Name: Tradecredebt Support
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
<!-- HTML Code Start -->
<section class="section1">
    <div class="container">
    
        <?php 
            if( get_field( 'title' ) ){
                echo '<h2 class="supp_title">';
                    echo get_field( 'title' );
                echo '</h2>';            
            }
        ?>
        <!-- Loggin a support ticket is as easy as 1, 2, 3 -->
    
    
    <div class="supp_wrap">
        <div class="row">
            <div class="col-md-7 supp_col">
                <!-- <h4>Here's how you do it:</h4> -->

                <?php 
                    if( get_field( 'sub_title' ) ){
                        echo '<h4>';
                            echo get_field( 'sub_title' );
                        echo '</h4>';            
                    }

                    if( get_field( 'steps' ) ){
                        
                        echo '<ol class="supp_list">';
                        
                        foreach (get_field( 'steps' ) as $key => $step) {

                            echo '<li>'.$step['step'].'</li>';        
                        }
                        
                        echo '</ol>';

                    }
                    
                /*<ol class="supp_list">
                    <li>Sign into SharpSpring</li>
                    <li>Select your user profile to access the settings dropdown</li>
                    <li>Click "Get Support" to access our Support Portal</li>
                </ol>*/

                    if(get_field( 'call_to_action' )){
                        
                        $btn = get_field( 'call_to_action' );
                        echo '<a class="btn btn-org supp_btn" href="'.$btn['url'].'" target="'.$btn['target'].'">'.$btn['title'].'</a>';

                    }

                    // <button class="btn btn-org supp_btn">Login </button>

                    if( get_field( 'description' ) ){
                        echo '<p>';
                            echo get_field( 'description' );
                        echo '</p>';            
                    }
                ?>
                
                    
                
                <!-- <p>From the Support Portal, you can track the status of your open tickets and enhancement requests.</p> -->
            </div>
            
            <div class="col-md-5">
                <?php
                    if(get_field('image')){
                        
                        echo '<img class="img-fluid supp_img" src="'.get_field('image').'" alt="img">';
                    } 
                ?>
                <!-- <img class="img-fluid supp_img" src="/wp-content/uploads/2021/03/support.jpg" alt="img"> -->
            </div>
            
        </div>
    </div>
</div>
</section>
<!-- HTML Code End -->
<?php get_footer(); ?>