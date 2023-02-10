<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseJsonResource extends JsonResource
{
    /**
     * @param int|string|DateTimeInterface|null $firstDate
     * @param int|string|DateTimeInterface|null $secondDate
     * @return string
     * @throws Exception
     */
    public function getDateDifference($firstDate, $secondDate)
    {
        $firstDate = Carbon::parse($firstDate);
        $secondDate = Carbon::parse($secondDate);

        return $firstDate->diffInDays($secondDate)
            ? $firstDate->diffInDays($secondDate) . ' д.'
            : $firstDate->diffInHours($secondDate) . ' г.';
    }

    /**
     * @param int|string|DateTimeInterface|null $value
     * @return array
     * @throws Exception
     */
    protected function formatDate($value)
    {
        return dates_bundle($this->dateToFront($value));
    }


    /**
     * @param int|string|DateTimeInterface|null $value
     * @return Carbon|null
     * @throws Exception
     */
    protected function dateToFront($value)
    {
        return $value
            ? date_to_carbon($value, app_timezone())->setTimezone(base_timezone())
            : null;
    }
}
