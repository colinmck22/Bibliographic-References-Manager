<?php
namespace Itb\Model;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class UserRepository extends DatabaseTableRepository
{
    /**
     * create a new UserRepository object
     * and intialise it with 3 users as defined below
     */
    function __construct()
    {
        $namespace = 'Itb\Model';
        $classNameForDbRecords = 'User';

        $tableName = 'users';
        parent::__construct($namespace, $classNameForDbRecords, $tableName);

    }
/*
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

        $colin = new User();
        $colin->setId(3);
        $colin->setUsername('colin');
        $colin->setPassword('mckenna');
        $colin->setRole(User::ROLE_LECTURER);

        $admin = new User();
        $admin->setId(4);
        $admin->setUsername('admin');
        $admin->setPassword('admin');
        $admin->setRole(User::ROLE_ADMIN);

        // add users to the array
        $this->users[1] = $matt;
        $this->users[2] = $joe;
        $this->users[3] = $colin;
        $this->users[4] = $admin;
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
*/
}