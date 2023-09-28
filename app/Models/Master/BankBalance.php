<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankBalance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function search(string $searches): Builder
    {
        return empty($searches) ? static::query()
           : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function clientBank(): BelongsTo
    {
        return $this->belongsTo(ClientBank::class);
    }
}
