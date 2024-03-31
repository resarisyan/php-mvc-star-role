<?php

namespace StarRole\PhpMvc\App;

class Router
{
    private static array $routers = [];

    public static function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []
    ) {
        self::$routers[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    public static function run()
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
            //abc
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routers as $router) {
            $pattern = "#^" . $router['path'] . "$#";
            if (preg_match($pattern, $path, $matches) && $method == $router['method']) {
                foreach ($router['middleware'] as $middleware) {
                    $instance = new $middleware();
                    $instance->handle();
                }

                $function = $router['function'];
                $controller = new $router['controller']();

                array_shift($matches);
                call_user_func_array([$controller, $function], $matches);

                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
