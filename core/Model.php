<?php
namespace Core;

use PDO;

/**
 * Class Model
 * @package Core
 */
class Model
{
	private $pdo;
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/main.php';

        try {
            $this->pdo = new PDO(
                "mysql:host = " . $this->config['DB']['HOST'] . ";
                dbname=" . $this->config['DB']['NAME'],
                $this->config['DB']['USER'],
                $this->config['DB']['PASS']
            );
        } catch (\PDOException $e) {
            echo "Не соединяется! " . $e->getMessage();
        }
    }

    public function getPage($query, $pageId)
    {
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $out = $this->pdo->prepare($query);
        $out->bindValue(':frm', $this->config['NEWS_ON_PAGE'], PDO::PARAM_INT);
        $out->bindValue(
            ':cnt',
            ($pageId - 1) * $this->config['NEWS_ON_PAGE'],
            PDO::PARAM_INT
        );
        $out->execute();

        return $out->fetchAll();
    }


    public function getCountPages($query)
    {
        $out = $this->pdo->prepare($query);
        $out->execute(['newsPerPage' => $this->config['NEWS_ON_PAGE']]);
        $news = $out->fetch();
        $pages = (int)($news['cnt'] / $this->config['NEWS_ON_PAGE']);

        if ($news['cnt'] % $this->config['NEWS_ON_PAGE']) {
            $pages += 1;
        }
        return $pages;
    }

    public function getOne($query, $id)
    {
        $out = $this->pdo->prepare($query);
        $out->execute(['id' => $id]);

        return $out->fetch();
    }
}
