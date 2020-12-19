<?php


namespace shop;


class Registry extends Singleton
{
    /**
     * свойства
     * @var array
     */
    public static array $properties = [];

    /**
     * задать свойство
     * @param string $name
     * @param string $value
     */
    public function setProperty(string $name, string $value): void
    {
        self::$properties[$name] = $value;
    }

    /**
     * получить свойство
     * @param $name
     * @return string
     * @throws \Exception
     */
    public function getProperty($name):string
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        throw new \Exception('Дан неверный ключ');
    }


    /**
     * получить все свойства
     * @return array
     */
    public function getProperties ():array
    {
        return self::$properties;
    }
}
