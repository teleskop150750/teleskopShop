<?php


namespace app\widgets\currency;


use RedBeanPHP\R;
use shop\App;

class Currency
{
    private $tpl;
    private $currencies;
    private $currency;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';
        $this->run();
    }

    protected function run()
    {
        $this->currencies =  App::$app->getProperty('currencies');
        $this->currency =  App::$app->getProperty('currency');
        echo $this->getHtml();
    }

    /**
     * получить список валют
     * @return array
     */
    public static function getCurrencies(): array
    {
        return R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC");
    }

    /**
     * получить текущую валюту
     * @param array $currencies
     * @return array
     */
    public static function getCurrency(array $currencies): array
    {
        if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)) {
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies);
        }

        $currency = $currencies[$key];
        $currency['code'] = $key;
        return $currency;
    }

    protected function getHtml()
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}