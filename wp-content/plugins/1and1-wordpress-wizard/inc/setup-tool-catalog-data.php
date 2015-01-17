<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Catalog_Data {

	private $themes_by_site_type;
	private $themes_by_id;
	private $plugins;
	private $plugins_by_id;

	public function __construct( $themes_by_site_type, $themes_by_id, $plugins, $plugins_by_id ) {
		$this->themes_by_site_type = $themes_by_site_type;
		$this->themes_by_id = $themes_by_id;
		$this->plugins = $plugins;
		$this->plugins_by_id = $plugins_by_id;
	}

	public function get_themes_by_site_type( $site_type ) {
		if ( isset( $this->themes_by_site_type[ $site_type ] ) ) {
			return $this->themes_by_site_type[ $site_type ];
		}

		return array();
	}

	public function get_theme_by_id( $theme_id ) {
		if ( isset( $this->themes_by_id[ $theme_id ] ) ) {
			return $this->themes_by_id[ $theme_id ];
		}

		return null;
	}

	public function get_recommended_plugins( $site_type ) {
		if ( isset( $this->plugins[ $site_type ][ 'recommended' ] ) ) {
			return $this->plugins[ $site_type ][ 'recommended' ];
		}

		return array();
	}

	public function get_default_plugins( $site_type ) {
		if ( isset( $this->plugins[ $site_type ][ 'default' ] ) ) {
			return $this->plugins[ $site_type ][ 'default' ];
		}

		return array();
	}

	public function get_plugins_by_ids( array $plugin_ids ) {
		foreach ( $plugin_ids as $plugin_id ) {
			if ( isset( $this->plugins_by_id[ $plugin_id ] ) ) {
				$plugins[ ] = $this->plugins_by_id[ $plugin_id ];
			}
		}

		if ( isset( $plugins ) ) {
			return $plugins;
		}

		return array();
	}

}
