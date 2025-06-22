<?php

namespace App\Core;

class Core
{
    public function __construct(private array $routes)
    {
        $this->setRoutes($routes);
    }

    public function run()
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';

        $url = ($url != '/') ? rtrim($url, '/') : $url;

        $routerFound = false;

        foreach ($this->getRoutes() as $path => $controllerAndAction) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+|\d+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controllerAndAction);

                $controller = "\\App\Controllers\\" . $currentController;
                (new $controller())->$action($matches);
            }
        }

        if (!$routerFound) {
            http_response_code(404);
        }
    }

    protected function getRoutes(): array
    {
        return $this->routes;
    }

    protected function setRoutes($routes)
    {
        $this->routes = $routes;
    }
}
