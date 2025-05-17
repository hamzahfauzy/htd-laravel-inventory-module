<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    use HasCreator;

    protected $table = 'inv_locations';
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}