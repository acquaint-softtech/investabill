


jQuery(window).load(function () {
  jQuery(".loader.tb").fadeOut("slow");
  jQuery("body").addClass("overflow_auto");
  jQuery('.section10').find('.row.m-auto').each(function () {
    var ImageDivHeight = jQuery(this).find('.img-div').height();
    var TextDivHeight = jQuery(this).find('.text-div').height();
    console.log('ImageDivHeight----' + ImageDivHeight + '------TextDivHeight-------' + TextDivHeight);

    if (ImageDivHeight < TextDivHeight) {
      jQuery(this).find('.img-div').addClass('up-down');
    }
    if (TextDivHeight < ImageDivHeight) {
      jQuery(this).find('.text-div').addClass('up-down');
    }

    jQuery(this).find('.text-div').find('p').each(function () {
      if (jQuery(this).is(':empty')) {
        jQuery(this).remove();
      }
    });

  });
});

jQuery(document).ready(function () {

  jQuery(".wpcf7-list-item-label").addClass(function (i) { return "tab" + (i + 1) })
  jQuery(".wpcf7-list-item-label.tab1").append("<span data-toggle='tooltip' title=' A revolving credebt® facility can replace a bank overdraft'><span class='tooltip_icon'>?</span></span>");
  jQuery(".wpcf7-list-item-label.tab2").append("<span data-toggle='tooltip' title=' A repayment credebt® facility can replace a term loan'><span class='tooltip_icon'>?</span></span>");
  jQuery(".wpcf7-list-item-label.tab3").append("<span data-toggle='tooltip' title=' Assets and loans can be financed or refinanced using a credebt® facility'><span class='tooltip_icon'>?</span></span>");

  jQuery('[data-toggle="tooltip"]').tooltip();

  // jQuery(' <span data-toggle="tooltip" title="A revolving credebt® facility can replace a bank overdraft"><span class="tooltip_icon">?</span></span>').appendTo('.wpcf7-radio.dp .wpcf7-list-item:first span.wpcf7-list-item-label');
  // jQuery(' <span data-toggle="tooltip" title="A repayment credebt® facility can replace a term loan"><span class="tooltip_icon">?</span></span>').appendTo('.wpcf7-radio.dp .wpcf7-list-item:second-child span.wpcf7-list-item-label');
  // jQuery(' <span data-toggle="tooltip2" title="Assets and loans can be financed or refinanced using a credebt® facility"><span class="tooltip_icon">?</span></span>').appendTo('.wpcf7-radio.dp .wpcf7-list-item:last span.wpcf7-list-item-label');

  jQuery(".TopUp").on('click', function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
  jQuery(".btn_menu").on('click', function () {
    jQuery(this).toggleClass("menuAct");
    jQuery(".nav_menu__menubar").toggleClass("open");
  });

  jQuery('.menu-item-has-children .icon').on('click', function (e) {

    jQuery(".menu-item-has-children").toggleClass("open");
  });
  // jQuery("a").on('click', function(event) {

  //   if (this.hash !== "") {
  //     event.preventDefault();

  //     var hash = this.hash;

  //     jQuery('html, body').animate({
  //       scrollTop: jQuery(hash).offset().top;
  //     }, 800, function(){

  //       window.location.hash = hash;
  //     });
  //   } 
  // });

  // For Gravaty Form Compare Button
  jQuery(document).on('click','.gform_page_fields li.gfield.form-compare.gfield_html a', function(e) {
      e.preventDefault();
      var refirect_url = jQuery(this).attr('href');
      var element_id = jQuery(this).parent().attr('id');
      // console.log( 'refirect_url: '+refirect_url+' & element_id:'+element_id );

      var expires = new Date();
      expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
      document.cookie = 'investabill_is_gform_element='+element_id+';expires=' + expires.toUTCString()+';path=/';

      window.location.href = refirect_url;
  });

  if( jQuery(".home-banner-slider .sliderOute").length ) {
    jQuery(".home-banner-slider .sliderOute").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      arrows: false,
      autoplaySpeed: 4000,
    });
  }

});