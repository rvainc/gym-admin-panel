<?php

namespace App\Http\Controllers\Concerns;

use Carbon\Carbon;
use DateTimeInterface;

trait DateTransformation
{
    /**
     * @param integer|string|DateTimeInterface|null $value
     * @return array|null
     */
    protected function dateToDisplay($value)
    {
        $date = is_null($value)
            ? null
            : date_to_carbon($value, app_timezone())->setTimezone(base_timezone());

        return dates_bundle($date);
    }

    /**
     * @param $value
     * @return Carbon|null
     */
    protected function dateToSystem($value)
    {
        if (blank($value)) {
            return null;
        }

        return date_replace_timezone(date_to_carbon($value), base_timezone())
            ->setTimezone(app_timezone());
    }

    /**
     * @param array $values
     * @param array $keys
     * @return array
     */
    protected function datesToSystem(array $values, array $keys)
    {
        return collect($values)
            ->map(function ($value, $key) use ($keys) {
                return in_array($key, $keys)
                    ? $this->dateToSystem($value)
                    : $value;
            })
            ->toArray();
    }
}
