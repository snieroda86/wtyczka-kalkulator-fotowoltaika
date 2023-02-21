<?php
/**
 * Plugin Name: SN Kalkulator
 * Plugin URI: https://developer.wordpress.org/plugins//
 * Description: Symulacja oferty na montaż paneli fotowoltaicznych
 * Version: 1.0.0
 * Author: Sebastian Nieroda
 * Author URI: https://www.web4you.biz.pl
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if( !class_exists( 'SN_Kalkulator' ) ){

  class SN_Kalkulator {
    
    // Constructor
    public function __construct() {
        
        $this->define_constants();
        add_action('admin_menu' , array($this , 'create_admin_menu') );
        // creste settings
        require_once(SN_KALK_PATH.'/class.sn-kalkulator_settings.php');
        $SN_Kalkulator_Settings = new SN_Kalkulator_Settings();
        require_once(SN_KALK_PATH.'/shortcodes/class.sn-kalkulator_shortcode.php');
        $SN_Kalkulator_Shortcode = new SN_Kalkulator_Shortcode();
        add_action( 'wp_enqueue_scripts', array( $this, 'add_jquery' ) );
        add_action('wp_enqueue_scripts' , array($this , 'register_scripts'),999 );
    }

    /**
     * Define Constants
     */
    public function define_constants(){
        // Path/URL to root of this plugin, with trailing slash.
        define ( 'SN_KALK_PATH', plugin_dir_path( __FILE__ ) );
        define ( 'SN_KALK_URL', plugin_dir_url( __FILE__ ) );
        define ( 'SN_KALK_VERSION', '1.0.0' );     
    }

    // Add jquery
    public function add_jquery() {
      wp_enqueue_script( 'jquery' );
    }

    // Create admin menu
    public function create_admin_menu(){
      add_menu_page(
            'Kalkulator fotowoltaiki',
            'Kalkulator fotowoltaiki',
            'manage_options',
            'sn_kalkulator_admin',
            array($this , 'sn_kalkulator_settings_page'),
            'dashicons-calculator',
            6
        );
    }

    // Admin settings page callback
    public function sn_kalkulator_settings_page(){
      if( ! current_user_can( 'manage_options' )){
        return;
      }
      // Messages
      if(isset($_GET['settings-updated'])){
        add_settings_error( 'sn_kalkulator_options', 'sn_kalkulator_message' , 'Settings Saved' , 'success' );
      }
      // Display messages
      settings_errors('sn_kalkulator_options');
      require (SN_KALK_PATH.'/views/settings-page.php');
    }

    // Regitser scripts
    public function register_scripts(){

      wp_register_style( 'sn-kalkulator-style-css', SN_KALK_URL.'assets/css/frontend.css' , array() , SN_KALK_VERSION , 'all' );
    }


  }

}

if( class_exists( 'SN_Kalkulator' ) ){
  $SN_Kalkulator = new SN_Kalkulator();
}





