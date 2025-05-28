<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://vander-web.com/
 * @since      1.0.0
 *
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/admin
 * @author     Ulrik Vander <ulrik@vanderweb.com>
 */
class Vanderweb_Bs4_Accordion_Admin {

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

	private $vanderweb_accordions_shortcodes_options;
	
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
		
		add_action( 'admin_init', array( $this, 'vanderweb_accordions_shortcodes_page_init' ) );

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
		 * defined in Vanderweb_Bs4_Accordion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vanderweb_Bs4_Accordion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vanderweb-bs4-accordion-admin.css', array(), $this->version, 'all' );

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
		 * defined in Vanderweb_Bs4_Accordion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vanderweb_Bs4_Accordion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vanderweb-bs4-accordion-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/**
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_options_page
		 */
		//add_submenu_page( 'plugins.php', 'Plugin settings page title', 'Admin area menu slug', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page' ) );

		add_submenu_page(
			'edit.php?post_type=vanderweb_accordions',
			__( 'Accordions - Shortcodes', 'vanderweb-bs4-accordion' ),
			__( 'Shortcodes', 'vanderweb-bs4-accordion' ),
			'manage_options',
			'vanderweb-accordions-shortcodes',
			array($this, 'vanderweb_accordions_shortcodes' )
		);

	}
	/**
	 * Render Shortcode Section.
	 *
	 * @since    1.0.0
	 */
	public function vanderweb_accordions_shortcodes() {
		$this->vanderweb_accordions_shortcodes_options = get_option( 'vanderweb_accordions_shortcodes_option_name' ); 
		include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );

	}
	public function vanderweb_accordions_shortcodes_page_init() {
		register_setting(
			'vanderweb_accordions_shortcodes_option_group', // option_group
			'vanderweb_accordions_shortcodes_option_name', // option_name
			array( $this, 'vanderweb_accordions_shortcodes_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'vanderweb_accordions_shortcodes_setting_section', // id
			__('Settings:', 'vanderweb-bs4-accordion'), // title
			array( $this, 'vanderweb_accordions_shortcodes_section_info' ), // callback
			'vanderweb-accordions-shortcodes-admin' // page
		);

		add_settings_field(
			'load_bootstrap_4_6_from_the_plugin_0', // id
			__('Load Bootstrap 4.6 from the plugin', 'vanderweb-bs4-accordion'), // title
			array( $this, 'load_bootstrap_4_6_from_the_plugin_0_callback' ), // callback
			'vanderweb-accordions-shortcodes-admin', // page
			'vanderweb_accordions_shortcodes_setting_section' // section
		);

		add_settings_field(
			'load_bootstrap_icons_1_2_from_the_plugin_1', // id
			__('Load Bootstrap Icons 1.2 from the plugin', 'vanderweb-bs4-accordion'), // title
			array( $this, 'load_bootstrap_icons_1_2_from_the_plugin_1_callback' ), // callback
			'vanderweb-accordions-shortcodes-admin', // page
			'vanderweb_accordions_shortcodes_setting_section' // section
		);
	}

	public function vanderweb_accordions_shortcodes_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['load_bootstrap_4_6_from_the_plugin_0'] ) ) {
			$sanitary_values['load_bootstrap_4_6_from_the_plugin_0'] = $input['load_bootstrap_4_6_from_the_plugin_0'];
		}

		if ( isset( $input['load_bootstrap_icons_1_2_from_the_plugin_1'] ) ) {
			$sanitary_values['load_bootstrap_icons_1_2_from_the_plugin_1'] = $input['load_bootstrap_icons_1_2_from_the_plugin_1'];
		}

		return $sanitary_values;
	}

	public function vanderweb_accordions_shortcodes_section_info() {
		?>
		<p><?php echo __( 'These Shortcodes require that Bootstrap 4.6 and Bootstrap Icons 1.2 is loaded to work.', 'vanderweb-bs4-accordion' ); ?></p>
		<p><?php echo __( 'If your current theme loads Bootstrap 4.6 and Bootstrap Icons 1.2, then set options to "No".', 'vanderweb-bs4-accordion' ); ?></p>
		<p><?php echo __( 'Otherwise change the settings to load from this plugin.', 'vanderweb-bs4-accordion' ); ?></p>
		<?php
	}

	public function load_bootstrap_4_6_from_the_plugin_0_callback() {
		?> <fieldset><?php $checked = ( $this->vanderweb_accordions_shortcodes_options['load_bootstrap_4_6_from_the_plugin_0'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="load_bootstrap_4_6_from_the_plugin_0-0"><input type="radio" name="vanderweb_accordions_shortcodes_option_name[load_bootstrap_4_6_from_the_plugin_0]" id="load_bootstrap_4_6_from_the_plugin_0-0" value="true" <?php echo $checked; ?>> <?php echo __('Yes', 'vanderweb-bs4-accordion'); ?></label><br>
		<?php $checked = ( isset( $this->vanderweb_accordions_shortcodes_options['load_bootstrap_4_6_from_the_plugin_0'] ) && $this->vanderweb_accordions_shortcodes_options['load_bootstrap_4_6_from_the_plugin_0'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="load_bootstrap_4_6_from_the_plugin_0-1"><input type="radio" name="vanderweb_accordions_shortcodes_option_name[load_bootstrap_4_6_from_the_plugin_0]" id="load_bootstrap_4_6_from_the_plugin_0-1" value="false" <?php echo $checked; ?>> <?php echo __('No, load Bootstrap 4.6 from your theme', 'vanderweb-bs4-accordion'); ?></label></fieldset> 
		<?php
	}

	public function load_bootstrap_icons_1_2_from_the_plugin_1_callback() {
		?> <fieldset><?php $checked = ( $this->vanderweb_accordions_shortcodes_options['load_bootstrap_icons_1_2_from_the_plugin_1'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="load_bootstrap_icons_1_2_from_the_plugin_1-0"><input type="radio" name="vanderweb_accordions_shortcodes_option_name[load_bootstrap_icons_1_2_from_the_plugin_1]" id="load_bootstrap_icons_1_2_from_the_plugin_1-0" value="true" <?php echo $checked; ?>> <?php echo __('Yes', 'vanderweb-bs4-accordion'); ?></label><br>
		<?php $checked = ( isset( $this->vanderweb_accordions_shortcodes_options['load_bootstrap_icons_1_2_from_the_plugin_1'] ) && $this->vanderweb_accordions_shortcodes_options['load_bootstrap_icons_1_2_from_the_plugin_1'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="load_bootstrap_icons_1_2_from_the_plugin_1-1"><input type="radio" name="vanderweb_accordions_shortcodes_option_name[load_bootstrap_icons_1_2_from_the_plugin_1]" id="load_bootstrap_icons_1_2_from_the_plugin_1-1" value="false" <?php echo $checked; ?>> <?php echo __('No, load Bootstrap Icons 1.2 from your theme', 'vanderweb-bs4-accordion'); ?></label></fieldset> 
		<?php
	}
}
