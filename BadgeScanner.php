<?php
/**
 * BobbaJuice - Badge Scanner
 * Scott Stamp <scott@hypermine.com>
 */

require "vendor/autoload.php";

use BobbaJuice\BadgeScanner\Scanner;

$cfg = new \Spot\Config();
$cfg->addConnection('mysql', 'mysql://badges:passw0rd@localhost/badges');

$spot = new \Spot\Locator($cfg);

$badgeMapper = $spot->mapper('BobbaJuice\BadgeScanner\Entity\Badge');

$badges = Scanner::Scan("de");

foreach ($badges as $badge) {
    try {
        $badgeMapper->create([
            'code'          => $badge->code,
            'name'          => $badge->name,
            'description'   => $badge->description
        ]);
    } catch (Exception $exception) {}
}