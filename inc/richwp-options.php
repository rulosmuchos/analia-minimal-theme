<?php
// Options Page

	if ( ! function_exists( 'minimumminimal' ) ) :

		function minimumminimal_themeoptions( $name ) {
			$default_theme_options = array(
				'logo' => '',
				'colorhd' => '#FFFFFF',
				'colorhdfont' => '#000000',
				'colorhdfonthover' => '#0066cc',
				'color1' => '#0066cc',
				'colorfontbuttons' => '#FFFFFF',
				'displayrelated' => '',
				'copyright' =>  get_bloginfo( 'name' ),
				'herofeaturedimage' => '',
				'info' => '',
				);
		
			$options = wp_parse_args( get_option( 'minimumminimal' ), $default_theme_options );

			return $options[$name];
		}
	endif;

add_action( 'customize_register', 'minimumminimal_customize_register' );
function minimumminimal_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'minimumminimal_info', array(
		'title' => __( 'Documentation / Upgrade', 'minimum-minimal' ),
		'priority' => 0,
	) );


	$wp_customize->add_setting( 'minimumminimal[info]', array(
		'default' => minimumminimal_themeoptions( 'info' ),
		'sanitize_callback' => 'minimumminimal_sanitize_text_html',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'info', array(
		
		'description' => wp_kses_post(__( '
        <h3>Demo</h3>
        <p>To see what is possible, take a look at the <a target="_blank" href="https://richwp.r1e9.com/minimumminimal" target="_blank">Theme Demo</a></p>
        <h3>Documentation</h3>
        <p>For further information about the installation and setup of this theme and to download the demo content file please visit the <a target="_blank" href="https://richwp.com/manuals/minimum-minimal-theme-installation-manual/" target="_blank">Installation & Setup Guide</a></p>
        <h1>Upgrade</h1>
        <p>Thank you for trying out the Minimum Minimal WordPress Theme. To remove the credit link in the footer and/or get receive help from our theme support, please upgrade to the original <strong>Minimum Minimal Theme</strong>.
        <p><a class="button button-primary" target="_blank" href="https://richwp.com/themes/minimumminimal/" target="_blank">Upgrade</a></p>
        ', 'minimum-minimal' ) ),
		'section' => 'minimumminimal_info',
		'settings' => 'minimumminimal[info]',
		'type' => 'hidden',
		'priority' => 40,
	) );

	$wp_customize->add_section( 'minimumminimal_colors', array(
		'title' => __( 'Colors', 'minimum-minimal' ),
		'priority' => 100,
	) );
	
	$wp_customize->add_setting( 'minimumminimal[colorhd]', array(
		'default' => minimumminimal_themeoptions( 'colorhd' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorhd', array(
		'label'   => __( 'Header Color', 'minimum-minimal' ),
		'section' => 'minimumminimal_colors',
		'settings'   => 'minimumminimal[colorhd]',
		'priority' => 5,
	) ) );
	
	$wp_customize->add_setting( 'minimumminimal[colorhdfont]', array(
		'default' => minimumminimal_themeoptions( 'colorhdfont' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
		
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorhdfont', array(
		'label'   => __( 'Header Font Color', 'minimum-minimal' ),
		'section' => 'minimumminimal_colors',
		'settings'   => 'minimumminimal[colorhdfont]',
		'priority' => 10,
	) ) );

	$wp_customize->add_setting( 'minimumminimal[colorhdfonthover]', array(
		'default' => minimumminimal_themeoptions( 'colorhdfonthover' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
		
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorhdfonthover', array(
		'label'   => __( 'Header Font Hover Color', 'minimum-minimal' ),
		'section' => 'minimumminimal_colors',
		'settings'   => 'minimumminimal[colorhdfonthover]',
		'priority' => 10,
	) ) );

	$wp_customize->add_setting( 'minimumminimal[color1]', array(
		'default' => minimumminimal_themeoptions( 'color1' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color1', array(
		'label'   => __( 'Lead Color', 'minimum-minimal' ),
		'section' => 'minimumminimal_colors',
		'settings'   => 'minimumminimal[color1]',
		'priority' => 20,
	) ) );	
	
	$wp_customize->add_setting( 'minimumminimal[colorfontbuttons]', array(
		'default' => minimumminimal_themeoptions( 'colorfontbuttons' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorfontbuttons', array(
		'label'   => __( 'Button Font Color', 'minimum-minimal' ),
		'section' => 'minimumminimal_colors',
		'settings'   => 'minimumminimal[colorfontbuttons]',
		'priority' => 40,
	) ) );

    $wp_customize->add_section( 'minimumminimal_misc', array(
		'title' => __( 'Misc.', 'minimum-minimal' ),
		'priority' => 120,
	) );

	$wp_customize->add_setting( 'minimumminimal[herofeaturedimage]', array(
		'default' => minimumminimal_themeoptions( 'herofeaturedimage' ),
		'sanitize_callback' => 'minimumminimal_sanitize_checkbox',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( 'minimumminimal[herofeaturedimage]', array(
		'settings' => 'minimumminimal[herofeaturedimage]',
		'label'    => __( 'Display Featured Image on Single Post View', 'minimum-minimal' ),
		'section'  => 'minimumminimal_misc',
		'type'     => 'checkbox',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'minimumminimal[displayrelated]', array(
		'default' => minimumminimal_themeoptions( 'displayrelated' ),
		'sanitize_callback' => 'minimumminimal_sanitize_checkbox',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( 'minimumminimal[displayrelated]', array(
		'settings' => 'minimumminimal[displayrelated]',
		'label'    => __( 'Display Related Posts', 'minimum-minimal' ),
		'section'  => 'minimumminimal_misc',
		'type'     => 'checkbox',
		'priority' => 20,
	) );
	
	$wp_customize->add_setting( 'minimumminimal[copyright]', array(
		'default' => minimumminimal_themeoptions( 'copyright' ),
		'sanitize_callback' => 'minimumminimal_sanitize_text_html',
		'type' => 'option',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'copyright', array(
		'label' => __( 'Copyright Notice in Footer', 'minimum-minimal' ),
		'section' => 'minimumminimal_misc',
		'settings' => 'minimumminimal[copyright]',
		'priority' => 30,
	) );
	
} 

function minimumminimal_sanitize_text_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function minimumminimal_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/* Add CSS */
function minimumminimal_add_styles() {
  if ( ! function_exists( 'get_richicon_font' ) ) {
    $richicon_font = array(
        'base' => get_template_directory_uri()."/font/richicons",
        'version' => '13409119');
  } else {
    $richicon_font = get_richicon_font();
  }
 ?>
<style type="text/css">
@font-face {
  font-family: 'richicons';
  src: url('<?php echo $richicon_font['base'].".eot?".$richicon_font['version']; ?>');
  src: url('<?php echo $richicon_font['base'].".eot?".$richicon_font['version']."#iefix"; ?>') format('embedded-opentype'),
    url('<?php echo $richicon_font['base'].".woff?".$richicon_font['version']; ?>') format('woff'),
    url('<?php echo $richicon_font['base'].".ttf?".$richicon_font['version']; ?>') format('truetype'),
    url('<?php echo $richicon_font['base'].".svg?".$richicon_font['version']."#richicons"; ?>') format('svg');
    font-weight: normal;
    font-style: normal;
  }

#top-menu,
.top-bar ul ul,
ul.submenu {
	background-color:<?php echo esc_attr( minimumminimal_themeoptions('colorhd'));?>;
}

<?php if (minimumminimal_themeoptions('colorhd') == "#ffffff") { ?>.top-bar ul ul, .menushop .is-dropdown-submenu a:hover {background: #f9f9f9;}<?php } ?>

a #sitetitle,
.top-bar a,
.icon-menu,
#iconmenu li:before,
.top-bar ul.submenu a,
.menushop .is-dropdown-submenu a,
.menushop .is-dropdown-submenu a:hover{
	color:<?php echo esc_attr( minimumminimal_themeoptions('colorhdfont'));?>;
}


a,
a:hover,
.top-bar a:hover,
.top-bar .current-menu-item a,
.top-bar ul.submenu a:hover,
#iconmenu li:hover:before,
.postbox a:hover .entry-title,
#copyright a:hover,
#footermenu a:hover,
#footer-widget-area a:hover, 
#top-widget-area a:hover,
.pagination .prev:hover, 
.pagination .next:hover,
.comment-metadata a:hover, 
.fn a:hover
<?php if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() ||  is_checkout() ) { ?>						
		,.woocommerce a.added_to_cart:before, .woocommerce .woocommerce-info::before<?php } }?>
	{
	color:<?php echo esc_attr( minimumminimal_themeoptions('color1'));?>;
}
.none
<?php if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() ||  is_checkout() ) { ?>, 
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
		.woocommerce #payment #place_order,
		.woocommerce-page #payment #place_order,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce button.button,
		.woocommerce button.button:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button,
		.woocommerce-cart a.button,
		.woocommerce-cart a.button:hover,
		.add_to_cart_button:hover,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt<?php } } ?>
	{
	background:<?php echo esc_attr( minimumminimal_themeoptions('color1'));?>;
}
.button,
.button:hover, 
.button:focus,
.add_to_cart_button:hover,
.add_to_cart_button:focus
<?php if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() ||  is_checkout() ) { ?>,
		.woocommerce ul.products li.product .button,
		.woocommerce input.button:hover,
		.woocommerce span.onsale<?php } } ?>
{
	background-color:<?php echo esc_attr( minimumminimal_themeoptions('color1'));?>;
	color: <?php echo esc_attr( minimumminimal_themeoptions('colorfontbuttons'));?>;
}
<?php if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() ||  is_checkout() ) { ?>
		
			.woocommerce .woocommerce-info{
				border-top-color: <?php echo esc_attr( minimumminimal_themeoptions('color1'));?>;
			} 
<?php 	} } ?>
.entry-content a.more-link,
.button,
.add_to_cart_button
<?php if ( function_exists( 'is_woocommerce' ) ) {
		if ( is_woocommerce() || is_cart() ||  is_checkout() ) { ?>
		.woocommerce ul.products li.product .button,
		.woocommerce input.button,
		.woocommerce input.button:hover,
		.woocommerce button.button,
		.woocommerce button.button:hover,
		.woocommerce-cart a.button,
		.woocommerce-cart a.button:hover,
		.woocommerce span.onsale<?php } } ?>
	{
	color:<?php echo esc_attr( minimumminimal_themeoptions('colorfontbuttons'));?>;
}
</style>
<?php } add_action('wp_head', 'minimumminimal_add_styles'); ?>