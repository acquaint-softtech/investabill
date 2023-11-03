<?php
/*
Template Name: Archives
*/
get_header(); 
?>

<!-- slider -->
<?php if ( get_field( 'banner' ) ) : ?>
    <section class="sliderImg banner">
        <?php $BannerUrl = wp_get_attachment_url( get_field( 'banner' ) ); ?>
        <img src="<?php echo $BannerUrl; ?>" class="img-fluid" />
        <?php if ( get_field( 'banner_bullets' ) ) : ?>
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
                                <?php foreach (get_field( 'banner_bullets' ) as $banner_bullets) { ?>

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
                                    
                                    <p class="banner-title"> <?php echo get_field( 'banner_right_title' ); ?> </p>                                           
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
        <?php endif; ?>
    </section>
<?php endif; ?>
<!-- //end -->

<section class="blog_section">
    <div class="container">
    	<div class="row">
    	<div class="w-75">
    		
        	<?php if  (get_field( 'title' )) : ?>
            	<h1 class="titleHead mb-3 mainTitle"><?php echo get_field( 'title' ); ?></h1>
        	<?php endif; ?>

        	<?php if  (get_field( 'description' )) : ?>
            	<p> <?php echo get_field( 'description' ); ?> </p>
            <?php endif; ?>

            <div class="row blog_wrap">
<h1 class="titleHead mb-3 mainTitle">Briefings</h1>
            	<?php $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => get_query_var( 'paged' ) ) ); ?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="postpage">
							<div class="post-list-title"><a href="<?php  the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php the_excerpt(); ?>
                                
							<div class="readmore-button"><a href="<?php  the_permalink(); ?>">Read More</a></div>
							</div>
						<?php endwhile; ?>
						
										
						<hr>
						<div class="navigation">
							<?php
							// Bring $wp_query into the scope of the function
							global $wp_query;
						
							// Backup the original property value
							$backup_page_total = $wp_query->max_num_pages;
						
							// Copy the custom query property to the $wp_query object
							$wp_query->max_num_pages = $loop->max_num_pages;
							?>
						
							<!-- now show the paging links -->
							<div class="alignleft"><?php previous_posts_link('Previous Entries'); ?></div>
							<div class="alignright"><?php next_posts_link('Next Entries'); ?></div>
						
							<?php
							// Finally restore the $wp_query property to it's original value
							$wp_query->max_num_pages = $backup_page_total;
							?>
						</div>

            </div>
        </div>
        <div class="w-25">
        	<?php dynamic_sidebar( 'blog-1' ); ?> 
        </div>
    </div>
    </div>
</section>

<?php get_footer(); ?>