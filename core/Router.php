<?php
namespace app\core;

class Router 
{
    /**
     * routes = [
     *      "method" => [path => callback]
     * ]
     */
    protected array $routes = [];
    public Request $request;

    /**
     * Router constructor.
     * 
     * @param \app\core\Request $request
     */
    public function __construct(\app\core\Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            echo "Not Found";
            exit;
        }

        echo call_user_func($callback);

    }
}