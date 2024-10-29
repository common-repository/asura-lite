<?php
/**
 * Asura Lite
 *
 * @wordpress-plugin
 * Plugin Name:         Asura Lite
 * Description:         Selling design sets made easy.
 * Version:             3.0.0
 * Author:              thelostasura
 * Author URI:          https://thelostasura.com/?utm_source=asura
 * Requires at least:   5.5
 * Tested up to:        5.6
 * Requires PHP:        7.4
 *
 * @package             Asura Lite
 * @author              thelostasura <mail@thelostasura.com>
 * @link                https://thelostasura.com
 * @since               1.0.0
 * @copyright           2020 thelostasura
 * @version             3.0.0
 */

namespace Asura;

defined( 'ABSPATH' ) || exit;
define( 'THELOSTASURA', '3.0.0' );

define( 'ASURA_PLUGIN_FILE', __FILE__ );
define( 'ASURA_PLUGIN_DIR', __DIR__ );
define( 'ASURA_PLUGIN_URL', plugins_url( '', __FILE__ ) . '/' );

if ( ! defined( 'ASURA_DEBUG' ) ) {
    define( 'ASURA_DEBUG', false );
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__ . '/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

add_filter( 'do_parse_request', function ( $continue, $wp, $extra_query_vars ) use ( $app ) {
    $response = $app->run();

    if ( $response !== null && $response !== false ) {
        die();
    } else {
        return $continue;
    }
}, 1, 3 );
