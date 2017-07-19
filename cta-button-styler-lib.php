<?php
/* CTA Button Styler v.0.6.4 */

/**
 * Color picker for form
 * @param string $name name of the color picker field
 * @param unknown $color - chosen color
 * @param unknown $default - default color
 * @param string $class optional class name for the option field
 * @param string $display - echo or return the html
 * @return string - return sting if $display is false
 */
function cta_button_color_picker($name,$color,$default='#efefef',$class='',$display=true){
	$out = "";
	$cls = $class? " ".$class."": "";
	$color = preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color )? $color: null;
	$default = preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $default )? $default: "#ff0000";
	if ($color){
		$out .= "<div class='cta-color-picker'>";
		$out .= "<input type='text' class='cta-button-color-pick".$cls."' name='".esc_attr($name)."' value='".esc_attr($color)."' data-default-color='".$default."'>";
		$out .= "</div>";
	} else {
		$out = "<p>ERROR: Color not recognized</p>";
	}
	if ($display) echo $out;
	else return $out;
}

/**
 * Create a dynamic option list based on an option name, an array of elements and a default element
 * @param array $elements elements to display in the drop-down 
 * @param string $name name of the option field
 * @param string $selected default or selected option
 * @param string $class optional class name for the option field
 * @param string $display - echo or return the html
 * @return string - return sting if $display is false
 */
function cta_button_dynamic_options($elements,$name,$selected,$class='',$display=true){
	$out = "";
	$cls = $class? " class='".$class."'": "";
	if (is_array($elements)){
		$out = "<select".$cls." name='".$name."' class='".$name."'>\n";
		$out .= ($selected=="")? "<option selected='selected'>-- Select --</option>\n": "";
		foreach ($elements as $emt){
			$chk=($emt==$selected)? "selected='selected'": "";
			$out .= "<option value='".$emt."' ".$chk.">".$emt."</option>\n";
		}
		$out .= "</select>\n";
	} else {
		$out = "<p>ERROR: Elements not defined for list</p>";
	}
	if ($display) echo $out;
	else return $out;
}

?>