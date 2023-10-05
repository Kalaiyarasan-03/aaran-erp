<?php

namespace App\Models\Erp\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricLot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
           : static::where('vname', 'like', '%' . $searches . '%');
    }


}
