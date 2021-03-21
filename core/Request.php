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
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
