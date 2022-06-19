<?php

/**
 *
 */
class View
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @param string $view_path
     * @param array $data
     * @param int $code
     * @return void
     */
    public static function show(string $view_path, array $data = [], int $code = 200)
    {
        $instance = new View();
        $instance->setData($data);

        require_once '../views/'.$view_path;
        http_response_code($code);
        exit();
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $attribute
     * @return mixed
     */
    public function getAttribute(string $attribute)
    {
        return $this->data[$attribute];
    }
}