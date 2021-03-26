<?php
namespace app\core;

/**
 * Request class
 */
class Request
{
    /**
     * Return URI of incomming request (without query parms).
     *
     * @return string
     **/
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $hasQueryParam = strpos($path, '?');
        if (!$hasQueryParam) {
            return $path;
        }
        return substr($path, 0, $hasQueryParam);
    }



    /**
     * Return HTTP METHOD of incomming request.
     *
     * @return string
     **/
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() 
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function getBody() 
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
