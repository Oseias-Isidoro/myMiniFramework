<?php

require_once __DIR__ . '/services/RouteService.php';
require_once __DIR__ . '/Request.php';

/**
 *
 */
class App
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->request = new Request();

        (new RouteService($this->request))->run();
    }
}