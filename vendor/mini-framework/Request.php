<?php

/**
 *
 */
class Request
{
    /**
     * @var array
     */
    private array $params;
    /**
     * @var array
     */
    private array $form_data;
    /**
     * @var string
     */
    private string $body;
    /**
     * @var string
     */
    private string $request_method;
    /**
     * @var string
     */
    private string $path;

    /**
     *
     */
    public function __construct()
    {
        $this->setPath(parse_url($_SERVER['REQUEST_URI'])['path']);
        $this->setRequestMethod($_SERVER['REQUEST_METHOD']);
        $this->setParams($_GET);
        $this->setFormData($_POST);
        $this->setBody(file_get_contents('php://input'));
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array|string
     */
    public function getParams(string $attribute = null)
    {
        return $this->params[$attribute] ?? $this->params;
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return $this->form_data;
    }

    /**
     * @param array $form_data
     */
    public function setFormData(array $form_data): void
    {
        $this->form_data = $form_data;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->request_method;
    }

    /**
     * @param string $request_method
     */
    public function setRequestMethod(string $request_method): void
    {
        $this->request_method = $request_method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }


}