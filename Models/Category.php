<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasActivity;
use App\Modules\Base\Traits\HasCreator;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasCreator, HasActivity;

    protected $table = 'inv_categories';
    protected $guarded = ['id'];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}