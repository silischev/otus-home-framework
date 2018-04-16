<?php

namespace Otus\Core;

use PDO;

class DbConnection
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * DbConnection constructor.
     *
     * @param string $dsn
     * @param string $userName
     * @param string $password
     */
    public function __construct(string $dsn, string $userName, string $password)
    {
        $this->connection = new PDO($dsn, $userName, $password);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

}