<?php
namespace Controllers;

use Core\Controller;
use Models\News;

/**
 * Class NewsController
 * @package Controllers
 */
class NewsController extends Controller
{
    protected $model;

    public function index()
    {
        $this->model = new News();
        $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        $data = $this->model->getPage($this->model->query, $page);
        $pages = $this->model->getCountPages($this->model->queryCount);

        return $this->render(
            '/../views/news/index',
            'Новости, стр. ' . $page,
            [
                'data' => $data,
                'pages' => $pages,
                'page' => $page
            ]
        );
    }
}
