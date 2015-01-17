<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Plugin_Installation_Step {

	static public function get_installation ( $site_type, $theme_id, $plugin_ids ) {

		?>

		<div class="wrap">
			<h2><?php esc_html_e( '1&1 WP Wizard', '1and1-wordpress-wizard' )?></h2>

			<h3><?php esc_html_e( 'Processing setup:', '1and1-wordpress-wizard' ); ?></h3>

			<p><?php esc_html_e( 'Please wait until all theme/plugins have been downloaded and installed.', '1and1-wordpress-wizard' ) ?></p>

			<?php
			$query_args = array( 'setup_action' => 'installation-progress', 'sitetype' => $site_type, 'plugins' => $plugin_ids );

			if ( isset( $theme_id ) ) {
				$query_args[ 'theme' ] = $theme_id;
			}

			$url = add_query_arg( $query_args );
			$url = wp_nonce_url( $url, 'installation-progress' );
			?>

			<iframe style='width: 100%; height:100%; min-height:850px;' src='<?php echo $url ?>'></iframe>
		</div>

	<?php
	}
}
