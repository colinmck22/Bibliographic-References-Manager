<?php


function indexAction()
{
    $shoppingCart = getShoppingCart();
    $products = get_all_products();
    $isLoggedIn = isLoggedInFromSession();
    $username = usernameFromSession();

    require_once __DIR__ . '/../templates/index.php';
}

function cartAction()
{
    $shoppingCart = getShoppingCart();
    $products = get_all_products();
    $isLoggedIn = isLoggedInFromSession();
    $username = usernameFromSession();

    require_once __DIR__ . '/../templates/_cart.php';
}


function aboutAction()
{
    $isLoggedIn = isLoggedInFromSession();
    $username = usernameFromSession();

    require_once __DIR__ . '/../templates/about.php';
}

function addToCart() 
{
    // get the ID of product to add to cart
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // get the cart array
    $shoppingCart = getShoppingCart();

    // default is old total is zero
    $oldTotal = 0;

    // if quantity found in cart array, then use this
    if(isset($shoppingCart[$id])){
        $oldTotal = $shoppingCart[$id];
    }

    // store old total + 1 as new quantity into cart array
    $shoppingCart[$id] = $oldTotal + 1;

    // store new  array into SESSION
    $_SESSION['shoppingCart'] = $shoppingCart;

    // redirect display page
    indexAction();
}

function removeFromCart()
{
    // get the ID of product to add to cart
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // get the cart array
    $shoppingCart = getShoppingCart();

    // remove entry for this ID
    unset($shoppingCart[$id]);

    // store new  array into SESSION
    $_SESSION['shoppingCart'] = $shoppingCart;

    // redirect display page
    cartAction();
}

function getShoppingCart()
{
    if (isset($_SESSION['shoppingCart'])){
        return $_SESSION['shoppingCart'];
    } else {
        return [];
    }
}

function forgetSession()
{
    killSession();

    // redirect to display text
    cartAction();
}

/**
 * advice on how to kill session from PHP.net
 * URL: http://php.net/manual/en/function.session-destroy.php
 */
function killSession()
{
    // (1) Unset all of the session variables.
    $_SESSION = [];

    // (2) If it is desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get('session.use_cookies')){
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    // (3) destroy the session.
    session_destroy();
}

function loginAction()
{
    $isLoggedIn = isLoggedInFromSession();
    $username = usernameFromSession();

    require_once __DIR__ . '/../templates/loginForm.php';
}

function logoutAction()
{
    // remove 'user' element from SESSION array
    unset($_SESSION['user']);

    // redirect to index action
    indexAction();
}

function processLoginAction()
{
    // default is bad login
    $isLoggedIn = false;

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // search for user with username in repository
    $userRepository = new \Itb\UserRepository();
    $isLoggedIn = $userRepository->canFindMatchingUsernameAndPassword($username, $password);

    // action depending on login success
    if($isLoggedIn){
        // STORE login status SESSION
        $_SESSION['user'] = $username;

        require_once __DIR__ . '/../templates/loginSuccess.php';
    } else {
        $message = 'bad username or password, please try again';
        require_once __DIR__ . '/../templates/message.php';
    }
}

//--------- helper functions -------


function isLoggedInFromSession()
{
    $isLoggedIn = false;

    // user is logged in if there is a 'user' entry in the SESSION superglobal
    if(isset($_SESSION['user'])){
        $isLoggedIn = true;
    }

    return $isLoggedIn;
}

function usernameFromSession()
{
    $username = '';

    // extract username from SESSION superglobal
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user'];
    }

    return $username;
}

function adminHomeAction()
{
    $isLoggedIn = isLoggedInFromSession();
    if ($isLoggedIn){
        $username = usernameFromSession();
        require_once __DIR__ . '/../templates/admin/index.php';
    } else {
        $message = 'UNAUTHORIZED ACCESS - the Guards are on their way to arrest you ...';
        require_once __DIR__ . '/../templates/message.php';
    }
}

function adminCodesAction()
{
    $isLoggedIn = isLoggedInFromSession();
    if ($isLoggedIn){
        $username = usernameFromSession();
        require_once __DIR__ . '/../templates/admin/codes.php';
    } else {
        $message = 'UNAUTHORIZED ACCESS - the Guards are on their way to arrest you ...';
        require_once __DIR__ . '/../templates/message.php';
    }
}
