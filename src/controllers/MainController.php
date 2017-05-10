<?php

namespace Itb\Controllers;

session_start();

use Itb\WebApplication;

class MainController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    public function indexAction(){

        $argsArray = [];
        $templateName = 'index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function publicAction(){
        $argsArray = [];
        $templateName = 'publicPage';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function aboutAction(){

        $argsArray = [];
        $templateName = 'about';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function refsAction(){
        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getAll();

        $argsArray = ['refs' => $refs];
        $templateName = 'refs';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function newRefsAction(){
        $request = $this->app['request_stack']->getCurrentRequest();
        $ref = $request->get('ref');
        $this->app['session']->set('ref', array('ref' => $ref) );

        $argsArray = [];
        $templateName = 'newRefs';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function lecturerBibsAction(){
        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getAll();

        $argsArray = ['refs' => $refs];
        $templateName = 'lecturerBibs';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function tagsAction(){
        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getAll();

        $argsArray = ['refs' => $refs];
        $templateName = 'tags';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function showTagAction($id)
    {
        // get reference to our repository
        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getOneById($id);

        if(null == $refs){
            $errorMessage = 'no REF found with id = ' . $id;
            $this->app->abort(404, $errorMessage);
        }

        $argsArray = ['refs' => $refs];
        $templateName = 'viewRef';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function votesAction(){
        $num = 0;

        $request = $this->app['request_stack']->getCurrentRequest();
        $vote = $request->get('vote');
        if ($vote == 'yes'){
            $total = $num+1;
            $yes = $total + $total;
            $this->app['session']->set('yes', array('yes' => $yes) );

            return $this->app->redirect('/tags');
        }

        elseif ($vote == 'no') {
            $no = $num + 1;
            $this->app['session']->set('no', array('no' => $no) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/tags');
        }
        $templateName = 'tags';
        $argsArray = [];
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);

    }

    public function listAction(){
        // get reference to our repository
        $userRepository = new \Itb\Model\UserRepository();
        $users = $userRepository->getAll();

        $argsArray = ['users' => $users];
        $templateName = 'list';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function showAction($id)
    {
        // get reference to our repository
        $userRepository = new \Itb\Model\UserRepository();
        $users = $userRepository->getOneById($id);

        if(null == $users){
            $errorMessage = 'no user found with id = ' . $id;
            $this->app->abort(404, $errorMessage);
        }

        $argsArray = ['users' => $users];
        $templateName = 'show';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function showNoIdAction()
    {
        $errorMessage = 'you must provide an isbn for the page.';
        // 400 - bad request
        $this->app->abort(400, $errorMessage);
    }

    public function getOneByUsername($username) {
        $userRepository = new \Itb\Model\UserRepository();
        $users = $userRepository->getAll();

        $isLoggedIn = is_logged_in_from_session();
        foreach ($users as $user){
            if($user == $username){
                return $user;
            }
        }
        return null;
    }


//--------- helper public functions -------


    public function isLoggedInFromSession()
    {
        $isLoggedIn = false;

        // user is logged in if there is a 'user' entry in the SESSION superglobal
        if(isset($_SESSION['user'])){
            $isLoggedIn = true;
        }

        return $isLoggedIn;
    }

    public function usernameFromSession()
    {
        $username = '';

        // extract username from SESSION superglobal
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
        }

        return $username;
    }

    public function cartListAction(){
        //$shoppingCart = $this->getShoppingCart();

        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getAll();

        $argsArray = ['refs' => $refs];
        $templateName = 'cartList';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    public function showCartAction($id)
    {
        // get reference to our repository
        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getOneById($id);

        if(null == $refs){
            $errorMessage = 'no REF found with id = ' . $id;
            $this->app->abort(404, $errorMessage);
        }

        $argsArray = ['refs' => $refs];
        $templateName = 'cart';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function addToCartAction($id)
    {
        // get the cart array
        $shoppingCart = $this->getShoppingCart();

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

        $refsRepository = new \Itb\Model\RefsRepository();
        $refs = $refsRepository->getAll();

        $argsArray = ['refs' => $refs];
        $templateName = 'cart';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function cartNoIdAction()
    {
        $errorMessage = 'you must provide an isbn for the page.';
        // 400 - bad request
        $this->app->abort(400, $errorMessage);
    }

    public function removeFromCartAction()
    {
        // get the ID of product to add to cart
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // get the cart array
        $shoppingCart = $this->getShoppingCart();

        // remove entry for this ID
        unset($shoppingCart[$id]);

        // store new  array into SESSION
        $_SESSION['shoppingCart'] = $shoppingCart;

        // redirect display page
        $argsArray = [];
        $templateName = 'cartList';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function getShoppingCart()
    {
        if (isset($_SESSION['shoppingCart'])){
            return $_SESSION['shoppingCart'];
        } else {
            return [];
        }
    }

    public function forgetSession()
    {
        killSession();

        // redirect to display text
        cartAction();
    }

    /**
     * advice on how to kill session from PHP.net
     *
     */
    public function killSession()
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

}
