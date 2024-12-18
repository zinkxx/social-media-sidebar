<?php
/**
 * Plugin Name: Social Media Sidebar
 * Description: Sayfanın sol tarafında sosyal medya logolarını gösteren modern bir eklenti.
 * Version: 1.2 Alpha
 * Author: [Dev Technic]
 * License: GPL2
 */

// CSS ve JS dosyalarını yükle
function sms_enqueue_assets() {
    wp_enqueue_style('sms-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('sms-script', plugin_dir_url(__FILE__) . 'js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'sms_enqueue_assets');

// Eklentinin admin paneli için ayar sayfası ekleyin
function sms_add_admin_menu() {
    add_menu_page(
        'Social Media Sidebar', // Sayfa başlığı
        'Sosyal Medya Sidebar', // Menü ismi
        'manage_options', // Yetki seviyesi
        'sms_settings', // Sayfa slug'ı
        'sms_settings_page', // Sayfa içeriği
        'dashicons-share', // Menü ikonu
        80 // Menü sırası
    );
}
add_action('admin_menu', 'sms_add_admin_menu');

// Eklentinin ayar sayfası içeriği
function sms_settings_page() {
    ?>
    <div class="wrap">
        <h1>Sosyal Medya Sidebar Ayarları</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('sms_settings_group');
            do_settings_sections('sms_settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Facebook URL</th>
                    <td><input type="text" name="sms_facebook_url" value="<?php echo esc_attr(get_option('sms_facebook_url')); ?>" class="regular-text" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Twitter URL</th>
                    <td><input type="text" name="sms_twitter_url" value="<?php echo esc_attr(get_option('sms_twitter_url')); ?>" class="regular-text" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Instagram URL</th>
                    <td><input type="text" name="sms_instagram_url" value="<?php echo esc_attr(get_option('sms_instagram_url')); ?>" class="regular-text" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">LinkedIn URL</th>
                    <td><input type="text" name="sms_linkedin_url" value="<?php echo esc_attr(get_option('sms_linkedin_url')); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Ayarları kaydetmek için gerekli işlemleri yapalım
function sms_register_settings() {
    register_setting('sms_settings_group', 'sms_facebook_url');
    register_setting('sms_settings_group', 'sms_twitter_url');
    register_setting('sms_settings_group', 'sms_instagram_url');
    register_setting('sms_settings_group', 'sms_linkedin_url');
}
add_action('admin_init', 'sms_register_settings');

// Social medya logolarını sidebar'da göster
function sms_social_media_sidebar() {
    ?>
    <div id="sms-sidebar" class="sms-sidebar">
        <ul>
            <li><a href="<?php echo esc_url(get_option('sms_facebook_url', '#')); ?>" target="_blank"><img src="<?php echo plugin_dir_url(__FILE__) . 'img/facebook.svg'; ?>" alt="Facebook"></a></li>
            <li><a href="<?php echo esc_url(get_option('sms_twitter_url', '#')); ?>" target="_blank"><img src="<?php echo plugin_dir_url(__FILE__) . 'img/twitter.svg'; ?>" alt="Twitter"></a></li>
            <li><a href="<?php echo esc_url(get_option('sms_instagram_url', '#')); ?>" target="_blank"><img src="<?php echo plugin_dir_url(__FILE__) . 'img/instagram.svg'; ?>" alt="Instagram"></a></li>
            <li><a href="<?php echo esc_url(get_option('sms_linkedin_url', '#')); ?>" target="_blank"><img src="<?php echo plugin_dir_url(__FILE__) . 'img/linkedin.svg'; ?>" alt="LinkedIn"></a></li>
        </ul>
    </div>
    <?php
}
add_action('wp_footer', 'sms_social_media_sidebar');
