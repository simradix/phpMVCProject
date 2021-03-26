<?php
namespace app\core;

/**
 * Router class
 * 
 * Implements request routing
 */
class Router 
{
    /**
     * routes = [
     *      "method" => [path => callback || view]
     * ]
     * 
     * Register for every incoming req that needs to be
     * handled -> to its METHOD map the PATH or VIEW 
     */
    /** @var Array $routes Registrated routes map method=>path=>action */
    protected array $routes = [];

    /** @var \app\core\Request $request Request class instance */
    protected \app\core\Request $request;

    /** @var \app\core\Response $response Response class instance */
    protected \app\core\Response $response;



    /**
     * Router constructor.
     * 
     * @param \app\core\Request $request
     * 
     * Inject Request object.
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }



    /**
     * Register the PATH and CALLBACK || VIEW for a GET
     *
     * @param String $path URL_path
     * @param Mixed  $callback Handler_Callback of View
     * @return void
     **/
    public function get(String $path, Mixed $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }



    /**
     * Register the PATH and CALLBACK||VIEW for a get req.
     *
     * @param String $path URL_path
     * @param Mixed  $callback Handler_Callback of View
     **/
    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }



    /**
     * Handle the incoming client requests.
     *
     * Resolve the incoming request to the registrated routes.
     *
     * @return mixed
     **/
    public function resolve(): mixed
    {
        // When a req its received use the Request obj 
        // to return the Path and Method of the req
        // get the apropriate callback registrated in
        // $this->routes.
        $path = $this->request->getPath();  // return client req URI
        $method = $this->request->method(); // return client req HTTP METHOD
        $callback = $this->routes[$method][$path] ?? false; // If exist return callback
        
        if (!$callback) {
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            return $this->render("_404");
        }

        // If the req handler is not a function, it means
        // that a View file was registrated instead of a callback.
        // The renderView method its called to return
        // the content of the view file.
        if (is_string($callback)) {
            return $this->render($callback);
        }

        if (is_array($callback)) {
            // Instantiate the current controller in use
            // inside Application::$app $controller prop
            Application::$app->setController(new $callback[0]);
            $callback[0] = Application::$app->getController();
        }

        // If there is a callback for the client req in the routes prop
        // here it is executed.
        return call_user_func($callback, $this->request);
    }



    /**
     * Returns a complete View.
     *
     * Specify the view file name thats 
     * gonna be injected into the layout view. 
     *
     * @param String $view View filename
     * @return string
     **/
    public function render(String $view, Array $params = []): String
    {
        $layout = $this->getLayout();
        $view = $this->getView($view, $params);
        
        return preg_replace("/{{\scontent\s}}/i", $view, $layout);
    }


    /**
     * Return the main layout view file
     *
     * @return string
     **/
    protected function getLayout(): String
    {
        $layout = Application::$app->controller->getLayoutName();
        
        // catche output-buffer and return it.
        ob_start();
        include_once Application::$ROOT_DIR . "/view/layouts/$layout.php";
        return ob_get_clean();
    }


    /**
     * Return view file
     *
     * @param String $view view filename
     * @return string
     **/
    protected function getView(String $view, Array $params = []): String
    {
        // iterate trough map and declare the key as a var
        // and assign its value to it. 
        // 'name'=>'value' --> $name = 'value';
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        
        // Every var in this functions scope its gonna be catched by
        // the include_onece and be directly available inside the included
        // scope.
        // catch output-buffer and return it
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        return ob_get_clean();
    } 
}