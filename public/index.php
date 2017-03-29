<?php
session_start();

require_once __DIR__ . '/../src/main_controller.php';
require_once __DIR__ . '/../src/product_functions.php';
require_once __DIR__ . '/../vendor/autoload.php';

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'product');
use Itb\MainController;

$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);

switch ($action){
    case 'logout':
        logoutAction();
        break;

    case 'processLogin':
        processLoginAction();
        break;

    case 'login':
        loginAction();
        break;

    case 'about':
        aboutAction();
        break;

    case 'cart':
        cartAction();
        break;

    case 'addToCart':
        addToCart();
        break;

    case 'removeFromCart':
        removeFromCart();
        break;

    case 'emptyCart':
        forgetSession();
        break;

    default:
        indexAction();
        //indexAction();

}