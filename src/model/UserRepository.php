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
}
