<?php
/* CTA Button Styler v.0.6.4 */

class cta_button_styler {
	private $cta_name = "cta101";
	private $options = array(
		'margin-left'=>'5px',
		'margin-right'=>'5px',
		'margin-top'=>'5px',
		'margin-bottom'=>'5px',
		'padding-left'=>'15px',
		'padding-right'=>'15px',
		'padding-top'=>'15px',
		'padding-bottom'=>'15px',
		'background-color'=>'#ffffff',
		'color'=>'#f47721',
		'font-weight'=>'bold',
		'border-width'=>'3px',
		'border-style'=>'solid',
		'border-color'=>'#f47721',
		'border-radius'=>'20px',
		'cursor'=>'pointer',
		'cursor'=>'hand'
	);
	private $hover_options = array(
		'background-color'=>'#f47721',
		'color'=>'#ffffff',
		'font-weight'=>'bold',
		'border-color'=>'#ffffff',
	);
	private $pluginloc = '';
	//var $temp = 'Info...';

	/**
	 * Initialise the plugin class
	 * @param string $loc the full directory and filename for the plugin
	 */
	public function __construct($loc){
		$this->pluginloc = strlen($loc)? $loc: __FILE__;
		$basename = plugin_basename($this->pluginloc);

		if (is_admin()){
			add_action('admin_enqueue_scripts', function(){
				wp_enqueue_style('cta-button-style', admin_url('admin-ajax.php?action=cta_dynamic'), array(), '1.0.0');
			});
			add_action('admin_enqueue_scripts', array($this, 'cta_button_enqueue_scripts'));
			add_action('admin_init',array($this, 'cta_button_register_settings'));
			add_action('admin_menu', array($this, 'cta_button_menu'));
			add_filter('plugin_action_links_'.$basename, array($this, 'cta_button_settings_link'));
			//add_filter( 'plugin_action_links', array( $this, 'zz_plugin_settings_link' ), 10, 2 );
			register_activation_hook($loc, array($this, 'cta_button_load_options'));
			register_uninstall_hook ($loc, array($this, 'cta_button_unset_options'));
			//register_deactivation_hook($loc, array($this, 'cta_button_unset_options'));
		} else {
			add_action('wp_enqueue_scripts', function(){
				wp_enqueue_style('cta-button-style', admin_url('admin-ajax.php?action=cta_dynamic'), array(), '1.0.0');
			});
		}
		add_action('wp_ajax_cta_dynamic', array($this, 'cta_button_dynamic_css'));
		add_action('wp_ajax_nopriv_cta_dynamic', array($this, 'cta_button_dynamic_css'));
		//add_action('wp_enqueue_scripts', array($this, 'cta_button_enqueue_styles'));
	}

// -------------------- Add styles and scripts --------------------
	/**
	 * Call the dynamic style sheet load
	 */
	function cta_button_dynamic_css() {
		//$this->temp .= 'AJAX cta_button_dynamic_css...';
		//require_once('css/cta-button-style.php');
		require_once(plugin_dir_path( __FILE__ ).'css/cta-button-style.php');
		return;
	}

	function cta_button_enqueue_styles(){
		wp_enqueue_style( 'cta-menu-button-css', plugins_url('css/cta_style.php', __FILE__), array(), '1.0.0'	);
	}

	function cta_button_enqueue_scripts(){
		wp_enqueue_style( 'wp-color-picker' );
		//wp_register_script('cta-menu-button', plugins_url('js/cta-button-admin.js', __FILE__), array('jquery', 'wp-color-picker'), 1.0, true);
		//wp_enqueue_script( 'cta-menu-button-js');
		wp_enqueue_script( 'cta-menu-button-js', plugins_url('js/cta-button-admin.js', __FILE__), array('jquery', 'wp-color-picker'), false, true );
	}
	
// -------------------- Add a menu item to the settings (themes) menu --------------------
	function cta_button_menu() {
		add_theme_page('Call to Action (CTA) button Styler', 'CTA Button Styler', 'edit_theme_options', 'cta_button_styler', array($this,'cta_button_options_page'));
	}

// -------------------- Add a link to the plugin to point to the settings location --------------------

