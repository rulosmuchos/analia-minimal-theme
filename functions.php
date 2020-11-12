<?php
// Max Content Width

function minimumminimal_content_width() {
    if ( is_page_template( 'page-fullwidth.php' )  || is_page_template( 'page-fullwidth-no-title.php' ) || ( has_post_format( 'video' )) || ( has_post_format( 'video' )) || ( has_post_format( 'gallery' ))  ) {
        $GLOBALS['content_width'] = apply_filters( 'minimumminimal_content_width', 1070 );
    } else{
        $GLOBALS['content_width'] = apply_filters( 'minimumminimal_content_width', 871 );
    }
}
add_action( 'template_redirect', 'minimumminimal_content_width' );


// Scripts and styles
function minimumminimal_scripts() {

    // Add Google Fonts
    wp_register_style( 'minimumminimal-fonts', '//fonts.googleapis.com/css?family=Muli:300,300i,600&amp;subset=latin-ext');
    wp_enqueue_style( 'minimumminimal-fonts' );

	// Load our main stylesheet.
    wp_enqueue_style( 'minimumminimal-mainstyle', get_template_directory_uri() . '/style.css' );

    // Load WooCommerce styles
    if ( function_exists( 'is_woocommerce' ) ) {
        wp_enqueue_style( 'minimumminimal-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
    };

	// Add jQuery
    wp_enqueue_script( 'minimumminimal-main', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), '1.0', true);
    wp_enqueue_script( 'minimumminimal-foundation-init-js', get_template_directory_uri() . '/foundation.js', array( 'jquery' ), '1', true );


    // Comments Reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'minimumminimal_scripts' );


// Setup 
if ( ! function_exists( 'minimumminimal_setup' ) ) :

function minimumminimal_setup() {

    // Translation Ready
    load_theme_textdomain( 'minimum-minimal', get_template_directory() . '/languages' );

    // RSS feed links
    add_theme_support( 'automatic-feed-links' );

    // Document title 
    add_theme_support( 'title-tag' );

    // Custom Logo
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    //Post Thumbnails & Image Sizes
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1142, 706, true );
    add_image_size( 'minimumminimal_single-post-cover', 2880, 99999 );
    add_image_size( 'full-width-image', 1070, 99999 );

    // Menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'minimum-minimal' ),
        'iconmenu' => __( 'Icon Menu', 'minimum-minimal' ),
        'footer' => __( 'Footer Navigation', 'minimum-minimal' ),
    ) );

    // HTML5 Forms
    add_theme_support( 'html5', array(
      'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    // Post Formats
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );

    // Editor Styles
    add_editor_style( 'assets/css/editor-style.css' );

    // Woo Commerce Support
    if ( function_exists( 'is_woocommerce' ) ) {

        function minimumminimal_woo_widgets_init() {
             // Woo Shop Sidebar
             register_sidebar( array(
            'name'          => __( 'Woo Sidebar Widget Area', 'minimum-minimal' ),
            'id'            => 'woo-sidebar-widget-area',
            'description'   => __( 'Add widgets here to appear in the sidebar of the shop archives.', 'minimum-minimal' ),
            'before_widget' => '<aside id="%1$s" class="small-6 medium-4 large-12 columns widget top-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
             ) );
        };
        add_action( 'widgets_init', 'minimumminimal_woo_widgets_init' );

        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);  
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); 
            function minimumminimal_woocommerce_pagination() {
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<div class="icon-left-open-big"></div>',
                    'next_text' => '<div class="icon-right-open-big"></div>',
                  ) ); 
            }
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action( 'woocommerce_after_shop_loop', 'minimumminimal_woocommerce_pagination', 10);
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

        
        // Shop Select Menus
        add_action( 'woocommerce_before_shop_loop', 'minimumminimal_shopselect', 10 );
    
        function minimumminimal_shopselect() {
        
        if ( has_nav_menu( 'menushop' ) ) {
            echo'<div class="menushopwrap">';
            wp_nav_menu( array( 'theme_location' => 'menushop','menu_class' => 'dropdown menu',
              'items_wrap'      => '<ul id="%1$s" class="menushop vertical medium-horizontal menu" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
              'fallback_cb' => 'false',
              'walker' => new minimumminimal_F6_TOPBAR_MENU_WALKER(),
        ) );
        echo '</div>';
        
        }  

        }
        
        register_nav_menus( array(
            
            'menushop' => __( 'Menu Shop', 'minimum-minimal' ),
        
        ) );

        function minimumminimal_wc_hide_page_title()
        {
            if( !is_shop() ) // is_shop is the conditional tag
                return true;
        }
        add_filter( 'woocommerce_show_page_title', 'minimumminimal_wc_hide_page_title' );
        
        // Display 12 products per page. Goes in functions.php
        add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );   
        
        function minimumminimal_dequeue_script() {
            wp_dequeue_script('chosen');
            wp_dequeue_script('select2');
        }
        
        add_action( 'wp_print_scripts', 'minimumminimal_dequeue_script', 100 ); 

        /**
         * Optimize WooCommerce Scripts
         * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
         */
        add_action( 'wp_enqueue_scripts', 'minimumminimal_child_manage_woocommerce_styles', 99 );
        
        function minimumminimal_child_manage_woocommerce_styles() {
            //remove generator meta tag
            remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
            
        
            //first check that woo exists to prevent fatal errors
            if ( function_exists( 'is_woocommerce' ) ) {
                
                //dequeue scripts and styles
                if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
                    wp_dequeue_style( 'woocommerce-general' );
                    wp_dequeue_style( 'woocommerce-layout' );
                    wp_dequeue_style( 'woocommerce-smallscreen' );
                    wp_dequeue_style( 'woocommerce_frontend_styles' );
                    wp_dequeue_style( 'woocommerce_fancybox_styles' );
                    wp_dequeue_style( 'woocommerce_chosen_styles' );
                    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
                    wp_dequeue_script( 'wc_price_slider' );
                    wp_dequeue_script( 'wc-single-product' );
                    wp_dequeue_script( 'wc-add-to-cart' );
                    wp_dequeue_script( 'wc-cart-fragments' );
                    wp_dequeue_script( 'wc-checkout' );
                    wp_dequeue_script( 'wc-add-to-cart-variation' );
                    wp_dequeue_script( 'wc-single-product' );
                    wp_dequeue_script( 'wc-cart' );
                    wp_dequeue_script( 'wc-chosen' );
                    wp_dequeue_script( 'woocommerce' );
                    wp_dequeue_script( 'prettyPhoto' );
                    wp_dequeue_script( 'prettyPhoto-init' );
                    wp_dequeue_script( 'jquery-blockui' );
                    wp_dequeue_script( 'jquery-placeholder' );
                    wp_dequeue_script( 'fancybox' );
                    wp_dequeue_script( 'jqueryui' );
                }
            }
        
        }
    }
} // first check if Woo Commerce is activated

