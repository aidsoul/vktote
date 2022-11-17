<?php
// declare(strict_types=1);
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

/**
 * Include confige file
 */
include 'config.php';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

/**
 * Routs
 */

$router = new Router;

// Go to index
$router->map('GET', '/', [Vktote\Http\Controllers\SiteController::class,'index']);

// Go to settings
$router->group('/settings', function ($router){
    $router->map('GET', '/', [Vktote\Http\Controllers\SettingsController::class, 'index']);
    $router->map('GET', '/group/add', [Vktote\Http\Controllers\SettingsController::class, 'groupAdd']);
    $router->map('POST', '/group/add/request', [Vktote\Http\Controllers\SettingsController::class, 'groupAddRequest']);
    $router->map('GET', '/group/delete', [Vktote\Http\Controllers\SettingsController::class,'deleteFolderProfile']);
    
});

// Go to group
$router->map('GET', '/group', [Vktote\Http\Controllers\GroupCotroller::class,'index']);

/**
 * User 
 */
// Go to login
$router->map('POST', '/login', [Vktote\Http\Controllers\UserController::class,'login']);
// Go to exit
$router->map('POST','/exit',[Vktote\Http\Controllers\UserController::class,'exit']);

/**
 * API
 */
$router->group('/api', function ($router) {
    $router->map('GET', '/bot.start', [Vktote\Http\Controllers\ApiCotroller::class, 'botStart']);
});

try{
    $response = $router->dispatch($request);
    // send the response to the browser
(new SapiEmitter)->emit($response);


}catch(\Exception  $e){
    echo ERROR_404;
}


