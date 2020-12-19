<?php


namespace shop;


class App
{
    public static object $app;

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query);
    }

    /**
     * задать параметры
     */
    protected function getParams(): void
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }
}
