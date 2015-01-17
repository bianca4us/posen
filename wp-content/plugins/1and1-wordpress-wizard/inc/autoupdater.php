<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

include_once 'transience-manager.php';

class One_And_One_Autoupdater {

	// whstatic.1and1.com
	static private $PLUGIN_ZIP_URL = 'http://82.165.225.14/wordpress/wordpress-wizard.zip';
	static private $README_URL     = 'http://82.165.225.14/wordpress/wordpress-wizard-version.txt';
	static private $CHECK_RATE_IN_SECONDS = 43200;

	public function start_auto_update() {
		if ( $this->update_check_necessary() && $this->newer_version_available() ) {
			$this->download_and_activate_new_version();
		}
	}

	private function update_check_necessary() {
		$transient_manager = new One_And_One_Transience_Manager();

		if ( $transient_manager->get( One_And_One_Transience_Manager::TRANSIENT_CHECK_FLAG ) ) {
			return false;
		}

		$transient_manager->store( One_And_One_Transience_Manager::TRANSIENT_CHECK_FLAG, 'set', self::$CHECK_RATE_IN_SECONDS );

		return true;
	}

	private function newer_version_available() {
		$current_version = $this->get_current_version();
		$latest_version  = $this->get_latest_version();

		if ( -1 == ( version_compare( $current_version, $latest_version ) ) ) {
			return true;
		}

		return false;
	}


	private function get_current_version() {
		include_once ABSPATH . '/wp-admin/includes/plugin.php';

		$plugin_file_path = One_And_One_Wizard::get_plugin_file_path();
		$data = get_plugin_data( $plugin_file_path );

		return $data[ 'Version' ];
	}

	private function get_latest_version() {
		$version = One_And_One_Utility::get_remote_response_body( self::$README_URL );

		if ( empty( $version ) ) {
			return false;
		}

		return $version;
	}

	private function download_and_activate_new_version() {
		if ( ! One_And_One_Utility::check_credentials( 'plugins.php', null ) ) {
			return false;
		};

		$response_body = One_And_One_Utility::get_remote_response_body( self::$PLUGIN_ZIP_URL );

		if ( empty( $response_body ) ) {
			return false;
		}

		$zip_file_path = One_And_One_Wizard::get_plugin_dir_path() . 'plugin.zip';

		global $wp_filesystem;
		$wp_filesystem->put_contents(
			$zip_file_path,
			$response_body,
			FS_CHMOD_FILE
		);

		// delete all transient data
		$transience_manager = new One_And_One_Transience_Manager();
		$transience_manager->erase_transient_data();

		$unzip = unzip_file( $zip_file_path, WP_PLUGIN_DIR );
		@unlink( $zip_file_path );

		activate_plugin( One_And_One_Wizard::get_plugin_file_path() );
	}

}
