<?php
/**
 * Testimonial
 *
 *
 */
namespace Ecoiefy\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Testimonial extends \Elementor\Widget_Base{

	public function get_name(){
		return 'ecoiefy_testimonial';
	}

	public function get_title(){
		return __(' Testimonial', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('eicon-testimonial-carousel eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		wp_enqueue_script( 'ecoiefy-testimonial',
		ECOIEFY_ASSETS_ASSETS . 'js/ecoiefy-testimonial.js',[], ECOIEFY_VERSION, true );
	 }

	public function get_script_depends() {
		return [ 'ecoiefy-testimonial' ];
	}
	

	public function get_keywords(){
		return ['team', 'membar', 'portfolio', 'profile', 'volunteer', 'testimonial'];
	}

	protected function _register_controls(){

		$this->start_controls_section('testimonail_section',
			[
				'label' => __( 'Testimonial Settings', 'ecoiefy-companion' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			't_name', [
				'label' => __( 'Name', 'ecoiefy-companion' ),
				'type'  => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			't_titel', [
				'label' => __( 'Titile', 'ecoiefy-companion' ),
				'type'  => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			't_content', [
				'label' => __( 'Testimonial', 'ecoiefy-companion' ),
				'type'  => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			't_thumb', [
				'label' => __( 'Image', 'ecoiefy-companion' ),
				'type'  => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'efy_testimonials',
			[
				'label'   => __( 'Gallery Items', 'exeter' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						't_content'     => __( 'Competently whiteboard future-proof growth strategies', 'ecoiefy-companion' ),
						't_name'        => __( 'Alson Freeman', 'ecoiefy-companion' ),
                        't_titel'       => __( 'Businessman', 'ecoiefy-companion' ),
                        't_thumb' => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						't_content'     => __( 'Competently whiteboard future-proof growth strategies', 'ecoiefy-companion' ),
						't_name'        => __( 'Masum Sakib', 'ecoiefy-companion' ),
                        't_titel'       => __( 'Businessman', 'ecoiefy-companion' ),
                        't_thumb' => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						't_content'     => __( 'Competently whiteboard future-proof growth strategies', 'ecoiefy-companion' ),
						't_name'        => __( 'Dexter Exe', 'ecoiefy-companion' ),
                        't_titel'       => __( 'Businessman', 'ecoiefy-companion' ),
                        't_thumb' => ['url' => Utils::get_placeholder_image_src()],
					],
					[
						't_content'     => __( 'Competently whiteboard future-proof growth strategies', 'ecoiefy-companion' ),
						't_name'        => __( 'Alex Care', 'ecoiefy-companion' ),
                        't_titel'       => __( 'Businessman', 'ecoiefy-companion' ),
                        't_thumb'       => ['url' => Utils::get_placeholder_image_src()],
					],
				],
				'title_field' => '{{{ t_name }}}',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display(); 
		$efy_testimonials = $settings['efy_testimonials'];

		?>	

		<div class="efy_testimonial_section">
			<div class="efy_three_item_slider owl-carousel">

				<?php foreach ($efy_testimonials as $efy_testimonial):

					$image = wp_get_attachment_image_url( $efy_testimonial['t_thumb']['id']);
					if (!$image) {
						$image = Utils::get_placeholder_image_src();
					};

				 ?>
					<div class="efy_testimonial_item">
						<div class="efy_testimonial_content">
							<?php echo ecoiefy_get_meta($efy_testimonial['t_content']); ?>
						</div>
						<div class="efy_testimonial_client">
							<div class="efy_testimonial_client_img">
								<img src="<?php echo esc_url($image) ?>" alt="">
							</div>

							<div class="efy_testimonial_client_neme">
								<h3 class="font-weight-semi-bold m-b-5"><?php echo esc_html($efy_testimonial['t_name']) ?></h3>
								<p><?php echo esc_html($efy_testimonial['t_titel']) ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php

		

	}

}