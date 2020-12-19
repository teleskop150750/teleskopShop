<?php


namespace shop;


class Router
{
    /**
     * маршруты
     * @var array
     */
    private static array $routes = [];

    /**
     * текущий маршрут
     * @var array
     */
    private static array $route = [];

    /**
     * добавить маршрут
     * @param string $regexp
     * @param array $route
     */
    public static function addRoute(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * получить массив маршрутов
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * получить текущий маршрут
     * @return array
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * перейти на страницу
     * @param string $url
     * @throws \Exception
     */
    public static function dispatch(string $url): void
    {
        $url = self::removeQueryString($url);

        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::formatAction(self::$route['action']) . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод не найден {$controller}::{$action}", 404);
                }
            } else {
                throw new \Exception("Класс не найден {$controller}", 404);
            }
        } else {
            throw new \Exception('Не найден маршрут', 404);
        }
    }

    /**
     * поиск соответствующего маршрута
     * @param string $url
     * @return bool
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }

                $route['controller'] = self::formatController($route['controller']);

                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }

                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * CamelCase
     * @param string $name
     * @return string
     */
    private static function formatController(string $controller): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $controller)));
    }

    /**
     * camelCase
     * @param string $name
     * @return string
     */
    private static function formatAction(string $action): string
    {
        return lcfirst(self::formatController($action));
    }

    /**
     * удалить GET параметры из url
     * @param string $url
     * @return string
     */
    private static function removeQueryString(string $url): string
    {
        $params = explode('&', $url, 2);
        if (strpos($params[0], '=') === false) {
            return rtrim($params[0], '/');
        }
        return '';
    }
}
