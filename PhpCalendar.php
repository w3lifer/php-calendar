<?php

namespace w3lifer\phpCalendar;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * # PhpCalendar
 *
 * ## Example of 12-month calendar
 *
 * ``` php
 * $year = $_GET['year'] ?? null;
 * $phpCalendar = (new PhpCalendar())->get(12, 1, $year); // ->getYear($year);
 * $prevSearchParams = '?year=' . $phpCalendar->prevPeriodParams['startYear'];
 * $nextSearchParams = '?year=' . $phpCalendar->nextPeriodParams['startYear'];
 * echo
 *     '<style>body {text-align: center;} table {margin: auto;}</style>' .
 *     '<hr>' .
 *     '<a href="' . $prevSearchParams . '">«««</a>' .
 *     '&nbsp;' .
 *     '<a href="' . $nextSearchParams . '">»»»</a>' .
 *     '<hr>';
 * echo $phpCalendar;
 * ```
 *
 * ## Example of periodic calendar
 *
 * ``` php
 * $numberOfMonths = $_GET['number-of-months'] ?? 6;
 * // Set `$startMonth` to `null` by default to get auto scrolling calendar
 * $startMonth = $_GET['start-month'] ?? 1;
 * $startYear = $_GET['start-year'] ?? null;
 * $phpCalendar =
 *     (new PhpCalendar())
 *         ->get($numberOfMonths, $startMonth, $startYear);
 * $prevSearchParams =
 *     '?number-of-months=' . $numberOfMonths .
 *     '&start-month=' . $phpCalendar->prevPeriodParams['startMonth'] .
 *     '&start-year=' . $phpCalendar->prevPeriodParams['startYear'];
 * $nextSearchParams =
 *     '?number-of-months=' . $numberOfMonths .
 *     '&start-month=' . $phpCalendar->nextPeriodParams['startMonth'] .
 *     '&start-year=' . $phpCalendar->nextPeriodParams['startYear'];
 * echo
 *     '<style>body {text-align: center;} table {margin: auto;}</style>' .
 *     '<hr>' .
 *     '<a href="' . $prevSearchParams . '">«««</a>' .
 *     '&nbsp;' .
 *     '<a href="' . $nextSearchParams . '">»»»</a>' .
 *     '<hr>';
 * echo $phpCalendar;
 * ```
 *
 * ## Configuration
 *
 * ``` php
 * // The default configuration
 *
 * $phpCalendar = new PhpCalendar([
 *     'language' => 'en',
 *     'monthNames' => [
 *         'January',
 *         'February',
 *         'March',
 *         'April',
 *         'May',
 *         'June',
 *         'July',
 *         'August',
 *         'September',
 *         'October',
 *         'November',
 *         'December'
 *     ],
 *     'weekDayAbbrs' => [
 *         'Mon',
 *         'Tue',
 *         'Wed',
 *         'Thu',
 *         'Fri',
 *         'Sat',
 *         'Sun'
 *     ],
 *     'firstDayOfWeek' => 1,
 *     'timezone' => date_default_timezone_get(),
 * ]);
 *
 * // The example of custom configuration
 *
 * $phpCalendar = new PhpCalendar([
 *     // If language exists in the `PhpCalendarI18n::$monthNames`, we can set
 *     // it here instead of `monthNames` and `weekDayAbbrs` as shown below; but
 *     // `monthName` and `weekDayAbbrs` will still have priority
 *     'language' => 'ru',
 *     'monthNames' => [
 *         'Январь',
 *         'Февраль',
 *         'Март',
 *         'Апрель',
 *         'Май',
 *         'Июнь',
 *         'Июль',
 *         'Август',
 *         'Сентябрь',
 *         'Октябрь',
 *         'Ноябрь',
 *         'Декабрь'
 *     ],
 *     'weekDayAbbrs' => [
 *         'Пнд',
 *         'Втр',
 *         'Срд',
 *         'Чтв',
 *         'Птн',
 *         'Сбт',
 *         'Вск'
 *     ],
 *     'firstDayOfWeek' => 7, // Or 'Sun', 'Sunday', 'sun', 'sunday'
 *     'timezone' => 'Europe/Moscow',
 * ]);
 * ```
 *
 * ## `get()` method
 *
 * This method is the main public method in this class.
 *
 * ``` php
 * public function get(
 *     int $numberOfMonths = 12,
 *     int $startMonth = null, // date('n')
 *     int $startYear = null // date('Y')
 * ) : PhpCalendar
 * ```
 *
 * It returns `PhpCalendar` object, which have the following public properties:
 *
 * - `$html string` — HTML calendar;
 * - `$prevPeriodParams array` — params for the prev period;
 * - `$nextPeriodParams array` — params for the next period.
 *
 * The following period params (keys of the arrays) are available:
 *
 * - `numberOfMonth`;
 * - `startMonth`;
 * - `startYear`.
 *
 * `PhpCalendar` class also have defined `__toString()` method, which just
 * returns self `$html` property (HTML calendar).
 *
 * ## Example of HTML calendar
 *
 * ``` html
 * <div class="php-calendar" data-timezone="UTC" data-timezone-offset="0">
 *     <div class="php-calendar_month-box" data-month-number="1">
 *         <table>
 *             <caption>
 *                 <span class="php-calendar_month-name">January</span>
 *                 <span class="php-calendar_year-name">1970</span>
 *             </caption>
 *             <tr>
 *                 <th>Mon
 *                 <th>Tue
 *                 <th>Wed
 *                 <th>Thu
 *                 <th>Fri
 *                 <th>Sat
 *                 <th>Sun
 *             <tr>
 *                 <td
 *                     data-week-number="1"
 *                     data-day-number="363"
 *                     data-timestamp="-259200"
 *                     class="php-calendar_day_other-month"
 *                  >
 *                     <span class="php-calendar_day">29</span>
 *                 <td
 *                     data-week-number="1"
 *                     data-day-number="364"
 *                     data-timestamp="-172800"
 *                     class="php-calendar_day_other-month"
 *                  >
 *                     <span class="php-calendar_day">30</span>
 *                 <td
 *                      data-week-number="1"
 *                      data-day-number="365"
 *                      data-timestamp="-86400"
 *                      class="php-calendar_day_other-month"
 *                  >
 *                     <span class="php-calendar_day">31</span>
 *                 <td
 *                      data-week-number="1"
 *                      data-day-number="1"
 *                      data-timestamp="0"
 *                 >
 *                     <span class="php-calendar_day php-calendar_today">
 *                         1
 *                     </span>
 *                 <td
 *                      data-week-number="1"
 *                      data-day-number="2"
 *                      data-timestamp="86400"
 *                  >
 *                     <span class="php-calendar_day">2</span>
 *                 <td
 *                     data-week-number="1"
 *                     data-day-number="3"
 *                     data-timestamp="172800"
 *                 >
 *                     <span class="php-calendar_day">3</span>
 *                 <td
*                      data-week-number="1"
*                      data-day-number="4"
*                      data-timestamp="259200"
*                  >
 *                     <span class="php-calendar_day">4</span>
 *             ...
 *         </table>
 *     </div>
 *     ...
 * </div>
 * ```
 */
