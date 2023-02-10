<?php

use Illuminate\Support\Carbon;

/**
 * @return string
 */
function base_timezone()
{
    return config('app.base_timezone');
}

/**
 * @return string
 */
function app_timezone()
{
    return config('app.timezone');
}
/**
 * @param Carbon|null $date
 * @return array|null
 */
function dates_bundle(?Carbon $date)
{
    return is_null($date) ? null : [
        'iso' => $date->toIso8601String(),
        'timestamp' => $date->getTimestamp(),
        'datetime' => $date->toDateTimeLocalString(),
    ];
}

/**
 * @param mixed $value
 * @param string|null $tz
 * @return Carbon
 * @throws Exception
 */
function date_to_carbon($value, $tz = null)
{
    if ($value instanceof Carbon) {
        return clone $value;
    }

    if ($value instanceof DateTimeInterface) {
        return new Carbon(
            $value->format('Y-m-d H:i:s.u'),
            $value->getTimezone()
        );
    }

    if (is_numeric($value)) {
        return Carbon::createFromTimestamp($value, $tz);
    }

    return Carbon::parse($value, $tz);
}

/**
 * @param Carbon|null $value
 * @param string $tz
 * @return Carbon|null
 */
function date_replace_timezone($value, $tz)
{
    return is_null($value)
        ? $value
        : Carbon::parse($value->toDateTimeLocalString(), $tz);
}

/**
 * @param Carbon $start
 * @param Carbon $ends
 * @return bool
 */
function check_transaction_status(Carbon $start, Carbon $ends)
{
    return Carbon::now()->between($start, $ends);
}
