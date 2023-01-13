(function($) {
    'use strict';

    // Prealoader
    $(window).on('load', function () {
        if ( $( '.prealoader' ).length ) {
            $( '.prealoader' ).delay(400).queue(function () {
                $(this).remove();
            });
        }
    });

    if ($('.dt__uptop').length) {
        $(document).on('scroll', function () {
            if ($(this).scrollTop() > 300) {
                $('.dt__uptop').addClass('active');
            } else {
                $('.dt__uptop').removeClass('active');
            }
        }); 
        //Click event to scroll to top
        $(document).on('click', '.dt__uptop', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    }

    $(document).ready(function() {
        // Header Slider        
        var dt__sliderMain = $('.dt__slider-main');
        if (dt__sliderMain.length) {
            dt__sliderMain.owlCarousel({
                rtl: $("html").attr("dir") == 'rtl' ? true : false,
                items: 1,
                margin: 0,
                loop: true,
                dots: $(".dt__slider").is(".dt__slider--three, .dt__slider--four, .dt__slider--five.style2") ? false : true,
                navRewind: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                autoHeight: true,
                autoplay: true,
                autoplayTimeout: 20000,
                smartSpeed: 1000,
                animateIn: false,
                animateOut: 'fadeOut',
                singleItem: true,
                //mouseDrag: false, //please add setting (On = true / Off = false)
                //touchDrag: !$(this).children().length >= 1 ? true : false, //please add setting (On = true / Off = false)
                responsive: {
                    0: {
                        nav: false
                    },
                    880: {                        
                        nav: $(".dt__slider").is(".dt__slider--three, .dt__slider--four, .dt__slider--five.style2") ? true : false
                    }
                }
            });
            dt__sliderMain.owlCarousel();
            dt__sliderMain.on('translate.owl.carousel', function (event) {
                var data_animation = $(".dt__slider-main [data-animation]");
                data_animation.each(function() {
                    var animation_name = $(this).data('animation');
                    $(this).removeClass('animated ' + animation_name).css('opacity', '0');
                });
            });
            $(".dt__slider-main [data-delay]").each(function() {
                var anim_delay = $(this).data('delay');
                $(this).css('animation-delay', anim_delay);
            });
            $(".dt__slider-main [data-duration]").each(function() {
                var anim_duration = $(this).data('duration');
                $(this).css('animation-duration', anim_duration);
            });
            dt__sliderMain.on('translated.owl.carousel', function() {
                var data_animation = dt__sliderMain.find('.owl-item.active').find("[data-animation]");
                data_animation.each(function() {
                    var animation_name = $(this).data('animation');
                    $(this).addClass('animated ' + animation_name).css('opacity', '1');
                });
            });
            if ( $(".dt__slider").hasClass("dt__slider--thumbnav") ) {
                function owlAsSliderMainThumb() {
                    $('.owl-item').removeClass('prev next');
                    var activeSlide = $('.dt__slider-main .owl-item.active');
                    activeSlide.next('.owl-item').addClass('next');
                    activeSlide.prev('.owl-item').addClass('prev');
                    var nextSlideImg = $('.dt__slider-main .owl-item.next').find('.dt__slider-item>img').attr('src');
                    var prevSlideImg = $('.dt__slider-main .owl-item.prev').find('.dt__slider-item>img').attr('src');
                    $('.dt__slider-main .owl-nav .owl-prev').css({
                        backgroundImage: 'url(' + prevSlideImg + ')'
                    });
                    $('.dt__slider-main .owl-nav .owl-next').css({
                        backgroundImage: 'url(' + nextSlideImg + ')'
                    });
                }
                owlAsSliderMainThumb();
                dt__sliderMain.on('translated.owl.carousel', function() {
                    owlAsSliderMainThumb();
                });
            }
        }

        // Service
        if ($('.dt__infoservices-carousel').length) {
            $(".dt__infoservices-carousel").owlCarousel({
                rtl: $("html").attr("dir") == 'rtl' ? true : false,
                items: 1,
                margin: $(".dt__infoservices").hasClass("dt__infoservices--one") ? 0 : 30,
                stagePadding: $(".dt__infoservices").hasClass("dt__infoservices--one") ? 0 : 15,
                loop: true,
                dots: false,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                autoHeight: true,
                autoplay: false,
                autoplayTimeout: 30000,
                smartSpeed: 2000,
                responsive: {
                    0: {
                        items: 1,
                    },
                    576: {
                        items: 2,
                    },
                    992: {
                        items: 3,
                    }
                }
            });
        }

       
        // Posts Carousel
        if ($('.dt__posts-carousel').length) {
            $(".dt__posts-carousel").owlCarousel({
                rtl: $("html").attr("dir") == 'rtl' ? true : false,
                items: 1,
                margin: 30,
                loop: true,
                dots: true,
                nav: false,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                autoHeight: true,
                autoplay: false,
                autoplayTimeout: 30000,
                smartSpeed: 2000,
                stagePadding: 15,
                responsive: {
                    0: {
                        items: 1,
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: 3,
                    }
                }
            });
        }

        // dt__infoservices-row
        if ($('.dt__infoservices-row .dt__infoservices-block').length) {
            $('.dt__infoservices-row .dt__infoservices-block').each(function(){
                $(this).hover(function(){$(this).parents('.dt__infoservices-row').find('.dt__infoservices-block').removeClass('active');$(this).addClass('active');});
            });
        }

    });

})(jQuery);