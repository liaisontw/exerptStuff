<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/liaisontw
 * @since      1.0.0
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/admin
 * @author     liason <liaison.tw@gmail.com>
 */
class Excerpt_Stuff_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_menu', array($this, 'admin_menu') );

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/excerpt-stuff-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/excerpt-stuff-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * excerpt_stuff_menu_settings function.
     * Add a menu item
     * @access public
     * @return void
     */

	public function admin_menu() {
		add_options_page( 'Excert Stuff Options', 
						  'Excert Stuff', 
						  'manage_options', 
						  'excert_stuff_options', 
						  array(&$this, 'excert_stuff_menu_options')				  
		);
	}

	public function excert_stuff_menu_options() {
		$excert_stuff_active = get_option( 'excert_stuff_active' );
		$excert_stuff_excerpt_text = get_option( '$excert_stuff_excerpt_text' );
		if ( !$excert_stuff_active ) $excert_stuff_active = 'yes';
		if ( !$excert_stuff_excerpt_text ) $excert_stuff_excerpt_text = 'Read More';
		
		if ( isset($_POST[ 'excert_stuff_submit_hidden' ]) && $_POST[ 'excert_stuff_submit_hidden' ] == 'Y' ) {
			if ( isset( $_POST['excert_html_nonce'] ) && !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['excert_html_nonce'] ) ), 'excert-html-nonce' ) ) {
				wp_die( esc_html( 'Form failed nonce verification.' ) );
			}
			if ( isset( $_POST[ 'excert_stuff_active' ] ) ) $excert_stuff_active = filter_var ( wp_unslash( $_POST[ 'excert_stuff_active' ] ), FILTER_SANITIZE_FULL_SPECIAL_CHARS ); else $excert_stuff_active = 'yes';
			update_option( 'excert_stuff_active', $excert_stuff_active );
			if ( isset( $_POST[ 'excert_stuff_excerpt_text' ] ) ) 
				 $excert_stuff_excerpt_text = filter_var ( wp_unslash( $_POST[ 'excert_stuff_excerpt_text' ] ), FILTER_SANITIZE_FULL_SPECIAL_CHARS ); 
			else $excert_stuff_excerpt_text = 'Read More';
			update_option( 'excert_stuff_excerpt_text', $excert_stuff_excerpt_text );
			echo '<div class="updated"><p><strong>' . esc_html( 'Settings saved.' ) . '</strong></p></div>';
		}
	?>
	<style>
	#excert_stuff label {white-space:nowrap}
	#excert_stuff input[type="radio"] {margin-left:15px}
	#excert_stuff input[type="radio"]:first-child {margin-left:0}
	#excert_stuff .value {display:inline-block;min-width:50px}
	#excert_stuff p {font-size:1.1em;font-weight:600}
	@media screen and (max-width: 500px) {#excert_stuff label {white-space:normal}}
	</style>
	<div class="wrap" id="excert_stuff">
		<h2>Excert Stuff Settings</h2>
		<form name="form1" method="post" action="">
			<input type="hidden" name="excert_stuff_nonce" value="<?php echo esc_html( wp_create_nonce('excert-html-nonce') ); ?>">
			<input type="hidden" name="excert_stuff_submit_hidden" value="Y">
			<table border="1" class="form-table" >
				<tbody>
					<tr>
						<td>
							<p class="description"><?php esc_html_e( 'Option', 'excert-stuff' ); ?></p>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Setting', 'excert-stuff' ); ?></p>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Description', 'excert-stuff' ); ?></p>
						</td>
					</tr>
					<tr class="excert_stuff_setting">
						<th><label><?php esc_html_e( " Excert Stuff (Setting Appearance of Excerts)", 'excert-stuff' ); ?></label></th>
						<td>
							<input type="radio" name="excert_stuff_active" value="yes"<?php echo ($excert_stuff_active=='yes' ? ' checked' : ''); ?>><span class="value"><strong><?php esc_html_e( 'Enable', 'excert-stuff' ); ?></strong></span>
							<input type="radio" name="excert_stuff_active" value="no"<?php echo ($excert_stuff_active!='yes' ? ' checked' : ''); ?>><span class="value"><?php esc_html_e( 'Disable', 'excert-stuff' ); ?></span>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Enable or disable Excert Stuff', 'excert-stuff' ); ?></p>
						</td>
					</tr>
					<tr class="excert_stuff_setting">
						<th><label><?php esc_html_e( " Excert Text", 'excert-stuff' ); ?></label></th>
						<td><input type="text" id="excert_stuff_excerpt_text" name="excert_stuff_excerpt_text" 
							maxlength="50" size="50" value="<?php echo $excert_stuff_excerpt_text?>"></input></td>
						<td>
							<p class="description"><?php esc_html_e( 'Customize excert text', 'excert-stuff' ); ?></p>
						</td>
			   		</tr>
					<tr class="excert_stuff_setting">
						<th><label><?php esc_html_e( " Excert Text Padding", 'excert-stuff' ); ?></label></th>
						<td><select name="Excerpt Text Padding">
  							<option value="padding_1">==</option>
  							<option value="padding_2">--</option>
  							<option value="padding_3">**</option>
  							<option value="padding_4">$$</option>
							<option value="padding_5">##</option>
  							<option value="padding_6">%%</option>
							<option value="padding_7">++</option>
  							<option value="padding_8">>></option>
						</select></td>
						<td>
							<p class="description"><?php esc_html_e( 'Customize excert text padding', 'excert-stuff' ); ?></p>
						</td>
			   		</tr>
			<p class="submit">
				<input type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'excert-stuff' ) ?>" />
			</p>
		</form>
	</div>


	<?php

	}
}
