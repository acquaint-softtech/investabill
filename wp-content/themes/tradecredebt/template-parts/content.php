<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>

<?php
    if( get_field('external_image') || wp_get_attachment_url() ){ ?>    
    <!-- slider -->
    <!-- <section class="sliderImg">
        <img src="<?php //echo get_the_post_thumbnail_url('', 'full'); ?>" class="img-fluid" />
    </section> -->
    <!-- //end -->

    <!-- slider -->
        <section class="sliderImg banner">
            <?php 
            if( get_field('external_image') ){

                $BannerUrl = get_field('external_image');
                $banner_class = "ext_img";
                
            
            }else{

                $banner_class = "";
                $BannerUrl = wp_get_attachment_url();
                
            }
            // $BannerUrl = wp_get_attachment_url( get_field( 'banner' ) ); 


            ?>
            <img src="<?php echo $BannerUrl; ?>" class=" <?php echo $banner_class; ?> img-fluid w-100" />
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
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/banner-bull.png" class="img-fluid" />
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
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/banner-bull.png" class="img-fluid" />
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

    <!-- 1 -->
    <?php 
    if(is_single()){
        $cmsClass="";
    }else{
        $cmsClass="cms";
    }
    ?>
    <section class="cmsSection1 section10 <?php echo $cmsClass; ?>">
        <div class="container">
            
            <?php 
            if(is_single()){
            ?>
                <h1> <?php the_title( ); ?></h1>
            <?php
            }else{
            ?>
                <h1 class="titleHead mb-3 mainTitle"> <?php the_title( ); ?></h1>
            <?php    
            }
            ?>

            <?php the_content();?>
            
        </div>
    </section>



    
    
    <div class="blog-wd">
        <div class="container">
        
            <?php dynamic_sidebar( 'custom-widget' ); ?>
        
        </div>
    </div>
    
    <!-- 12 -->
    <section class="section12">
        <div class="container">
            <div class="col-md-10 m-auto">
                    <h2 class="blog-title-homemb-4 text-center vc_custom_heading"> <span> <b>More</b> Posts Like This </span> </h2>
                <?php if ( get_field( 's12_description' ) ) : ?>
                    <p class="text-center">
                        <?php echo get_field( 's12_description' ); ?>
                    </p>
                <?php endif; ?>
            </div>
 
            <?php $BlogPosts = wp_get_recent_posts(array(
                                'numberposts' => 3, // Number of recent posts thumbnails to display
                                'post_status' => 'publish' // Show only the published posts
                            )); 
            ?>
            <div class="row">
                <?php foreach ($BlogPosts as $post) {
                    setup_postdata($post); 
                    $PostId = $post['ID'];
                    ?>


                    <div class="col-md-4">
                        <article>
                            <div class="ImgBox">
                                <?php 

                                if( get_field('external_image' , $PostId ) ){

                                    echo '<img src="'.get_field('external_image' , $PostId).'" class="img-fluid" />';
                                }else{

                                    echo get_the_post_thumbnail($PostId); 
                                }

                                ?>
                            </div>
                            <div class="contBox">
                                <h3><?php echo $post['post_title']; ?> </h3>
                                <?php if( get_the_excerpt( $PostId ) ): ?>
                                    <p><?php echo '<a href="'.get_the_permalink($PostId).'">Read  Article</a>'; ?></p>
                                <?php else: ?>
                                    <?php //get_the_excerpt( $PostId ); ?>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php } wp_reset_postdata(); wp_reset_query(); ?>

            </div>

        </div>

    </section>
