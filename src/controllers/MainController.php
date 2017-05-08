<?php

namespace Itb\Controllers;

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

    public function listAction(){
        // get reference to our repository
        $userRepository = new \Itb\Model\UserRepository();
        $users = $userRepository->getAll();

        $argsArray = ['users' => $users];
        $templateName = 'list';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

  public function cartAction(){

        $argsArray = [];
        $templateName = 'cart';
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
        $errorMessage = 'you must provide an isbn for the show page (e.g. /show/123)';
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
}
