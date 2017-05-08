<?php

namespace Itb\Controllers;


class UserController
{
    private $app;

    public function __construct(\Itb\WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /login
    public function loginAction()
    {
        // build args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'loginForm';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /logout
    public function logoutAction()
    {
        // logout any existing user
        $this->app['session']->remove('user');

        // redirect to home page
        return $this->app->redirect('/');
    }

    // action for POST route:    /processLogin
    public function processLoginAction()
    {
        // retrieve 'name' from GET params in Request object
        $request = $this->app['request_stack']->getCurrentRequest();
        $username = $request->get('username');
        $password = $request->get('password');

        $user = new \Itb\Model\User();
        $user = $user->getOneByUsername($username);
        $role = $user->getRole();

        $isLoggedIn = $user->canFindMatchingUsernameAndPassword($username, $password);

        // authenticate!
        if ($isLoggedIn && $role == 4) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username));

            // success - redirect to the secure admin home page
            return $this->app->redirect('/admin');
        }
        else if($isLoggedIn && $role == 2) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/student');
        }
        // authenticate!
        else if ($isLoggedIn && $role == 3) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/lecturer');
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter',
        );

        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
