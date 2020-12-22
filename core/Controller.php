<?php
namespace Core;

/**
 * Class Controller
 * @package Core
 */
class Controller
{
    protected $layout;
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/main.php';
        $this->layout = $this->config['LAYOUT'];
    }

	protected function render($view, $title = '', $data = []) {
		$page = new Page($this->layout, $view, $title, $data);

		return $this->renderLayout($page, $this->renderView($page));
	}

    private function renderLayout(Page $page, $content) {
			$layoutPath = $_SERVER['DOCUMENT_ROOT'] . "{$page->layout}.php";

			if (file_exists($layoutPath)) {
				ob_start();
					$title = $page->title;
					include $layoutPath;
				return ob_get_clean();
			} else {
				echo "Не найден файл с лейаутом по пути $layoutPath"; die();
			}
		}

		private function renderView(Page $page) {
			if ($page->view) {
				$viewPath = $_SERVER['DOCUMENT_ROOT'] . "{$page->view}.php";

				if (file_exists($viewPath)) {
					ob_start();
						$data = $page->data;
						extract($data);
						include $viewPath;
					return ob_get_clean();
				} else {
					echo "Не найден файл с представлением по пути $viewPath"; die();
				}
			}
		}
}
