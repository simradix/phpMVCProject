<?php
namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $hasQueryParam = strpos($path, '?');
        if (!$hasQueryParam) {
            return $path;
        }
        return substr($path, 0, $queryParamPos);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
