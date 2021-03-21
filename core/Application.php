<?php
namespace app\core;
/**
 * Application class
 * 
 * Framework entrypoint.
 */
class Application
{
    /** @var String $ROOT_DIR The dirname of the projects rootdir */
    public static String $ROOT_DIR;

    /** @var \app\core\Router $router Router instace */
    public Router $router;
    
    /** @var \app\core\Request $request Request instance */
    public Request $request;

    /** @var \app\core\Response $response Response instance */
    public $response;

    public static \app\core\Application $app;



    /**
     * Application contructor
     * 
     * Declare static property rootPath which should
     * contain the dirname of the project file.
     * Inject Request instance into Appplication instance.
     * Inject Router instance with the Request instance.
     *
     * @param String $rootPath top-most dirname
     **/
    public function __construct(String $rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new \app\core\Request();
        $this->response = new \app\core\Response();
        $this->router = new \app\core\Router($this->request, $this->response);
    }



    /**
     * Framework starte method
     *
     * Executes Router's resolve method that resolves
     * the incomming client's requests.
     *
     * @return void
     **/
    public function run (): void 
    {
        echo $this->router->resolve();
    }
}

