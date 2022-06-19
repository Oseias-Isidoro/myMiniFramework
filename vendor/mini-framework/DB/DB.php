<?php

require_once __DIR__.'/Connection.php';

/**
 *
 */
class DB
{
    /**
     * @var Connection
     */
    private Connection $connection;

    /**
     *
     */
    public function __construct()
    {
        $this->connection = new Connection();
    }

    /**
     * @param string $query
     * @param array $bindValues
     * @return array|false
     */
    public function raw(string $query, array $bindValues = [])
    {
        return $this->execute($query, $bindValues);
    }

    /**
     * @param string $query
     * @param array $bindValues
     * @return array|false
     */
    protected function execute(string $query, array $bindValues = [])
    {
        $stmt = $this->connection->getConnection()->prepare($query);

        foreach ($bindValues as $key => $value)
            $stmt->bindValue($key, $value);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}