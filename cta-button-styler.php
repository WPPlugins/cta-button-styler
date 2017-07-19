<?php
/**
 * Plugin Name: CTA Button Styler
 * Plugin URI:  http://www.creatorseo.com/cta-button-styler-plugin/
 * Description: Style your Call To Action (CTA) links and buttons to improve your click-through rates
 * Version:     0.6.4
 * Author:		Clinton CreatorSEO
 * Author URI: http://www.creatorseo.com
 * License: GPLv3
 * Last change: 2017-06-13
 *
 * Copyright 2016-17 CreatorSEO (email : info@creatorseo.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You can find a copy of the GNU General Public License at the link
 * http://www.gnu.org/licenses/gpl.html or write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

$inline = true;
$use_class = 2;

//Security - abort if this file is called directly
if (!defined('WPINC')){
	die;
}

require_once(plugin_dir_path( __FILE__ ) . 'cta-button-styler-lib.php');
require_once(plugin_dir_path( __FILE__ ) . 'class.cta-button-styler.php');

$cta_button = new cta_button_styler(__FILE__);

?>