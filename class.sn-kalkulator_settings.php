<?php 
if(! class_exists('SN_Kalkulator_Settings')){
	class SN_Kalkulator_Settings{
		
		public static $options;


		public function __construct(){
			self::$options = get_option('sn_kalkulator_options');

			add_action('admin_init' , array($this , 'admin_init'));
		}

				// Create sections
		public function admin_init(){
			register_setting('sn_kalkulator_group', 'sn_kalkulator_options' , array($this , 'sn_kalkulator_validate'));

			// Sections
			add_settings_section(
		        'sn_kalkulator_main_section',
		        'Kwoty przypisane do rodzajów instalacji', 
		        NULL,
		        'sn_kalk_settings_area'
		    );
		    
		    // Fields

		    // Oferta ekonomiczna

			add_settings_field(
			    'sn_kalkulator_economic',
			    'Oferta ekonomiczna',
			    array($this , 'sn_oferta_ekonomiczna_callback'),
			    'sn_kalk_settings_area',
			    'sn_kalkulator_main_section'
			);

			 // Oferta standard

			add_settings_field(
			    'sn_kalkulator_standard',
			    'Oferta standardowa',
			    array($this , 'sn_oferta_standardowa_callback'),
			    'sn_kalk_settings_area',
			    'sn_kalkulator_main_section'
			);

			 // Oferta premium

			add_settings_field(
			    'sn_kalkulator_premium',
			    'Oferta standardowa',
			    array($this , 'sn_oferta_premium_callback'),
			    'sn_kalk_settings_area',
			    'sn_kalkulator_main_section'
			);
			
		}

		// Oferta eoknomiczna callback
		public function sn_oferta_ekonomiczna_callback(){ ?>
			<input 
			type="number"
			name="sn_kalkulator_options[sn_kalkulator_economic]"
			id="sn_kalkulator_economic"
			value="<?php echo isset( self::$options['sn_kalkulator_economic'] ) ? esc_attr( self::$options['sn_kalkulator_economic'] ) : ''; ?>"
			>
		<?php }

		// Oferta standardowa callback
		public function sn_oferta_standardowa_callback(){ ?>
			<input 
			type="number"
			name="sn_kalkulator_options[sn_kalkulator_standard]"
			id="sn_kalkulator_standard"
			value="<?php echo isset( self::$options['sn_kalkulator_standard'] ) ? esc_attr( self::$options['sn_kalkulator_standard'] ) : ''; ?>"
			>
		<?php }

		// Oferta premium callback
		public function sn_oferta_premium_callback(){ ?>
			<input 
			type="number"
			name="sn_kalkulator_options[sn_kalkulator_premium]"
			id="sn_kalkulator_premium"
			value="<?php echo isset( self::$options['sn_kalkulator_premium'] ) ? esc_attr( self::$options['sn_kalkulator_premium'] ) : ''; ?>"
			>
		<?php }



	}	
}