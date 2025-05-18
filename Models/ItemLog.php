<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasActivity;
use App\Modules\Base\Traits\HasCreator;
use App\Traits\HasDotNotationFilter;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    //

    use HasDotNotationFilter, HasCreator, HasActivity;

    protected $table = 'inv_item_logs';
    protected $guarded = ['id'];
    protected $appends = ['amountLabel'];

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

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function getAmountLabelAttribute()
    {
        return ($this->record_type == 'OUT' ? '-' : '') . $this->amount;
    }
}
