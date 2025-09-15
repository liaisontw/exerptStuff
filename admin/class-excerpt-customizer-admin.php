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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/excerpt-customizer-admin.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/excerpt-customizer-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * excerpt_stuff_menu_settings function.
     * Add a menu item
     * @access public
     * @return void
     */

	public function admin_menu() {
		add_options_page( 'Excerpt Customzer Options', 
						  'Excerpt Customzer', 
						  'manage_options', 
						  'excerpt_stuff_options', 
						  array(&$this, 'excerpt_stuff_menu_options')				  
		);
	}

	public function excerpt_stuff_menu_options() {
		$excerpt_stuff_active = get_option( 'excerpt_stuff_active' );
		$excerpt_stuff_excerpt_text = get_option( 'excerpt_stuff_excerpt_text' );
		$excerpt_stuff_excerpt_padding = get_option( 'excerpt_stuff_excerpt_padding' );
		
		if ( current_user_can('manage_options') ) {
			if ( isset($_POST[ 'excerpt_stuff_submit_hidden' ]) && $_POST[ 'excerpt_stuff_submit_hidden' ] == 'Y' ) 
			{
				if (   isset( $_POST['excerpt_stuff_nonce'] ) 
				    && wp_verify_nonce( sanitize_text_field( 
					   wp_unslash( $_POST['excerpt_stuff_nonce'] ) ), 'excerpt-stuff-nonce' ) ) 
				{
					if ( isset( $_POST[ 'excerpt_stuff_active' ] ) ) 
					{
						$excerpt_stuff_active = filter_var ( 
							wp_unslash( $_POST[ 'excerpt_stuff_active' ] ), 
							FILTER_SANITIZE_FULL_SPECIAL_CHARS ); 
					} else {
						$excerpt_stuff_active = 'yes';
					}				
					
					if (   isset( $_POST[ 'excerpt_stuff_excerpt_text' ]) 
						&& !empty( $_POST[ 'excerpt_stuff_excerpt_text' ]) ) 
					{
						$excerpt_stuff_excerpt_text = filter_var ( 
							wp_unslash( $_POST[ 'excerpt_stuff_excerpt_text' ] ), 
							FILTER_SANITIZE_FULL_SPECIAL_CHARS ); 
					} else {
						$excerpt_stuff_excerpt_text = get_option( 'excerpt_stuff_excerpt_text' );
					}
					
					if ( isset( $_POST[ 'excerpt_stuff_excerpt_padding' ] ) ) 
					{
						$excerpt_stuff_excerpt_padding = filter_var ( 
							wp_unslash( $_POST[ 'excerpt_stuff_excerpt_padding' ] ), 
							FILTER_SANITIZE_FULL_SPECIAL_CHARS );
					} else {
						$excerpt_stuff_excerpt_padding = '..';
					}
					
					update_option( 'excerpt_stuff_active', $excerpt_stuff_active );
					update_option( 'excerpt_stuff_excerpt_text', $excerpt_stuff_excerpt_text );
					update_option( 'excerpt_stuff_excerpt_padding', $excerpt_stuff_excerpt_padding);
					
					echo '<div class="updated"><p><strong>' . esc_html( 'Settings saved.' ) . '</strong></p></div>';
				} else {
					wp_die( esc_html( 'Form failed nonce verification.' ) );
				}
			}
		}
	?>
	
	<div class="wrap" id="excerpt_stuff">
		<h2>Excerpt Customzer Settings</h2>
		<form name="form1" method="post" action="">
			<input type="hidden" name="excerpt_stuff_nonce" value="<?php echo esc_html( wp_create_nonce('excerpt-stuff-nonce') ); ?>">
			<input type="hidden" name="excerpt_stuff_submit_hidden" value="Y">
			<table border="1" class="form-table" >
				<tbody>
					<tr>
						<td>
							<p class="description"><?php esc_html_e( 'Option', 'liaison-excerpt-customizer' ); ?></p>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Setting', 'liaison-excerpt-customizer' ); ?></p>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Description', 'liaison-excerpt-customizer' ); ?></p>
						</td>
					</tr>
					<tr class="excerpt_stuff_setting">
						<th><label><?php esc_html_e( " Excerpt Customzer (Setting Appearance of excerpts)", 'liaison-excerpt-customizer' ); ?></label></th>
						<td>
							<input type="radio" name="excerpt_stuff_active" value="yes"<?php echo ($excerpt_stuff_active=='yes' ? ' checked' : ''); ?>><span class="value"><strong><?php esc_html_e( 'Enable', 'liaison-excerpt-customizer' ); ?></strong></span>
							<input type="radio" name="excerpt_stuff_active" value="no"<?php echo ($excerpt_stuff_active!='yes' ? ' checked' : ''); ?>><span class="value"><?php esc_html_e( 'Disable', 'liaison-excerpt-customizer' ); ?></span>
						</td>
						<td>
							<p class="description"><?php esc_html_e( 'Enable or disable excerpt Stuff', 'liaison-excerpt-customizer' ); ?></p>
						</td>
					</tr>
					<tr class="excerpt_stuff_setting">
						<th><label><?php esc_html_e( " Excerpt Text (Retype to validate new setting)", 'liaison-excerpt-customizer' ); ?></label></th>
						<td><input type="text" id="excerpt_stuff_excerpt_text" name="excerpt_stuff_excerpt_text" 
							maxlength="50" size="50" value="<?php esc_html( $excerpt_stuff_excerpt_text ); ?>" placeholder="<?php echo 'Retype before submit' ?>"></input></td>
						<td>
							<p class="description"><?php esc_html_e( 'Customize excerpt text', 'liaison-excerpt-customizer' ); ?></p>
						</td>
			   		</tr>
					<tr class="excerpt_stuff_setting">
						<th><label><?php esc_html_e( " Excerpt Text Padding (Replace Space in Text)", 'liaison-excerpt-customizer' ); ?></label></th>
						<td><select id="excerpt_stuff_excerpt_padding" name="excerpt_stuff_excerpt_padding">
							<option value=".." <?php echo ($excerpt_stuff_excerpt_padding=='..' ? 'selected' : ''); ?> >..</option>
  							<option value="__" <?php echo ($excerpt_stuff_excerpt_padding=='__' ? 'selected' : ''); ?> >__</option>
  							<option value="==" <?php echo ($excerpt_stuff_excerpt_padding=='==' ? 'selected' : ''); ?> >==</option>
  							<option value="--" <?php echo ($excerpt_stuff_excerpt_padding=='--' ? 'selected' : ''); ?> >--</option>
  							<option value="**" <?php echo ($excerpt_stuff_excerpt_padding=='**' ? 'selected' : ''); ?> >**</option>
  							<option value="$$" <?php echo ($excerpt_stuff_excerpt_padding=='$$' ? 'selected' : ''); ?> >$$</option>
							<option value="##" <?php echo ($excerpt_stuff_excerpt_padding=='##' ? 'selected' : ''); ?> >##</option>
  							<option value="%%" <?php echo ($excerpt_stuff_excerpt_padding=='%%' ? 'selected' : ''); ?> >%%</option>
							<option value="++" <?php echo ($excerpt_stuff_excerpt_padding=='++' ? 'selected' : ''); ?> >++</option>
  							<option value="@@" <?php echo ($excerpt_stuff_excerpt_padding=='@@' ? 'selected' : ''); ?> >@@</option>
						</select></td>
						<td>
							<p class="description"><?php esc_html_e( 'Customize excerpt text padding', 'liaison-excerpt-customizer' ); ?></p>
						</td>
			   		</tr>
			<p class="submit">
				<input type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'liaison-excerpt-customizer' ) ?>" />
			</p>
		</form>
	</div>


	<?php

	}
}
