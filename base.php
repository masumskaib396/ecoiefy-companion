<?php 

use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Ecoiefy_Extension {
	
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
	const MINIMUM_PHP_VERSION = '5.6';


	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {
		load_plugin_textdomain( 'ecoiefy' );
	}

	

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		//add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'ecoiefy_editor_styles' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered',[$this,'register_new_category']);
		add_action( 'wp_enqueue_scripts', array( $this, 'ecoiefy_register_frontend_styles' ), 10 );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ecoiefy_frontend_before_scripts' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'ecoiefy_register_frontend_scripts' ] );
		
	}
	

	function ecoiefy_frontend_before_scripts(){

		// wp_enqueue_script('ecoiefy-test',
		// ECOIEFY_ASSETS_ASSETS .'js/test.js',
		// 	array('jquery'), ECOIEFY_VERSION, true);

	}

	/**
	 * Load Frontend Script
	 *
	*/
	public function ecoiefy_register_frontend_scripts(){

		wp_enqueue_script('owl-carousel3',
		ECOIEFY_ASSETS_ASSETS .'js/owl-carousel.min.js',
			array('jquery'), ECOIEFY_VERSION, true);

		wp_enqueue_script('ecoiefy-magnific-popup',
		ECOIEFY_ASSETS_ASSETS .'js/jquery.magnific-popup.min.js',
			array('jquery'), ECOIEFY_VERSION, true);
		
		

	}



	/**
	 * Load Frontend Styles
	 *
	*/
	public function ecoiefy_register_frontend_styles(){
		wp_enqueue_style(
			'ecoiefy-bootstrap',
			ECOIEFY_ASSETS_ASSETS .'css/bootstrap.min.css',
			 null, ECOIEFY_VERSION
		);

		wp_enqueue_style(
			'ecoiefy-elementor-style',
			ECOIEFY_ASSETS_ASSETS .'css/elementor-style.css',
			 null, ECOIEFY_VERSION
		);

		wp_enqueue_style(
			'ecoiefy-owl-carousel3',
			ECOIEFY_ASSETS_ASSETS .'css/owl.carousel.min.css',
			 null, ECOIEFY_VERSION
		);

		wp_enqueue_style(
			'ecoiefy-magnific-popup',
			ECOIEFY_ASSETS_ASSETS .'css/magnific-popup.css',
			 null, ECOIEFY_VERSION
		);

		





	}

	/**
	 * Load Frontend Styles
	 *
	*/
	

	/**
	 * Widgets Catgory
	 *
	*/
	public function register_new_category($manager){
	   $manager->add_category('ecoiefy',
			[
				'title' => __( 'Ecoiefy Companion  Addons', 'ecoiefy-companion' ),
			]);
	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ecoiefy-companion' ),
			'<strong>' . esc_html__( 'Elementor Ecoiefy Extension', 'ecoiefy-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ecoiefy-companion' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ecoiefy-companion' ),
			'<strong>' . esc_html__( 'Elementor Ecoiefy Extension', 'ecoiefy-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ecoiefy-companion' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ecoiefy-companion' ),
			'<strong>' . esc_html__( 'Elementor Ecoiefy Extension', 'ecoiefy-companion' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ecoiefy-companion' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		//Include Widget files

		
		require_once( ECOIEFY_ADDONS_DIR . 'Volunteer/widget.php' );
		require_once( ECOIEFY_ADDONS_DIR . 'Testimonial/widget.php' );
		require_once( ECOIEFY_ADDONS_DIR . 'Gallery/gallery-carousel.php' );
		require_once( ECOIEFY_ADDONS_DIR . 'Gallery/gallery-filter.php' );
		require_once( ECOIEFY_ADDONS_DIR . 'Event/event.php' );


		$widgets_manager->register_widget_type( new \Ecoiefy\Widgets\Elementor\Volunteer() );
		$widgets_manager->register_widget_type( new \Ecoiefy\Widgets\Elementor\Testimonial() );
		$widgets_manager->register_widget_type( new \Ecoiefy\Widgets\Elementor\GalleryCarousel() );
		$widgets_manager->register_widget_type( new \Ecoiefy\Widgets\Elementor\GalleryFilter() );
		$widgets_manager->register_widget_type( new \Ecoiefy\Widgets\Elementor\Events() );
		

	}


}

Ecoiefy_Extension::instance();
