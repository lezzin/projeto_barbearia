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
        $parser = new UrlParser();
        $url = $parser->parse();

        $routerFound = false;

        foreach ($this->getRoutes() as $path => $controllerAndAction) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controllerAndAction);

                $controllerClass = "\\App\\Controllers\\{$currentController}";
                $controller = new $controllerClass();

                call_user_func_array([$controller, $action], $matches);

                break;
            }
        }

        if (!$routerFound) {
            http_response_code(404);
            echo "404 Not Found: {$url}";
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
