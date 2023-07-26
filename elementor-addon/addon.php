<?php
//new category registerd
function bisnu_print($arry)
{
    echo '<pre>';
    print_r($arry);
    echo '</pre>';

}

function bisnu_add_new_category($elements_manager)
{
    $elements_manager->add_category('bisnu_category', [
        'title' => "Bisnu Category",
    ]);


}

add_action('elementor/elements/categories_registered', 'bisnu_add_new_category');

//widget registerd
function bisnu_elementor_addon_register($widget_manager)
{

    require_once('widgets/testimonial.php');
    $widget_manager->register(new Bisnu_Testimonial);
}

;
add_action('elementor/widgets/register', 'bisnu_elementor_addon_register');

