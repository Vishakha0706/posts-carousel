<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/vishakha07/
 * @since      1.0.0
 *
 * @package    Posts_Carousel
 * @subpackage Posts_Carousel/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Posts_Carousel
 * @subpackage Posts_Carousel/public
 * @author     Vishakha Gupta <vishakha.wordpress02@gmail.com>
 */
class Posts_Carousel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @author Vishakha Gupta
	 * @since  1.0.0
	 * @access public
	 */
	public function register_styles() {
		wp_register_style( 'owl-carousel-css', plugin_dir_url( __FILE__ ) . 'assets/css/owl.carousel.css', array(), $this->version, 'all' );
		wp_register_style( 'owl-theme-css', plugin_dir_url( __FILE__ ) . 'assets/css/owl.theme.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/posts-carousel-public.css', array(), time(), 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @author Vishakha Gupta
	 * @since  1.0.0
	 * @access public
	 */
	public function register_scripts() {
		wp_register_script( 'owl-carousel-js', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/posts-carousel-public.js', array( 'jquery' ), time(), false );
	}

	/**
	 * Enqueue all scripts and styles.
	 *
	 * @author Vishakha Gupta
	 * @since  1.0.0
	 * @access public
	 */
	public function enqueue_scripts_and_styles() {
		if ( ! wp_style_is( 'owl-carousel-css', 'enqueued' ) ) {
			wp_enqueue_style( 'owl-carousel-css' );
		}
		if ( ! wp_style_is( 'owl-theme-css', 'enqueued' ) ) {
			wp_enqueue_style( 'owl-theme-css' );
		}
		if ( ! wp_style_is( $this->plugin_name, 'enqueued' ) ) {
			wp_enqueue_style( $this->plugin_name );
		}
		if ( ! wp_script_is( 'owl-carousel-js', 'enqueued' ) ) {
			wp_enqueue_script( 'owl-carousel-js');
		}
		if ( ! wp_script_is( $this->plugin_name, 'enqueued' ) ) {
			wp_enqueue_script( $this->plugin_name );
		}
	}

	/**
	 * Display all posts.
	 *
	 * @author Vishakha Gupta
	 * @since  1.0.0
	 * @access public
	 * @param  array $atts Shortcode includes a parameter for show posts accordingly.
	 */
	public function display_all_posts( $atts = array() ) {
		global $post;
		$this->enqueue_scripts_and_styles();
		$atts  = shortcode_atts(
			array(
				'posts_per_page' => -1,
				'cat' => ''
			),
			$atts
		);
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => $atts['posts_per_page'],
			'post_status'    => 'publish',
			'cat'			 => $atts['cat']
		);
		$query = new WP_Query( $args );
		ob_start(); ?>
		<?php
		echo '<div class="owl-carousel">';
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<div class="carousel-content-wrap">
				<?php if ( has_post_thumbnail() ) { ?>
      		<div class="carousel-thumb">
						<?php the_post_thumbnail( array( 300, 200 ) ); ?>
					</div>
      	<?php } ?>
	      	<div class="carousel-content">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="carousel-excerpt">
							<?php the_excerpt(); ?>
						</div>
	      	</div>
		    </div>
			<?php endwhile;
			wp_reset_postdata();
		else :
			esc_html_e( 'No Post found.', 'posts-carousel' );
		endif;
		echo '</div>';
		return ob_get_clean();
	}

}
