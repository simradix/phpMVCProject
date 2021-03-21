<?php
namespace app\core;

/**
 * Response class
 */
class Response
{
    /**
     * Set HTTP response status code
     *
     * @param INT $code HTTP status code.
     * @return void
     **/
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }
}
