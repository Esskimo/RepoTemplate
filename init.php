<?php
mb_internal_encoding("UTF-8");
date_default_timezone_set("Europe/Prague");

define('__ROOT__', dirname(dirname(__FILE__)));

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'inc/errors.log');

// Register environment variables
if (file_exists(__ROOT__ . __DIR__  . "/env/env.php")) {
    include(__ROOT__ . __DIR__ . "/env/env.php");
}
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return $value;
    }
}
// Register environment variables

// Autoload classes
spl_autoload_register(
    function ($class) {
        $path = __ROOT__ . __DIR__ . "/inc/" . $class . ".class.php";
        if (file_exists($path) and filesize($path) > 0) {
            require_once($path);
        } else {
            trigger_error("Class was not found : " . $path, E_USER_ERROR);
        }
    }
);
// Autoload classes

// Connect to the database
try {
    Database::connect(env('DB_HOST'), env('DB_USER'), env('DB_PASS'), env('DB_NAME'));
} catch (PDOException $e) {
    print("Error: " . $e);
}
// Connect to the database
