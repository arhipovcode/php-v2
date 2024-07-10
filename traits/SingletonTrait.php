<?php

namespace traits;

trait SingletonTrait
{
    // Трейт для вставки в любой класс, если нужно сделать его использование
    // только один раз на весь проект
    private static $instance = null;

    /**
     * @return static
     */
    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static();
    }

    private function __construct(){}
    private function __clone(){}
    public function __wakeup(){}
}
