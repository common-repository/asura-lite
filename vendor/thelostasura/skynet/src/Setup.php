<?php

namespace TheLostAsura\Skynet;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class Setup {
	public static function isInstalled() {
		return get_option( 'asura_installed' ) ? true : false;
	}

	public static function lastPluginOrder() {
		$asura          = plugin_basename( ASURA_PLUGIN_FILE );
		$active_plugins = get_option( 'active_plugins' );
		$asura_index    = array_search( $asura, $active_plugins );
		array_splice( $active_plugins, $asura_index, 1 );
		array_push( $active_plugins, $asura );
		update_option( 'active_plugins', $active_plugins );
	}

	public static function doInstallation() {
		add_action( 'activated_plugin', [ Setup::class, 'lastPluginOrder' ] );
		self::migrate();
		ob_start();
	}

	public static function install( $network_wide = false ) {
		if ( is_multisite() && $network_wide ) {
			wp_die(
				'Sorry, network activation is not available, please activate asura plugin per site', 
				'Per site only',  
				array( 
					'response' => 403, 
					'back_link' => true 
				)
			);
		} else {
			self::doInstallation();
		}
	}

	public static function deactivate() {}

	public static function uninstall() {
		if ( config( 'database.uninstall', false ) ) {
			Artisan::call( 'migrate:reset', [
				'--force' => true,
			] );
			Schema::dropIfExists( config( 'database.migrations' ) );
		}
	}

	public static function migrate() {
		if ( ! self::isInstalled() ) {
			Schema::dropIfExists( config( 'database.migrations' ) );
		}

		if ( ! Schema::hasTable( config( 'database.migrations' ) ) ) {
			Artisan::call( 'migrate:install' );
		}

		Artisan::call( 'migrate', [
			'--force' => true,
		] );

		update_option( 'asura_installed', THELOSTASURA );
	}
}