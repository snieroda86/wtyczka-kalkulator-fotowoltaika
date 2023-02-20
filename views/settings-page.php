<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

	<form action="options.php" method="post">
		<?php 
			settings_fields('sn_kalkulator_group');
			do_settings_sections( 'sn_kalk_settings_area' );
		 ?>
		
		<?php submit_button('Save settings'); ?>
	</form>

	<div class="shortcode-display-sn">
		<span>Użyj shortcode <span><b><input type="text" disabled value="[sn_kalkulator]"></b></span> aby wyświetlić kalkulator </span>
	</div>
</div>