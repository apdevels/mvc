<?php
namespace Core;

use Controllers\NewsController;
use Controllers\ViewController;

/**
 * Определяет, какой контроллер должен обрабатывать запрос
 * Class Application
 * @package Core
 */
class Application
{
    public function run()
    {
        preg_match('/^\/(\w+)\.php/', $_SERVER['REQUEST_URI'], $matches);

        if ($matches[1] == 'news') {
            return ((new NewsController())->index());
        } else if ($matches[1] == 'view') {
            return ((new ViewController())->index());
        }
    }
}
