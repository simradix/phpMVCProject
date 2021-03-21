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


    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        
        if (!$callback) {
            return "Not Found";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }


    public function renderView(String $view)
    {
        $layout = $this->layoutContent();
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        $viewContent = ob_get_clean();
        $pattern = "/{{\scontent\s}}/i";
        
        return preg_replace($pattern, $viewContent, $layout);
    }


    protected function layoutContent() 
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/view/layouts/main.php";
        return ob_get_clean();
    }
}