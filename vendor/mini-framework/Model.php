<?php

require_once __DIR__.'/DB/Connection.php';

class Model
{
    protected Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection();

        $this->table = $this->table ?? get_class($this).'s';
    }

    public function get()
    {
        $query = "select * from $this->table where 1;";

        $stmt = $this->connection->getConnection()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $query = "select * from $this->table where id = :id;";

        $stmt = $this->connection->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}