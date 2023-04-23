<?php

// Load WordPress environment
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(dirname(__FILE__)) . '/');
}

if (!defined('WPINC')) {
    require_once(ABSPATH . 'wp-load.php');
}

// Check if user is authorized to perform action
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

// Get plugin options
$dp_camper_api_key = get_option('dp_camper_api_key', '');
$dp_camper_api_url = get_option('dp_camper_api_url', '');
$dp_camper_client_id = get_option('dp_camper_client_id', '');

// Check if API key is set
if (empty($dp_camper_api_key)) {
    wp_die(__('Please enter a valid API key.'));
}

// Check if API URL is set
if (empty($dp_camper_api_url)) {
    wp_die(__('Please enter a valid API URL.'));
}

// Check if Client ID is set
if (empty($dp_camper_client_id)) {
    wp_die(__('Please enter a valid Client ID.'));
}

// Build API request URL
$request_url = $dp_camper_api_url . '/objects';

// Set request headers
$headers = array(
    'Content-Type' => 'application/json',
    'Authorization' => 'Bearer ' . $dp_camper_api_key,
    'ClientId' => $dp_camper_client_id,
);

// Make API request
$response = wp_remote_get($request_url, array(
    'headers' => $headers,
));

// Check if API request was successful
if (is_wp_error($response)) {
    $error_message = $response->get_error_message();
    wp_die(__('Error fetching data: ') . $error_message);
}

// Parse API response
$data = json_decode(wp_remote_retrieve_body($response));

// Check if data is valid
if (empty($data) || !is_array($data)) {
    wp_die(__('Error fetching data: Invalid response format.'));
}

// Loop through data and create/update posts
foreach ($data as $object) {
    // Check if post already exists
    $post_id = post_exists($object->carModel . ' ' . $object->carId, '', '', 'dp_camper');

    // Set post data
    $post_data = array(
        'post_type' => 'dp_camper',
        'post_title' => $object->carModel . ' ' . $object->carId,
        'post_content' => $object->carModel . ' ' . $object->carId,
        'post_status' => 'publish',
    );

    // If post doesn't exist, create it
    if (!$post_id) {
        $post_id = wp_insert_post($post_data);
    }
    // If post exists, update it
    else {
        $post_data['ID'] = $post_id;
        wp_update_post($post_data);
    }

    // Set post meta
    update_post_meta($post_id, 'car_brand', $object->carBrand);
    update_post_meta($post_id, 'car_model', $object->carModel);
}


?>