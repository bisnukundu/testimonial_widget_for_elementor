<?php


class Bisnu_Testimonial extends \Elementor\Widget_Base
{
    function bisnu_print($arr)
    {
        echo "<pre>";
        echo print_r($arr);
        echo "</pre>";
    }

    public function get_name()
    {
        return 'Bisnu Testimonial';
    }

    public function get_title()
    {
        return esc_html__('Testimonial', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-group';
    }

    public function get_categories()
    {
        return ['bisnu_category'];
    }

    public function get_keywords()
    {
        return ['testimonial', 'widget'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('testimonial_aa', [
                'label' => "Testimonial Info",
                'type' => Elementor\Controls_Manager::TAB_CONTENT]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('tsc_profile', [
            'label' => "Image",
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('tsc_name', [
            'label' => "Name",
            "default" => "Jone",
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
        ]);
        $repeater->add_control('tsc_description', [
            'label' => 'Description',
            'default' => 'test description',
            'type' => \Elementor\Controls_Manager::TEXT
        ]);
        $repeater->add_control('tsc_lnMore_btn_txt', [
            'label' => 'Learn More Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => "Learn More"
        ]);
        $repeater->add_control('tsc_lnMore_url', [
            'label' => 'Learn More URL',
            'type' => \Elementor\Controls_Manager::URL,
        ]);
        $repeater->add_control('tsc_visit_btn_txt', [
            'label' => 'Start Visit Button',
            'default' => 'Visit',
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $repeater->add_control('tsc_visit_btn_link', [
            'label' => 'Start Visit URL',
            'type' => \Elementor\Controls_Manager::URL,
        ]);
        $repeater->add_control('tsc_rating', [
            'label' => "Rating",
            'type' => \Elementor\Controls_Manager::NUMBER,
            'max' => 5,
            'default' => 5,
        ]);

        $this->add_control(
            'testimonial_item',
            [
                'label' => esc_html__('Testimonial Item', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tsc_name}}}',
            ]
        );
        $this->end_controls_section();

//        Setting Option Tab  Start

        $this->start_controls_section('setting_option', [
            'label' => 'Option',
            'type' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control('carousel', [
            'label' => 'Carousel',
            'type' => \Elementor\Controls_Manager::SWITCHER
        ]);
        $this->end_controls_section();
    }

    function render()
    {
        $items = $this->get_settings_for_display();
        $html = '<div>';
        if ($items['carousel'] === 'yes') {
            $html .= "<script>
        jQuery(document).ready(function($) {
            $('.carasole_m').slick({
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 3
        });
        })
        </script>";
        }

        $html .= '<div class="flex carasole_m gap-5 text-center justify-content flex-wrap">';


        foreach ($items['testimonial_item'] as $item) {
            $html .= "<div class='border  p-5 rounded hover:shadow-md hover:translate-y-[-15px] transition cursor-pointer'>";
            $html .= "<div class='mx-auto mb-3 rounded-full h-40 w-40 testimonial_img overflow-hidden'>" . wp_get_attachment_image($item['tsc_profile']['id'], '', '', ['class' => 'rounded-full h-40 w-40']) . "</div>";
            $html .= "<p>" . $item['tsc_name'] . " </p>";
            $html .= "<small>" . $item['tsc_description'] . "</small>";
            $html .= "<p>" . str_repeat("<i class='fas fa-star text-gray-900'></i>", $item['tsc_rating']) . "</p>";
            $html .= "<div class='flex gap-2'>";
            $html .= "<a class='text-sm px-5 py-2 hover:bg-gray-900 hover:text-white transition rounded border shadow' href='{$item['tsc_lnMore_url']['url']}'>" . $item['tsc_lnMore_btn_txt'] . "</a>";
            $html .= "<a class='text-sm px-5 py-2 hover:bg-gray-900 hover:text-white transition rounded border shadow' href='{$item['tsc_visit_btn_link']['url']}'>" . $item['tsc_visit_btn_txt'] . "</a>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= '</div>';
        $html .= '</div>';
        echo $html;
//        bisnu_print($items['carousel']);
    }

}