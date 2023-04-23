<?php
/**
 * Plugin Name: DP Camper
 * Plugin URI: https://yourwebsite.com/
 * Description: Plugin to fetch and display camper data from API.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com/
 * Text Domain: dp-camper
 */
 
if (!defined('ABSPATH')) exit; // Exit if accessed directly
 
// Define constants
define('DPCAMPER_PLUGIN_FILE', __FILE__);
define('DPCAMPER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DPCAMPER_PLUGIN_URL', plugin_dir_url(__FILE__));
 
// Include required files
require_once DPCAMPER_PLUGIN_DIR . 'includes/camper-post-type.php';
require_once DPCAMPER_PLUGIN_DIR . 'includes/options-page.php';
require_once DPCAMPER_PLUGIN_DIR . 'includes/fetch-data.php';
 
?>
