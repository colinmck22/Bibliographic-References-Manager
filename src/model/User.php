<?php
/**
 * namespace Itb\Model
 */
namespace Itb\Model;

/**
 * use databaseTable
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
/**
 * use databaseManager
 */
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * Class User extends DatabaseTable
 * @package Itb\Model
 */
class User extends DatabaseTable
{
    /**
     * define public role
     * example:
     * <code>
     * 1
     * </code>
     * @var integer
     */
    const ROLE_PUBLIC = 1;

    /**
     * define student role
     * example:
     * <code>
     * 2
     * </code>
     * @var integer
     */
    const ROLE_STUDENT = 2;

    /**
     * define lecturer role
     * example:
     * <code>
     * 3
     * </code>
     * @var integer
     */
    const ROLE_LECTURER = 3;

    /**
     * define admin role
     * example:
     * <code>
     * 4
     * </code>
     * @var integer
     */
    const ROLE_ADMIN = 4;

    /**
     * id of user (unique primary KEY)
     *
     * example:
     * <code>
     * 1234
     * </code>
     * @var integer
     */

    private $id;

    /**
     * username
     *
     * example:
     * <code>
     * dave
     * </code>
     *
     * @var string
     */
    private $username;

    /**
     * user password
     *
     * example:
     * <code>
     * password
     * </code>
     *
     * @var string
     */
    private $password;

    /**
     * users role
     *
     * example:
     * <code>
     * 2
     * </code>
     *
     * @var int
     */
    private $role;

    /**
     * get the ID
     *
     * example usage:
     *
     * <code>
     * return $this->id;
     * </code>
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set ID
     *
     * example usage:
     *
     * <code>
     * $this->id = $id;
     * </code>
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * get $username
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * set username
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * get $password
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * get $role
     * @return string $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * set role
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * set password
     * @param string $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**
     * return success (or not) of attempting to find matching username/password in the repo
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public function canFindMatchingUsernameAndPassword($username, $password)
    {
        $user = User::getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $user){
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        if($password == $hashedStoredPassword)
            return true;
    }

    /**
     * if record exists with $username, return User object for that record
     * otherwise return 'null'
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {

        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

}
