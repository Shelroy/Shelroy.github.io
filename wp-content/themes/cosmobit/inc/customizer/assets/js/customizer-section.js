( function( api ) {
	// Extends our custom "example-1" section.
	api.sectionConstructor['plugin-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );
} )( wp.customize );

function cosmobitfrontpagesectionsnavigattion( cosmobit_section_id ){
    var navigation_id = "dt__slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( cosmobit_section_id ) {
        case 'accordion-section-information_options':
        navigation_id = "information_options";
        break;
		
        case 'accordion-section-service_options':
        navigation_id = "service_options";
        break;
		
		case 'accordion-section-cta2_options':
        navigation_id = "cta2_options";
        break;
		
		case 'accordion-section-why_choose_options':
        navigation_id = "why_choose_options";
        break;
		
		case 'accordion-section-blog_options':
        navigation_id = "blog_options";
        break;
		
		 case 'accordion-section-information3_options':
        navigation_id = "information3_options";
        break;
		
		case 'accordion-section-service3_options':
        navigation_id = "service3_options";
        break;
		
		case 'accordion-section-cta2_options':
        navigation_id = "cta2_options";
        break;
		
		case 'accordion-section-blog3_options':
        navigation_id = "blog3_options";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}


function cosmobitfrontpage2sectionsscroll( cosmobit_section_id ){
    var navigation_id = "dt__slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( cosmobit_section_id ) {
        case 'accordion-section-information2_options':
        navigation_id = "information2_options";
        break;
		
		case 'accordion-section-service2_options':
        navigation_id = "service2_options";
        break;
		
		case 'accordion-section-cta3_options':
        navigation_id = "cta3_options";
        break;
		
		
		case 'accordion-section-blog2_options':
        navigation_id = "blog2_options";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}

function cosmobitfrontpage4sectionsscroll( cosmobit_section_id ){
    var navigation_id = "dt__slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( cosmobit_section_id ) {
        case 'accordion-section-information4_options':
        navigation_id = "information4_options";
        break;
		
		case 'accordion-section-service4_options':
        navigation_id = "service4_options";
        break;
		
		case 'accordion-section-why_choose4_options':
        navigation_id = "why_choose4_options";
        break;
		
		case 'accordion-section-blog4_options':
        navigation_id = "blog4_options";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}


function cosmobitfrontpage5sectionsscroll( cosmobit_section_id ){
    var navigation_id = "dt__slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( cosmobit_section_id ) {
        case 'accordion-section-funfact6_options':
        navigation_id = "funfact6_options";
        break;
		
		case 'accordion-section-service5_options':
        navigation_id = "service5_options";
        break;
		
		case 'accordion-section-blog5_options':
        navigation_id = "blog5_options";
        break;
		
		case 'accordion-section-cta5_options':
        navigation_id = "cta5_options";
        break;
		
		case 'accordion-section-information5_options':
        navigation_id = "information5_options";
        break;
		
		case 'accordion-section-about5_options':
        navigation_id = "about5_options";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}


 jQuery('body').on('click', '#sub-accordion-panel-cosmobit_frontpage_options .control-subsection .accordion-section-title', function(event) {
        var cosmobit_section_id = jQuery(this).parent('.control-subsection').attr('id');
        cosmobitfrontpagesectionsnavigattion( cosmobit_section_id );
});

 jQuery('body').on('click', '#sub-accordion-panel-cosmobit_frontpage2_options .control-subsection .accordion-section-title', function(event) {
        var cosmobit_section_id = jQuery(this).parent('.control-subsection').attr('id');
        cosmobitfrontpage2sectionsscroll( cosmobit_section_id );
});

 jQuery('body').on('click', '#sub-accordion-panel-cosmobit_frontpage4_options .control-subsection .accordion-section-title', function(event) {
        var cosmobit_section_id = jQuery(this).parent('.control-subsection').attr('id');
        cosmobitfrontpage4sectionsscroll( cosmobit_section_id );
});

 jQuery('body').on('click', '#sub-accordion-panel-cosmobit_frontpage5_options .control-subsection .accordion-section-title', function(event) {
        var cosmobit_section_id = jQuery(this).parent('.control-subsection').attr('id');
        cosmobitfrontpage5sectionsscroll( cosmobit_section_id );
});