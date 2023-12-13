<?php

namespace App\Models\Erp\Production;

use App\Models\Erp\Order;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cutting extends Model
{
    use HasFactory;

    use BelongsToTenant;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public static function nextNo()
    {
        return static::max('vno') + 1;
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function jobcard(): BelongsTo
    {
        return $this->belongsTo(Jobcard::class);
    }
}
