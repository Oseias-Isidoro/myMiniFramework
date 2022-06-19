<?php

require_once __DIR__.'/DB/DB.php';

/**
 *
 * @property string $table
 */
abstract class Model extends DB
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->table ?? get_class($this).'s';
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
     * @param int $id
     * @param array $data
     * @return array|false
     */
    public function update(int $id, array $data)
    {
        $attributes = '';

        foreach ($data as $key => $value)
            $attributes = $attributes.$key." = '$value'".(end($data) == $value ? '': ',');

        return $this->execute(
            "UPDATE $this->table SET $attributes WHERE id = :id;",
            [':id' => $id]
        );
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function delete(int $id)
    {
        return $this->execute("DELETE FROM $this->table WHERE id = :id", [':id' => $id]);
    }
}