<?php

namespace oQuiz\Utils;

use oQuiz\App;

abstract class DateFormat
{
    public static function formatDateFromMySQL(string $dateMySQL)
    {
        $timestamp = strtotime($dateMySQL);

        return self::formatDate($timestamp);
    }

    public static function formatDate(int $timestamp)
    {
        return date(App::getConfig('DATE_FORMAT'), $timestamp);
    }
}
