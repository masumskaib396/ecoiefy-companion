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

class GalleryCarousel extends \Elementor\Widget_Base{

	public function get_name(){
		return 'efy_gallery_carousel';
	}

	public function get_title(){
		return __(' Gallery Carousel', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('eicon-media-carousel eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		wp_enqueue_script( 'ecoiefy-gallery-c',
		ECOIEFY_ASSETS_ASSETS . 'js/ecoiefy-gallery-carousel.js',[], ECOIEFY_VERSION, true );
	 }

	public function get_script_depends() {
		return [ 'ecoiefy-gallery-c' ];
	}
	

	public function get_keywords(){
		return ['gallery', 'photo'];
	}

	protected function _register_controls(){

		$this->start_controls_section('gallery_section',
			[
				'label' => __( 'Gallery Settings', 'ecoiefy-companion' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery_c',
			[
				'label' => __( 'Content', 'ecoiefy-companion' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Please click on button arrow in order to view more or View all photo gallery', 'ecoiefy-companion'),
			],
		);

		$this->end_controls_section();
	}

	protected function render() {


		$settings = $this->get_settings_for_display(); 
		$gallery_c = $settings['gallery_c'];


		$gallery_args = array( 
			'posts_per_page' => -1,
			'post_type'=> 'egs',
			'post_status' => 'publish',
		);
		$efg_loop = new \WP_Query($gallery_args);


		?>	
			
			<div class="efy_gallery_section">
				<div class="efy_gallery_slider owl-carousel">
					<?php while($efg_loop->have_posts()): $efg_loop->the_post();?>
					<div class="efy_single_galley">
						<a class="efy_zoom_gallery" href="<?php the_post_thumbnail_url('full') ?>">
							<?php the_post_thumbnail('large') ?>
							<div class="efy_gallery_hover text-center">
								<span class="text-efy-mantis m-b-20">+</span>
								<h3 class="text-efy-white font-weight-semi-bold"><?php the_title(); ?></h3>
							</div>
						</a>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>

				<div class="efy_single_content_section bg-efy-mantis text-center">
					<div class="container">
						<div class="efy_single_content p-t-b-60">
							<div class="text-efy-white efy-font-24">
								<?php echo ecoiefy_get_meta($gallery_c) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

}
