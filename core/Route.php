<?php

class Route
{
    private $uri;
    private static $routes=[];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    static function get($exp, $cb)
    {


        array_push(self::$routes, [$exp, $cb]);

    }

    static function resolve(){

        $uri = rtrim($_SERVER['REQUEST_URI'], '/');

        $routes = self::$routes;
        $isMatched = false;
        for ($i = 0; $i <count($routes); $i++) {
            //print_r( $this->routes[$i][0] );
            $isMatched = self::match($routes[$i][0], $uri);

            if($isMatched){
               return $routes[$i][1]();
            }

        }
        if(!$isMatched){
            return require './views/404.php';
        }
    }

     static function match($exp, $uri)
    {
        // echo 'position '. strstr($exp, ':');

        $uri = explode('/', $uri);
        $exp = explode('/', $exp);

        $matched = true;
        if (count($uri) !== count($exp)) {
            $matched = false;

        } else {
            for ($i = 0; $i < count($uri); $i++) {
                if (!($uri[$i] == $exp[$i] || substr($exp[$i], 0, 1) == ':')) {
                    $matched = false;
                }
            }
        }
        return $matched;
    }

    private function isParam($str)
    {

    }

    /*public function resolve()
    {

        for ($i = 0; $i < count($this->routes); $i++) {
            //print_r( $this->routes[$i][0] );
            if ($this->routes[$i][0] == $this->uri) {
                $this->routes[$i][1]();
            }
        }

        // print_r($this->routes);
    }*/
}