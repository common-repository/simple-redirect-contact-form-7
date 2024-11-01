=== Simple Redirect - Contact Form 7 ===
Contributors: fuleshshete, mulika
Donate link: 
Tags: mulika, contact form 7 redirect, contact form 7, cf7, redirect settings
Requires at least: 4.7
Tested up to: 6.2.2
Requires PHP: 7.0
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Redirect settings for Contact Form 7, Redirect after mail sent or form submit, Add settings line in form "Additional Settings" tab, on_mailsent_redirect_to: REDIRECT_URL, on_submit_redirect_to: REDIRECT_URL


== Description ==

Redirect settings for Contact Form 7, Redirect after mail sent or form submit, Add settings line in form "Additional Settings" tab, 
on_mailsent_redirect_to: REDIRECT_URL
on_submit_redirect_to: REDIRECT_URL


Example:
on_mailsent_redirect_to: https://www.example.com/thank-you/
on_submit_redirect_to: https://www.example.com/step-2/


== Installation ==

1. Upload plugins folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `on_mailsent_redirect_to: REDIRECT_URL` in your "Contact Form 7 > Forms > Additional Settings" tab


== Changelog ==

= 1.0.0 =
* Added redirect settings.

= 1.0.1 =
* Added new redirect settings for on form submit.

= 1.0.2 =
* Updated for version compatibility.