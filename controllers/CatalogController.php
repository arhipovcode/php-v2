<?php

namespace controllers;

class CatalogController
{
    protected string|null $action = null;
    protected string $defaultAction = 'index';

    public function run(string $action = null): void
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function actionIndex(): void
    {
        $menuItems = [
            ['title' => 'О нас', 'link' => 'about', 'color' => '#D3B599'],
            ['title' => 'Каталог', 'link' => 'catalog', 'color' => '#115E67'],
            ['title' => 'Где купить', 'link' => 'buy', 'color' => '#9D2B2E'],
            ['title' => 'Блог', 'link' => 'blog', 'color' => '#FD6B28'],
            ['title' => 'Контакты', 'link' => 'contacts', 'color' => '#D3B599'],
            ['title' => 'Найди свою форму', 'link' => 'find', 'color' => '#9D2B2E'],
        ];
        include __DIR__ . '/../views/layouts/store/index.php';
    }
}
