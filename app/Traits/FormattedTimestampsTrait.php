<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormattedTimestampsTrait
{
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::create($value)->format('d/m/Y H:i');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::create($value)->format('d/m/Y H:i');
    }

    public function getDeletedAtAttribute($value): string
    {
        return Carbon::create($value)->format('d/m/Y H:i');
    }
}
