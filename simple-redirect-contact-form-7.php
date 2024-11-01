<?php
/**
 * Plugin Name:       Simple Redirect - Contact Form 7
 * Plugin URI:        
 * Description:       Redirect settings for Contact Form 7, Redirect after mail sent or form submit, Add settings line in form "Additional Settings" tab, <strong>on_mailsent_redirect_to: REDIRECT_URL</strong>, <strong>on_submit_redirect_to: REDIRECT_URL</strong>
 * Version:           1.0.3
 * Requires at least: 4.7
 * Requires PHP:      7.0
 * Author:            Mulika Team
 * Author URI:        https://www.mulikainfotech.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


/*
'Simple Redirect - Contact Form 7' is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

'Simple Redirect - Contact Form 7' is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with 'Simple Redirect - Contact Form 7'. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


// Blocked direct access
defined( 'ABSPATH' ) || exit;

// Global class object
$micf7_obj = new MICF7_Simple_Redirect();

if( !is_admin() ){
add_action('wpcf7_contact_form', array($micf7_obj, 'prepare_redirections') );
add_action('wp_footer', array($micf7_obj, 'add_redirections_dom_event'), 99 );
}

add_action('admin_footer', array($micf7_obj, 'add_settings_help'), 99 );    


class MICF7_Simple_Redirect{
    
    function prepare_redirections($this_obj){
        
        $form_id  = $this_obj->id();
        
        $setting_keys = array(
            'on_mailsent_redirect_url',
            'on_mailsent_redirect_to',
            'on_submit_redirect_to'
        );
        
        foreach($setting_keys as $setting_key){
            $setting_value = $this_obj->additional_setting($setting_key);
            if( !empty($setting_value) ){
                $setting_value = trim(trim($setting_value[0],'"'),"'");
                $GLOBALS['micf7_addons_settings'][$form_id][$setting_key] = $setting_value;
            }
        }
        
    }
    
    
    function add_redirections_dom_event(){
        
        if( empty($GLOBALS['micf7_addons_settings']) ){
            return false;
        }
        
        $micf7_settings = $GLOBALS['micf7_addons_settings'];
        
        ob_start();
        ?> 
<!-- Simple Redirect - Contact Form 7 -->
<script> 
        <?php
        foreach($micf7_settings as $form_id => $form_settings){
            foreach($form_settings as $setting_key=>$redirect_url){
                if( empty($redirect_url) ){ continue; }
                $form_event = '';
                if( $setting_key == 'on_mailsent_redirect_url' || $setting_key == 'on_mailsent_redirect_to' ){
                    $form_event = 'wpcf7mailsent';
                }
                if( $setting_key == 'on_submit_redirect_to' ){
                    $form_event = 'wpcf7submit';
                }
                if( $form_event == '' ){ continue; }
                ?> 
document.addEventListener( '<?php echo $form_event;?>', function( event ) {
    if('<?php echo $form_id;?>' == event.detail.contactFormId){
        window.location = '<?php echo $redirect_url;?>';
    }
}, false);
                <?php
            }
        }
        ?> 
</script>
        <?php
        
        $contents = ob_get_contents();
        ob_end_clean();
        echo $contents;
        
    }
    
    
    function add_settings_help(){
        
        ob_start();
        ?>
        <script>
        jQuery('#additional-settings-panel').append("<p class='simple-redirect-contact-form-7-examples'><strong>Redirect Settings Ex.:</strong> <br>on_mailsent_redirect_to: https://www.example.com/thank-you/ <br>on_submit_redirect_to: https://www.example.com/step-2/</p>");
        </script>
        <?php
        $contents = ob_get_contents();
        ob_end_clean();
        echo $contents;
        
    }
    
    
}
