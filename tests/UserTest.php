<?php

namespace ItbTest;

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'product');

use Itb\Model\User;
use Mattsmithdev\PdoCrud\DatabaseManager;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        // Arrange
        $p = new User();

        // Act
        $p->setId(4);

        // Assert
        $p->getId();
    }

    public function testUsername()
    {
        // Arrange
        $p = new User();

        // Act
        $p->setUsername('dave');

        // Assert
        $p->getUsername();
    }

    public function testPassword()
    {
        // Arrange
        $p = new User();

        // Act
        $p->setPassword('password');

        // Assert
        $p->getPassword();
    }

    public function testRole()
    {
        // Arrange
        $p = new User();

        // Act
        $p->setRole(4);

        // Assert
        $p->getRole();
    }

    public function testGetOneByUsername()
    {
        // Arrange
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        // Act
        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        // Assert
        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

}

