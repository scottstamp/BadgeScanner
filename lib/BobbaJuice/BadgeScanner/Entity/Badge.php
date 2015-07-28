<?php
/**
 * Created by PhpStorm.
 * User: scott
 * Date: 7/28/2015
 * Time: 2:00 AM
 */

namespace BobbaJuice\BadgeScanner\Entity;
use Spot\Entity;

class Badge extends Entity
{
    protected static $table = 'badges';
    public static function fields() {
        return [
            'id'            => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'code'          => ['type' => 'string', 'required' => true, 'index' => true],
            'name'          => ['type' => 'string', 'required' => true],
            'description'   => ['type' => 'string']
            //'date_added'    => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }
}