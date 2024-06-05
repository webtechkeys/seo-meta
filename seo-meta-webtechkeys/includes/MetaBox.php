<?php

namespace Webtechkeys\SEO_Meta;
class MetaBox
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta_box_data']);
    }

    public function add_meta_box()
    {
        add_meta_box(
            'seo_meta_webtechkeys_meta_box',
            'SEO Meta Tags',
            [$this, 'render_meta_box_html'],
            ['post', 'page'],
            'side',
            'high'
        );
    }

    public function render_meta_box_html($post)
    {
        $meta_title = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_title', true);
        $meta_description = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_description', true);
        $meta_keywords = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_keywords', true);
        $meta_author = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_author', true);
        $link_canonical = get_post_meta($post->ID, '_seo_meta_webtechkeys_meta_link_canonical', true);
        wp_nonce_field('seo_meta_webtechkeys_meta_box', 'seo_meta_webtechkeys_meta_box_nonce');

?>
        <p>
            <label for="seo_meta_webtechkeys_meta_title"><?php esc_attr_e('Title', 'seo-meta-webtechkeys-plugin'); ?></label>
            <input type="text" id="seo_meta_webtechkeys_meta_title" name="seo_meta_webtechkeys_meta_title" value="<?php echo esc_attr($meta_title); ?>" style="width: 100%;" class="regular-text" placeholder="Add your meta title">
        </p>
        <p>
            <label for="seo_meta_webtechkeys_meta_description"><?php esc_attr_e('Meta Description', 'seo-meta-webtechkeys-plugin'); ?></label>
            <textarea id="seo_meta_webtechkeys_meta_description" name="seo_meta_webtechkeys_meta_description" rows="2" style="width: 100%;" class="widefat" placeholder="Add your meta description"><?php echo esc_attr($meta_description); ?></textarea>
        </p>
        <p>
            <label for="seo_meta_webtechkeys_meta_keywords"><?php esc_attr_e('Meta Keywords', 'seo-meta-webtechkeys-plugin'); ?></label>
            <input type="text" id="seo_meta_webtechkeys_meta_keywords" name="seo_meta_webtechkeys_meta_keywords" value="<?php echo esc_attr($meta_keywords); ?>" class="widefat" style="width: 100%;" placeholder="Add your keywords with comma separator">
        </p>
        <p>
            <label for="seo_meta_webtechkeys_meta_author"><?php esc_attr_e('Meta Author', 'seo-meta-webtechkeys-plugin'); ?></label>
            <input type="text" id="seo_meta_webtechkeys_meta_author" name="seo_meta_webtechkeys_meta_author" value="<?php echo esc_attr($meta_author); ?>" class="widefat" style="width: 100%;" placeholder="Add author name">
        </p>
        <p>
            <label for="seo_meta_webtechkeys_meta_link_canonical"><?php esc_attr_e('Link Canonical', 'seo-meta-webtechkeys-plugin'); ?></label>
            <input type="text" id="seo_meta_webtechkeys_meta_link_canonical" name="seo_meta_webtechkeys_meta_link_canonical" value="<?php echo esc_attr($link_canonical); ?>" class="widefat" style="width: 100%;" placeholder="Add conical link">
        </p>
<?php
    }

    public function save_meta_box_data($post_id)
    {
        if (!isset($_POST['seo_meta_webtechkeys_meta_box_nonce']) || !wp_verify_nonce($_POST['seo_meta_webtechkeys_meta_box_nonce'], 'seo_meta_webtechkeys_meta_box')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        if (isset($_POST['seo_meta_webtechkeys_meta_title'])) {
            $meta_title = sanitize_text_field($_POST['seo_meta_webtechkeys_meta_title']);
            update_post_meta($post_id, '_seo_meta_webtechkeys_meta_title', $meta_title);
        }

        if (isset($_POST['seo_meta_webtechkeys_meta_keywords'])) {
            $meta_keywords = sanitize_text_field($_POST['seo_meta_webtechkeys_meta_keywords']);
            update_post_meta($post_id, '_seo_meta_webtechkeys_meta_keywords', $meta_keywords);
        }

        if (isset($_POST['seo_meta_webtechkeys_meta_description'])) {
            $meta_description = sanitize_text_field($_POST['seo_meta_webtechkeys_meta_description']);
            update_post_meta($post_id, '_seo_meta_webtechkeys_meta_description', $meta_description);
        }

        if (isset($_POST['seo_meta_webtechkeys_meta_author'])) {
            $meta_author = sanitize_text_field($_POST['seo_meta_webtechkeys_meta_author']);
            update_post_meta($post_id, '_seo_meta_webtechkeys_meta_author', $meta_author);
        }

        if (isset($_POST['seo_meta_webtechkeys_meta_link_canonical'])) {
            $link_canonical = sanitize_text_field($_POST['seo_meta_webtechkeys_meta_link_canonical']);
            update_post_meta($post_id, '_seo_meta_webtechkeys_meta_link_canonical', $link_canonical);
        }
    }
}
