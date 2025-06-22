<?php

namespace App\Core;

class UrlParser
{
    public function parse(): string
    {
        $basePath = $this->getBasePath();
        $uri = $this->getCurrentUri();
        $cleanUri = $this->removeBasePath($uri, $basePath);

        return '/' . trim($cleanUri, '/');
    }

    private function getBasePath(): string
    {
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        return rtrim(str_replace('public', '', $scriptPath), '/');
    }

    private function getCurrentUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
    }

    private function removeBasePath(string $uri, string $basePath): string
    {
        if (strpos($uri, $basePath) === 0) {
            return substr($uri, strlen($basePath));
        }

        return $uri;
    }

    private function extractSegments(string $uri): array
    {
        $segments = explode('/', trim($uri, '/'));
        return array_values(array_filter($segments, fn($segment) => $segment !== ''));
    }
}
