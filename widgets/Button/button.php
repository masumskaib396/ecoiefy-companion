<?php
/**
 * Thmpw Logo Widget.
 *
 *
 * @since 1.0.0
 */
namespace Ecoiefy\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Button extends \Elementor\Widget_Base{

	public function get_name(){
		return 'button';
	}

	public function get_title(){
		return __(' Button ', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('ecoiefy eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		// wp_enqueue_script( 'ecoiefy-test',
		// ECOIEFY_ASSETS_ASSETS . 'js/test.js',[], ECOIEFY_VERSION, true );

		// wp_enqueue_style( 'ecoiefy-test-css',
		// ECOIEFY_ASSETS_ASSETS . 'css/test-css.css',[], ECOIEFY_VERSION, true );
	 }

	public function get_script_depends() {
		return [ 'ecoiefy-test' ];
	}
	 public function get_style_depends() {
		return [ 'ecoiefy-test-css' ];
	}

	public function get_keywords(){
		return ['team', 'membar', 'portfolio', 'profile'];
	}

	protected function _register_controls(){

		$this->start_controls_section('team_section',
			[
				'label' => __( 'Team Content', 'ecoiefy-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control('ecoiefy_button_link_selection', 
			[
				'label'         => __('Link Type', 'ecoiefy-companion'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'url'   => __('URL', 'premium-addons-for-elementor'),
					'link'  => __('Existing Page', 'ecoiefy-companion'),
				],
				'default'       => 'url',
				'label_block'   => true,
			]
        );

		$this->add_control('ecoiefy_button_link',
            [
                'label'         => __('Link', 'ecoiefy-companion'),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'   => 'https://themepaw.com/',
                    'is_external' => '',
                ],
                'show_external' => true,
                'placeholder'   => 'https://themepaw.com/',
                'label_block'   => true,
                'condition'     => [
                    'ecoiefy_button_link_selection' => 'url'
                ]
            ]
		);
		
		$this->add_control('ecoiefy_button_existing_link',
		[
			'label'         => __('Existing Page', 'ecoiefy-companion'),
			'type'          => Controls_Manager::SELECT2,
			'options'       => ecoiefy_get_all_pages(),
			'condition'     => [
				'ecoiefy_button_link_selection'     => 'link',
			],
			'multiple'      => false,
			'separator'     => 'after',
			'label_block'   => true,
		]
	);

	$this->end_controls_section();
	}

	protected function render() {


		?>	
			<i class="icon icon-ar-left"></i>
			<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur, non.</p>

		<?php

		

	}

}