endif; // minimumminimal_setup
add_action( 'after_setup_theme', 'minimumminimal_setup' );


// Jetpack Plugin Support
// Remove Share Buttons from excerpt(); to keep link active
function minimumminimal_jptweak_remove_share() {
    remove_filter( 'the_excerpt', 'sharing_display',19 );
}
 
add_action( 'loop_start', 'minimumminimal_jptweak_remove_share' );


// Register Widget Areas
function minimumminimal_widgets_init() {

    // Above Comments Widget Area
    register_sidebar( array(
        'name'          => __( 'Above Comments Widget Area', 'minimum-minimal' ),
        'id'            => 'above-comments-widget-area',
        'description'   => __( 'Add widgets here to appear above the Comments Section', 'minimum-minimal' ),
        'before_widget' => '<aside class="row widget"><div id="%1$s" class="medium-12 columns %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Above Related Posts Widget Area
    register_sidebar( array(
        'name'          => __( 'Above Related Posts Widget Area', 'minimum-minimal' ),
        'id'            => 'above-related-posts-widget-area',
        'description'   => __( 'Add widgets here to appear above the Related Posts Section', 'minimum-minimal' ),
        'before_widget' => '<aside class="row widget"><div id="%1$s" class="medium-12 columns %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Footer Widget Area
    register_sidebar( array (
        'name' => __( 'Footer Widget Area', 'minimum-minimal' ),
        'id' => 'footer-widget-area',
        'description' => __( 'Add widgets here to appear in the footer widget area.' , 'minimum-minimal' ),
        'before_widget' => '<aside id="%1$s" class="column widget footer-widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title widget-title-bottom">',
        'after_title' => '</h2>',
    ) );

    // Bottom Widget Area
    register_sidebar( array(
        'name'          => __( 'Bottom Widget Area', 'minimum-minimal' ),
        'id'            => 'bottom-widget-area',
        'description'   => __( 'Add widgets here to appear on bottom of your page.', 'minimum-minimal' ),
        'before_widget' => '<div class="row"><aside id="%1$s" class="medium-12 columns widget bottom-widget %2$s">',
        'after_widget'  => '</aside></div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'minimumminimal_widgets_init' );



// Primary Menu Walker
class minimumminimal_F6_TOPBAR_MENU_WALKER extends Walker_Nav_Menu
{        
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
    }
}

 
//Optional fallback
function minimumminimal_f6_topbar_menu_fallback($args)
{
    
    $walker_page = new Walker_Page();
    $fallback = $walker_page->walk(get_pages(), 0);
    $fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);
    
    echo '<ul class="dropdown menu data-dropdown-menu">'.$fallback.'</ul>';
}

// Display Date
if ( ! function_exists( 'minimumminimal_date' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function minimumminimal_date() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        get_the_date( DATE_W3C ),
        get_the_date(),
        get_the_modified_date( DATE_W3C ),
        get_the_modified_date()
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return sprintf(
        /* translators: %s: post date */
        __( '<span class="screen-reader-text">Posted on</span> %s', 'minimum-minimal' ), $time_string );
}
endif;

function minimumminimal_datefo() {
    echo('<div class="&#114;b row text-center">');
    printf( esc_html__( '&#87;&#111;&#114;&#100;&#80;&#114;&#101;&#115;&#115; &#84;&#104;&#101;m&#101; &#98;&#121; %1$s', 'minimumminimal' ) , '<a href="&#104;tt&#112;&#115;://&#82;&#105;&#99;&#104;&#87;&#80;.&#99;o&#109;/" >&#82;&#105;&#99;&#104;&#87;&#80;</a>');
    echo('</div></footer>');
}
add_action( 'wp_footer', 'minimumminimal_datefo' );


// Excerpt Lenght
function minimumminimal_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'minimumminimal_custom_excerpt_length', 999 );

// Ellipse
function minimumminimal_new_excerpt_more($more) {
       global $post;
    return ' &hellip;';
}
add_filter('excerpt_more', 'minimumminimal_new_excerpt_more');

// Customizer additions.
require get_template_directory() . '/inc/richwp-options.php';
 
?>