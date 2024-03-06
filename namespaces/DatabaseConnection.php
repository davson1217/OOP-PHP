<?php
namespace Database;

interface DBInterface
{
    public function connect();
    public function disconnect();
}
trait DatabaseConnection
{
    private $serverName = "127.0.0.1:3306";
    private $username = "root";
    // private $password = "";
    public $connection;

    public function connect()
    {
        $this->connection = mysqli_connect($this->serverName, $this->username);
        if (!$this->connection || $this->connection->connect_error) {
            die("Connection Error: " . $this->connection->connect_error);
        }

        return $this->connection;
    }

    public function disconnect()
    {
        $this->connection->close();
    }
}