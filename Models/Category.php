<?php

namespace App\Modules\Inventory\Models;

use App\Modules\Base\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasCreator;

    protected $table = 'inv_categories';
    protected $guarded = ['id'];
}