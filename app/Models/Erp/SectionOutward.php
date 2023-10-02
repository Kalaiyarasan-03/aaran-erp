<?php

namespace App\Models\Erp;

use App\Models\Master\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionOutward extends Model
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

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public static function nextNo()
    {
        return static::max('vno') + 1;
    }
}
