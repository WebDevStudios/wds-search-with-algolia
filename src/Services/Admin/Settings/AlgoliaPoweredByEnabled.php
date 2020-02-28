<?php
/**
 * AlgoliaPoweredByEnabled Setting class file.
 *
 * @package WebDevStudios\WPSWA\Services\Admin\Settings
 * @since   2.0.0
 */

namespace WebDevStudios\WPSWA\Services\Admin\Settings;

use \WebDevStudios\WPSWA\Utility\AlgoliaSettings;
use \WDS_WPSWA_Vendor\WebDevStudios\OopsWP\Structure\Service;

/**
 * Class AlgoliaPoweredByEnabled
 *
 * @since 2.0.0
 */
class AlgoliaPoweredByEnabled extends Service {

	/**
	 * The name of this option setting.
	 *
	 * Used for option_name in register_setting,
	 * and id in add_settings_field.
	 *
	 * @since  2.0.0
	 *
	 * @var string
	 */
	protected $option_name = 'algolia_powered_by_enabled';

	/**
	 * The option group this option setting belongs to.
	 *
	 * Used for option_group in register_setting
	 *
	 * @since  2.0.0
	 *
	 * @var string
	 */
	protected $option_group = 'algolia_settings';

	/**
	 * The AlgoliaSettings object.
	 *
	 * @since  2.0.0
	 *
	 * @Inject
	 * @var AlgoliaSettings
	 */
	protected $algolia_settings;

	/**
	 * Options constructor.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 *
	 * @param AlgoliaSettings $algolia_settings The AlgoliaSettings object.
	 */
	public function __construct( AlgoliaSettings $algolia_settings ) {
		$this->algolia_settings = $algolia_settings;
	}

	/**
	 * Register hooks.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 */
	public function register_hooks(): void {
		\add_action( 'admin_init', [ $this, 'register_setting' ] );
		\add_action( 'admin_init', [ $this, 'add_settings_field' ] );
	}

	/**
	 * Get the option name.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 *
	 * @return string
	 */
	public function get_option_name(): string {
		return $this->option_name;
	}

	/**
	 * Get the option group.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 *
	 * @return string
	 */
	public function get_option_group(): string {
		return $this->option_group;
	}

	/**
	 * Register this setting.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 */
	public function register_setting(): void {
		\register_setting(
			$this->get_option_group(),
			$this->get_option_name(),
			[
				'type'              => 'text',
				'description'       => \esc_html__( 'Displays or Removes Powered By Algolia logo', 'wp-search-with-algolia' ),
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'show_in_rest'      => false,
				'default'           => '',
			]
		);
	}

	/**
	 * Add this setting field.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 */
	public function add_settings_field(): void {
		\add_settings_field(
			$this->get_option_name(),
			\esc_html__( 'Remove Algolia powered by logo', 'wp-search-with-algolia' ),
			[ $this, 'render_field' ],
			'wpswa',
			'algolia_section_settings'
		);
	}

	/**
	 * Sanitize callback for the field.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 *
	 * @param string|null $value The value to sanitize.
	 *
	 * @return string|null
	 */
	public function sanitize_callback( ?string $value = '' ): ?string {
		return 'no' === $value ? 'no' : 'yes';
	}

	/**
	 * Render callback for the field.
	 *
	 * @since  2.0.0
	 * @author WebDevStudios <contact@webdevstudios.com>
	 */
	public function render_field(): void {
		include_once WPSWA_PLUGIN_DIR . '/src/Views/Admin/Settings/AlgoliaPoweredByEnabled.php';
	}
}