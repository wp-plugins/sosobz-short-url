<?php
/*
Plugin Name: SosoBz Short URL
Plugin URI: http://ur1.bz
Description: Automatically shortens the blog post URL.
Version: 1.3
Author: Soso.Bz
Author URI: http://ur1.bz
*/

define('DEFAULT_API_URL', 'http://ur1.bz/api.php?url=%s');

class SosoBz_Short_URL
{
    function create($post_id)
    {
        if (!$apiURL = get_option('sosobzShortUrlApiUrl')) {
            $apiURL = DEFAULT_API_URL;
        }

        $post = get_post($post_id);
        $pos = strpos($post->post_name, 'autosave');
        if ($pos !== false) {
            return false;
        }
        $pos = strpos($post->post_name, 'revision');
        if ($pos !== false) {
            return false;
        }

        $apiURL = str_replace('%s', urlencode(get_permalink($post_id)), $apiURL);

        $result = false;

        if (ini_get('allow_url_fopen')) {
            if ($handle = @fopen($apiURL, 'r')) {
                $result = fread($handle, 4096);
                fclose($handle);
            }
        } elseif (function_exists('curl_init')) {
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $result = @curl_exec($ch);
            curl_close($ch);
        }

        if ($result !== false) {
            delete_post_meta($post_id, 'SosoBzShortURL');
            $res = add_post_meta($post_id, 'SosoBzShortURL', $result, true);
            return true;
        }
    }

    function options()
    {
        return array(
           'ApiUrl'         => DEFAULT_API_URL,
           'Display'        => 'Y',
           );
    }

    function display($content)
    {

        global $post;

        if ($post->ID <= 0) {
            return $content;
        }

        $options = $this->options();

        foreach ($options AS $key => $val)
        {
            $opt[$key] = get_option('sosobzShortUrl' . $key);
        }

        $shortUrl = get_post_meta($post->ID, 'SosoBzShortURL', true);

        if (empty($shortUrl)) {
            return $content;
        }

        $shortUrlEncoded = urlencode($shortUrl);

        ob_start();
        include './wp-content/plugins/post-address-shortening/show.php';
        $content .= ob_get_contents();
        ob_end_clean();

        return $content;
    }
}

$gssu = new SosoBz_Short_URL;

if (is_admin()) {
    add_action('publish_post', array(&$gssu, 'create'));
} else {
    add_filter('the_content', array(&$gssu, 'display'));
}