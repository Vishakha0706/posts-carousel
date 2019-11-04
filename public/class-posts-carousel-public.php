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
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Posts_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Posts_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/posts-carousel-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Posts_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Posts_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/posts-carousel-public.js', array( 'jquery' ), $this->version, false );

	}

	public function display_all_posts( $atts = array() ) {
		global $post;
		$atts  = shortcode_atts(
			array(
				'posts_per_page' => -1,
				'cat' => array()
			),
			$atts
		);
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => $atts['posts_per_page'],
			'post_status'    => 'publish',
		//	'cat'			 => $atts['cat']
		); echo 'ghvjvh';
		$query = new WP_Query( $args );
		ob_start();
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
			$query->the_post(); ?>
			
			<?php the_title(); ?>
			<?php endwhile;
			wp_reset_postdata();
		else :
			esc_html_e( 'No Deal found.', 'posts-carousel' );
		endif;
		return ob_get_clean();
	}

}
