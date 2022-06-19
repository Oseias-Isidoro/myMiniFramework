<?php

/**
 *
 */
class Connection
{
    /**
     * @var string
     */
    private string $servername;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var PDO
     */
    private PDO $connection;
    /**
     * @var string
     */
    private string $db_name;

    /**
     *
     */
    public function __construct()
    {
        $this->servername = 'localhost:3306';
        $this->db_name = 'test_framework';
        $this->username = 'root';
        $this->password = '';
        $this->connect();
    }

    /**
     * @return void
     */
    private function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->db_name", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }


}