<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

include_once 'site-type.php';

class One_And_One_Site_Type_Catalog {

	private $site_types;

	public function __construct() {
		$this->site_types[] = new One_And_One_Site_Type( 'gallery',
			                                             esc_html__( 'Gallery', '1and1-wordpress-wizard' ),
			                                             'Gallery.png',
			                                             esc_html__( 'Create an image gallery to publish your images quickly and easily.', '1and1-wordpress-wizard' ) );

		$this->site_types[] = new One_And_One_Site_Type( 'blog',
			                                             esc_html__( 'Blog', '1and1-wordpress-wizard' ),
			                                             'Blog.png',
			                                             esc_html__( 'Create your own blog in just a few steps.', '1and1-wordpress-wizard' ) );

		$this->site_types[] = new One_And_One_Site_Type( 'personal',
			                                             esc_html__( 'Personal Website', '1and1-wordpress-wizard' ),
			                                             'Personal.png',
			                                             esc_html__( 'Create a personal website quickly and easily.', '1and1-wordpress-wizard' ) );

		$this->site_types[] = new One_And_One_Site_Type( 'business',
			                                             esc_html__( 'Business Website', '1and1-wordpress-wizard' ),
			                                             'Business.png',
			                                             esc_html__( 'Create a professional company website to present your business.', '1and1-wordpress-wizard' ) );
	}

	public function get_all_site_types() {
		return $this->site_types;
	}

}