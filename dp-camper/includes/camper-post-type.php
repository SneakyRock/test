<?php
function dp_create_camper_post_type() {
    register_post_type( 'dp_camper',
        array(
            'labels' => array(
                'name' => __( 'Camper' ),
                'singular_name' => __( 'Camper' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'dp_camper'),
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-location-alt'
        )
    );
}
add_action( 'init', 'dp_create_camper_post_type' );
?>