class PhpCalendar
{
    /*
     * =========================================================================
     * PRIVATE PROPERTIES
     * =========================================================================
     */

    /**
     * Translations of month names, week day names and week day abbreviations.
     * @var array
     */
    private $i18n;

    /**
     * Two-letter lowercase language code according to ISO-639-1.
     * @var string
     * @see https://loc.gov/standards/iso639-2/php/code_list.php
     */
    private $language = 'en';

    /**
     * Month names: 12 elements.
     * @var array
     */
    private $monthNames;

    /**
     * Week day abbreviations: 7 elements.
     * @var array
     */
    private $weekDayAbbrs;

    /**
     * First day of week: 1 (Monday) - 7 (Sunday).
     * We can set its value as an **English week day name** or an **English week
     * day abbreviation** (three letters) via configuration array passed to
     * constructor.
     * For example:
     * ``` php
     * $phpCalendar = new PhpCalendar([
     *     'firstDayOfWeek' => 7,
     * ]);
     *
     * $phpCalendar = new PhpCalendar([
     *     'firstDayOfWeek' => 'Sun',
     * ]);
     *
     * $phpCalendar = new PhpCalendar([
     *     'firstDayOfWeek' => 'Sunday',
     * ]);
     *
     * $phpCalendar = new PhpCalendar([
     *     'firstDayOfWeek' => 'sun',
     * ]);
     *
     * $phpCalendar = new PhpCalendar([
     *     'firstDayOfWeek' => 'sunday',
     * ]);
     * ```
     * @var int|string
     */
    private $firstDayOfWeek = 1;

    /**
     * A new timezone.
     * @var string
     */
    private $newTimezone;

    /**
     * The timezone of the context where methods of this class will be called.
     * @var string
     */
    private $oldTimezone;

    /**
     * Current Unix timestamp.
     * @var int
     */
    private $today;

