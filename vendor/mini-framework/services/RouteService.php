<?php

require_once __DIR__ . '/../../../vendor/mini-framework/View.php';

/**
 *
 */
class RouteService
{
    /**
     * @var Request
     */
    private Request $request;
    /**
     * @var array
     */
    private array $routes;
    /**
     * @var array
     */
    private array $currentRoute;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        try {
            $this->init();
        } catch (\Throwable $th) {
            View::show('../vendor/mini-framework/views/error.phtml', [
                'message' => $th->getMessage().' code: '.$th->getCode()
            ], $th->getCode());
        }
    }

    /**
     * @throws Exception
     */
    private function init()
    {
        $this->loadRoutes();
        $this->routeExists($this->request->getPath());
        $this->setCurrentRoute($this->routes[$this->request->getPath()] ?? []);
        $this->checkMethod();
    }

    /**
     * @throws Exception
     */
    private function checkMethod()
    {
        if ($this->currentRoute['method'] !== $this->request->getRequestMethod())
            throw new \Exception('Method not allowed for this route', 400);
    }

    /**
     * @return void
     */
    private function loadRoutes()
    {
        /**
         * @var array $routes
         */
        require_once '../routes/web.php';
    }

    /**
     * @param array $route
     * @return void
     */
    public function setCurrentRoute(array $route)
    {
        $this->currentRoute = $route;
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function run()
    {
        require_once __DIR__ . '/../../../Controllers/'.$this->currentRoute['controller'].'.php';
        $refl = new ReflectionClass($this->currentRoute['controller']);
        $instance = $refl->newInstanceArgs(array());
        $instance->{$this->currentRoute['action']}($this->request);
    }

    /**
     * @param string $method
     * @param string $route
     * @param string $controller
     * @param string $action
     * @return void
     */
    private function add(string $method, string $route, string $controller, string $action)
    {
        $this->routes[$route] = array(
            'method' => strtoupper($method),
            'controller' => $controller,
            'action' => $action
        );
    }

    /**
     * @throws Exception
     */
    public function routeExists(string $path)
    {
        if (!isset($this->routes[$path]))
            throw new \Exception('Route not found', 404);
    }
}