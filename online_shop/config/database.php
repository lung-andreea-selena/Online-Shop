<?php
class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'shop');

        if ($this->connection->connect_error) {
            throw new Exception('Database connection failed: ' . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);

        if ($result === false) {
            throw new Exception('Error executing query: ' . $this->connection->error);
        }

        return $result;
    }

    public function prepare($sql)
    {
        $stmt = $this->connection->prepare($sql);

        if ($stmt === false) {
            throw new Exception('Error preparing statement: ' . $this->connection->error);
        }

        return $stmt;
    }

    //to prevent SQL injection
    public function escape($value): string
    {
        return $this->connection->real_escape_string($value);
    }

    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
