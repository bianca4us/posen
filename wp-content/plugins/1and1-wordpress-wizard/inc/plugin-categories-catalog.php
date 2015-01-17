<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Plugin_Categories_Catalog {

	private $plugin_category;

	public function __construct() {
		$this->plugin_category[ 'anti_spam' ] = esc_html__( 'Spam Protection', '1and1-wordpress-wizard' );
		$this->plugin_category[ 'content_management' ] = esc_html__( 'Content Management', '1and1-wordpress-wizard' );
		$this->plugin_category[ 'comment_management' ] = esc_html__( 'Comment Management', '1and1-wordpress-wizard' );
		$this->plugin_category[ 'seo' ] = esc_html__( 'Search Engine Optimization', '1and1-wordpress-wizard' );
		$this->plugin_category[ 'forms' ] = esc_html__( 'Forms', '1and1-wordpress-wizard' );
		$this->plugin_category[ 'caching' ] = esc_html__( 'Caching', '1and1-wordpress-wizard' );
	}

	public function get_plugin_category_name( $plugin_category ) {
		if ( isset( $this->plugin_category[ $plugin_category ] ) ) {
			return $this->plugin_category[ $plugin_category ];
		} else {
			return "";
		}
	}

}