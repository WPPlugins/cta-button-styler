=== CTA Button Styles ===
Contributors: creatorseo
Donate link: http://www.creatorseo.com/cta-button-styler-plugin/
Tags: call to action, CTA, Button, styling, click through rate, CTR, plugin, plugins, Wordpress
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 0.6.4
License:GPLv2 
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Call to Action (CTA) button styler allows administrators to highlight buttons and menu items in Wordpress as call to actions.

== Description ==

CTA Button Styler is a plugin for Wordpress that allows easy styling of existing buttons in Wordpress. Buttons labelled with the *cta101* class can be easily turned into effective **Call To Action buttons** which will encourage visitors to stay on the site and click through to the desired page.

Reducing your bounce-rate (i.e. getting visitors to look at more than one page on your site) is important for your site ranking. Using effective call to action buttons encourages visitors to click through and visit other pages thereby reducing your overall bounce rate and potentially increasing your ranking.

CTA button styler is designed with flexibility and ease of use in mind. It is easy to install. Does not consume any unnecessary resources and simply does what it needs to do to keep visitors on the site.

You get to decide the button styles and the hover-styles for your button and can change the buttons at any time according to your needs or to test whether a different style leads to more click-through's.

This is the first version of the plugin to be released. We are working on more advanced options like AB testing and image buttons. These advanced features will be rolled out in a future version of the software.

For more information, check out plugin page at [Help](http://myinfo.ie/CTA-Button-Styling/) or see the [Working demo on CreatorSEO](http://www.creatorseo.com/) on our site.

== Installation ==

1. Upload `cta-button-styler` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on 'CTA Button Styler' in the Appearance menu to configure the button

== Frequently Asked Questions ==

= Can this plugin be used on menu items? =

Yes, this first release of CTA Button Styler is a very straightforward plugin and can be used to create Call to Action buttons on menus and on links.

= Can the buttons be styled to match the colors on my theme? =

Yes, the plugin allows you to change colours, button size, hover styles etc. There are a range of styling options to change using the Call To Action Styling option on the Wordpress 'Appearance' admin dashboard.

= Where do I find the button styling options? =

Click on *Call To Action Styling* option on the Wordpress 'Appearance' admin dashboard.

= How do I style a link as a CTA button? =

Simply add the **cta101** as class name to the link e.g. class="cta101"

= How do I style a menu item as a CTA button? =

1. Log in to the Dashboard and select Appearance->Menus
2. First ensure that the show menu class option is checked by clicking 'Screen Options at the top of the screen
3. Check the CSS classes button option
4. Switch menu CSS class on
5. Set the syle class on the menu item to 'cta101'
6. Menu now will be styled accordingly

= Can I style more than one button or link? =

Yes, but too many calls to action on any page will defeat the objective. Ideally try to have no more than 2 calls to action visible on any page view. 

= Can I define more than one style? =

Only one user defined style is provided in this launch edition of the plugin. However, the code was developed to allow for multiple styles and even for A/B testing of calls to action. If there is demand for this additional functionality, it will be provided in a later version. 

= I set up the button on the menu as indicated but it won't work? =

The CTA button sometimes has to compete with the styling in the theme and the button then may not appear as it should. Fortunately there is an easy solution to this. Just enclose your menu Navigation Label in the tags &lt;button class="cta101"&gt;*Navigation Label*&lt;/button&gt;. Do not include the style tag in the menu CSS field. Everything now should work.  

= Why does the CTA button overlap other text in the page when I use it with in-line elements? =

In-line elements (like span and a) ignore vertical (top and bottom) margins and only apply horizontal margins. This is in accordance with the CSS specification. Wherever possible, apply the CTA button class only to block level elements (like button and div) and this issue will not occur. 

== Screenshots ==

1. Screenshot showing links the before and after applying *Call To Action Styling*. Notice that the class cta101 is added to the button or link to style it.
2. The admin menu in Appearance->CTA Button Styles where styles can be defined. Notice that there is a preview of the styled button at the top of the page.
3. Screen clip showing how to switch on CSS Classes in  Appearance->Menu in order to include the CTA styling class (cta101) to a menu item.
4. Screen clip showing where to add the cta101 class in the item Menu.
5. Example CTA styles button on a site menu 

== Changelog ==

= 0.6.2 to 0.6.4 =

* Tested with latest Wordpress version up to Wordpress 4.8

= 0.6.1 =

* Added settings to the plugin menu
* More help added
* Bug Fix: Demo style button fixed

= 0.5.3 =

* Error in admin-post.php call changed to admin-ajax.php

= 0.5.2 =

* Small fix

= 0.5.1 =

* Added more resolution on padding

= 0.5 =

* Initial Release

== Upgrade Notice ==

= 0.5.1 =

Minor changes to help files

= 0.5.1 =

This upgrade adds more resolution on padding allowing the user to set padding values for all 4 locations

= 0.5 =

Initial release, no bugs identified.