<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/liaisontw
 * @since      1.0.0
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/public
 * @author     liason <liaison.tw@gmail.com>
 */
class Excerpt_Stuff_Public {

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
		 * defined in Excerpt_Stuff_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Excerpt_Stuff_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/excerpt-stuff-public.css', array(), $this->version, 'all' );

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
		 * defined in Excerpt_Stuff_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Excerpt_Stuff_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/excerpt-stuff-public.js', array( 'jquery' ), $this->version, false );

	}

	public function init_excerpt_stuff() {
		if (wp_validate_boolean( get_option( 'excerpt_stuff_active' ) ) )  {
			add_filter( 'excerpt_more', array($this, 'excerpt_stuff_add_excerpt'), 999 );
		}
	}

	public function excerpt_stuff_add_excerpt($excerpt) {
		if ('yes' == get_option( 'excerpt_stuff_active' ) )  {
			$text = get_option( 'excerpt_stuff_excerpt_text' );
			$padding = get_option( 'excerpt_stuff_excerpt_padding' );
			$excerpt = str_replace(' ', $padding, $text);
		}else{
			$excerpt = null;
		}

        return $excerpt;
	}
	
}
