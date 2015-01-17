<?php

/* ---------------------------------------------------------
	Enqueue CSS / JS
--------------------------------------------------------- */

// Enqueue Google Fonts

function fullfolio_load_fonts() {

    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700');
    wp_enqueue_style( 'googleFonts');

}
    
add_action('wp_print_styles', 'fullfolio_load_fonts');

// Enqueue Masonry

function fullfolio_insert_masonry(){ wp_enqueue_script('masonry'); }

add_filter('wp_enqueue_scripts','fullfolio_insert_masonry');

// Enqueue CSS / JS

function fullfolio_scripts_and_styles() {
	
	// CSS

	wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', null, 4.1, 'screen' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.min.css', null, 1.0, 'screen' );
	wp_enqueue_style( 'normalize' );

	wp_register_style( 'default', get_template_directory_uri() . '/css/default.css', null, 1.0, 'screen' );
	wp_enqueue_style( 'default' );
	
	wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', null, 1.0, 'screen' );
	wp_enqueue_style( 'main' );
	
	// JS

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2-respond-1.1.0.min.js', null, 2.6, false );
	wp_enqueue_script( 'modernizr' );

	wp_register_script( 'browser', get_template_directory_uri() . '/js/jquery.browser.min.js', null, 1.0, true );
	wp_enqueue_script( 'browser' );
	
	wp_register_script( 'respond', get_template_directory_uri() . '/js/respond.js', null, 1.0, true );
	wp_enqueue_script( 'respond' );

	wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', null, 1.0, true );
	wp_enqueue_script( 'imagesloaded' );
	
	wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', null, 1.0, true );
	wp_enqueue_script( 'fitvids' );
	
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', null, 1.0, true );
	wp_enqueue_script( 'main' );
	
}

add_action( 'wp_enqueue_scripts', 'fullfolio_scripts_and_styles' );

/* ---------------------------------------------------------
	Disable WordPress version
--------------------------------------------------------- */

function fullfolio_remove_generators() { return ''; }

add_filter('the_generator','fullfolio_remove_generators');

/* ---------------------------------------------------------
	Register Menus
--------------------------------------------------------- */

function fullfolio_register_default_menus() {

  register_nav_menus( array( 'main-menu' => __( 'Main Menu', 'fullfolio' ) ) );

}

add_action( 'init', 'fullfolio_register_default_menus' );

function fullfolio_default_menu() { ?>

	<div class="menu-main-menu-container">
		<ul id="menu-main-menu" class="nav">
			<li><?php _e( 'Please create or select a Menu in Appearance / Menus', 'fullfolio' );?></li>
		</ul>
	</div>

<?php }

/* ---------------------------------------------------------
	Register Footer Widget
--------------------------------------------------------- */

if (function_exists('register_sidebar')) {

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'fullfolio' ),
		'id'            => 'fullfolio-footer',
		'description'   => __( 'Appears in the footer section of the site.', 'fullfolio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

}

/* ---------------------------------------------------------
	Theme Customization API
--------------------------------------------------------- */

// Convert HEX to RGB 
function fullfolio_hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );

        $rgb = array($r, $g, $b);
        return implode(",", $rgb);
}

function fullfolio_customize_register( $wp_customize ) {

	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );

	$wp_customize->get_section('title_tagline')->title = __( 'Site Title & Logo', 'fullfolio' );
	$wp_customize->get_section('title_tagline')->description = '';
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_control('display_header_text');

	$wp_customize->add_setting( 'logo' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Image Logo', 'fullfolio'),
        'section'  => 'title_tagline',
        'settings' => 'logo',
    )));	

	$wp_customize->add_section( 'fullfolio_color_scheme', array(
	    'title'          => __( 'Color Scheme', 'fullfolio' ),
	    'priority'       => 35,
	) );    

	// color 1
	$wp_customize->add_setting( 'color_1' , array(
	    'default'     => '#000000',
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_1', array(
		'label'        => __( 'Color 1', 'fullfolio' ),
		'section'    => 'fullfolio_color_scheme',
		'settings'   => 'color_1',
	) ) );

	// color 2
	$wp_customize->add_setting( 'color_2' , array(
	    'default'     => '#666',
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_2', array(
		'label'        => __( 'Color 2', 'fullfolio' ),
		'section'    => 'fullfolio_color_scheme',
		'settings'   => 'color_2',
	) ) );

	// color 3
	$wp_customize->add_setting( 'color_3' , array(
	    'default'     => '#e4e4e4',
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_3', array(
		'label'        => __( 'Color 3', 'fullfolio' ),
		'section'    => 'fullfolio_color_scheme',
		'settings'   => 'color_3',
	) ) );

}