    /*
     * =========================================================================
     * PUBLIC PROPERTIES
     * =========================================================================
     */

    /**
     * Resulting markup.
     * @var string
     */
    public $html = '';

    /**
     * @var array
     */
    public $prevPeriodParams = [];

    /**
     * @var array
     */
    public $nextPeriodParams = [];

    /*
     * =========================================================================
     * METHODS
     * =========================================================================
     */

    /**
     * This method just returns value of the `$html` property.
     * @return string
     */
    public function __toString()
    {
        return $this->html;
    }

    /**
     * PhpCalendar constructor.
     * ``` php
     * $config['language']       // See `$language`
     * $config['monthNames']     // See `$monthNames`
     * $config['weekDayAbbrs']   // See `$weekDayAbbrs`
     * $config['firstDayOfWeek'] // See `$firstDayOfWeek`
     * $config['timezone']       // See `$newTimezone`
     * ```
     * @param array $config
     * @throws Exception
     * @see $language
     * @see $monthNames
     * @see $weekDayAbbrs
     * @see $firstDayOfWeek
     * @see $newTimezone
     */
    public function __construct($config = [])
    {
        $this->i18n = PhpCalendarI18n::getAll();

        // Language

        if (isset($config['language'])) {
            if (array_key_exists(
                $config['language'],
                $this->i18n['monthNames']
            )) {
                $this->language = $config['language'];
            }
            unset($config['language']);
        }

        // Month names

        if (isset($config['monthNames'])) {
            $this->setMonthsNames($config['monthNames']);
            unset($config['monthNames']);
        } else {
            $this->monthNames = $this->i18n['monthNames'][$this->language];
        }

        // Week day abbreviations

        if (isset($config['weekDayAbbrs'])) {
            $this->setWeekDayAbbrs($config['weekDayAbbrs']);
            unset($config['weekDayAbbrs']);
        } else {
            $this->weekDayAbbrs = $this->i18n['weekDayAbbrs3'][$this->language];
        }

        // First day of week

        if (isset($config['firstDayOfWeek'])) {
            if (is_int($config['firstDayOfWeek'])) {
                $this->setFirstDayOfWeek_ByWeekDayNumber(
                    $config['firstDayOfWeek']
                );
            } elseif (is_string($config['firstDayOfWeek'])) {
                $this->setFirstDayOfWeek_ByWeekDayString(
                    $config['firstDayOfWeek']
                );
            } else {
                throw new Exception(
                    'Type of the "firstDayOfWeek" element must be ' .
                        'either integer or string'
                );
            }
            unset($config['firstDayOfWeek']);
        }

        // Timezone

        if (isset($config['timezone'])) {
            $this->newTimezone = $config['timezone'];
            unset($config['timezone']);
        }

        // Check on unknown properties

        if ($config) {
            throw new Exception(
                'Setting unknown property: '
                    . static::class . '::$' . array_keys($config)[0]
            );
        }
    }

    /**
     * Sets month names.
     * @param array $monthNames January (0) - December (11).
     * @throws Exception
     */
    private function setMonthsNames(array $monthNames)
    {
        if (count($monthNames) !== 12) {
            throw new Exception('The number of month names must be 12');
        }
        $this->monthNames = $monthNames;
    }

    /**
     * Sets week day abbreviations.
     * @param array $weekDayAbbrs Monday (0) - Sunday (6).
     * @throws Exception
     */
    private function setWeekDayAbbrs(array $weekDayAbbrs)
    {
        if (count($weekDayAbbrs) !== 7) {
            throw new Exception(
                'The number of week day abbreviations must be 7'
            );
        }
        $this->weekDayAbbrs = $weekDayAbbrs;
    }

    /**
     * Sets number of the first day of week by week day number.
     * @param int $weekDayNumber Week day number (1-7).
     * @throws Exception
     */
    private function setFirstDayOfWeek_ByWeekDayNumber(int $weekDayNumber)
    {
        if ($weekDayNumber < 1 || $weekDayNumber > 7) {
            throw new Exception(
                'The week day number must be in range from 1 to 7 inclusively'
            );
        }
        $this->firstDayOfWeek = $weekDayNumber;
        $this->shiftWeekDayAbbrs();
    }

