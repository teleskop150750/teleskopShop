<?php


namespace app\controllers;


use RedBeanPHP\R;
use shop\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = R::findAll('test');
        $this->setMeta('TITLE','Описание...', 'Ключевые слова...');
        $name ='John';
        $age = 30;
        $cache = Cache::getInstance();
        $date = $cache->get('test');
        debug($date, 'test');
        $this->setData(compact('name', 'age', 'posts'));
    }
}
