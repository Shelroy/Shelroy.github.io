/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
     * Outputs custom css for responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @param  {String} ext css value extension eg: px, in
     * @return {[string]} css output
     */
    function range_live_media_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	$(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.cs-range-value').html(val);
            $(this).val(val);
        });
    })
	
	
	/**
	 * hdr_logo_size
	 */
	range_live_media_load( 'hdr_logo_size', '.site--logo img', [ 'max-width' ], 'px !important' );
	
	//cosmobit_hdr_contact_title
	wp.customize(
		'cosmobit_hdr_contact_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt__header-widget .contact1 .contact__body .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_hdr_email_title
	wp.customize(
		'cosmobit_hdr_email_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt__header-widget .contact2 .contact__body .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_hdr_top_mbl_title
	wp.customize(
		'cosmobit_hdr_top_mbl_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt__header-widget .contact3 .contact__body .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_hdr_top_time_title
	wp.customize(
		'cosmobit_hdr_top_time_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt__header-widget .contact4 .contact__body .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_hdr_btn_lbl
	wp.customize(
		'cosmobit_hdr_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt__navbar-button-item a' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service_ttl
	wp.customize(
		'cosmobit_service_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--service .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service_subttl
	wp.customize(
		'cosmobit_service_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--service .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service_text
	wp.customize(
		'cosmobit_service_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--service .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta2_text
	wp.customize(
		'cosmobit_cta2_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--cta2 .dt__siteheading h2.title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta2_btn_lbl
	wp.customize(
		'cosmobit_cta2_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--cta2  a.dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_left_ttl
	wp.customize(
		'cosmobit_why_choose_left_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-left .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_left_subttl
	wp.customize(
		'cosmobit_why_choose_left_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-left h2.title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_left_text
	wp.customize(
		'cosmobit_why_choose_left_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-left .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_left_f_ttl
	wp.customize(
		'cosmobit_why_left_f_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-left .media-body h5.media-title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_left_f_text
	wp.customize(
		'cosmobit_why_left_f_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-left .media-body .media-content' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_why_choose_right_ttl
	wp.customize(
		'cosmobit_why_choose_right_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-right .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_right_subttl
	wp.customize(
		'cosmobit_why_choose_right_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-right .dt__siteheading .title.head-ttl' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_right_text
	wp.customize(
		'cosmobit_why_choose_right_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-right .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_right_f_text
	wp.customize(
		'cosmobit_why_choose_right_f_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-right .dt__about-cta .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose_right_f_btn_lbl
	wp.customize(
		'cosmobit_why_choose_right_f_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--why .why-right .dt__about-cta a.dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog_ttl
	wp.customize(
		'cosmobit_blog_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--blog .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog_subttl
	wp.customize(
		'cosmobit_blog_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--blog .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog_text
	wp.customize(
		'cosmobit_blog_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front1--blog .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service2_ttl
	wp.customize(
		'cosmobit_service2_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--service .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service2_subttl
	wp.customize(
		'cosmobit_service2_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--service .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service2_text
	wp.customize(
		'cosmobit_service2_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--service .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta3_text
	wp.customize(
		'cosmobit_cta3_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--cta .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta3_btn_lbl
	wp.customize(
		'cosmobit_cta3_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--cta .btn-dt a' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog2_ttl
	wp.customize(
		'cosmobit_blog2_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--blog .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog2_subttl
	wp.customize(
		'cosmobit_blog2_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--blog .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog2_text
	wp.customize(
		'cosmobit_blog2_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front2--blog .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service4_ttl
	wp.customize(
		'cosmobit_service4_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--service .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service4_subttl
	wp.customize(
		'cosmobit_service4_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--service .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service4_text
	wp.customize(
		'cosmobit_service4_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--service .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose4_left_ttl
	wp.customize(
		'cosmobit_why_choose4_left_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-left .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose4_left_subttl
	wp.customize(
		'cosmobit_why_choose4_left_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-left h2.title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose4_left_text
	wp.customize(
		'cosmobit_why_choose4_left_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-left .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why4_left_f_ttl
	wp.customize(
		'cosmobit_why4_left_f_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-left .media-body h5.media-title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why4_left_f_text
	wp.customize(
		'cosmobit_why4_left_f_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-left .media-body .media-content' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_why_choose4_right_ttl
	wp.customize(
		'cosmobit_why_choose4_right_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-right .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose4_right_subttl
	wp.customize(
		'cosmobit_why_choose4_right_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-right .dt__siteheading .title.head-ttl' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_why_choose4_right_text
	wp.customize(
		'cosmobit_why_choose4_right_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--why .why-right .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog4_ttl
	wp.customize(
		'cosmobit_blog4_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--blog .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog4_subttl
	wp.customize(
		'cosmobit_blog4_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--blog .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog4_text
	wp.customize(
		'cosmobit_blog4_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front4--blog .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_information3_ttl
	wp.customize(
		'cosmobit_information3_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--info .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_information3_subttl
	wp.customize(
		'cosmobit_information3_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--info .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_information3_text
	wp.customize(
		'cosmobit_information3_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--info .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_service3_ttl
	wp.customize(
		'cosmobit_service3_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--service .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service3_subttl
	wp.customize(
		'cosmobit_service3_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--service .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service3_text
	wp.customize(
		'cosmobit_service3_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--service .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog3_ttl
	wp.customize(
		'cosmobit_blog3_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--blog .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog3_subttl
	wp.customize(
		'cosmobit_blog3_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--blog .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog3_text
	wp.customize(
		'cosmobit_blog3_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front3--blog .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service5_ttl
	wp.customize(
		'cosmobit_service5_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--service .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service5_subttl
	wp.customize(
		'cosmobit_service5_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--service .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_service5_text
	wp.customize(
		'cosmobit_service5_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--service .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_blog5_ttl
	wp.customize(
		'cosmobit_blog5_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--blog .dt__siteheading .subtitle' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog5_subttl
	wp.customize(
		'cosmobit_blog5_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--blog .dt__siteheading .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_blog5_text
	wp.customize(
		'cosmobit_blog5_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--blog .dt__siteheading .text' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta5_text
	wp.customize(
		'cosmobit_cta5_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--cta .dt__siteheading h2.title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_cta5_btn_lbl
	wp.customize(
		'cosmobit_cta5_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--cta  a.dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_about5_right_ttl
	wp.customize(
		'cosmobit_about5_right_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--about .dt__about-content .subtitle' ).text( newval );
				}
			);
		}
	);
	
	
	//cosmobit_about5_right_subttl
	wp.customize(
		'cosmobit_about5_right_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--about .dt__about-content .title' ).text( newval );
				}
			);
		}
	);
	
	//cosmobit_about5_right_text
	wp.customize(
		'cosmobit_about5_right_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front5--about .dt__about-content .text' ).text( newval );
				}
			);
		}
	);
	
	/**
	 * Container Width
	 */
	wp.customize( 'cosmobit_site_container_width', function( value ) {
		
		value.bind( function( cosmobit_site_container_width ) {
			var class_name      = 'cosmobit_site_container_width'; // Used as id in gfont link
			var css_class       = $( '.' + class_name );			
			
			if (cosmobit_site_container_width >= 768 && cosmobit_site_container_width < 2000){
				var head_append     = '<style class="' + class_name + '">.dt-container{ max-width: ' + cosmobit_site_container_width + 'px;}</style>';
			}

			if ( css_class.length ) {
				css_class.replaceWith( head_append );
			} else {
				$( 'head' ).append( head_append );
			}
			
		});
		
	} );
	
	/**
	 * Breadcrumb Typography
	 */
	range_live_media_load( 'cosmobit_breadcrumb_height_option', '.dt__pagetitle', [ 'padding-top' ], 'rem' );
	range_live_media_load( 'cosmobit_breadcrumb_height_option', '.dt__pagetitle', [ 'padding-bottom' ], 'rem' );
	
	/**
	 * Body font size
	 */
	
	range_live_media_load( 'cosmobit_body_font_size_option', 'body', [ 'font-size' ], 'px' );
	
	/**
	 * Body Letter Spacing
	 */
	
	range_live_media_load( 'cosmobit_body_ltr_space_option', 'body', [ 'letter-spacing' ], 'px' );
	
	/**
	 * Body font weight
	 */
	wp.customize( 'cosmobit_body_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'body' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * Body font style
	 */
	wp.customize( 'cosmobit_body_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'body' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * Body Text Decoration
	 */
	wp.customize( 'cosmobit_body_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'body, a' ).css( 'text-decoration', decoration );
		} );
	} );
	/**
	 * Body text tranform
	 */
	wp.customize( 'cosmobit_body_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'body' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * cosmobit_body_line_height
	 */
	range_live_media_load( 'cosmobit_body_line_height_option', 'body', [ 'line-height' ] );
	
	/**
	 * H1 font family
	 */
	wp.customize( 'cosmobit_h1_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h1' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H1 font size
	 */
	range_live_media_load( 'cosmobit_h1_font_size_option', 'h1', [ 'font-size' ], 'px' );
	
	/**
	 * H1 font style
	 */
	wp.customize( 'cosmobit_h1_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h1' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H1 Text Decoration
	 */
	wp.customize( 'cosmobit_h1_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h1' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H1 font weight
	 */
	wp.customize( 'cosmobit_h1_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h1' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H1 text tranform
	 */
	wp.customize( 'cosmobit_h1_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h1' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H1 line height
	 */
	range_live_media_load( 'cosmobit_h1_line_height_option', 'h1', [ 'line-height' ] );
	
	/**
	 * H1 Letter Spacing
	 */
	 
	range_live_media_load( 'cosmobit_h1_ltr_space_option', 'h1', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H2 font family
	 */
	wp.customize( 'cosmobit_h2_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h2' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H2 font size
	 */
	range_live_media_load( 'cosmobit_h2_font_size_option', 'h2', [ 'font-size' ], 'px' );
	
	/**
	 * H2 font style
	 */
	wp.customize( 'cosmobit_h2_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h2' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H2 Text Decoration
	 */
	wp.customize( 'cosmobit_h2_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h2' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H2 font weight
	 */
	wp.customize( 'cosmobit_h2_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h2' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H2 text tranform
	 */
	wp.customize( 'cosmobit_h2_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h2' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H2 line height
	 */
	range_live_media_load( 'cosmobit_h2_line_height_option', 'h2', [ 'line-height' ]);
	
	/**
	 * H2 Letter Spacing
	 */
	
	range_live_media_load( 'cosmobit_h2_ltr_space_option', 'h2', [ 'letter-spacing' ], 'px' );
	/**
	 * H3 font family
	 */
	wp.customize( 'cosmobit_h3_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h3' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H3 font size
	 */
	range_live_media_load( 'cosmobit_h3_font_size_option', 'h3', [ 'font-size' ], 'px' );
	
	/**
	 * H3 font style
	 */
	wp.customize( 'cosmobit_h3_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h3' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H3 Text Decoration
	 */
	wp.customize( 'cosmobit_h3_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h3' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H3 font weight
	 */
	wp.customize( 'cosmobit_h3_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h3' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H3 text tranform
	 */
	wp.customize( 'cosmobit_h3_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h3' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H3 line height
	 */
	range_live_media_load( 'cosmobit_h3_line_height_option', 'h3', [ 'line-height' ]);
	
	/**
	 * H3 Letter Spacing
	 */
	
	range_live_media_load( 'cosmobit_h3_ltr_space_option', 'h3', [ 'letter-spacing' ], 'px' );
	
	
	/**
	 * H4 font family
	 */
	wp.customize( 'cosmobit_h4_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h4' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H4 font size
	 */
	range_live_media_load( 'cosmobit_h4_font_size_option', 'h4', [ 'font-size' ], 'px' );
	
	/**
	 * H4 font style
	 */
	wp.customize( 'cosmobit_h4_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h4' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H4 Text Decoration
	 */
	wp.customize( 'cosmobit_h4_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h4' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H4 font weight
	 */
	wp.customize( 'cosmobit_h4_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h4' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H4 text tranform
	 */
	wp.customize( 'cosmobit_h4_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h4' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H4 line height
	 */
	range_live_media_load( 'cosmobit_h4_line_height_option', 'h4', [ 'line-height' ]);
	
	/**
	 * H4 Letter Spacing
	 */
	
		range_live_media_load( 'cosmobit_h4_ltr_space_option', 'h4', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H5 font family
	 */
	wp.customize( 'cosmobit_h5_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h5' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H5 font size
	 */
	range_live_media_load( 'cosmobit_h5_font_size_option', 'h5', [ 'font-size' ], 'px' );
	
	/**
	 * H5 font style
	 */
	wp.customize( 'cosmobit_h5_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h5' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H5 Text Decoration
	 */
	wp.customize( 'cosmobit_h5_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h5' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H5 font weight
	 */
	wp.customize( 'cosmobit_h5_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h5' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H5 text tranform
	 */
	wp.customize( 'cosmobit_h5_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h5' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H5 line height
	 */
	range_live_media_load( 'cosmobit_h5_line_height_option', 'h5', [ 'line-height' ]);
	
	/**
	 * H5 Letter Spacing
	 */
	
	range_live_media_load( 'cosmobit_h5_ltr_space_option', 'h5', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H6 font family
	 */
	wp.customize( 'cosmobit_h6_font_family_option', function( value ) {
		value.bind( function( font_family_option ) {
			jQuery( 'h6' ).css( 'font-family', font_family_option );
		} );
	} );
	
	/**
	 * H6 font size
	 */
	range_live_media_load( 'cosmobit_h6_font_size_option', 'h6', [ 'font-size' ], 'px' );
	
	/**
	 * H6 font style
	 */
	wp.customize( 'cosmobit_h6_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h6' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H6 Text Decoration
	 */
	wp.customize( 'cosmobit_h6_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h6' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H6 font weight
	 */
	wp.customize( 'cosmobit_h6_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h6' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H6 text tranform
	 */
	wp.customize( 'cosmobit_h6_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h6' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H6 line height
	 */
	range_live_media_load( 'cosmobit_h6_line_height_option', 'h6', [ 'line-height' ]);
	
	/**
	 * H6 Letter Spacing
	 */
	
	range_live_media_load( 'cosmobit_h6_ltr_space_option', 'h6', [ 'letter-spacing' ], 'px' );
	
} )( jQuery );