    /**
     * Sets number of the first day of week by week day string.
     * @param string $weekDayString Mon-Sun, Monday-Sunday, mon-sun,
     *                              monday-sunday.
     * @throws Exception
     */
    private function setFirstDayOfWeek_ByWeekDayString(string $weekDayString)
    {
        // Mon-Sun
        $key = array_search($weekDayString, $this->i18n['weekDayAbbrs3']['en']);
        // Monday-Sunday
        if ($key === false) { // (!) Strict comparison with `false`
            $key =
                array_search($weekDayString, $this->i18n['weekDayNames']['en']);
            // mon-sun
            if ($key === false) {
                $key =
                    array_search(
                        $weekDayString,
                        $this->i18n['weekDayAbbrs3']['en']
                    );
                // monday-sunday
                if ($key === false) {
                    $key =
                        array_search(
                            $weekDayString,
                            $this->i18n['weekDayNames']['en']
                        );
                }
            }
        }
        if ($key === false) {
            throw new Exception(
                'The week day name must be as ' .
                    'Mon-Sun, Monday-Sunday, mon-sun or monday-sunday'
            );
        }
        $this->firstDayOfWeek = ++$key;
        $this->shiftWeekDayAbbrs();
    }

    /**
     * Shifts week day abbreviations by number of the first day of week.
     * It is universal method to be used when setting up `$firstDayOfWeek` and
     * `$weekDayAbbrs`.
     * @see setFirstDayOfWeek_ByWeekDayNumber()
     * @see setFirstDayOfWeek_ByWeekDayString()
     */
    private function shiftWeekDayAbbrs()
    {
        for ($i = 1; $i < $this->firstDayOfWeek; $i++) {
            array_push($this->weekDayAbbrs, array_shift($this->weekDayAbbrs));
        }
    }

    /**
     * For more details see DocBlock of the class itself.
     * @param int      $numberOfMonths
     * @param int|null $startMonth
     * @param int|null $startYear
     * @return PhpCalendar
     * @see PhpCalendar
     */
    public function get(
        int $numberOfMonths,
        int $startMonth = null,
        int $startYear = null
    ) : PhpCalendar {

        $this->setTimezone();

        $this->setToday();

        $this->validateNumberOfMonths($numberOfMonths);

        if ($startMonth === null) {
            $startMonth = (int) date('n');
        } else {
            $this->validateStartMonthNumber($startMonth);
        }

        if ($startYear === null) {
            $startYear = (int) date('Y');
        }

        $prevMonth = $nextMonth = $startMonth;
        $prevYear = $nextYear = $startYear;

        $markup = '';
        for ($i = 1; $i <= $numberOfMonths; $i++) {
            $markup .= $this->getMonthMarkup($nextMonth, $nextYear);
            $nextMonth++;
            if ($nextMonth === 13) {
                $nextMonth = 1;
                $nextYear++;
            }
            $prevMonth--;
            if ($prevMonth === 0) {
                $prevMonth = 12;
                $prevYear--;
            }
        }
        $markup = $this->wrap($markup);

        $this->html = $markup;

        // Search params for the prev period

        $this->prevPeriodParams['numberOfMonth'] = $numberOfMonths;
        $this->prevPeriodParams['startMonth'] = $prevMonth;
        $this->prevPeriodParams['startYear'] = $prevYear;

        // Search params for the next period

        $this->nextPeriodParams['numberOfMonth'] = $numberOfMonths;
        $this->nextPeriodParams['startMonth'] = $nextMonth;
        $this->nextPeriodParams['startYear'] = $nextYear;

        $this->resetTimezone();

        return $this;
    }

    /**
     * Sets timezone.
     * @return bool
     * @throws Exception
     */
    private function setTimezone()
    {
        if (!$this->newTimezone) {
            return false;
        }
        $this->oldTimezone = date_default_timezone_get();
        if (date_default_timezone_set($this->newTimezone)) {
            return true;
        }
        throw new Exception('Can not set the timezone');
    }

    /**
     * Sets current Unix timestamp to the `$today` property.
     */
    private function setToday()
    {
        $this->today = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
    }

    /**
     * Validates number of months.
     * @param int $numberOfMonths
     * @throws Exception
     */
    private function validateNumberOfMonths(int $numberOfMonths)
    {
        if ($numberOfMonths <= 0) {
            throw new Exception(
                'The number of months must be greater than 0'
            );
        }
    }

    /**
     * Validates passed month number.
     * @param int $monthNumber
     * @throws Exception
     */
    private function validateStartMonthNumber(int $monthNumber)
    {
        if ($monthNumber < 1 || $monthNumber > 12) {
            throw new Exception(
                'The month number must be in range from 1 to 12 inclusively'
            );
        }
    }

