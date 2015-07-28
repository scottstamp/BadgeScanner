<?php
/**
 * BobbaJuice - Badge Scanner
 * Scott Stamp <scott@hypermine.com>
 */

namespace BobbaJuice\BadgeScanner;

class Badge
{
    public $code;
    public $name;
    public $description;

    public function __construct($code) {
        $this->code = $code;
    }
}