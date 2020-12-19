<?php


namespace shop\base;



class View
{
    protected array $route;
    protected string $controller;
    protected string $model;
    protected string $view;
    protected string $prefix;
    protected ?string $layout;
    protected array $data = [];
    protected array $meta = [];

    public function __construct(array $route, array $meta, ?string $layout = '', string $view = '')
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;

        if (!is_null($layout)) {
            $this->layout = $layout ?: LAYOUT;
        } else {
            $this->layout = null;
        }
    }

    /**
     * рендер
     * @param $data
     * @throws \Exception
     */
    public function render(?array $data): void
    {
        if (is_array($data)){
            extract($data);
        }
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

        if (is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }

        if (!is_null($this->layout)) {
             $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Не найден шаблон {$layoutFile}", 500);
            }
        }
    }

    /**
     * задать метаданные
     * @return string
     */
    public function getMeta(): string
    {
        $meta = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $meta .= '<meta name="description" content="' . $this->meta['description'] . '">' . PHP_EOL;
        $meta .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $meta;
    }
}
