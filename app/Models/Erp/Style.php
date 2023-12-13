<?php

namespace App\Models\Erp;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Style extends Model
{
    use HasFactory;

    use BelongsToTenant;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
