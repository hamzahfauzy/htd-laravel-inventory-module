<?php

namespace App\Modules\Inventory\Models;

use App\Traits\HasDotNotationFilter;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    //

    use HasDotNotationFilter;

    protected $table = 'inv_item_logs';
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
