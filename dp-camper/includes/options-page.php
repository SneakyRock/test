<?php
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 
// Generate the options page HTML
function dp_camper_options_page() {
    // Check if the current user has permission to access the options page
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
 
    // If the form has been submitted, save the options in the database
    if (isset($_POST['submit'])) {
        // Verify the nonce before proceeding
        if (!isset($_POST['dp_camper_options_nonce']) || !wp_verify_nonce($_POST['dp_camper_options_nonce'], 'dp_camper_options')) {
            wp_die('Security check failed. Please try again.');
        }
        // Save the options in the database
        update_option('dp_camper_api_key', sanitize_text_field($_POST['dp_camper_api_key']));
        update_option('dp_camper_api_url', sanitize_text_field($_POST['dp_camper_api_url']));
        update_option('dp_camper_client_id', sanitize_text_field($_POST['dp_camper_client_id']));
        echo '<div class="notice notice-success is-dismissible"><p>Options saved successfully!</p></div>';
    }
 
    // Get the options from the database
    $dp_camper_api_key = get_option('dp_camper_api_key', '');
    $dp_camper_api_url = get_option('dp_camper_api_url', '');
    $dp_camper_client_id = get_option('dp_camper_client_id', '');
 
    // Output the options page HTML
    ?>
    <div class="wrap">
        <h1>DP Camper Plugin Options</h1>
        <form method="post" action="">
            <?php wp_nonce_field('dp_camper_options', 'dp_camper_options_nonce'); ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="dp_camper_api_key">API Key</label></th>
                        <td>
                            <input name="dp_camper_api_key" type="text" id="dp_camper_api_key" value="<?php echo esc_attr($dp_camper_api_key); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="dp_camper_api_url">API URL</label></th>
                        <td>
                            <input name="dp_camper_api_url" type="text" id="dp_camper_api_url" value="<?php echo esc_attr($dp_camper_api_url); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="dp_camper_client_id">Client ID</label></th>
                        <td>
                            <input name="dp_camper_client_id" type="text" id="dp_camper_client_id" value="<?php echo esc_attr($dp_camper_client_id); ?>" class="regular-text" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </p>
        </form>
        <p>
            <input type="button" class="button" id="fetch-camper-data" value="Fetch Camper Data">
        </p>
    </div>
    <?php
}
 
// Save the options in the database
function dp_save_camper_options() {
    if (isset($_POST['submit'])) {
        // Verify the nonce before proceeding.
        if (!isset($_POST['dp_camper_options_nonce']) || !wp_verify_nonce($_POST['dp_camper_options_nonce'], 'dp_camper_options')) {
            wp_die('Security check failed. Please try again.');
        }
        update_option('dp_camper_api_key', sanitize_text_field($_POST['dp_camper_api_key']));
        update_option('dp_camper_api_url', sanitize_text_field($_POST['dp_camper_api_url']));
        update_option('dp_camper_client_id', sanitize_text_field($_POST['dp_camper_client_id']));
        echo '<div class="notice notice-success is-dismissible"><p>Options saved successfully!</p></div>';
    }
}
add_action('admin_init', 'dp_save_camper_options');
 
// Add options page
add_action('admin_menu', 'dp_camper_options_submenu');
function dp_camper_options_submenu() {
  add_submenu_page(
    'edit.php?post_type=dp_camper',
    'DP Camper API Settings',
    'API Settings',
    'manage_options',
    'dp-camper-options',
    'dp_camper_options_page'
  );
}
 
 
 
 
?>
 
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  (function($) {
    $('#fetch-camper-data').click(function() {
      $.ajax({
        url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
        type: 'post',
        data: {
          action: 'dp_fetch_camper_data',
          nonce: '<?php echo wp_create_nonce( "dp_fetch_camper_data" ); ?>'
        },
        success: function(response) {
          alert(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error: ' + textStatus + ' - ' + errorThrown);
        }
      });
    });
  })(jQuery);
});
</script>