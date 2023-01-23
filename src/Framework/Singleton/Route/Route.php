<?php

namespace Framework\Singleton\Route;

use Exception;
use Framework\Singleton\Singleton;

const ROUTE_NOT_FOUND_REDIRECT = 12;
const ROUTE_NOT_FOUND_BUT_DISPLAY_THE_ERROR = 13;

class Route implements Singleton
{
    private static $instance;
    private $routes;

    public function __construct()
    {
        $this->routes[] = ['url' => "error/404", "method" => "get", "name" => "404", "action" => function () {
            return "404 Not Found";
        }];
        $this->routes[] = ['url' => "error/401", "method" => "get", "name" => "401", "action" => function () {
            return "401 Bad Request";
        }];
    }
    public static function get(): Route
    {
        if (!self::$instance)
            self::$instance = new Route();
        return self::$instance;
    }

    public function addGet($url, $action, $name)
    {
        $this->routes[] = ['url' => $url, "method" => "get", "name" => $name, "action" => $action];
    }
    public function addPost($url, $action, $name)
    {
        $this->routes[] = ['url' => $url, "method" => "post", "name" => $name, "action" => $action];
    }

    public function route($routeName, $params = [])
    {
        try {
            return str_replace([":/"], "://", str_replace(["//"], "/", SITE_URL . $this->detectRouteByName($routeName)['url'])) . $this->paramsQuery($params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), ROUTE_NOT_FOUND_BUT_DISPLAY_THE_ERROR);
        }
    }

    public function redirect($routeName, $params = [])
    {
        
        return header("Location: " . SITE_URL . $this->detectRouteByName($routeName)['url']).$this->paramsQuery($params);
    }




    private function paramsQuery($params) {
        $paramsQuery = "";
        if (!empty($params)) {
            $paramsQuery = "?";
            $it = 0;
            foreach ($params as $paramName => $paramValue)
                $paramsQuery .= $paramName . "=" . $paramValue . (++$it < (count($params) - 1));
        }

        return $paramsQuery;
    }
    private function detectRouteByName($routeName)
    {
        $routeFound = null;
        foreach (self::get()->routes as $route) {
            if ($route['name'] == $routeName)
                $routeFound = $route;
        }
        if (!$routeFound)
            throw new Exception("Route not found", ROUTE_NOT_FOUND_REDIRECT);
        return $routeFound;
    }

    private function detectRouteByUrl($routeUrl)
    {
        $routeFound = null;
        foreach (self::get()->routes as $route) {
            if (str_replace(['/', "http:", "https:"], "", $route['url']) == explode("?",str_replace(["/", "http:", "https:"], '', $routeUrl))[0])
                $routeFound = $route;
        }
        if (!$routeFound)
            throw new Exception("Route not found", ROUTE_NOT_FOUND_REDIRECT);
        return $routeFound;
    }

    public function makeActionByUrl($url)
    {
        try {
            $route = self::get()->detectRouteByUrl($url);

            if (is_callable($route['action']))
                return $route['action']();

            $controller = explode("@", $route['action'])[0];
            $method = explode("@", $route['action'])[1];
            return call_user_func('\App\Controller\\' . $controller . '::' . $method);
        } catch (Exception $e) {
            if ($e->getCode() == ROUTE_NOT_FOUND_REDIRECT)
                self::get()->redirect("404");
            else
                echo $e->getMessage();
        }
    }
}
