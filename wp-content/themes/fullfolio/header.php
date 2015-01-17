<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

        <!-- loading -->
        <div id="post-loading">
            <div class="wrapperloading">
              <div class="loading up"></div>
              <div class="loading down"></div>
            </div>
        </div>
        <!-- /loading --> 

        <!-- header -->
        <div class="header-container">

            <h1 class="logo">
                <a href="<?php echo site_url();?>">
                
                <?php if( get_theme_mod( 'logo' ) == '') { ?>

                    <?php bloginfo( 'name' ); ?>

                <?php } else { ?>                   

                    <img src="<?php echo get_theme_mod( 'logo' );?>">

                <?php } ?>
                                    
                </a>
            </h1>

            <div class="mobile-button">
                <i class="fa fa-bars fa-2x"></i> 
            </div>

        </div>
        <!-- /header -->

        <!-- main menu -->
        <?php wp_nav_menu( array('menu' => 'Main Menu', 'menu_class' => 'nav', 'theme_location' => 'main-menu', 'fallback_cb' => 'fullfolio_default_menu',) ); ?>
        <!-- /main menu -->

