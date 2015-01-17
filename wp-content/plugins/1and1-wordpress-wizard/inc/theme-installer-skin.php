<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

include_once 'upgrader-skin.php';

class One_And_One_Theme_Installer_Skin extends One_And_One_Upgrader_Skin {
	public $theme = '';

	function __construct($args = array()) {
		$defaults = array( 'url' => '', 'theme' => '', 'nonce' => '', 'title' => __('Update Theme') );
		$args = wp_parse_args($args, $defaults);

		$this->theme = $args['theme'];

		parent::__construct($args);
	}

	function after() {
		$update_actions = array();

		if ( ! empty( $this->upgrader->result[ 'destination_name' ] ) && $theme_info = $this->upgrader->theme_info() ) {
			$name = $theme_info->display( 'Name' );
			$stylesheet = $this->upgrader->result[ 'destination_name' ];
			$template = $theme_info->get_template();

			$preview_link = add_query_arg( array(
				'preview' => 1,
				'template' => urlencode( $template ),
				'stylesheet' => urlencode( $stylesheet ),
			), trailingslashit( home_url() ) );

			$update_actions[ 'preview' ] =
				'<a href="' . wp_customize_url( $stylesheet ) . '" class="hide-if-no-customize load-customize" title="' . printf( esc_attr( 'Customize &#8220;%s&#8221;' ),
					$name ) . '" target="_parent">' . esc_html__( 'Customize Theme', '1and1-wordpress-wizard' ) . '</a>';
		}

		$update_actions[ 'themes_page' ] =
			'<a href="' . self_admin_url( 'themes.php' ) . '" target="_parent">' . esc_html__( 'Go to Themes', '1and1-wordpress-wizard' ) . '</a>';

		$this->feedback( implode( ' | ', (array)$update_actions ) );
	}

	function get_folder_exsists_message() {
		return __( 'The theme already exists.', '1and1-wordpress-wizard' );
	}

}