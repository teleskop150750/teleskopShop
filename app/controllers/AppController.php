<?php


namespace app\controllers;


use app\models\AppModal;
use app\widgets\currency\Currency;
use RedBeanPHP\R;
use shop\App;
use shop\base\Controller;
use shop\Cache;

class AppController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModal();
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));
        App::$app->setProperty('cats', self::cacheCategory());
    }

    public static function cacheCategory()
    {
        $cache = Cache::getInstance();
        $cats = $cache->get('cats');
        if (!$cats) {
            $cats = R::getAssoc("SELECT * FROM category");
            $cache->set('cats', $cats);
        }
        return $cats;
    }
}
