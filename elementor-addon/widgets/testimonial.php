<?php

class Bisnu_Testimonial extends \Elementor\Widget_Base
{
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
        $repeater->add_control('tsc_title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Testimonial'
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
        ]);
        $repeater->add_control('tsc_lnMore_btn', [
            'label' => 'Learn More URL',
            'type' => \Elementor\Controls_Manager::URL,
        ]);
        $repeater->add_control('tsc_visit_btn_txt', [
            'label' => 'Start Visit Button',
            'default' => 'st visit text',
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $repeater->add_control('tsc_visit_btn_link', [
            'label' => 'Start Visit URL',
            'type' => \Elementor\Controls_Manager::URL,
        ]);
        $repeater->add_control('tsc_rating', [
            'label' => "Rating",
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5,
        ]);

        $this->add_control(
            'testimonial_item',
            [
                'label' => esc_html__('Testimonial Item', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tsc_title}}}',
            ]
        );
        $this->end_controls_section();
    }

    function render()
    {
        return "<p>Bisnu Kundu</p>";
    }

}