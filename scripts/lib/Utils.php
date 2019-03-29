<?php

namespace Urbania\AppleNews\Scripts;

class Utils
{
    public static function sortTypes($types)
    {
        usort($types, function ($a, $b) {
            $aIsClass = preg_match('/^[A-Z]/', $a) === 1;
            $aIsObject = $aIsClass && preg_match('/\\\[A-Z]/', $a) === 1;
            $bIsClass = preg_match('/^[A-Z]/', $b) === 1;
            $bIsObject = $bIsClass && preg_match('/\\\[A-Z]/', $b) === 1;
            if ($aIsObject && $bIsObject) {
                return strcmp($a, $b);
            } elseif ($bIsObject && !$aIsObject) {
                return 1;
            } elseif ($aIsObject || $aIsClass) {
                return -1;
            } elseif (!$aIsObject && !$bIsClass) {
                return strcmp($aIsObject, $bIsClass);
            }
            return 1;
        });

        return $types;
    }
}
