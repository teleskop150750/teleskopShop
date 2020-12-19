<?php


namespace app\controllers;


use app\models\AppModal;
use shop\base\Controller;

class AppController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModal();
    }
}
