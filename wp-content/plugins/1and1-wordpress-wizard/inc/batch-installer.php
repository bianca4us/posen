<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
include_once( 'theme-install-config.php' );

class One_And_One_Batch_Installer {

	private $theme;
	private $plugins;
	private $callback_url;
	private $form_fields;

	function __construct( $theme, array $plugins, $callback_url, $form_fields ) {
		$this->theme = $theme;
		$this->plugins = $plugins;
		$this->callback_url = $callback_url;
		$this->form_fields = $form_fields;

	}

	function setup_plugins_and_theme() {
		ignore_user_abort( true );
		set_time_limit( 0 );

		// check credentials first before starting the install process...
		if ( ! One_And_One_Utility::check_credentials( $this->callback_url, $this->form_fields ) ) {
			// we don't have the credentials to install the plugin...
			return false;
		};

		do_action( 'one_and_one_batch_installer_start' );

		$this->install_and_activate_theme();

		$this->install_and_activate_plugins();

		do_action( 'one_and_one_batch_installer_end' );

		echo '<br/>';
		echo '<h3>' . esc_html__( 'Installation completed.', '1and1-wordpress-wizard' ) . '</h3>';


        //Dismiss the welcom panel...
		$perisistent_manager = new One_And_One_Persistence_Manager();
		$perisistent_manager->store( One_And_One_Persistence_Manager::WELCOME_PANEL_DISMISS_KEY, true );


		//Deactivate the 1&1 setup plugin...
		deactivate_plugins( One_And_One_Wizard::get_plugin_file_path() );

		//Hide the menu item
		echo '<script>jQuery("#menu-tools .current", window.parent.document).hide();</script>';

		echo '<h3>' . sprintf( esc_html__( 'The 1&1 WP Wizard has been deactivated, you can find it in the %s area.', '1and1-wordpress-wizard' ),
				'<a href="' . self_admin_url( 'plugins.php' ) . '" target="_parent">' .
				esc_html_x( 'Plugins', 'area', '1and1-wordpress-wizard' ) . '</a>' ) . '</h3>';
	}

	private function install_and_activate_theme() {
		// Check if a new theme is selected
		if ( $this->theme != null &&
			$this->theme->slug != null	) {
			$this->install_theme( $this->theme->slug );
			$this->activate_theme( $this->theme->slug );
		} else {
			echo( '<h3>' . esc_html__( 'No theme has been selected. The current theme will be kept.', '1and1-wordpress-wizard' ) . '</h3>' );
		}
	}

	private function install_theme( $theme_slug ) {
		include_once ABSPATH . 'wp-admin/includes/theme-install.php'; //for themes_api..

		$api = themes_api(
			'theme_information',
			array( 'slug' => $theme_slug, 'fields' => array( 'sections' => false, 'tags' => false ) )
		);

		if ( is_wp_error( $api ) ) {
			wp_die( $api );
		}

		wp_enqueue_script( 'customize-loader' );

		$title = sprintf( esc_html__( 'Installing theme: %s', '1and1-wordpress-wizard' ), $api->name . ' ' . $api->version );

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; //for theme installer
		include_once 'theme-installer-skin.php'; //for the 1&1 installer skin

		$installer = new Theme_Upgrader( new One_And_One_Theme_Installer_Skin( array( 'title' => $title, 'theme' => $theme_slug ) ) );
		$installer->install( $api->download_link );
	}

	private function install_and_activate_plugins() {
		$plugin_sum = count( $this->plugins );
		$plugin_count = 0;

		echo '<br/>';

		if ( $plugin_sum > 0 ) {
			echo '<h3>' . sprintf( esc_html__( 'Installing plugins (%s)', '1and1-wordpress-wizard' ), $plugin_sum ) . '</h3>';

			foreach ( $this->plugins as $plugin ) {
				$plugin_count++;
				$this->install_plugin( $plugin->slug, $plugin_count, $plugin_sum );
			}

			$this->activate_plugins();

			echo '<a href="' . self_admin_url( 'plugins.php' ) . '" target="_parent">'
				. esc_html__( 'Go to Plugins', '1and1-wordpress-wizard' ) . '</a>';
			echo '<br/>';
		} else {
			echo '<h3>' . esc_html__( 'No Plugins have been selected.', '1and1-wordpress-wizard' ) . '</h3>';
		}
	}


	private function install_plugin( $plugin_slug, $plugin_count, $plugin_sum ) {
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php'; //for plugins_api..

		$api = plugins_api( 'plugin_information', array( 'slug' => $plugin_slug, 'fields' => array( 'sections' => false ) ) ); //Save on a bit of bandwidth.

		if ( is_wp_error( $api ) ) {
			wp_die( $api );
		}

		$title = sprintf( esc_html__( 'Installing plugin: %1$s (%2$s/%3$s)', '1and1-wordpress-wizard' ), $api->name . ' ' . $api->version, $plugin_count, $plugin_sum );

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; //for theme installer
		include_once 'plugin-installer-skin.php'; //for the 1&1 installer skin

		$upgrader = new Plugin_Upgrader( new One_And_One_Plugin_Installer_Skin( array( 'title' => $title, 'plugin' => $plugin_slug ) ) );
		$upgrader->install( $api->download_link );
	}


	private function activate_theme( $theme_slug ) {
		echo '<h3>' . esc_html__( 'Activating theme...', '1and1-wordpress-wizard' ) . '</h3>';

		switch_theme( $theme_slug );
	}

	private function activate_plugins() {
		echo '<h3>' . esc_html__( 'Activating plugins...', '1and1-wordpress-wizard' ) . '</h3>';

		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

		wp_clean_plugins_cache( true );

		$plugins = get_plugins();

		$plugin_slugs = wp_list_pluck( $this->plugins, 'slug' );

		foreach ( $plugins as $key => $plugin ) {
			$parts = explode('/', $key);

			if ( in_array( $parts[0], $plugin_slugs ) ) {
				activate_plugin( $key );
			}
		}
	}

}