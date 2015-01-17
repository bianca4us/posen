<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

include_once 'setup-tool-catalog-data.php';
include_once 'transience-manager.php';

class One_And_One_Catalog {

	private $catalog_url = 'http://82.165.225.14/wordpress/wordpress-wizard-catalog.json';
	private $catalog_data;

	public function __construct() {
		$transient_manager = new One_And_One_Transience_Manager();

		// read cached catalog data
		$this->catalog_data = $transient_manager->get( One_And_One_Transience_Manager::CATALOG_DATA_CACHE );

		if ( false === $this->catalog_data || null == $this->catalog_data ) {
			// catalog data is not in the cache, so read it
			$this->catalog_data = $this->read_catalog_data();

			// and cache it
			$transient_manager->store( One_And_One_Transience_Manager::CATALOG_DATA_CACHE, $this->catalog_data, 12 * HOUR_IN_SECONDS );
		}
	}

	private function read_catalog_data() {
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php'; //for plugins_api..

		$data = One_And_One_Utility::get_remote_response_body( $this->catalog_url );

		if ( ! $data ) {
			$data = file_get_contents( plugin_dir_path( __FILE__ ) . 'setup-catalog.json' );
		}

		$setup_catalog = json_decode( $data, true );

		if ( ! $setup_catalog ) {
			return new One_And_One_Catalog_Data( array(), array(), array(), array() );
		}

		include_once 'plugin-categories-catalog.php';
		$plugin_categories_catalog = new One_And_One_Plugin_Categories_Catalog();

		foreach ( $setup_catalog[ 'themes' ] as $catalog_item ) {
			$theme_info = themes_api(
				'theme_information',
				array( 'slug' => $catalog_item[ 'slug' ], 'fields' => array( 'sections' => true, 'tags' => true ) )
			);

			foreach ( $catalog_item[ 'siteTypes' ] as $site_type ) {
				$site_type_id = $site_type[ 'id' ];
				$themes_by_site_type[ $site_type_id ][ ] = $theme_info;
			}

			$themes_by_id[ $catalog_item[ 'slug' ] ] = $theme_info;
		}

		foreach ( $setup_catalog[ 'plugins' ] as $catalog_item ) {
			$plugin_info = plugins_api( 'plugin_information', array( 'slug' => $catalog_item[ 'slug' ], 'fields' => array( 'sections' => true ) ) );

			// add the picture url...
			if ( isset( $catalog_item[ 'picUrl' ] ) ) {
				$plugin_info->picUrl = $catalog_item[ 'picUrl' ];
			} else {
				$plugin_info->picUrl = null;
			}

			$locale = get_locale();

			if ( ! empty( $catalog_item[ 'shortDescription_' . $locale ] ) ) {
				$plugin_info->shortDescription = $catalog_item[ 'shortDescription_' . $locale ];
			} elseif ( ! empty( $catalog_item[ 'shortDescription' ] ) ) {
				$plugin_info->shortDescription = $catalog_item[ 'shortDescription' ];
			} else {
				$plugin_info->shortDescription = null;
			}

			if ( isset( $catalog_item[ 'pluginCategory' ] ) ) {
				$plugin_info->pluginCategoryTitle = $plugin_categories_catalog->get_plugin_category_name( $catalog_item[ 'pluginCategory' ] );
			} else {
				$plugin_info->pluginCategoryTitle = null;
			}

			foreach ( $catalog_item[ 'siteTypes' ] as $site_type ) {
				$site_type_id = $site_type[ 'id' ];
				$installation_type = $site_type[ 'installation' ];
				$plugins[ $site_type_id ][ $installation_type ][ ] = $plugin_info;
			}

			$plugins_by_id[ $catalog_item[ 'slug' ] ] = $plugin_info;
		}

		return new One_And_One_Catalog_Data( $themes_by_site_type, $themes_by_id, $plugins, $plugins_by_id );
	}

	public function get_themes_by_site_type( $site_type ) {
		return $this->catalog_data->get_themes_by_site_type( $site_type );
	}

	public function get_theme_by_id( $theme_id ) {
		return $this->catalog_data->get_theme_by_id( $theme_id );
	}

	public function get_recommended_plugins( $site_type ) {
		return $this->catalog_data->get_recommended_plugins( $site_type );
	}

	public function get_default_plugins( $site_type ) {
		return $this->catalog_data->get_default_plugins( $site_type );
	}

	public function get_plugins_by_ids( array $plugin_ids ) {
		return $this->catalog_data->get_plugins_by_ids( $plugin_ids );
	}

}
