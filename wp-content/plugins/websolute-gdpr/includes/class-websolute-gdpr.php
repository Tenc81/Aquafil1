<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.websolute.com
 * @since      1.0.0
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 * @author     Alessandro Lambertini <alambertini@websolute.it>
 */
class Websolute_Gdpr {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Websolute_Gdpr_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'websolute-gdpr';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Websolute_Gdpr_Loader. Orchestrates the hooks of the plugin.
	 * - Websolute_Gdpr_i18n. Defines internationalization functionality.
	 * - Websolute_Gdpr_Admin. Defines all hooks for the admin area.
	 * - Websolute_Gdpr_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-websolute-gdpr-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-websolute-gdpr-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-websolute-gdpr-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-websolute-gdpr-public.php';

		$this->loader = new Websolute_Gdpr_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Websolute_Gdpr_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Websolute_Gdpr_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Websolute_Gdpr_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'informative_register' ); //registrazione CPT
		$this->loader->add_action( 'add_meta_boxes_informative', $plugin_admin, 'adding_custom_meta_boxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_informative', 10, 2 );
		$this->loader->add_action('admin_init', $plugin_admin, 'informative_settings_init');
		$this->loader->add_action('admin_menu', $plugin_admin, 'informative_options_page');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$plugin_public = new Websolute_Gdpr_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		add_shortcode('wp-gdpr', array($plugin_public, 'informative_render'));
		$this->loader->add_action( 'template_redirect', $plugin_public, 'informative_render' );
		if ( is_plugin_active( 'formidable/formidable.php' ) ) {
			$this->loader->add_action( 'frm_after_create_entry', $plugin_public, 'formidableToIubenda');
		}
        if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
            $this->loader->add_action( 'wpcf7_before_send_mail', $plugin_public, 'cf7ToIubenda');
        }
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            $this->loader->add_action( 'woocommerce_checkout_fields', $plugin_public, 'custom_override_checkout_fields');
            $this->loader->add_action( 'woocommerce_checkout_update_order_meta', $plugin_public, 'woocommerceGdprMeta' );
            $this->loader->add_action( 'woocommerce_after_order_notes', $plugin_public, 'woocommerceGdprOptions' );
            //$this->loader->add_action( 'woocommerce_new_order', $plugin_public, 'woocommerceToIubenda' );
		}else{
            $this->loader->add_action( 'user_register', $plugin_public, 'userToIubenda');
        }
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Websolute_Gdpr_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
