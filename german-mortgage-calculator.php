<?php
/**
 * Plugin Name: German Mortgage Calculator
 * Description: A simple and neat-looking German Mortgage Calculator that calculates the affordable house price based on preferred monthly down payment and other adjustable values.
 * Version: 0.02
 * Author: Dennis Birkhölzer
 * Author URI: https://www.dennisbirkhoelzer.com
 * License: GPLv2 or later
 * Text Domain: german-mortgage-calculator
 */

if (!defined('ABSPATH')) {
    exit;
}

function gmc_enqueue_scripts() {
    wp_enqueue_style('gmc-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('gmc-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css');
}

add_action('wp_enqueue_scripts', 'gmc_enqueue_scripts');

function gmc_shortcode() {
    ob_start();
    ?>
    <div class="gmc-calculator">
        <!-- Calculator form will be placed here -->
        <form class="gmc-form">
    <label for="gmc-monthly-down-payment"><?php _e('Monthly Down Payment:', 'german-mortgage-calculator'); ?></label>
    <input type="number" id="gmc-monthly-down-payment" step="0.01" min="0" required>

    <label for="gmc-interest-rate"><?php _e('Interest Rate:', 'german-mortgage-calculator'); ?></label>
    <input type="number" id="gmc-interest-rate" step="0.01" min="0" value="2.50" required>

    <label for="gmc-term-in-years"><?php _e('Term in Years:', 'german-mortgage-calculator'); ?></label>
    <input type="number" id="gmc-term-in-years" min="1" value="20" required>

    <!-- Additional adjustable values -->
    <button type="button" class="gmc-settings-toggle">
    <i class="fas fa-cog"></i>
    </button>
    <div class="gmc-settings" style="display: none;">
        <label for="gmc-broker-commission"><?php _e('Broker Commission:', 'german-mortgage-calculator'); ?></label>
        <input type="number" id="gmc-broker-commission" step="0.01" min="0" value="3.57" required>
        
        <label for="gmc-notary-fees"><?php _e('Notary Fees:', 'german-mortgage-calculator'); ?></label>
        <input type="number" id="gmc-notary-fees" step="0.01" min="0" value="2.00" required>
        
        <label for="gmc-land-transfer-tax"><?php _e('Land Transfer Tax:', 'german-mortgage-calculator'); ?></label>
        <input type="number" id="gmc-land-transfer-tax" step="0.01" min="0" value="6.50" required>
    </div>


    <!-- ... -->

    <button type="submit"><?php _e('Calculate', 'german-mortgage-calculator'); ?></button>
</form>
<div class="gmc-results">
    <!-- Results will be displayed here -->
</div>

    </div>
    <?php
    return ob_get_clean();
}
// Include the Plugin Update Checker library
require 'plugin-update-checker-5.0/plugin-update-checker.php';

// Configure the update checker
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/bestbirchwood/mortgage-calculator/main/metadata.json',
    __FILE__
);

add_shortcode('german_mortgage_calculator', 'gmc_shortcode');
?>
