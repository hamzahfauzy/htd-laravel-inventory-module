<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    use HasCreator;

    protected $table = 'inv_items';
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class.'inv_item_categories', 'item_id','category_id');
    }

    public function logs()
    {
        return $this->hasMany(ItemLog::class, 'item_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}