<?php
/**
 * Thmpw Volunteer Widget.
 *
 *
 */
namespace Ecoiefy\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Volunteer extends \Elementor\Widget_Base{

	public function get_name(){
		return 'volunteer';
	}

	public function get_title(){
		return __(' Volunteer', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('eicon-button eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}	

	public function get_keywords(){
		return ['team', 'membar', 'portfolio', 'profile', 'volunteer'];
	}

	protected function _register_controls(){

		$this->start_controls_section('volunteer_section',
			[
				'label' => __( 'Volunteer Settings', 'ecoiefy-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'volunteer_per_page',
			[
				'label' => __( 'Numbar Of Items', 'ecoiefy-companion' ),
				'description' => 'user empty value show all posts',
				'type' => Controls_Manager::NUMBER,
				'default' => '',
			]
		);
		//Per Column
		$this->add_responsive_control( 'per_line', [
            'label'              => __( 'Columns per row', 'ecoiefy-companion' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '6',
                'mobile_default'     => '12',
                'options'            => [
                    '12'=> '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                ],
            	'frontend_available' => true,
        ] );

        $this->add_responsive_control(
            'v_image_height',
            [
                'label' => __( 'Height', 'ecoiefy-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .efy_team_img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



		$this->add_control(
			'show_volunteer_box',
			[
				'label' => __( 'Show Volunteer Box', 'ecoiefy-companion' ),
				'type'  => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'ecoiefy-companion' ),
				'label_off' => __( 'Hide', 'ecoiefy-companion' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'v_box_title',
			[
				'label' => __( 'Title', 'ecoiefy-companion' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Support with us', 'ecoiefy-companion'),
				'condition' => [
					'show_volunteer_box' => 'yes',
				],
			],
		);

		$this->add_control(
			'v_box_content',
			[
				'label' => __( 'Content', 'ecoiefy-companion' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Joined as a<br/><strong class="efy-font-30">Volunteer</strong>', 'ecoiefy-companion'),
				'condition' => [
					'show_volunteer_box' => 'yes',
				],
			],
		);

		$this->add_control('ecoiefy_btn_link', 
			[
				'label'         => __('Link Type', 'ecoiefy-companion'),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'url'   => __('URL', 'ecoiefy-companion'),
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
		
		$this->add_control('ecoiefy_btn_existing_link',
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

		$settings = $this->get_settings_for_display(); 

		//box content	
		$show_volunteer_box = $settings['show_volunteer_box'];
		$v_box_title = $settings['v_box_title'];
		$v_box_content = $settings['v_box_content'];

		//custom post content 
		$volunteer_per_page = !empty($settings['volunteer_per_page']) ? $settings['volunteer_per_page'] : 1000;
		
		$args = array( 
			'posts_per_page' => $volunteer_per_page,
			'post_type'=> 'volunteer',
			'post_status' => 'publish',
		);

		$volunteers = new \WP_Query($args);

		$grid_classes = array();
	    $grid_classes[] = 'col-lg-' . $settings['per_line'];
	    $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
	    $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
	    $grid_classes = implode( ' ', $grid_classes );
		$this->add_render_attribute('efy_grid_cls', 'class', [$grid_classes]);


		// if( $settings['ecoiefy_btn_link'] == 'url' ){
  //           $button_url = $settings['ecoiefy_btn_link']['url'];
  //       } else {
  //           $button_url = get_permalink( $settings['pawelem_button_existing_link'] );
  //       }

        
		
		// $this->add_render_attribute( 'pawelem_button', [
		// 	'href'	=> esc_attr($button_url),
		// ]);

        
		// if( $settings['pawelem_button_link']['is_external'] ) {
		// 	$this->add_render_attribute( 'pawelem_button', 'target', '_blank' );
		// }
		// if( $settings['pawelem_button_link']['nofollow'] ) {
		// 	$this->add_render_attribute( 'pawelem_button', 'rel', 'nofollow');
		// }


		// $this->add_render_attribute( 'pawelem_button', 'data-text', esc_attr($settings['button_text'] ));


		?>	
		<div class="efy_team_section text-center efy_inner_volunteer">
			<div class="container">
				<div class="row">
					<?php while($volunteers->have_posts()): $volunteers->the_post(); ?>

					<?php 
						$position = get_field('position'); 
						$icons   = get_field('social_profile_');

						?>
						<div <?php echo $this->get_render_attribute_string('efy_grid_cls'); ?>>
							<div class="efy_team_item">

								<?php if (has_post_thumbnail()): ?>
									<div class="efy_team_img m-b-25">
										<?php the_post_thumbnail('medium'); ?>
									</div>
								<?php endif ?>

								<div class="efy_team_content p-b-40">
									<a href="<?php the_permalink(); ?>">
										<h3 class="m-b-5 efy-font-20 font-weight-semi-bold">
											<?php the_title(); ?>
										</h3>
									</a>
									
									<p class="m-b-30"><?php echo esc_html($position) ?></p>

									<?php if ($icons): ?>
										<ul class="efy_social_icon list-inline m-0">
											<?php foreach ( $icons as  $icon ): ?>
												<li><a target="_blank" href="<?php echo esc_url($icon['profile_url']) ?>">
													<i class="icon icon-<?php echo esc_attr($icon['profile_name']) ?>"></i></a>
												</li>
											<?php endforeach ?>
										</ul>
									<?php endif ?>

								</div>

							</div>
						</div>
				    <?php endwhile; wp_reset_postdata(); ?>


				    <?php if( $show_volunteer_box ): ?>
						<div class="col-lg-3 col-md-3">
							<div class="efy_volunteer_joined bg-efy-saltpan">
								<p class="text-efy-primary m-b-40 efy-font-20">
									<?php echo esc_html($v_box_title) ?>
								</p>

								<h3 class="text-efy-ebony m-b-40  efy-line-height-1-3 efy-font-24 font-weight-medium ">
									<?php echo ecoiefy_get_meta($v_box_content); ?>
								</h3>

								<a class="efy_default_btn bg-efy-mantis text-efy-white" href="#">
									Joined Now<i class="icon icon-ar-left"></i>
								</a>
							</div>
						</div>
					<?php endif; ?>

				</div><!--- End row -->

				<div class="efy_pagination d-flex justify-content-between">

					<div class="efy_single_pagination">
						<div class="efy_pagination_icon bg-efy-white text-efy-mantis text-center">
							<i class="icon icon-ar-right"></i>
						</div>
					</div>

					<div class="efy_single_pagination">
						<ul>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">.</a></li>
							<li><a href="#">.</a></li>
							<li><a href="#">.</a></li>
							<li><a href="#">.</a></li>
							<li><a href="#">12</a></li>
							<li><a href="#">13</a></li>
							<li><a href="#">14</a></li>
						</ul>
					</div>

					<div class="efy_single_pagination">
						<div class="efy_pagination_icon bg-efy-white text-efy-mantis text-center">
							<i class="icon icon-ar-left"></i>
						</div>
					</div>

				</div>
			</div><!--- End container -->
		</div><!--- End efy_team_section -->

		<?php

		

	}

}