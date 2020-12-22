<?php
namespace Controllers;

use Core\Controller;
use Models\View;

/**
 * Class ViewController
 * @package Controllers
 */
class ViewController extends Controller
{
    public function index()
    {
        $model = new View();
        $id = (int)$_GET['id'];
        $data = $model->getOne($model->query, $id);

        return $this->render(
            '/../views/view/index',
            $data['title'],
            ['data' => $data]
        );
    }
}
