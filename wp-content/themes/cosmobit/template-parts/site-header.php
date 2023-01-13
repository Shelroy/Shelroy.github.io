<?php  
// Preloader
do_action('cosmobit_site_preloader'); 	

// Header Image
do_action('cosmobit_wp_hdr_image'); 
$cosmobit_hs_hdr_sticky = get_theme_mod( 'cosmobit_hs_hdr_sticky','1');
?>
 <!--=== / Start: As--Header (Topbar + Navbar (Mobile Menu)) / === -->
    <header id="dt__header" class="dt__header header--three">
        <div class="dt__header-topbar dt-d-lg-block dt-d-none">
            <?php do_action('cosmobit_site_header'); ?>
        </div>
        <div class="dt__header-navwrapper">
            <div class="dt__header-navwrapperinner">
                <!--=== / Start: As--Navbar / === -->
                <div class="dt__navbar dt-d-none dt-d-lg-block">
                    <div class="dt__navbar-wrapper <?php if($cosmobit_hs_hdr_sticky=='1'): esc_attr_e('is--sticky','cosmobit'); endif; ?>">
                        <div class="dt-container">
                            <div class="dt-row">
                                <div class="dt-col-2 dt-my-auto">
                                    <div class="site--logo">
                                       <?php do_action('cosmobit_site_logo'); ?>
                                    </div>
                                </div>
                                <div class="dt-col-10 dt-my-auto">
                                    <div class="dt__navbar-menu">
                                        <nav class="dt__navbar-nav">
                                            <?php do_action('cosmobit_site_header_navigation'); ?>
                                        </nav>
                                        <div class="dt__navbar-right">
                                            <ul class="dt__navbar-list-right">
                                                <?php do_action('cosmobit_woo_cart'); ?>
                                                <?php do_action('cosmobit_site_main_search'); ?>
                                                <?php do_action('cosmobit_header_button'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=== / End: As--Navbar / === -->
                <!--=== / Start: As--Mobile Menu / === -->
                <div class="dt__mobilenav <?php if($cosmobit_hs_hdr_sticky=='1'): esc_attr_e('is--sticky','cosmobit'); endif; ?> dt-d-lg-none">
                    <div class="dt__mobilenav-topbar">                              
                        <button type="button" class="dt__mobilenav-topbar-toggle"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
                        <div class="dt__mobilenav-topbar-content">
                            <div class="dt-container">
                                <div class="dt-row">
                                    <div class="dt-col-12">
                                        <?php do_action('cosmobit_site_header'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dt-container">
                        <div class="dt-row">
                            <div class="dt-col-12">
                                <div class="dt__mobilenav-menu">
                                    <div class="dt__mobilenav-logo">
                                        <div class="site--logo">
                                            <?php do_action('cosmobit_site_logo'); ?>
                                        </div>
                                    </div>
                                    <div class="dt__mobilenav-toggles">
                                        <div class="dt__mobilenav-right">
                                            <ul class="dt__navbar-list-right">
                                                <?php do_action('cosmobit_site_main_search'); ?>
                                                <?php do_action('cosmobit_header_button'); ?>
                                            </ul>
                                        </div>
                                        <div class="dt__mobilenav-mainmenu">
                                            <button type="button" class="hamburger dt__mobilenav-mainmenu-toggle">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dt__mobilenav-mainmenu-content">
                                                <div class="off--layer"></div>
                                                <div class="dt__mobilenav-mainmenu-inner">
                                                    <button type="button" class="dt__header-closemenu site--close"></button>
                                                    <?php do_action('cosmobit_site_header_navigation'); ?>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                <!--=== / End: As--Mobile Menu / === -->
            </div>
        </div>
    </header>