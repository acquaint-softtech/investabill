<?php 
/*
Template Name: Tradecredebt Home
*/
get_header();
?>

  <link rel='stylesheet' href='https://unpkg.com/swiper/css/swiper.min.css'>
<link rel='stylesheet' href='https://unpkg.com/swiper/swiper-bundle.css'>

<a href="#investment-enquiry" style="display: none;" class="investment-enquiry-button">Book Your Appointment</a>
    <!-- slider -->
    <?php if ( get_field( 'banner' ) ) : ?>
        <section class="sliderImg banner">
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
            <?php if ( get_field( 'banner_bullets' ) ) : ?>
                <div class="banner-box">
                    <div class="container">
                        <div class="row">
                            <?php if( get_field( 'banner_right_title' ) || get_field( 'banner_bullets' )['right_bullets'] ) { ?>
                            <div class="col-md-6 left">
                                <div class="banner-bullets left">
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
                            <?php if( get_field( 'banner_left_title' ) || get_field( 'banner_bullets' )['left_bullets'] ) { ?>
                            
                                <div class="col-md-6 right">
                                    <div class="banner-bullets right">
                                        <?php if(get_field( 'banner_left_title' )) {?>
                                            <div class="banner-bullets-title">

                                                <p class="banner-title"> <?php echo get_field( 'banner_left_title' ); ?> </p>                                           
                                            </div>
                                        <?php } ?>
                                        <?php foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>

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
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>
    <!-- //end -->
    
    <?php if ( have_posts() ) : ?>

                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post(); ?>

                            <div class="dmbs-page-content container">

                                <?php the_content(); ?>

                            </div>
                    <?php
                        // End the loop.
                    endwhile;
                    ?>

                <?php endif; ?>

    
    <!-- 12 -->
    <section class="section12">
        <div class="container">
            <div class="col-md-10 m-auto">
                <?php if ( get_field( 's12_title' ) ) : ?>
                    <h2 class="blog-title-homemb-4 text-center"> <span> <?php echo get_field( 's12_title' ); ?> </span> </h2>
                <?php endif; ?>
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
                                    <p><?php echo '<a href="'.get_the_permalink($PostId).'">Read Full Article></a>'; ?></p>
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
    


<?php 
get_footer();
?>