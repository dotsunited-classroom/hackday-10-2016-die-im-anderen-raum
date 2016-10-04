<?php

class Request
{
    private $request = null;

    public function __construct()
    {
        $this->request = [
            'get' => $_GET,
            'post' => $_POST,
            //'session' => $_SESSION,
            'cookie' => $_COOKIE,
            'files' => $_FILES,
            'server' => $_SERVER,
        ];
    }

    public function getRoute()
    {
        return trim($this->request['server']['REQUEST_URI'], '/');
    }

    public function getMethod()
    {
        return mb_strtolower($this->request['server']['REQUEST_METHOD'], 'utf-8');
    }

    public function getAddress()
    {
        $http = $this->request['server']['HTTPS'] ? 'https://' : 'http://';
        $name = $this->request['server']['HTTP_HOST'];
        $route = $this->getRoute();

        return $http . $name . '/' . $route;
    }
}