add_action( 'customize_register', 'fullfolio_customize_register' );

function fullfolio_customize_css() { ?>

	<?php if( get_theme_mod('color_1') != '') { ?>

		<style type="text/css">

			body { color:<?php echo get_theme_mod('color_1');?>; }

			a:link, a:visited {
				color:<?php echo get_theme_mod('color_1');?>;
				text-decoration: none;
			}

			a:hover { color:<?php echo get_theme_mod('color_2');?>; }

			.title h3 { color:<?php echo get_theme_mod('color_1');?>; }

			.item { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			.item .mask {
				background:rgb( <?php echo fullfolio_hex2rgb( get_theme_mod('color_1') );?> );
				background-color: rgba(<?php echo fullfolio_hex2rgb( get_theme_mod('color_1') );?>, 0.85);
			}

			.item-no-thumbnail:hover { background:<?php echo get_theme_mod('color_1');?>; }

			.date-item { color:<?php echo get_theme_mod('color_1');?>; }

			.content a:link, .content a:visited { color:<?php echo get_theme_mod('color_1');?>; }

			.content a:hover { color:<?php echo get_theme_mod('color_1');?>; }

			.reply a:link, .reply a:visited { 
				background:<?php echo get_theme_mod('color_1');?>;
				border:solid 1px <?php echo get_theme_mod('color_1');?>; 
				color:#FFF;
			}

			.reply a:hover { 
				color:<?php echo get_theme_mod('color_1');?>;
				background:#FFF; 
			}

			input[type="submit"] { 
				background:<?php echo get_theme_mod('color_1');?>;
				border:solid 1px <?php echo get_theme_mod('color_1');?>; 
			}

			input[type="submit"]:hover { color:<?php echo get_theme_mod('color_1');?>; }

			footer { background:<?php echo get_theme_mod('color_1');?>; }

			ul.nav a:link, ul.nav a:visited { color: <?php echo get_theme_mod('color_1');?>; }

			ul.nav a:hover { color: <?php echo get_theme_mod('color_2');?>; }			

			ul.nav li.current-menu-item a:link, ul.nav li.current-menu-item a:visited { color: <?php echo get_theme_mod('color_2');?>; }

			.header-container { border-bottom:solid 1px <?php echo get_theme_mod('color_3');?>; }

			.comment { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			.reply a:hover { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			input { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			textarea { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			input[type="submit"]:hover { border:solid 1px <?php echo get_theme_mod('color_3');?>; }

			ul.nav li { border-top: solid 1px <?php echo get_theme_mod('color_3');?>; }

			@media only screen and (min-width: 768px) {

				ul.nav li { border-top: none; }

			}

		</style>

	<?php } ?>

<?php }

add_action( 'wp_head', 'fullfolio_customize_css');

/* ---------------------------------------------------------
	Options Meta Box
--------------------------------------------------------- */

add_action( 'add_meta_boxes', 'fullfolio_meta_box_add' );

function fullfolio_meta_box_add() {

    add_meta_box( 'fullfolio-options-box', 'FullFolio Options', 'fullfolio_meta_box_cb', 'post', 'normal', 'high' );
    add_meta_box( 'fullfolio-options-box', 'FullFolio Options', 'fullfolio_meta_box_cb', 'page', 'normal', 'high' );

}

function fullfolio_meta_box_cb( $post ) { 

	$values = get_post_custom( $post->ID );
	$selected = isset( $values['fullfolio_meta_box_select'] ) ? esc_attr( $values['fullfolio_meta_box_select'][0] ) : '';

	?>

    <p>
        <label for="fullfolio_meta_box_select"><?php echo __( 'Layout', 'fullfolio' );?></label>
        <select name="fullfolio_meta_box_select" id="fullfolio_meta_box_select">
            <option value="2" <?php selected( $selected, '2' ); ?>><?php echo __( 'Two Columns', 'fullfolio' );?></option>
            <option value="1" <?php selected( $selected, '1' ); ?>><?php echo __( 'One Column', 'fullfolio' );?></option>
        </select>
    </p>

<?php }

add_action( 'save_post', 'fullfolio_meta_box_save' );

function fullfolio_meta_box_save( $post_id ) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
         
    if( isset( $_POST['fullfolio_meta_box_select'] ) )
        update_post_meta( $post_id, 'fullfolio_meta_box_select', esc_attr( $_POST['fullfolio_meta_box_select'] ) );

}


/* ---------------------------------------------------------
	Images support
--------------------------------------------------------- */

// Add thumbnail support
add_theme_support( 'post-thumbnails' );

// Image sizes
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'fullfolio-thumb', 770, 9999, false );
}

/**
* Get post media images
*
* Usage:
* if ($images = fullfolio_get_images( TRUE )) { // exclude featured image 
*	foreach ($images as $image) {
*		$url = wp_get_attachment_url($image->ID);
*       $img = wp_get_attachment_image($image->ID, 'full');
*	}
* }
* 
* @param boolean $exclude Exclude Featured image
* @return array 
*/
function fullfolio_get_images($exclude = FALSE) {
	
	global $post;

	if($exclude == FALSE) {

		$thumb_ID = '';

	} else {

		$thumb_ID = get_post_thumbnail_id( $post->ID );

	}
	
	return get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'exclude' => $thumb_ID) );

}