    /**
     * Returns month table as HTML string.
     * @param int $monthNumber
     * @param int $year
     * @return string
     */
    private function getMonthMarkup(int $monthNumber, int $year)
    {
        $matrix = $this->getMonthMatrix($monthNumber, $year);

        $monthName = $this->monthNames[$monthNumber - 1];

        $table =
            '<div' .
                ' class="php-calendar_month-box"' .
                ' data-month-number="' . $monthNumber . '"' .
            '>' .
                '<table>' .
                    '<caption>' .
                        '<span class="php-calendar_month-name">' .
                            $monthName .
                        '</span>' .
                        ' ' .
                        '<span class="php-calendar_year-name">' .
                            $year .
                        '</span>' .
                    '</caption>' .
                    '<tr>' .
                        '<th>' . implode('<th>', $this->weekDayAbbrs) .
                    '<tr>';

        $cellsNumber = count($matrix);

        for ($i = 0; $i < $cellsNumber; $i++) {
            // Day
            $day = date('j', $matrix[$i]);
            // Today
            $today = $matrix[$i] === $this->today ? ' php-calendar_today' : '';
            $day =
                '<span class="php-calendar_day' . $today . '">'
                    . $day .
                '</span>';
            // <td>
            $td = '<td';
            $td .= ' data-week-number="' . (int) date('W', $matrix[$i]) . '"';
            $td .= ' data-day-number="' . (date('z', $matrix[$i]) + 1) . '"';
            $td .= ' data-timestamp="' . $matrix[$i] . '"';
            if (($i + 1) % 7 === 0 && ($i !== $cellsNumber - 1)) {
                $table .= $td . '>' . $day . '<tr>';
            } else {
                $td .=
                    (int) date('n', $matrix[$i]) !== $monthNumber
                        ? ' class="php-calendar_day_other-month">'
                        : '>';
                $table .= $td . $day;
            }
        }

        $table .= '</table></div>';

        return $table;
    }

    /**
     * Returns array of Unix timestamps, which represents month days.
     * @param int $month
     * @param int $year
     * @return array
     */
    private function getMonthMatrix(int $month, int $year)
    {
        $firstDayTimestamp = mktime(0, 0, 0, $month, 1, $year);

        $matrix = [];

        // First "row"

        $interval =
            date('N', $firstDayTimestamp) -
                $this->firstDayOfWeek;
        if ($interval < 0) {
            $interval += 7;
        }
        for ($i = 0; $i > -$interval; $i--) {
            $matrix[] = mktime(0, 0, 0, $month, $i, $year);
        }
        $matrix = array_reverse($matrix);

        // Days

        $daysInMonth = date('t', $firstDayTimestamp);
        $matrix[] = $firstDayTimestamp;
        for ($i = 2; $i <= $daysInMonth; $i++) {
            $matrix[] = mktime(0, 0, 0, $month, $i, $year);
        }

        // Last "row"

        $nextMonth = $month + 1;
        $interval =
            $this->firstDayOfWeek -
                date('N', mktime(0, 0, 0, $nextMonth, 1, $year));
        if ($interval < 0) {
            $interval += 7;
        }
        for ($i = 1; $i <= $interval; $i++) {
            $matrix[] = mktime(0, 0, 0, $nextMonth, $i, $year);
        }

        // Return

        return $matrix;
    }

    /**
     * Wraps calendar by markup and sets values for `data-timezone` and
     * `data-timezone-offset` attributes.
     * @param $calendar string
     * @return string
     */
    private function wrap($calendar)
    {
        $markup =
            '<div' .
                ' class="php-calendar"' .
                ' data-timezone="' . date_default_timezone_get() . '"' .
                ' data-timezone-offset="' . $this->getTimezoneOffset() . '"' .
            '>' . $calendar . '</div>';
        return $markup;
    }

    /**
     * Returns timezone offset.
     * @return int
     */
    private function getTimezoneOffset()
    {
        $timezoneObj =
            new DateTimeZone(date_default_timezone_get());
        $timezoneOffset =
            $timezoneObj->getOffset(new DateTime(null, $timezoneObj));
        return $timezoneOffset;
    }

    /**
     * Resets timezone to previous value.
     */
    private function resetTimezone()
    {
        if ($this->oldTimezone) {
            date_default_timezone_set($this->oldTimezone);
        }
    }

    /*
     * =========================================================================
     * HELPERS
     * =========================================================================
     */

    /**
     * Returns calendar for the specified year (by default for the current
     * year).
     * @param int|null $year
     * @return static
     */
    public function getYear(int $year = null) : PhpCalendar
    {
        return $this->get(12, 1, $year);
    }
}
