<?php

namespace Itb\Controllers;

class AdminController
{
    private $app;

    public function __construct(\Itb\WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction()
    {
                // test if 'username' stored in session ...
                $username = $this->getAuthenticatedUserName();

                $user = new \Itb\Model\User();
                $user = $user->getOneByUsername($username);
                $role = $user->getRole();


                // check we are authenticated --------
                $isAuthenticated = (null != $username);
                if (!$isAuthenticated) {
                    // not authenticated, so redirect to LOGIN page
                    return $this->app->redirect('/login');
                }

                if ($role == 4) {
                    // store username into args array
                    $argsArray = [];

                    // render (draw) template
                    // ------------
                    $templateName = 'admin/index';
                    return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
                }
                else{
                    // store username into args array
                    $argsArray = [];

                    // render (draw) template
                    // ------------
                    $templateName = '/noAccess';
                    return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
                }
            }

            // action for route:    /adminCodes
            // will we allow access to the Admin home?
            public function codesAction()
            {
                // test if 'username' stored in session ...
                $username = $this->getAuthenticatedUserName();

                $user = new \Itb\Model\User();
                $user = $user->getOneByUsername($username);
                $role = $user->getRole();


                // check we are authenticated --------
                $isAuthenticated = (null != $username);
                if (!$isAuthenticated) {
                    // not authenticated, so redirect to LOGIN page
                    return $this->app->redirect('/login');
                }

                if ($role == 4) {
                // store username into args array
                $argsArray = [];

                // render (draw) template
                // ------------
                $templateName = 'admin/codes';
                return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
                }
                else{
                    // store username into args array
                    $argsArray = [];

                    // render (draw) template
                    // ------------
                    $templateName = '/noAccess';
                    return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
                }
            }

            /**
             * if user logged-in, THEN return user's username
             * if user not logged-in THEN return 'null'
             *
             * @return null (or string username)
             */

    public function getAuthenticatedUserName()
    {
        // IF object (array) 'user' found with non-null value in 'session'
        $user = $this->app['session']->get('user');

        // if no such object in session, return NULL
        if(null == $user){
            return null;
        }

        // IF no value found in $user with key 'username' then return NULL
        if (!isset($user['username'])){
            return null;
        }

        // if we get here, we can return the value whose key is 'username'
        return $user['username'];
    }

}
