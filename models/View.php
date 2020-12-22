<?php
namespace Models;

use \Core\Model;

/**
 * Class View
 * @package Models
 */
class View extends Model
{
    public $query = "SELECT 
                            title,
                            content
                      FROM news
                      WHERE id = :id";
}
