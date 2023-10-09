<?php

namespace App\Models\Erp;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cutting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vno', '=', $searches);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function jobcard(): BelongsTo
    {
        return $this->belongsTo(Jobcard::class);
    }

    public static function nextNo()
    {
        return static::max('vno') + 1;
    }

}
