<?php
/**
 * Gallery Carousel
 *
 *
 */
namespace Ecoiefy\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Events extends \Elementor\Widget_Base{

	public function get_name(){
		return 'efy_event';
	}

	public function get_title(){
		return __('Events', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('eicon-calendar eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}

	public function get_keywords(){
		return ['gallery', 'photo', 'isotop', 'filter', 'events'];
	}

	protected function _register_controls(){

		$this->start_controls_section('events_section',
			[
				'label' => __( 'Eevent Settings', 'ecoiefy-companion' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 

		?>
				<p>	Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Voluptas, dolore?	</p>
		<?php
	}

}
