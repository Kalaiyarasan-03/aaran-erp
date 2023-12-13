<?php

namespace App\Models\Erp\Production;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ironing extends Model
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


}
