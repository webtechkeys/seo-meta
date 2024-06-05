<?php

/*
 * Plugin Name
 * 
 * @package         SEO
 * @author          Webtechkeys
 * @copyright       2024 Webtechkeys
 * @license         GPL-2.0-or-later
 * 
 * @wordpress-plugin * 
 * Plugin Name: SEO Meta Webtechkeys
 * Description: Add your SEO meta tags on the page header
 * Version: 1.0
 * Requires at least: 5.4
 * Requires PHP: 7.4
 * Author: Webtechkeys
 * License: GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0-standalone.html
 * Text Domain:       seo-meta-webtechkeys
 */

 namespace Webtechkeys\SEO_Meta;

 if (!defined('ABSPATH')) {
    exit;
}

use Webtechkeys\SEO_Meta\MetaBox;
use Webtechkeys\SEO_Meta\MetaTags;

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

new MetaBox();
new MetaTags();
