<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

add_action('wp_enqueue_scripts','my_theme_scripts_function');
function my_theme_scripts_function() {
   
   wp_enqueue_script( 'myscript', get_stylesheet_directory_uri() . '/js/sticky_class.js');

   if ( is_singular('easy-photo-album') ) {
   	    wp_enqueue_script( 'masonry-js', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js');
   		wp_enqueue_script( 'masonry-scripts', get_stylesheet_directory_uri() . '/js/masonry-custom.js');
   }
}




/* Custom Shortcode for Creating Stripe Customer with ACH (via PLAID or CC info
* Depends  WP Simple Pay Pro For Stripe
*
*/

function zmd_stripe_new_customer_widget_function ($atts)
{

    require_once('zmd-stripe/classes/class_zmd_stripe.php');
    ZMD_Stripe_Plugin::get_instance();

    ZMD_Stripe_Plugin::new_customer_widget($atts);
    

}
add_shortcode( 'zmd_stripe_new_customer_widget', 'zmd_stripe_new_customer_widget_function' );

function zmd_stripe_customer_pay_widget_function ($atts)
{
    require_once('zmd-stripe/classes/class_zmd_stripe.php');
    ZMD_Stripe_Plugin::get_instance();
    ZMD_Stripe_Plugin::customer_pay_widget($atts);

}
add_shortcode( 'zmd_stripe_customer_pay_widget', 'zmd_stripe_customer_pay_widget_function' );


/*
* END CUSTOM Shortcode
*
*/



?>