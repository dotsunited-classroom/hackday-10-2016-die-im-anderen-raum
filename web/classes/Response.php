<?php

class Response
{
    public function __construct()
    {

    }

    public function json($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
    }

    public function send(int $code, string $message = '')
    {
        header("HTTP/1.0 $code");
        echo $message;
    }
}