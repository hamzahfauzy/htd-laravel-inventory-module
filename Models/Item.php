<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasCreator;
use App\Traits\HasDotNotationFilter;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    use HasCreator, HasDotNotationFilter;

    protected $table = 'inv_items';
    protected $guarded = ['id'];
    protected $appends = ['stock'];

    public function categories()
    {
        return $this->belongsToMany(Category::class . 'inv_item_categories', 'item_id', 'category_id');
    }

    public function logs()
    {
        return $this->hasMany(ItemLog::class, 'item_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function getStockAttribute()
    {
        return $this->logs()->sum('amount');
    }
}
