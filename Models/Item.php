<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasActivity;
use App\Modules\Base\Traits\HasCreator;
use App\Traits\HasDotNotationFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    //
    use HasCreator, HasDotNotationFilter, HasActivity;

    protected $table = 'inv_items';
    protected $guarded = ['id'];
    protected $appends = ['stock','completeName'];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
        return $this->logs()->sum(DB::raw("CASE WHEN record_type = 'IN' THEN amount ELSE -amount END")) . ' ' . $this->unit;
    }

    public function getCompleteNameAttribute()
    {
        return $this->name . ($this->sku || $this->code ? ' ('.($this->sku ? $this->sku .' - ' : '').$this->code.')' : '');
    }

    public function conversions()
    {
        return $this->hasMany(ItemConversion::class, 'item_id', 'id');
    }
}
