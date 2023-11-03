<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
	<!-- Footer -->
    <footer>
        <div class="container">
            <?php if ( get_field( 'newsletter_shortcode', 'option' ) || get_field( 'newsletter_title', 'option' ) || get_field( 'newsletter_description', 'option' ) ) : ?>
                <div class="signUpBox">
                    <div class="row">
                        <div class="col-lg-3 p-0">
                            <div class="box1">
                                <?php if( get_field( 'newsletter_icon', 'option' ) ): ?>
                                    <?php $newsletter_icon = get_field( 'newsletter_icon', 'option' ); ?>
                                    <img src="<?php echo $newsletter_icon['url']; ?>" alt="<?php echo $newsletter_icon['alt']; ?>" class="img-fluid" />
                                <?php endif; ?>
                                <?php if( get_field( 'newsletter_title', 'option' ) ): ?>
                                    <h4>
                                       <?php the_field( 'newsletter_title', 'option' ); ?>
                                    </h4>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if( get_field( 'newsletter_description', 'option' ) ): ?>
                            <div class="col-lg-6 p-0">
                                <div class="box2">
                                        <h4>
                                           <?php the_field( 'newsletter_description', 'option' ); ?>
                                        </h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if( get_field( 'newsletter_shortcode' , 'option' ) ): ?>
                            <div class="col-lg-3 p-0">
                                <div class="form-group mb-0">
                                    <?php echo do_shortcode(''. get_field('newsletter_shortcode' , 'option' ) .'' );?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="linkList">
                <ul class="mailUl">
                    <?php 
                    $hide_col_1 = get_field( 'col_1_hide' , 'option' );
                    if( !$hide_col_1 ) { 
                    ?>
                    <li class="mainLI">
                        <label class="linkTitle"><?php echo the_field('col_1_title' , 'option'); ?></label>
                        <ul>
                            <li>
                                <label>
                                
                                <?php 
                                    if( get_field('address' , 'option') ){

                                        esc_html_e( the_field('address' , 'option') , 'tradecredebt' );
                                    
                                    }
                                ?>   
                                </label>
                            </li>
                            <li>
                                <img src="<?php the_field('logo_1' , 'option') ?>" class="img-fluid my-2" />
                            </li>
                            <li>
                                <img src="<?php the_field('logo_2' , 'option') ?>" class="img-fluid my-2" />
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php
                        $locations = get_nav_menu_locations();
                        $menuID_1 = $locations['footer-menu-one'];
                        $nav_menu = wp_get_nav_menu_object( $menuID_1 );
                        if( is_object( $nav_menu ) )
                    {
                        ?>
                        <li class="mainLI">
                            <label class="linkTitle"><?php echo $nav_menu->name; ?></label>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-one','container' =>'' )); ?><ul class="ltd_ul sec_ul">
							
							<?php
							if( have_rows('after_shipping_menu','option') ):
								while( have_rows('after_shipping_menu', 'option') ): the_row();
									echo '<li>'.get_sub_field('after_shipping_menu_text','option').'</li>';
								endwhile;
					endif;
							?>
                        </ul></li>
                        <?php 		
                    } 
					
					?>
                    <?php
                        
                        $menuID_2 = $locations['footer-menu-two'];
                        $nav_menu_2 = wp_get_nav_menu_object( $menuID_2 );
                        if( is_object( $nav_menu_2 ) )
                        {
                        ?>
                        <li class="mainLI">
                            <label class="linkTitle"><?php echo $nav_menu_2->name; ?></label>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-two','container' =>'' )); ?> <ul class="cono_ul sec_ul">
							
							<?php if( have_rows('after_trade_menu','option') ):
                                while( have_rows('after_trade_menu', 'option') ): the_row();
                                    echo '<li>'.get_sub_field('after_trade_menu_text','option').'</li>';
                                endwhile;
                        endif; ?>
							</ul></li> 
                        <?php 
                        }                         
                        ?>
                    <?php
                        
                        $menuID_3 = $locations['footer-menu-three'];
                        $nav_menu_3 = wp_get_nav_menu_object( $menuID_3 );
                        if( is_object( $nav_menu_3 ) )
                    {
                        ?>
                        <li class="mainLI">
                            <label class="linkTitle"><?php echo $nav_menu_3->name; ?></label>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-three','container' =>'' )); ?> <ul class="tax_ul sec_ul">
							
							<?php if( have_rows('after_finance_menu','option') ):
                                while( have_rows('after_finance_menu', 'option') ): the_row();
                                    echo '<li>'.get_sub_field('after_finance_menu_text','option').'</li>';
                                endwhile;
                    endif; ?>
                        </ul></li>
                        <?php 
                    } 
                    ?>

                    <?php
                       
                        $menuID_4 = $locations['footer-menu-four'];
                        $nav_menu_4 = wp_get_nav_menu_object( $menuID_4 );
                        if( is_object( $nav_menu_4 ) )
                    {
                        ?>
                        <li class="mainLI">
                            <label class="linkTitle"><?php echo $nav_menu_4->name; ?></label>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-four','container' =>'' )); ?> <ul class="duns_ul sec_ul">
							
							<?php if( have_rows('after_franchise_menu','option') ):
                                while( have_rows('after_franchise_menu', 'option') ): the_row();
                                    echo '<li>'.get_sub_field('after_franchise_menu_text','option').'</li>';
                                endwhile;
                    endif; ?>
                        </ul></li>
                        <?php 
                    } 
                    
                    ?>

                    <?php 
                    $hide_col_last = get_field( 'col_last_hide' , 'option' );
                    if( !$hide_col_last ) { 
                    ?>
                    <li class="mainLI">
                        <label class="linkTitle"><?php the_field('col_last_title' , 'option'); ?></label>
                        <ul class="contactUs">
                            <?php if( get_field('phone_number_1' , 'option') ){ 
                                $phone_1 = get_field('phone_number_1' , 'option');
                            ?>
                            <li>
                                <label> <img src="<?php echo get_template_directory_uri(); ?>/images/phoneIcon.png" class="img-fluid" /> <a href="tel:<?php echo $phone_1; ?>"><?php echo $phone_1 ?></a>
                                </label>
                                
                            </li>
                            <?php } ?>
                            <?php if( get_field('phone_number_2' , 'option') ){ 
                                $phone_2 = get_field('phone_number_2' , 'option');
                            ?>
                            <li>
                                <label> <img src="<?php echo get_template_directory_uri(); ?>/images/phoneIcon.png" class="img-fluid" /> <a href="tel:<?php echo $phone_2; ?>"><?php echo $phone_2 ?></a>
                                    <?php
                                    if( get_field('phone_number_2_text' , 'option') ){
                                        echo '<span>'.get_field('phone_number_2_text', 'option').'</span>';
                                    }
                                    ?>
                                </label>
                            </li>
                            <?php } ?>

                            <?php if( get_field('email' , 'option') ){ ?>
                            <li class="mailIcon">
                                <a href="mailto:<?php echo get_field( 'email', 'options' ); ?>" class="d-flex align align-items-center">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/mailIcon.png" class="img-fluid" />
                                    <?php esc_html_e( the_field('email' , 'option') , 'tradecredebt' ); ?></a>
                            </li>
                            <?php } ?>

                            <?php if( get_field('location' , 'option') ){ 
                                $location = get_field('location' , 'option');
                            ?>
                            <li>
                                <label> <img src="<?php echo get_template_directory_uri(); ?>/images/mapIcon.png" class="img-fluid" /> <?php 

                                echo '<a href="'.$location['url'].'" target="'.$location['target'].'">'.$location['title'].'</a>';

                                ?></label>
                            </li>
                            <?php } ?>

                        </ul>

                        <label class="linkTitle"><?php the_field('social_media_title' , 'option'); ?></label>
                        <ul class="socialIcon">
                            <?php if( get_field('facebook_link' , 'option') ){ ?>
                            <li>
                                <a rel="nofollow" href="<?php the_field('facebook_link' , 'option') ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <?php } ?>

                            <?php if( get_field('twitter_link' , 'option') ){ ?>
                            <li>
                                <a rel="nofollow" href="<?php the_field('twitter_link' , 'option') ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <?php } ?>

                            <?php if( get_field('linkedin_link' , 'option') ){ ?>
                            <li>
                                <a rel="nofollow" href="<?php the_field('linkedin_link' , 'option') ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                </ul>
            </div>

            <div class="FootCont">
                <span class="TopUp" onclick=" function () { window.scrollTo({ top: 0, behavior: "><i class="fa fa-angle-up"></i></span>
                <div class="row m-auto p-0">
                    <div class="col-xl-6 p-0">
                        <!-- copyright_text -->
                        <?php if( get_field('copyright_text' , 'option') ){ ?>
                        <label class="m-0"> <?php the_field('copyright_text' , 'option') ?> </label>
                    <?php } ?>
                    </div>
                    <div class="col-xl-6 p-0">
                        <ul>
                            <?php
                              $menuID_5 = $locations['footer-menu-five'];
                              $menu_items_5 = wp_get_nav_menu_items($menuID_5);
                              foreach( $menu_items_5 as $menu_item_5 ) {

                                $link = $menu_item_5->url;
                                $title = $menu_item_5->title;
                                
                                echo '<li><a href="'.$link.'">'.$title.'</a></li>';
                              }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	<div class="questionnaire-data" style="display:none;">
            <span class="demand_regulated"><?php echo get_option( 'demand_regulated' ); ?></span>
            <span class="demand_credebt"><?php echo get_option( 'demand_credebt' ); ?></span>
            <span class="demand_high_risk"><?php echo get_option( 'demand_high_risk' ); ?></span>
            <span class="fixed_regulated"><?php echo get_option( 'fixed_regulated' ); ?></span>
            <span class="fixed_credebt"><?php echo get_option( 'fixed_credebt' ); ?></span>
            <span class="fixed_high_risk"><?php echo get_option( 'fixed_high_risk' ); ?></span>
            <span class="term_regulated"><?php echo get_option( 'term_regulated' ); ?></span>
            <span class="term_credebt"><?php echo get_option( 'term_credebt' ); ?></span>
            <span class="term_high_risk"><?php echo get_option( 'term_high_risk' ); ?></span>
        </div>
    </footer>

		<?php wp_footer(); ?>

    
    <script>
// This is the initial GravityForms binding, it will be lost upon a page change with next/previous
// Thus we make a bind on gform_page_loaded event also
 if( jQuery('#gform_14.lead-gene').length > 0 ) {
	jQuery('.gfield_radio input[type=radio]').bind("click", function() {
		//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
		jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
	});
}

jQuery(document).bind('gform_page_loaded', function(event, form_id, current_page){
      // code to be trigger when next/previous page is loaded
      if( jQuery('#gform_14.lead-gene').length > 0 ) {
		jQuery('.gfield_radio input[type=radio]').bind("click", function() {
			//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
			jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
		});
	}
  });
  </script>
      
      <script>
      document.querySelectorAll('a.investment-enquiry-button').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>

<script>
    jQuery(document).ready(function ($) {
        $(document).bind("gform_post_render", function() {
            var demand_regulated = $('.questionnaire-data .demand_regulated').text()+'%';
            var demand_credebt = $('.questionnaire-data .demand_credebt').text()+'%';
            var demand_high_risk = $('.questionnaire-data .demand_high_risk').text()+'%';

            var fixed_regulated = $('.questionnaire-data .fixed_regulated').text()+'%';
            var fixed_credebt = $('.questionnaire-data .fixed_credebt').text()+'%';
            var fixed_high_risk = $('.questionnaire-data .fixed_high_risk').text()+'%';

            var term_regulated = $('.questionnaire-data .term_regulated').text()+'%';
            var term_credebt = $('.questionnaire-data .term_credebt').text()+'%';
            var term_high_risk = $('.questionnaire-data .term_high_risk').text()+'%';

            if($('#label_13_1_0').length > 0) {
                if($('#label_13_1_0').text().indexOf('%') <= -1){
                    var label_13_1_0_space = '';
                    if($('#label_13_1_0').text().indexOf('c.') <= -1){
                        label_13_1_0_space = ' ';
                    }
                    $('#label_13_1_0').append(label_13_1_0_space+fixed_regulated);
                }
            }
            if($('#label_13_1_1').length > 0) {
                if($('#label_13_1_1').text().indexOf('%') <= -1){
                    var label_13_1_1_space = '';
                    if($('#label_13_1_1').text().indexOf('c.') <= -1){
                        label_13_1_1_space = ' ';
                    }
                    $('#label_13_1_1').append(label_13_1_1_space+fixed_credebt);
                }
            }
            if($('#label_13_1_2').length > 0) {
                if($('#label_13_1_2').text().indexOf('%') <= -1){
                    var label_13_1_2_space = '';
                    if($('#label_13_1_2').text().indexOf('c.') <= -1){
                        label_13_1_2_space = ' ';
                    }
                    $('#label_13_1_2').append(label_13_1_2_space+fixed_high_risk);
                }
            }
            if($('#label_13_3_0').length > 0) {
                var label_13_3_0_space = '';
                if($('#label_13_1_2').text().indexOf('c.') <= -1){
                    label_13_3_0_space = ' ';
                }
                $('#label_13_3_0').append(label_13_3_0_space+fixed_regulated);
            }
            if($('#label_13_3_1').length > 0) {
                var label_13_3_1_space = '';
                if($('#label_13_3_1').text().indexOf('c.') <= -1){
                    label_13_3_1_space = ' ';
                }
                $('#label_13_3_1').append(label_13_3_1_space+fixed_credebt);
            }
            if($('#label_13_22_0').length > 0) {
                var label_13_22_0_space = '';
                if($('#label_13_22_0').text().indexOf('c.') <= -1){
                    label_13_22_0_space = ' ';
                }
                $('#label_13_22_0').append(label_13_22_0_space+fixed_regulated);
            }
            if($('#label_13_22_1').length > 0) {
                var label_13_22_1_space = '';
                if($('#label_13_22_1').text().indexOf('c.') <= -1){
                    label_13_22_1_space = ' ';
                }
                $('#label_13_22_1').append(label_13_22_1_space+fixed_credebt);
            }
            if($('#label_13_10_0').length > 0) {
                if($('#input_13_1 input:checked').attr('id') == 'choice_13_1_0') {
                    var label_13_10_0_space = '';
                    if($('#label_13_10_0').text().indexOf('c.') <= -1){
                        label_13_10_0_space = ' ';
                    }
                    $('#label_13_10_0').append(label_13_10_0_space+demand_regulated);
                    var label_13_10_1_space = '';
                    if($('#label_13_10_1').text().indexOf('c.') <= -1){
                        label_13_10_1_space = ' ';
                    }
                    $('#label_13_10_1').append(label_13_10_1_space+fixed_regulated);
                    var label_13_10_2_space = '';
                    if($('#label_13_10_2').text().indexOf('c.') <= -1){
                        label_13_10_2_space = ' ';
                    }
                    $('#label_13_10_2').append(label_13_10_2_space+term_regulated);
                }
            }
            if($('#label_13_10_1').length > 0) {
                if($('#input_13_1 input:checked').attr('id') == 'choice_13_1_1') {
                    var label_13_10_0_space = '';
                    if($('#label_13_10_0').text().indexOf('c.') <= -1){
                        label_13_10_0_space = ' ';
                    }
                    $('#label_13_10_0').append(label_13_10_0_space+demand_credebt);
                    var label_13_10_1_space = '';
                    if($('#label_13_10_1').text().indexOf('c.') <= -1){
                        label_13_10_1_space = ' ';
                    }
                    $('#label_13_10_1').append(label_13_10_1_space+fixed_credebt);
                    var label_13_10_2_space = '';
                    if($('#label_13_10_2').text().indexOf('c.') <= -1){
                        label_13_10_2_space = ' ';
                    }
                    $('#label_13_10_2').append(label_13_10_2_space+term_credebt);
                }
            }
            if($('#label_13_10_2').length > 0) {
                if($('#input_13_1 input:checked').attr('id') == 'choice_13_1_2') {
                    var label_13_10_0_space = '';
                    if($('#label_13_10_0').text().indexOf('c.') <= -1){
                        label_13_10_0_space = ' ';
                    }
                    $('#label_13_10_0').append(label_13_10_0_space+demand_high_risk);
                    var label_13_10_1_space = '';
                    if($('#label_13_10_1').text().indexOf('c.') <= -1){
                        label_13_10_1_space = ' ';
                    }
                    $('#label_13_10_1').append(label_13_10_1_space+fixed_high_risk);
                    var label_13_10_2_space = '';
                    if($('#label_13_10_2').text().indexOf('c.') <= -1){
                        label_13_10_2_space = ' ';
                    }
                    $('#label_13_10_2').append(label_13_10_2_space+term_high_risk);
                }
            }

		
            if($('#label_14_1_0').length > 0) {
                if($('#label_14_1_0').text().indexOf('%') <= -1){
                    var label_14_1_0_space = '';
                    if($('#label_14_1_0').text().indexOf('c.') <= -1){
                        label_14_1_0_space = ' ';
                    }
                    $('#label_14_1_0').append(label_14_1_0_space+fixed_regulated);
                }
            }
            if($('#label_14_1_1').length > 0) {
                if($('#label_14_1_1').text().indexOf('%') <= -1){
                    var label_14_1_1_space = '';
                    if($('#label_14_1_1').text().indexOf('c.') <= -1){
                        label_14_1_1_space = ' ';
                    }
                    $('#label_14_1_1').append(label_14_1_1_space+fixed_credebt);
                }
            }
            if($('#label_14_1_2').length > 0) {
                if($('#label_14_1_2').text().indexOf('%') <= -1){
                    var label_14_1_2_space = '';
                    if($('#label_14_1_2').text().indexOf('c.') <= -1){
                        label_14_1_2_space = ' ';
                    }
                    $('#label_14_1_2').append(label_14_1_2_space+fixed_high_risk);
                }
            }
            if($('#label_14_3_0').length > 0) {
                var label_14_3_0_space = '';
                if($('#label_14_3_0').text().indexOf('c.') <= -1){
                    label_14_3_0_space = ' ';
                }
                $('#label_14_3_0').append(label_14_3_0_space+fixed_regulated);
            }
            if($('#label_14_3_1').length > 0) {
                var label_14_3_1_space = '';
                if($('#label_14_3_1').text().indexOf('c.') <= -1){
                    label_14_3_1_space = ' ';
                }
                $('#label_14_3_1').append(label_14_3_1_space+fixed_credebt);
            }
            if($('#label_14_10_0').length > 0) {
                if($('#input_14_1 input:checked').attr('id') == 'choice_14_1_0') {
                    var label_14_10_0_space = '';
                    if($('#label_14_10_0').text().indexOf('c.') <= -1){
                        label_14_10_0_space = ' ';
                    }
                    $('#label_14_10_0').append(label_14_10_0_space+demand_regulated);
                    var label_14_10_1_space = '';
                    if($('#label_14_10_1').text().indexOf('c.') <= -1){
                        label_14_10_1_space = ' ';
                    }
                    $('#label_14_10_1').append(label_14_10_1_space+fixed_regulated);
                    var label_14_10_2_space = '';
                    if($('#label_14_10_2').text().indexOf('c.') <= -1){
                        label_14_10_2_space = ' ';
                    }
                    $('#label_14_10_2').append(label_14_10_2_space+term_regulated);
                }
            }
            if($('#label_14_10_1').length > 0) {
                if($('#input_14_1 input:checked').attr('id') == 'choice_14_1_1') {
                    var label_14_10_0_space = '';
                    if($('#label_14_10_0').text().indexOf('c.') <= -1){
                        label_14_10_0_space = ' ';
                    }
                    $('#label_14_10_0').append(label_14_10_0_space+demand_credebt);
                    var label_14_10_1_space = '';
                    if($('#label_14_10_1').text().indexOf('c.') <= -1){
                        label_14_10_1_space = ' ';
                    }
                    $('#label_14_10_1').append(label_14_10_1_space+fixed_credebt);
                    var label_14_10_2_space = '';
                    if($('#label_14_10_2').text().indexOf('c.') <= -1){
                        label_14_10_2_space = ' ';
                    }
                    $('#label_14_10_2').append(label_14_10_2_space+term_credebt);
                }
            }
            if($('#label_14_10_2').length > 0) {
                if($('#input_14_1 input:checked').attr('id') == 'choice_14_1_2') {
                    var label_14_10_0_space = '';
                    if($('#label_14_10_0').text().indexOf('c.') <= -1){
                        label_14_10_0_space = ' ';
                    }
                    $('#label_14_10_0').append(label_14_10_0_space+demand_high_risk);
                    var label_14_10_1_space = '';
                    if($('#label_14_10_1').text().indexOf('c.') <= -1){
                        label_14_10_1_space = ' ';
                    }
                    $('#label_14_10_1').append(label_14_10_1_space+fixed_high_risk);
                    var label_14_10_2_space = '';
                    if($('#label_14_10_2').text().indexOf('c.') <= -1){
                        label_14_10_2_space = ' ';
                    }
                    $('#label_14_10_2').append(label_14_10_2_space+term_high_risk);
                }
            }
        });
        
    });
</script>
  
  
	</body>
</html>