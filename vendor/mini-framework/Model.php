<?php

require_once __DIR__.'/DB/Connection.php';

/**
 *
 * @property string $table
 */
class Model
{
    /**
     * @var Connection
     */
    protected Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection();

        $this->table = $this->table ?? get_class($this).'s';
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
     * @return array|false
     */
    public function all()
    {
        return $this->execute("select * from $this->table where 1");
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function find(int $id)
    {
        return $this->execute(
            "select * from $this->table where id = :id",
            [':id' => $id]
        );
    }

    /**
     * @param string $query
     * @param array $bindValues
     * @return array|false
     */
    protected function execute(string $query, array $bindValues = [])
    {
        $stmt = $this->connection->getConnection()->prepare($query);

        if (isset($bindValues))
            foreach ($bindValues as $key => $value)
                $stmt->bindValue($key, $value);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}