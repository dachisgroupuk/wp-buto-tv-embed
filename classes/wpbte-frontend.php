<?php
/**
 * Frontend class to handle the auto embedding of Buto TV videos into post content.
 *
 * Description: This allows for the embedding of Buto TV videos from their URLs
 * Version: 1.0
 * Author: Ross Tweedie
 * Author URI: http://www.dachisgroup.com
 */
class WpButoTvEmbedFrontend extends WpButoTvEmbedCore
{

    function init()
    {
        parent::init();

        /**
         * Add the Buto TV embeds
         */
        wp_embed_register_handler( 'butotv', '#http://play\.buto\.tv/(?<video_id>[A-za-z0-9]+)#i', array( __CLASS__, 'wp_embed_handler_butotv' ) );
    }


    /**
    * The Buto TV embed handler callback.
    *
    * @see WP_Embed::register_handler()
    * @see WP_Embed::shortcode()
    *
    * @param array $matches The regex matches from the provided regex when calling {@link wp_embed_register_handler()}.
    * @param array $attr Embed attributes.
    * @param string $url The original URL that was matched by the regex.
    * @param array $rawattr The original unmodified attributes.
    * @return string The embed HTML.
    */
    function wp_embed_handler_butotv( $matches, $attr, $url, $rawattr ) {

        // Initialise the variables
        $video_id = $width = $height = null;

        $video_id = isset ( $matches['video_id'] ) ? $matches['video_id'] : '';

        // If the user supplied a fixed width AND height, use it
        if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
            $width  = (int) $rawattr['width'];
            $height = (int) $rawattr['height'];
        } else {
            list( $width, $height ) = wp_expand_dimensions( 425, 230, $attr['width'], $attr['height'] );
        }

        $iframe = '<iframe id="buto_iframe_' . $video_id . '" src="http://embed.buto.tv/' . $video_id . '" width="' . $width.'" height="' . $height . '" frameborder="0" scrolling="no"></iframe> ';

    	return apply_filters( 'embed_butotv', $iframe, $matches, $attr, $url, $rawattr );
    }

}
