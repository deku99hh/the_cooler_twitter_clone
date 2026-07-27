<?php
require_once "../app/vendor/autoload.php";

$config = parse_ini_file(__DIR__ . '/config.ini', true);

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);


session_set_cookie_params([
    'lifetime' => $config['lifetime'],
    'domain' => $config['host'],
    'path' => '/',
    'secure' => $config['secure'],
    'httponly' => true
]);

session_start();

function regenerateSessionId(): void
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
    try {
        $_SESSION["CSRF"] = bin2hex(random_bytes(32));
    } catch (RandomException) {

    }
}

if (!isset($_SESSION['last_regeneration'])) {
    regenerateSessionId();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        regenerateSessionId();
    }
}

$_SESSION["BURL"] = $config["BURL"];

require_once "../app/Core/Dependencies.php";
