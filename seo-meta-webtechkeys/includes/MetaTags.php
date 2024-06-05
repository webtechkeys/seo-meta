<?php

namespace Webtechkeys\SEO_Meta;
class MetaTags
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'add_meta_tags'], 2);
    }

    public function add_meta_tags()
    {
        if (is_singular()) {
            global $post;

            $meta_title = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_title', true);
            $meta_description = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_description', true);
            $meta_keywords = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_keywords', true);
            $meta_author = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_author', true);
            $link_canonical = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_link_canonical', true);

            if (!empty($meta_title)) {
                echo '<title>' . esc_attr($meta_title) . '</title>' . "\n";
            }
            if (!empty($meta_description)) {
                echo '<meta name="description" content="' . esc_attr($meta_description) . '" />' . "\n";
            }
            if (!empty($meta_keywords)) {
                echo '<meta name="keywords" content="' . esc_attr($meta_keywords) . '" />' . "\n";
            }
            if (!empty($meta_author)) {
                echo '<meta name="author" content="' . esc_attr($meta_author) . '" />' . "\n";
            }
            if (!empty($link_canonical)) {
                echo '<link rel="canonical" href="' . esc_attr($link_canonical) . '" />' . "\n";
            }
        }
    }
}
