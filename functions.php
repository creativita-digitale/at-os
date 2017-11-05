<?php
/**
 * Boutique engine room
 *
 * @package boutique
 */

/**
 * Set the theme version number as a global variable
 */
$theme				= wp_get_theme( 'booking-plus' );
$Booking_plus_version	= $theme['Version'];

$theme				= wp_get_theme( 'storefront' );
$storefront_version	= $theme['Version'];

require_once( 'inc/images-functions.php' );
require_once( 'inc/utility-functions.php' );
require_once( 'inc/class-at-os-products.php' );

//require_once( 'inc/customizer/class-storefront-customizer.php' );



add_action("storefront_before_content", "slider_widget", 2, 69);

function slider_widget (){
 	if (is_front_page() ){
    	echo do_shortcode("[metaslider id=1963]"); 
	}
	if (is_page(20)){
		echo do_shortcode("[metaslider id=2020]"); 
	}
}


if (!function_exists('axl_themesupport')):
	function axl_themesupport()
	{
		if (!isset($content_width)) $content_width = 770;
		global $wp_version;
		// Add theme support for Automatic Feed Links
		if (version_compare($wp_version, '3.0', '>=')):
			add_theme_support('automatic-feed-links');
		else:
			automatic_feed_links();
		endif;
		// Add theme support for Featured Images
		add_theme_support('post-thumbnails');
		// Add theme support for Semantic Markup
		$markup = array(
			'search-form',
			'comment-form',
			'comment-list',
		);
		add_theme_support('html5', $markup);
		$domain = 'at-os';
		load_theme_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain);
		load_theme_textdomain($domain, get_stylesheet_directory() . '/lang');
		load_theme_textdomain($domain, get_template_directory() . '/lang');
	}
endif;

add_action('after_setup_theme', 'axl_themesupport');


add_image_size( 'macchine-thumb', 150, 200 );
add_image_size( 'thumb-carosello', 73, 119 );
add_image_size( 'macchine-medium', 300, 400 );
add_image_size( 'macchine-high', 400, 600 );



function my_scripts_method() {
	if ( !is_admin() ) {
		
		wp_enqueue_script(
			'jcarousel',
			get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js',
			array( 'jquery' )
		);
		wp_enqueue_script(
			'jcarousel-control',
			get_stylesheet_directory_uri() . '/assets/js/jquery.jcarousel-control.min.js',
			array( 'jquery' )
		);
		

		
		
		
		
		wp_register_script( 'colorbox', '//cdn.jsdelivr.net/colorbox/1.5.6/jquery.colorbox-min.js', array('jquery') );
    	wp_enqueue_script( 'colorbox' );
		
		wp_register_script( 'scrollto', '//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.11/jquery.scrollTo.min.js', array('jquery') );
		wp_enqueue_script( 'scrollto' );
		
		wp_register_script( 'localscroll', '//cdnjs.cloudflare.com/ajax/libs/jquery-localScroll/1.3.5/jquery.localScroll.min.js', array('jquery', 'scrollto') );
		wp_enqueue_script( 'localscroll' );
		
		wp_enqueue_script(
			'zoom',
			get_stylesheet_directory_uri() . '/assets/js/jquery.zoom.min.js',
			array( 'jquery' )
		);
	
	
        wp_deregister_script('historyjs');
		wp_register_script( 'historyjs', get_bloginfo( 'stylesheet_directory' ) . '/assets/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
		wp_enqueue_script( 'historyjs' );
		
	
   

	
	
	wp_enqueue_script(
		'scripts',
		get_stylesheet_directory_uri() . '/assets/js/scripts.js',
		array( 'jquery', 'jcarousel',  'jcarousel-control', 'zoom', 'bootstrap', 'colorbox' ,  'scrollto' , 'localscroll')
	);
	
	
	
	
	}
}


add_action( 'wp_enqueue_scripts', 'my_scripts_method' );




function immagine_carosello ($post_id, $size = 'macchine-thumb'){
	
	
	//return '$post_id da immagine carosello'. $post_id;
	
	
	if(has_post_thumbnail($post_id)){
		
	return	get_the_post_thumbnail($post_id, $size);
	
	}else{
	
	return	wp_get_attachment_image( 382, $size);
	}

}

add_action( 'init' , 					 'silvercare_register_ubermenu_skins', 9 );

function silvercare_register_ubermenu_skins(){
		//wp_die( get_stylesheet_directory_uri() . '/asset/sass/ubermenu/ubermenu.css');
   if( function_exists( 'ubermenu_register_skin' ) ){
      $skin_slug = 'atos-maintheme';       //replace with your skin slug
      $skin_name = '[AT_OS] Main theme';   //Replace with the name of your skin (visible to users)
      $skin_path = get_stylesheet_directory_uri() . '/asset/sass/ubermenu/ubermenu.css';  //Replace with path to the custom skin in your theme
      ubermenu_register_skin( $skin_slug , $skin_name , $skin_path );
   }
}


function register_my_menu() {
  register_nav_menu('product-menu',__( 'Product Menu', 'at-os' ));
}
add_action( 'init', 'register_my_menu' );


// Returns an array of term objects, or a WP_Error object if any of the taxonomies to get terms from does not exist. 

function return_terms($tax) {
	 
	 $taxonomy = get_terms( $tax, 'orderby=count&hide_empty=0' );
	  	
		if ( class_exists('FirePHP') && current_user_can('edit_themes') ) {
		  	$firephp = FirePHP::getInstance(true);
			
			
			$firephp->group('$tax: ' . $tax );
		}
			
		
	
	
		$taxonomy_terms = array();
		if (  !is_wp_error( $taxonomy ) ){
			
			 foreach ( $taxonomy as $term ) {
				
				 array_push ( $taxonomy_terms , $term->term_id );
				 
				 
				if ( class_exists('FirePHP') && current_user_can('edit_themes') ) {
		
				$firephp->log('term_id: ' . $term->term_id );
				$firephp->log('term_id: ' . $term->name);
				
				}
	
				
				
				
			 }
			if ( class_exists('FirePHP') && current_user_can('edit_themes') ) { 
			 $firephp->trace($taxonomy_terms);
			 $firephp->groupEnd();
			} 
		   return 	$taxonomy_terms;
			
		  
		 }
		 
	
}
