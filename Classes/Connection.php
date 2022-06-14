<?php

class Connection
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=qor3a_dev","root","root");
    }
    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}