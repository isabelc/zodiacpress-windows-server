<?php
/*
Plugin Name: ZodiacPress Windows Server
Plugin URI: https://isabelcastillo.com/free-plugins/zodiacpress-windows-server
Description: Make ZodiacPress and other astrology plugins work on sites that use Windows hosting.
Version: 1.3
Author:	Isabel Castillo
Author URI:	https://isabelcastillo.com
License: GNU GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: zp-windows-server
Domain Path: languages

Copyright 2106-2019 Isabel Castillo

This file is part of ZodiacPress Windows Server.

ZodiacPress Windows Server is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

ZodiacPress Windows Server is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with ZodiacPress Windows Server. If not, see <http://www.gnu.org/licenses/>.
*/
if ( ! defined( 'ZP_WINDOWS_SERVER_PATH' ) ) {
	define( 'ZP_WINDOWS_SERVER_PATH', plugin_dir_path( __FILE__ ) );
}
if ( defined( 'ZODIACPRESS_PATH' ) && function_exists( 'zp_is_server_windows') ) {
	if ( zp_is_server_windows() ) {
		add_filter( 'zp_sweph_dir', 'zpws_sweph_dir' );
		add_filter( 'zp_sweph_file', 'zpws_sweph_file' );
	}

	/**
	 * Format the path to Swiss Ephemeris to use backslashes for Windows.
	 */
	function zpws_sweph_dir( $dir ) {
					
		// Ephemeris files reside in ZP core, just flip slashes
		$core_sweph_dir = str_replace( '/', '\\', ZODIACPRESS_PATH . 'sweph' ) . '\\';

		return $core_sweph_dir;
	}

	/**
	 * Overide the default ephemeris execution file with this one which works on Windows.
	 */
	function zpws_sweph_file( $swetest ) {

		$sweph_dir = str_replace( '/', '\\', ZP_WINDOWS_SERVER_PATH . 'sweph' ) . '\\';

		return $sweph_dir . $swetest;
	}
}
