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
class Refs extends DatabaseTable
{
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
     * ref
     *
     * example:
     * <code>
     * ref
     * </code>
     *
     * @var string
     */
    private $ref;

    /**
     * links
     *
     * example:
     * <code>
     * links
     * </code>
     *
     * @var string
     */
    private $links;

    /**
     * description
     *
     * example:
     * <code>
     * description
     * </code>
     *
     * @var int
     */
    private $description;

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
     * get $ref
     * @return string $ref
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * set username
     * @param string $username
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * get $links
     * @return string $links
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * get $Description
     * @return string $Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * set description
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * set Links
     * @param string $Links
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }

    /**
     * get all refs
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function get_all_refs()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        // SQL query
        $sql = 'SELECT * FROM refs';

        // execute query and collect results
        $statement = $connection->query($sql);
        $refs = $statement->fetchAll();

        return $refs;
    }

    public static function get_one_ref($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = "SELECT * FROM refs WHERE id=$id";
        $statement = $connection->query($sql);

        if ($row = $statement->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

}
