<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Transience_Manager {

	const CATALOG_DATA_CACHE   = 'oao_catalog_data_cache';
	const TRANSIENT_CHECK_FLAG = 'oao_auto_update_last_check';

	public function store( $key, $value, $ttl_in_sec ) {
		set_transient( $key, $value, $ttl_in_sec );
	}

	public function get( $key ) {
		return get_transient( $key );
	}

	public function erase_transient_data() {
		delete_transient( self::CATALOG_DATA_CACHE );
		delete_transient( self::TRANSIENT_CHECK_FLAG );
	}

}