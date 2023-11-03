<?php 
/*
Template Name: Tradecredebt Team
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
    	<?php  
        global $wpdb;
        $query = "SELECT
            post.ID,
            post.post_title,
            post.post_excerpt,
            post.post_name,
            meta.meta_value AS 'country',
            meta2.meta_value AS 'office',
            meta3.meta_value AS 'position',
            meta4.meta_value AS 'is_lb',
            meta5.meta_value AS 'sorting'
            FROM {$wpdb->prefix}posts post
            LEFT JOIN {$wpdb->prefix}postmeta meta ON meta.post_id = post.ID AND meta.meta_key = 'team_page_location_country'
            LEFT JOIN {$wpdb->prefix}postmeta meta2 ON meta2.post_id = post.ID AND meta2.meta_key = 'team_page_location_office'
            LEFT JOIN {$wpdb->prefix}postmeta meta3 ON meta3.post_id = post.ID AND meta3.meta_key = 'team_page_position'
            LEFT JOIN {$wpdb->prefix}postmeta meta4 ON meta4.post_id = post.ID AND meta4.meta_key = 'is_local_branch_manager'
            LEFT JOIN {$wpdb->prefix}postmeta meta5 ON meta5.post_id = post.ID AND meta5.meta_key = 'sorting'
            WHERE post.post_type = 'team' AND post.post_status = 'publish'
            ORDER BY meta.meta_value DESC, IF(sorting IS NULL OR sorting = '', 1, 0), sorting+0, post.post_title";

            $teams_result = $wpdb->get_results($query, ARRAY_A);
            $teams = array();
            foreach ($teams_result as $team) {
                $key_header = (!empty($team['country']) and !empty($team['office']) and !$team['is_lb']) ? $team['office'] /* . ' - ' . $team['office'] */ : 0;
                $teams[$key_header][] = array(
                    'id' => $team['ID'],
                    'title' => $team['post_title'],
                    'sub_title' => (!empty($team['position']) and !empty($team['office'])) ? $team['position'] . ' - ' . $team['office'] : $team['position'] . $team['office'],
                    'excerpt' => $team['post_excerpt'],
                    'slug' => $team['post_name'],
                    'is_lb' => $team['is_lb'],
                );
            }
        if(get_field('team_description')) {
            echo '<p style="margin-bottom: 0px;">'.get_field('team_description').'</p>';
        }?>
        <div class="profile-main">
            <!-- Profile main -->
            <?php foreach ($teams as $team_header => $inner_teams) {
                if ($team_header) {
                    $need_header = false;
                    ?>
                    <div class="profile-content new-profile-content" style="min-height: 340px">
                    <div class="team_page_country_outer teams_page_header">
                        <div class="team_page_country teams_page_header">
                            <?php echo $team_header; ?>
                        </div>
                    </div>
                    <?php
                }
                foreach($inner_teams as $team){
                    if (has_post_thumbnail( $team['id'] ) ):
                        $team_image = wp_get_attachment_image_src( get_post_thumbnail_id( $team['id'] ), 'full' );
                    endif;
                    if ($need_header):
                    ?>
                    <div class="profile-content new-profile-content">
                        <?php endif; ?>
                        <div class="profile-pic">
                            <?php if ($team['is_lb']): ?>
                            <a href="/team/<?php echo $team['slug']; ?>">
                                <img src="<?php echo $team_image[0]; ?>" alt="<?php echo $team['title']; ?>">
                            </a>
                            <?php else: ?>
                                <img src="<?php echo $team_image[0]; ?>" alt="<?php echo $team['title']; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="profile-des">
                            <?php if ($team['is_lb']): ?>
                                <a href="/team/<?php echo $team['slug']; ?>"><h3><?php echo $team['title']; ?></h3></a>
                            <?php else: ?>
                                <h3><?php echo $team['title']; ?></h3>
                            <?php endif; ?>
                            <h4><?php echo $team['sub_title']; ?></h4>
                            <div class="profile-text">
                                <p><?php echo $team['excerpt']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                $need_header = true;
            }}
            ?>
        </div>
    </div>   
    </div>
</section>
<script>
    jQuery(document).ready(function () {
        
    });
</script>
<?php get_footer(); ?>