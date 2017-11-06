<?php

namespace w3lifer\phpCalendar;

/**
 * Class PhpCalendarI18n.
 */
class PhpCalendarI18n
{
    protected static $monthNames = [
        'be' => [
            'Студзень',
            'Люты',
            'Сакавік',
            'Красавік',
            'Травень (Май)',
            'Чэрвень',
            'Ліпень',
            'Жнівень',
            'Верасень',
            'Кастрычнік',
            'Лістапад',
            'Снежань'
        ],
        'en' => [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ],
        'ru' => [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь'
        ],
    ];

    protected static $weekDayNames = [
        'be' => [
            'Панядзелак',
            'Аўторак',
            'Серада',
            'Чацвер',
            'Пятніца',
            'Субота',
            'Нядзеля'
        ],
        'en' => [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ],
        'ru' => [
            'Понедельник',
            'Вторник',
            'Среда',
            'Четверг',
            'Пятница',
            'Суббота',
            'Воскресенье'
        ],
    ];

    protected static $weekDayAbbrs2 = [
        'be' => ['Пн', 'Аў', 'Ср', 'Чц', 'Пт', 'Сб', 'Нд'],
        'en' => ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        'ru' => ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
    ];

    protected static $weekDayAbbrs3 = [
        'be' => ['Пнд', 'Аўт', 'Сер', 'Чцв', 'Пят', 'Суб', 'Няд'],
        'en' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        'ru' => ['Пнд', 'Втр', 'Срд', 'Чтв', 'Птн', 'Сбт', 'Вск'],
    ];

    public static function getAll()
    {
        return [
            'monthNames' => static::$monthNames,
            'weekDayNames' => static::$weekDayNames,
            'weekDayAbbrs2' => static::$weekDayAbbrs2,
            'weekDayAbbrs3' => static::$weekDayAbbrs3,
        ];
    }

    public static function getMonthNames(string $language = 'en') : array
    {
        return
            isset(static::$monthNames[$language])
                ? static::$monthNames[$language]
                : static::$monthNames['en'];
    }

    public static function getWeekDayNames(string $language = 'en') : array
    {
        return
            isset(static::$weekDayNames[$language])
                ? static::$weekDayNames[$language]
                : static::$weekDayNames['en'];
    }

    public static function getWeekDayAbbrs2(string $language = 'en') : array
    {
        return
            isset(static::$weekDayAbbrs2[$language])
                ? static::$weekDayAbbrs2[$language]
                : static::$weekDayAbbrs2['en'];
    }

    public static function getWeekDayAbbrs3(string $language = 'en') : array
    {
        return
            isset(static::$weekDayAbbrs3[$language])
                ? static::$weekDayAbbrs3[$language]
                : static::$weekDayAbbrs3['en'];
    }

    public static function getIndexedMonthNames(string $language = 'en') : array
    {
        return
            array_combine(
                self::getMonthNames(), // [!] Without $language
                self::getMonthNames($language)
            );
    }

    public static function getIndexedWeekDayNames(
        string $language = 'en'
    ) : array
    {
        return
            array_combine(
                self::getWeekDayNames(), // [!] Without $language
                self::getWeekDayNames($language)
            );
    }

    public static function getIndexedWeekDayAbbrs2(
        string $language = 'en'
    ) : array
    {
        return
            array_combine(
                self::getWeekDayAbbrs2(), // [!] Without $language
                self::getWeekDayAbbrs2($language)
            );
    }

    public static function getIndexedWeekDayAbbrs3(
        string $language = 'en'
    ) : array
    {
        return
            array_combine(
                self::getWeekDayAbbrs3(), // [!] Without $language
                self::getWeekDayAbbrs3($language)
            );
    }
}
