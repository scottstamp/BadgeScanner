<?php
/**
 * Created by PhpStorm.
 * User: scott
 * Date: 7/28/2015
 * Time: 12:08 AM
 */

namespace BobbaJuice\BadgeScanner;

include "Badge.php";

class Scanner
{
    private static function DownloadTexts($hotel = "com") {
        return file_get_contents("https://www.habbo.$hotel/gamedata/external_flash_texts/1");
    }

    private static function ParseTexts($texts) {
        $textVars = array();
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $texts) as $line) {
            $varParts = explode("=", $line);
            if (strpos($varParts[0], "badge_") !== FALSE)
                if (strpos($varParts[0], "_name") !== FALSE || strpos($varParts[0], "_desc") !== FALSE)
                    $textVars[$varParts[0]] = implode('=', array_slice($varParts, 1));
        }

        return $textVars;
    }
    
    private static function ParseBadgeTexts($textVars) {
        $badges = array();
        foreach ($textVars as $name => $value) {
            if (substr($name, 0, 6) == "badge_") {
                $badge = trim(substr($name, 11));
                if (!array_key_exists($badge, $badges)) $badges[$badge] = new Badge($badge);
                if (strpos($name, "_name") !== FALSE) $badges[$badge]->name = $value;
                if (strpos($name, "_desc") !== FALSE) $badges[$badge]->description = $value;
            } else {
                $badge = trim(explode("_badge", $name)[0]);
                if (!array_key_exists($badge, $badges)) $badges[$badge] = new Badge($badge);
                if (strpos($name, "_name") !== FALSE) $badges[$badge]->name = $value;
                if (strpos($name, "_desc") !== FALSE) $badges[$badge]->description = $value;
            }
        }

        return $badges;
    }

    public static function Scan($hotel = "com") {
        return Scanner::ParseBadgeTexts(Scanner::ParseTexts(Scanner::DownloadTexts($hotel)));
    }
}