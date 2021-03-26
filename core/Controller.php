<?php
namespace app\core;

/**
 * Controller Class
 */
class Controller
{
    public String $layout = 'main';


    /**
     * Method render() randers the view with the specified params
     *
     *
     * @param string $view View name
     * @return mixed
     * @package app\core
     **/
    public function render(String $view, Array $params = []): mixed
    {
        return Application::$app->router->render($view, $params);
    }

    public function setLayoutName(String $layout)
    {
        $this->layout = $layout;
    }

    public function getLayoutName()
    {
        return $this->layout;
    }
}