/* ---------------------------------------------------------
	Load more posts
	based on https://github.com/tokmak/wp-load-more-ajax
--------------------------------------------------------- */

function dt_add_main_js(){
  
	wp_register_script( 'main-js', get_template_directory_uri() . '/js/load-more-posts.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'main-js' );
	wp_localize_script( 'main-js', 'headJS', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'templateurl' => get_template_directory_uri(), 'posts_per_page' => get_option('posts_per_page') ) );
  
}

add_action( 'wp_enqueue_scripts', 'dt_add_main_js', 90);
add_action( "wp_ajax_load_more", "load_more_func" );
add_action( "wp_ajax_nopriv_load_more", "load_more_func" );

function load_more_func() {

    if ( !wp_verify_nonce( $_REQUEST['nonce'], "load_posts" ) ) {
      exit("No naughty business please");
    }

  	$offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
  	$posts_per_page = isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):10;
	$post_type = isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'post';
  
	ob_start();
 	
  	$args = array(
	  	'post_type'=>$post_type,
		'offset' => $offset,
		'posts_per_page' => $posts_per_page,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'publish'
	);	

  	$posts_query = new WP_Query( $args );
  
  	if ($posts_query->have_posts()) {

		$result['have_posts'] = true;

		while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

			<?php
		        $cats = get_the_category();
		        $arr = array();

		        foreach ($cats as $cat) {

		        	array_push($arr, $cat->name);

		        }

		        $cats_arr = implode(', ', $arr);
		    ?>

		    <!-- item -->
			<?php get_template_part( 'template', 'item' ); ?> 
			<!-- /item -->


		<?php endwhile;

		$result['html'] = ob_get_clean();

  	} else {

	  $result['have_posts'] = false;

  	}

   	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    	$result = json_encode($result);
        echo $result;

    } else { 

        header("Location: ".$_SERVER["HTTP_REFERER"]);

    }

	die();

}

/* ---------------------------------------------------------
	Set up the content width value based on the theme's design
--------------------------------------------------------- */

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/* ---------------------------------------------------------
	comment-reply script enqueued
--------------------------------------------------------- */

if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

/* ---------------------------------------------------------
	remove text below comment entry box
--------------------------------------------------------- */

add_filter('comment_form_defaults', 'fullfolio_remove_comment_styling_prompt');

function fullfolio_remove_comment_styling_prompt($defaults) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}


/* ---------------------------------------------------------
	automatic-feed-links theme support
--------------------------------------------------------- */

add_theme_support( 'automatic-feed-links' );


/* ---------------------------------------------------------
	Internationalizing Localizing
--------------------------------------------------------- */

function fullfolio_theme_setup(){

    load_theme_textdomain('fullfolio', get_template_directory() . '/languages');

}

add_action('after_setup_theme', 'fullfolio_theme_setup');



