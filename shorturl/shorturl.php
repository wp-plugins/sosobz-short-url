<?php
/*
Plugin Name: Soso.Bz Short URL
Plugin URI: http://Soso.Bz
Description: Automatically shortens the blog post URL. Based on GentleSource.
Version: 1.0.0
Author: Soso.Bz
Author URI: http://Soso.Bz
*/

define('DEFAULT_API_URL', 'http://soso.bz/api.php?url=%s');

class GentleSource_Short_URL
{
    function create($post_id)
    {
        if (!$apiURL = get_option('gentlesourceShortUrlApiUrl')) {
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
            delete_post_meta($post_id, 'GentleSourceShortURL');
            $res = add_post_meta($post_id, 'GentleSourceShortURL', $result, true);
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
            $opt[$key] = get_option('gentlesourceShortUrl' . $key);
        }

        $shortUrl = get_post_meta($post->ID, 'GentleSourceShortURL', true);

        if (empty($shortUrl)) {
            return $content;
        }

        $shortUrlEncoded = urlencode($shortUrl);

        ob_start();
        include './wp-content/plugins/shorturl/template/show.php';
        $content .= ob_get_contents();
        ob_end_clean();

        return $content;
    }
}

$gssu = new GentleSource_Short_URL;

if (is_admin()) {
    add_action('edit_post', array(&$gssu, 'create'));
    add_action('save_post', array(&$gssu, 'create'));
    add_action('publish_post', array(&$gssu, 'create'));
} else {
    add_filter('the_content', array(&$gssu, 'display'));
}