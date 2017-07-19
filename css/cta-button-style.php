<?php
/* CTA Button Styler v.0.6.4 */
header('Content-type: text/css');

$clsname = get_option('cta_button_name');
$clsname = strlen($clsname)>=5? $clsname: "cta101";
$opt = get_option('cta_button_options');
$opt1 = get_option('cta_button_hover_options');
$color0 = "#000000";
$color1 = "#000000";

$css = '@CHARSET "ISO-8859-1";'."\r\n";
$css .= ".".$clsname." {\r\n";
foreach ($opt as $att => $value) {
	$nb = stristr($att,'border')? " !important": (stristr($att,'padding')? " !important": "");
	$css .= "\t".$att.": ".$value.$nb.";\r\n";
	$color0 = $att=='color'? $value: $color0;
}
$css .= "}\r\n";

$css .= ".".$clsname.":hover {\r\n";
foreach ($opt1 as $att => $value) {
	$nb = stristr($att,'border')? " !important": "";
	$css .= "\t".$att.": ".$value.$nb.";\r\n";
	$color1 = $att=='color'? $value: $color1;
}
$css .= "}\r\n";
//remove any default styling around links as these will interfere with the button style
$css .= ".".$clsname.">a {padding: 0 !important; background: transparent !important; color: ".$color0." !important;}\r\n";
$css .= ".".$clsname.":hover>a {padding: 0 !important; background: transparent !important; color: ".$color1." !important;}\r\n";
echo $css;


?>