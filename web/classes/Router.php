<?php

class Router
{
    const GET = 'get';
    const POST = 'post';

    private $routes = [];
    private $path = null;
    private $errors = [];
    private $response = null;

    public function __construct($path = '/')
    {
        $this->path = $path;

        //$this->response = new Response();
    }

    protected function addRoute($method, $url, $callback)
    {
        $url = trim($this->path . '/' . $url, '/');

        $this->routes[$method][$url] = [
            'callback' => $callback,
        ];
    }

    public function get($url, $callback)
    {
        $this->addRoute(self::GET, $url, $callback);
    }

    public function post($url, $callback)
    {
        $this->addRoute(self::POST, $url, $callback);
    }

    public function error($status, $callback)
    {
        $this->errors[$status] = $callback;
    }

    public function start(Request $request)
    {
        if(array_key_exists($request->getRoute(), $this->routes[$request->getMethod()])) {
            $this->routes[$request->getMethod()][$request->getRoute()]['callback']();
        } else {
            if(is_callable($this->errors['404'])) {
                //$this->response->send(404);
                header("HTTP/1.0 404 Not Found");
                $this->errors['404']();
            } else {
                header("HTTP/1.0 404 Not Found");
                //$this->response->send(404, 'Datei nicht gefunden!');
            }
        }
    }
}