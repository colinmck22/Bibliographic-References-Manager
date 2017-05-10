<?php
namespace Itb\Model;

use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class RefsRepository extends DatabaseTableRepository
{
    /**
     * create a new UserRepository object
     * and intialise it with 3 users as defined below
     */

    function __construct()
    {
        $namespace = 'Itb\Model';
        $classNameForDbRecords = 'Ref';

        $tableName = 'refs';
        parent::__construct($namespace, $classNameForDbRecords, $tableName);

    }
}
