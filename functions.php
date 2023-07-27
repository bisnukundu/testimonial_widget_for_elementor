<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// checking elementor active or not
function bisnu_js_enque()
{
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com',[],1);
}

add_action('wp_enqueue_scripts', 'bisnu_js_enque');

function bisnu_init()
{

    if (is_plugin_active('elementor/elementor.php')) {

        function my_custom_admin_notice()
        {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e('Bisnu Kundu Elemenor is active!', 'text-domain'); ?></p>
            </div>
            <?php
        }

        add_action('admin_notices', 'my_custom_admin_notice');

    } else {
        // Elementor is not active
        function notice_fn2()
        {
            ?>
            <div class="notice error is-dismissible">
                <p><?php _e('Bisnu Kundu Elemenor is not active! please active elementor plugin', 'text-domain'); ?></p>
            </div>
            <?php
        }

        ;
        add_action('wp_notice', notice_fn2());
    }

}

//bisnu_init();

add_action('admin_init', 'bisnu_init');

require_once('elementor-addon/addon.php');

function bisnu_custom_post_type()
{
    register_post_type("bisnu_team_view", [
        'label' => esc_html__('Team', 'elementor-addon'),
        'public' => false,
        'show_ui' => true,
        'supports' => ['editor', 'thumbnail', 'title', 'author']
    ]);
}

add_action('init', 'bisnu_custom_post_type');

function bisnu_team_shortcode()
{
    $team_data = new wp_query([
        'post_type' => 'bisnu_team_view',
        'per_page' => -1,
        'post_status' => 'publish'
    ]);

    $html = '';
    while ($team_data->have_posts()) {
        $team_data->the_post();
        $html .= "<p class='bg-red-500 text-white'>" . get_the_title() . "</p>";
    }

    wp_reset_query();
    return $html;
}

;
add_shortcode('bisnu_teams_stc', 'bisnu_team_shortcode');