	/**
	 * Add links to Settings page
	 */
	public function zz_plugin_settings_link($links, $file) {
		static $plugin;
		$plugin = plugin_basename( $this->pluginloc );
		if ( $file == $plugin ) {
			$url = get_admin_url().'themes.php?page=cta_button_styler';
			$settings_link = '<a href="'.$url.'">' . __("Settings") . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	function cta_button_settings_link($links) {
		$url = get_admin_url().'themes.php?page=cta_button_styler';
		$settings_link = '<a href="'.$url.'">' . __("Settings") . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

// -------------------- Define and create the options update page --------------------

	/**
	 * Register the plugin settings that will be stored to the option table and displayed on the menu page
	 */
	function cta_button_register_settings(){
		//$this->temp .= 'Settings Registered...';
		register_setting('cta_button_template_group', 'cta_button_name');
		register_setting('cta_button_template_group', 'cta_button_options');
		register_setting('cta_button_template_group', 'cta_button_hover_options');
	}

	/**
	 * Draw the data (styles) manipulation page
	 */
	function cta_button_options_page() {
		$opt = get_option('cta_button_options');
		$opt1 = get_option('cta_button_hover_options');
		$opt = array_merge($this->options,$opt);
		$opt1 = array_merge($this->hover_options,$opt1);
		$name = get_option('cta_button_name');
		$name = strlen($name)>=5? $name: "cta101";

		if(current_user_can('manage_options')) {
			echo "<div class='wrap'>";
			echo "<h2>Call To Action Button Styling</h2>";
			//echo "<h3>Temp</h3><div style='padding: 10px 0'>".$this->temp."</div>";
			echo "<div style='padding: 10px 0'><button class='".$name."'>Sample Call to Action Button</button>";
			echo "<p><em>Save changes to the options to see the style changes in the button above</em></p></div>";
			echo "<form action='options.php' method='post'>";
			settings_fields('cta_button_template_group'); //This line must be inside the form tags
			//do_settings_fields('cta_button_template_group');

			echo "<h3>Button Styles</h3>";
			echo "<p><em>Use the Button Class Label below (i.e. '".$name."') to style any menus or text buttons on your site (case sensitive).
				Either wrap the text in a &lt;span&gt...&lt;/span&gt element to create a button around any text or
				assign the class to a menu element (as described in the help text).</em></p>";

			echo "<table class='form-table'>";

			echo "<tr valign='top'><th scope='row'>Button Class Label: </th>";
			echo "<td>".$name."<input type='hidden' name='cta_button_name' size='17' value='".$name."' /></td></tr>";

			//$ets = array('', '', '', '', '', '', '');
			$ets = array('0px', '5px', '10px', '15px', '20px', '40px', '60px', '80px', '110px', '150px');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[margin-left]',esc_attr($opt['margin-left']),'',false);
			echo "<tr valign='top'><th scope='row'>Left Margin Space</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[margin-right]',esc_attr($opt['margin-right']),'',false);
			echo "<tr valign='top'><th scope='row'>Right Margin Space</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[margin-top]',esc_attr($opt['margin-top']),'',false);
			echo "<tr valign='top'><th scope='row'>Top Margin Space</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[margin-bottom]',esc_attr($opt['margin-bottom']),'',false);
			echo "<tr valign='top'><th scope='row'>Bottom Margin Space</th><td>".$dropdn."</td></tr>";

			$ets = array('2px', '5px', '7px', '10px', '15px', '20px', '30px', '40px', '50px');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[padding-left]',esc_attr($opt['padding-left']),'',false);
			echo "<tr valign='top'><th scope='row'>Left Text Padding</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[padding-right]',esc_attr($opt['padding-right']),'',false);
			echo "<tr valign='top'><th scope='row'>Right Text Padding</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[padding-top]',esc_attr($opt['padding-top']),'',false);
			echo "<tr valign='top'><th scope='row'>Top Text Padding</th><td>".$dropdn."</td></tr>";
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[padding-bottom]',esc_attr($opt['padding-bottom']),'',false);
			echo "<tr valign='top'><th scope='row'>Bottom Text Padding</th><td>".$dropdn."</td></tr>";

			$dropdn = cta_button_color_picker('cta_button_options[background-color]',$opt['background-color'],$opt['background-color'],'',false);
			echo "<tr valign='top'><th scope='row'>Button Color</th><td>".$dropdn."</td></tr>";

			$dropdn = cta_button_color_picker('cta_button_options[color]',$opt['color'],$opt['color'],'',false);
			echo "<tr valign='top'><th scope='row'>Button Label Color</th><td>".$dropdn."</td></tr>";

			$ets = array('normal', 'bold', 'bolder', 'lighter');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[font-weight]',esc_attr($opt['font-weight']),'',false);
			echo "<tr valign='top'><th scope='row'>Button Text Weight</th><td>".$dropdn."</td></tr>";

			$ets = array('thin', 'medium', 'thick', '1px', '2px', '10px');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[border-width]',esc_attr($opt['border-width']),'',false);
			echo "<tr valign='top'><th scope='row'>Border Width</th><td>".$dropdn."</td></tr>";

			$ets = array('none', 'solid', 'dotted', 'groove', 'ridge', 'inset', 'outset', 'double');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[border-style]',esc_attr($opt['border-style']),'',false);
			echo "<tr valign='top'><th scope='row'>Border Style</th><td>".$dropdn."</td></tr>";

			$dropdn = cta_button_color_picker('cta_button_options[border-color]',$opt['border-color'],$opt['border-color'],'',false);
			echo "<tr valign='top'><th scope='row'>Border Color</th><td>".$dropdn."</td></tr>";

			$ets = array('0px', '5px', '10px', '15px', '20px', '25px', '30px');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[border-radius]',esc_attr($opt['border-radius']),'',false);
			echo "<tr valign='top'><th scope='row'>Border Rounding Radius</th><td>".$dropdn."</td></tr>";

			$ets = array('crosshair', 'default', 'hand', 'help', 'pointer');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_options[cursor]',esc_attr($opt['cursor']),'',false);
			echo "<tr valign='top'><th scope='row'>Cursor type</th><td>".$dropdn."</td></tr>";

			echo "</table>";

			//-----------------------------------------------------------------
			echo "<h3>Button Hover Styles</h3>";
			echo "<table class='form-table'>";

			$dropdn = cta_button_color_picker('cta_button_hover_options[background-color]',$opt1['background-color'],$opt1['background-color'],'',false);
			echo "<tr valign='top'><th scope='row'>Button Color</th><td>".$dropdn."</td></tr>";

			$dropdn = cta_button_color_picker('cta_button_hover_options[color]',$opt1['color'],$opt1['color'],'',false);
			echo "<tr valign='top'><th scope='row'>Button Label Color</th><td>".$dropdn."</td></tr>";

			$ets = array('normal', 'bold', 'bolder', 'lighter');
			$dropdn = cta_button_dynamic_options($ets,'cta_button_hover_options[font-weight]',esc_attr($opt1['font-weight']),'',false);
			echo "<tr valign='top'><th scope='row'>Button Text Weight</th><td>".$dropdn."</td></tr>";

			$dropdn = cta_button_color_picker('cta_button_hover_options[border-color]',$opt['border-color'],$opt1['border-color'],'',false);
			echo "<tr valign='top'><th scope='row'>Border Color</th><td>".$dropdn."</td></tr>";

			echo "</table>";
			submit_button();
			echo "</form>";
			echo "</div>";

		} else {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
	}

// -------------------- Other functions --------------------

// -------------------- Define actions to be taken when installing and uninstalling the Plugin --------------------
	function cta_button_load_options() {
		//$value = serialize($options);
		add_option('cta_button_name', $this->cta_name);
		add_option('cta_button_options', $this->options);
		add_option('cta_button_hover_options', $this->hover_options);
	}

	function cta_button_unset_options() {
		delete_option('cta_button_name');
		delete_option('cta_button_options');
		delete_option('cta_button_hover_options');
	}

// --------------------------------------------------------------------------------------------------------------

}
?>