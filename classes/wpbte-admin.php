<?php
/**
 * Admin class to control the administration system options and pages
 *
 * Description: This allows for the embedding of Buto TV videos from their URLs
 * Version: 1.0
 * Author: Ross Tweedie
 * Author URI: http://www.dachisgroup.com
 */
class WpButoTvEmbedAdmin extends WpButoTvEmbedCore
{
    function init()
    {
        parent::init();

        add_action( 'admin_menu', array( __CLASS__, 'add_admin_pages' ) );

        register_deactivation_hook( self::$plugin_file, array( $this, 'uninstall' ) );
        //register_deactivation_hook( WpButoTvEmbedAdmin::get_plugin_file(), array( $this, 'uninstall' ) );

    }

    /**
     * Add the administration menu for the plugin
     *
     * @param void
     * @return void
     */
    static function add_admin_pages()
    {
        add_media_page( __( 'Buto TV Embed' , 'imv'), __( 'Buto TV Embed' , 'imv'), 'create_users', 'buto-embed', array( __CLASS__, 'index_page' ) );
    }


    function index_page()
    {
        $message = null;

        include( WpButoTvEmbedAdmin::get_plugin_path() . 'views/admin-index.php' );
    }


    /**
     * Uninstall option
     *
     * This will be called when the plugin is disactivated or uninstalled.
     *
     * It will remove the wpkve settings from the options database table
     */
    function uninstall()
    {
        //When the plugin is uninstalled or deactivation, cleanup the options
        delete_option( WpButoTvEmbedAdmin::$option_name );
    }

}
