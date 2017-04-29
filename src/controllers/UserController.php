<?php

namespace Itb\Controllers;

use Itb\Model\User;
use Itb\Model\UserRepository;

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

        // authenticate!
        if ('admin' === $username && 'admin' === $password) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/admin');
        }

        // authenticate!
        else if ('lecturer' === $username && 'lecturer' === $password) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/lecturer');
        }

        // authenticate!
        else if ('student' === $username && 'student' === $password) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/student');
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