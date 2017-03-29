<?php
namespace Itb;

class UserRepository
{
    private $users = [];
    
    public function __construct()
    {
        $matt = new User();
        $matt->setId(1);
        $matt->setUsername('matt');
        $matt->setPassword('smith');
        $matt->setRole(User::ROLE_PUBLIC);

        $joe = new User();
        $joe->setId(2);
        $joe->setUsername('joe');
        $joe->setPassword('bloggs');
        $joe->setRole(User::ROLE_STUDENT);

        $admin = new User();
        $admin->setId(3);
        $admin->setUsername('colin');
        $admin->setPassword('mckenna');
        $matt->setRole(User::ROLE_LECTURER);

        $admin = new User();
        $admin->setId(4);
        $admin->setUsername('admin');
        $admin->setPassword('admin');
        $matt->setRole(User::ROLE_ADMIN);

        // add users to the array
        $this->users[1] = $matt;
        $this->users[2] = $admin;
        $this->users[3] = $joe;
    }

    public function getAll()
    {
        return $this->users;
    }

    public function getOneById($id)
    {
        if($id == 1 || $id == 2 || $id = 3){
            return $this->users[$id];
        } else {
            return null;
        }
    }

    public function getOneByUsername($username) {
        foreach ($this->users as $user){
            if($user->getUsername() == $username){
                return $user;
            }
        }
        return null;
    }

    public function canFindMatchingUsernameAndPassword($username, $password){
        $user = $this->getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $user){
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedStoredPassword);
    }





}