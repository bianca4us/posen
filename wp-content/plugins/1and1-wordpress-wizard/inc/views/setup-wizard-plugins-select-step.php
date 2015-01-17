<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Plugin_Select_Step {

	static public function get_plugin_selection( $site_type, $theme_id ) {

		add_thickbox();

		$catalog = new One_And_One_Catalog();
		$recommended_plugins = $catalog->get_recommended_plugins( $site_type );
		$default_plugins = $catalog->get_default_plugins( $site_type );

		?>

		<script type="text/javascript">
			function showBox(id, title) {
				tb_show(title, '#TB_inline?height=500&width=800&inlineId=' + id + '&modal=false', null);
			}

			jQuery(function($) {
				$( '.oneandone-plugin-browser' ).on( 'click', '.oneandone-install-checkbox input', function(evt) {
					$checkbox = $(this);

					if ( $checkbox.prop('checked') ) {
						$(this).closest('.oneandone-install-checkbox').addClass( 'checked' );
					} else {
						$(this).closest('.oneandone-install-checkbox').removeClass( 'checked' );
					}
				});
			});
		</script>

	<form action="<?php echo esc_url( add_query_arg( array( 'setup_action' => 'install' ) ) ); ?>" method="post">
		<!-- Add nonce-->
		<?php wp_nonce_field( 'install' ) ?>
		<input type="hidden" name="sitetype" value="<?php echo esc_attr( $site_type ); ?>"/>
		<input type="hidden" name="theme" value="<?php echo esc_attr( $theme_id ); ?>"/>

		<div class="wrap">

			<?php
			include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-header.php' );
			One_And_One_Wizard_Header::get_wizard_header(3);?>

			<h3 class="clear"><?php esc_html_e( 'Step 3 - Selecting plugins', '1and1-wordpress-wizard' ); ?></h3>

			<p><?php esc_html_e( 'Select the desired plugins to expand the range of functions in your WordPress installation.', '1and1-wordpress-wizard' ); ?></p>
			<br/>

			<div class="oneandone-functionality-choice">
				<?php
				$index = 0;
				$sum_default_plugins = count( $default_plugins );
				if ( $sum_default_plugins > 0 ) {
					?>

					<h3><?php esc_html_e( 'Recommended plugins:', '1and1-wordpress-wizard' ); ?></h3>

					<div class="oneandone-plugin-browser">
						<?php
						foreach ( $default_plugins as $plugin ) {
							include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-plugin-item.php' );

							$popup_id = "Popup" . $index++;

							One_And_One_Plugin_Item::get_plugin_item( $plugin, $popup_id, true );
						} ?>
					</div>
				<?php } ?>


				<?php
				$sum_recommended_plugins = count( $recommended_plugins );
				if ( $sum_recommended_plugins > 0 ) {
					?>

					<h3><?php esc_html_e( 'These plugins are worth a try as well:', '1and1-wordpress-wizard' ); ?></h3>

					<div class="oneandone-plugin-browser">
						<?php
						foreach ( $recommended_plugins as $plugin ) {
							include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-plugin-item.php' );

							$popup_id = "Popup" . $index++;

							One_And_One_Plugin_Item::get_plugin_item( $plugin, $popup_id, false );
						} ?>
					</div>

				<?php
				}
				?>
			</div>
			<br class="clear">
			<input type="submit" name="install" value="<?php esc_attr_e( 'Install all selected theme/plugins', '1and1-wordpress-wizard' ); ?>"
				   class="button button-primary"/>

			<p>
				<a href="<?php echo esc_url( admin_url( 'tools.php?page=1and1-wordpress-wizard' ) ); ?>"><?php esc_html_e( 'Back to the beginning', '1and1-wordpress-wizard' ); ?></a>
			</p>
		</div>

	<?php
	}

}