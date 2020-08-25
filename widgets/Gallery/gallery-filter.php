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

class GalleryFilter extends \Elementor\Widget_Base{

	public function get_name(){
		return 'efy_gallery_filter';
	}

	public function get_title(){
		return __(' Gallery Filter', 'ecoiefy-companion');
	}

	public function get_icon(){
		return ('eicon-media-carousel eicon-button');
	}

	public function get_categories(){
		return ['ecoiefy'];
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		wp_enqueue_script( 'ecoiefy-isotope-filter',
		ECOIEFY_ASSETS_ASSETS . 'js/isotope.pkgd.min.js',['jquery','ecoiefy-gallery-filter'], ECOIEFY_VERSION, true );

		wp_enqueue_script( 'ecoiefy-gallery-filter',
		ECOIEFY_ASSETS_ASSETS . 'js/ecoiefy-gallery-filter.js',['jquery'], ECOIEFY_VERSION, true );
	 }

	public function get_script_depends() {
		return [ 'ecoiefy-gallery-filter' ];
	}
	

	public function get_keywords(){
		return ['gallery', 'photo', 'isotop', 'filter'];
	}

	protected function _register_controls(){

		$this->start_controls_section('gallery_filter_section',
			[
				'label' => __( 'Gallery Settings', 'ecoiefy-companion' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$args_filter = array( 
			'posts_per_page' => -1,
			'post_type'=> 'egs',
			'post_status' => 'publish',
		);
		$filter_loop = new \WP_Query($args_filter);

		?>	
		<div class="efy_gallery_section">
			<div class="container">
				<div class="efy_gallery_menu m-b-85 text-center">
					<div class="watch-gallery-nav">
						<ul id="watch-filter-gallery" class="option-set clear-both" data-option-key="filter">
							<li data-option-value="*"><a class="active">
								<?php _e('All', 'ecoiefy-companion') ?></a>
							</li>
							<?php
								 $ecoefy_gallery_cats = get_terms('egs_tax');
								 foreach ($ecoefy_gallery_cats  as $ecoefy_gallery_cat ): ?>
									<li data-option-value=".<?php echo $ecoefy_gallery_cat->slug; ?>"><a class="active">
										<?php echo $ecoefy_gallery_cat->name; ?>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
				<div class="efy_galler_item" id="efy_gallery_three_column">

					<?php while($filter_loop->have_posts()): $filter_loop->the_post();

						$terms = get_the_terms( get_the_ID(), 'egs_tax' );    
						if ( $terms && ! is_wp_error( $terms ) ) : 
							$draught_links = array();
							foreach ( $terms as $term ) {
								$draught_links[] = $term->slug;
							}				 
							$on_draught = join( " ", $draught_links );
						endif;
					 	?>

						<div class="collection-grid-item <?php echo esc_attr($on_draught) ?>">
							<div class="efy_single_galley">
								<a class="efy_zoom_gallery" href="<?php the_post_thumbnail_url('full') ?>">
									<?php the_post_thumbnail('large') ?>
									<div class="efy_gallery_hover text-center">
										<span class="text-efy-mantis m-b-20">+</span>
										<h3 class="text-efy-white font-weight-semi-bold">
											<?php the_title(); ?>
										</h3>
									</div>
								</a>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
				<div class="efy_pagination d-flex justify-content-between m-t-80">
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
		</div><!--- End efy_gallery_section -->
		
		<?php
	}

}
