<?php


namespace app\controllers;


use RedBeanPHP\R;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $currency = $_GET['currency'] ?? null;
        if ($currency) {
            $curr = R::findOne('currency', 'code = ?', [$currency]);
            if (!empty($curr)) {
                setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
            }
        }
        redirect();
    }
}