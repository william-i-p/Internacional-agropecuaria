<?php
defined( 'ABSPATH' ) || exit;

class WWS_Compatibility_Dokan {

	public function __construct() {
		// Admin actions.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_setting' ) );

		if ( 'yes' === $this->get_setting( 'status' ) ) {
			// Dokan hooks.
			add_action( 'dokan_product_edit_after_options', array( $this, 'edit_product_fields' ), 80, 1 );
			add_action( 'dokan_product_updated', array( $this, 'save_product_fields' ), 50, 2 );

			add_action( 'wws_admin_post_metabox_notice', array( $this, 'admin_post_metabox_notice' ) );
		}
	}

	/**
	 * Add plugin sub page.
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_submenu_page(
			'wc-whatsapp-support',
			esc_html__( 'Dokan Multivendor', 'wc-wws' ),
			esc_html__( 'Dokan Multivendor', 'wc-wws' ),
			'manage_options',
			'wc-whatsapp-support_dokan',
			array( $this, 'admin_dokan_page' )
		);
	}

	/**
	 * Register plugin options.
	 *
	 * @return void
	 */
	public function register_setting() {
		register_setting( 'wws_dokan_multivendor_option_group', 'wws_dokan_multivendor_settings', array( $this, 'sanitize_settings' ) );
	}

	/**
	 * Sanitize admin settings.
	 *
	 * @param array $input
	 * @return array
	 */
	public function sanitize_settings( $input ) {
		$input['status'] = isset( $input['status'] ) ? 'yes' : 'no';

		return $input;
	}

	/**
	 * Admin Dokan settings.
	 *
	 * @return void
	 */
	public function admin_dokan_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'WordPress WhatsApp Support For Dokan Multivendor', 'wc-wws' ); ?></h1>
			<?php settings_errors(); ?>
			<hr>

			<form action="options.php" method="post">
				<?php settings_fields( 'wws_dokan_multivendor_option_group' ); ?>

				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for=""><?php esc_html_e( 'WhatsApp Support For Dokan', 'wc-wws' ); ?></label>
							</th>
							<td>
								<input
									type="checkbox"
									name="wws_dokan_multivendor_settings[status]"
									<?php checked( 'yes', $this->get_setting( 'status' ) ); ?> > <?php esc_html_e( 'Enable/ Disable', 'wc-wws' ); ?>
								<p class="description"><?php esc_html_e( 'You can enable or disable WordPress WhatsApp Support for Dokan vendors.', 'wc-wws' ); ?></p>
								<p class="description"><?php esc_html_e( "This feature allow vendors to add WhatsApp Number for customer support from their Dokan's edit product page.", 'wc-wws' ); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Display settings on Dokan edit product page for vendors.
	 *
	 * @param int $post_id
	 * @return void
	 */
	public function edit_product_fields( $post_id ) {
		?>
		<div class="dokan-other-options dokan-edit-row dokan-clearfix ">
			<div class="dokan-section-heading" data-togglehandler="dokan_other_options">
				<h2><i class="fa fa-whatsapp" aria-hidden="true"></i> <?php esc_html_e( 'WhatsApp Support', 'wc-wws' ); ?></h2>
				<p><?php esc_html_e( 'You can add your WhatsApp number on your product page.', 'wc-wws' ); ?></p>
				<a href="#" class="dokan-section-toggle">
					<i class="fa fa-sort-desc fa-flip-vertical" aria-hidden="true" style="margin-top: 9px;"></i>
				</a>
				<div class="dokan-clearfix"></div>
			</div>

			<div class="dokan-section-content">

				<div class="dokan-form-group">
					<label for="_wws_support_contact_number" class="form-label"><?php esc_html_e( 'Your WhatsApp Number', 'wc-wws' ); ?></label>
					<input
						type="number"
						name="_wws_support_contact_number"
						id="_wws_support_contact_number"
						class="dokan-form-control"
						min="0"
						step="1"
						value="<?php echo esc_attr( get_post_meta( $post_id, '_wws_support_contact_number', true ) ); ?>">
						<p class="help-block"><?php esc_html_e( 'Enter mobile phone number with the international country code, without + character. Example:  911234567890 for (+91) 1234567890', 'wc-wws' ); ?></p>
				</div>

			</div>
		</div>
		<?php
	}

	/**
	 * Display admin metabox notice.
	 *
	 * @return void
	 */
	public function admin_post_metabox_notice() {
		?>
		<h4>
			<?php esc_html_e( 'WordPress WhatsApp Support for Dokan is enabled. These settings are managing by the vendors. Admin can also override and change settings for vendors.', 'wc-wws' ); ?><br/>
			<hr>
		</h4>
		<?php
	}

	/**
	 * Save settings by vendors.
	 *
	 * @param int $post_id
	 * @param array $postdata
	 * @return void
	 */
	public function save_product_fields( $post_id, $postdata ) {
		if ( ! empty( $postdata['_wws_support_contact_number'] ) ) {
			update_post_meta( $post_id, '_wws_support_contact_number', sanitize_textarea_field( $postdata['_wws_support_contact_number'] ) );
		} else {
			delete_post_meta( $post_id, '_wws_support_contact_number' );
		}
	}

	/**
	 * Get Dokan settings for WordPress WhatsApp Support.
	 *
	 * @param string $data
	 * @return string
	 */
	private function get_setting( $data ) {
		if ( ! isset( $data ) ) {
			return false;
		}

		$setting = get_option( 'wws_dokan_multivendor_settings' );

		if ( ! isset( $setting[ $data ] ) ) {
			return false;
		}

		return $setting[ $data ];
	}

}

new WWS_Compatibility_Dokan;
