<?php

function connect_to_db()
{
    // DSN - the Data Source Name - requred by the PDO to connect
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

    // attempt to create a connection to the database
    try {
        $connection = new \PDO($dsn, DB_USER, DB_PASS);
    } catch (\PDOException $e) {
        // deal with connection error
        print 'ERROR - there was a problem trying to create DB connection' . PHP_EOL;
        return null;
    }

    return $connection;
}

function get_all_products()
{
    $connection = connect_to_db();

    // SQL query
    $sql = 'SELECT * FROM products';

    // execute query and collect results
    $statement = $connection->query($sql);
    $products = $statement->fetchAll();

    return $products;
}

function get_one_product($id)
{
    $connection = connect_to_db();

    $sql = "SELECT * FROM products WHERE id=$id";
    $statement = $connection->query($sql);

    if ($row = $statement->fetch()) {
        return $row;
    } else {
        return null;
    }
}