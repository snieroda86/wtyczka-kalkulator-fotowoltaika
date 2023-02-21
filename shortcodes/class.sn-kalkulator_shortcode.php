<?php

if(!class_exists('SN_Kalkulator_Shortcode')){
	class SN_Kalkulator_Shortcode{
		public function __construct(){
			add_shortcode( 'sn_kalkulator', array($this , 'sn_kalk_add_shortcode') );
		}

		public function sn_kalk_add_shortcode(){

			// require slider html markup
			ob_start();
			require(SN_KALK_PATH.'views/sn-kalkulator-template.php');
			wp_enqueue_style('sn-kalkulator-style-css');
			return ob_get_clean();
		}
	}
}