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
        require_once __DIR__.'/../../../db_config.php';

        /** @var string $DB_SERVE */
        $this->servername = $DB_SERVE;
        /** @var string $DB_NAME */
        $this->db_name = $DB_NAME;
        /** @var string $DB_USERNAME */
        $this->username = $DB_USERNAME;
        /** @var string $DB_PASSWORD */
        $this->password = $DB_PASSWORD;

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