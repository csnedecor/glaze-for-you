<?php
// Enqueue stylesheets
function glazy_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'glazy_enqueue_styles', 11 );

function remove_sidebars(){
    unregister_sidebar('home1');
    unregister_sidebar('home2');
    unregister_sidebar('home3');
}
add_action('widgets_init', 'remove_sidebars', 11);

include('inc/customizer.php');
