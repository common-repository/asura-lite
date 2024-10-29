<?php

namespace TheLostAsura\Skynet;

use Illuminate\Support\ServiceProvider;

class SkynetServiceProvider extends ServiceProvider {
	public function register() {
		register_activation_hook( ASURA_PLUGIN_FILE, [ Setup::class, 'install' ] );
		register_deactivation_hook( ASURA_PLUGIN_FILE, [ Setup::class, 'deactivate' ] );
		register_uninstall_hook( ASURA_PLUGIN_FILE, [ Setup::class, 'uninstall' ] );
	}

	public function boot() {
	}
}