<?php
namespace Models;

use \Core\Model;

/**
 * Class News
 * @package Models
 */
class News extends Model
{
    public $query = "SELECT id,
                            FROM_UNIXTIME(idate, '%d.%m.%Y') as date,
                            title,
                            announce
                      FROM news
                      ORDER BY idate
                      DESC 
                      LIMIT :frm OFFSET :cnt
                      ";

    public $queryCount = "SELECT COUNT(id) cnt
                            FROM news";
}
