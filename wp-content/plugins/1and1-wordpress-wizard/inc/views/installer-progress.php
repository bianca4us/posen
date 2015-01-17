<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Plugin_Installation_Progress {

	static public function get_progress_page ( $theme_id, $plugin_ids ) {
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<link rel="stylesheet" href="<?php echo One_And_One_Wizard::get_css_url() . '1and1-install-progress.css'; ?>" type="text/css" media="all">
			<?php wp_print_scripts( 'jquery' ); ?>
		</head>

		<body class="oneandone-install-progress">

		<?php
		include_once( One_And_One_Wizard::get_inc_dir_path() . 'batch-installer.php' );

		$catalog = new One_And_One_Catalog();

		if ( isset( $theme_id ) ) {
			$theme = $catalog->get_theme_by_id( $theme_id );
		} else {
			$theme = null;
		}

		$plugins      = $catalog->get_plugins_by_ids( $plugin_ids );
		$callback_url = wp_nonce_url( $_SERVER[ 'REQUEST_URI' ], 'installation-progress' );

		$batch_installer = new One_And_One_Batch_Installer( $theme, $plugins, $callback_url, null );
		$batch_installer->setup_plugins_and_theme();

		?>

		</body>
		</html>

	<?php
	}
}