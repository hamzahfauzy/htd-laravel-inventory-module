<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Location;

class ItemResource extends Resource {

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Items';
    protected static ?string $navigationIcon = 'bx bx-box';
    protected static ?string $slug = 'inv-items';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = Location::class;

    public static function table()
    {
        return [
            // 'creator.name' => [
            //     'label' => 'User'
            // ],
            // 'action' => [
            //     'label' => 'Action',
            //     '_searchable' => true
            // ],
            // 'description' => [
            //     'label' => 'Description',
            //     '_searchable' => true
            // ],
            // // 'data' => [
            // //     'label' => 'Data',
            // // ],
            // 'created_at' => [
            //     'label' => 'Created At'
            // ]
        ];
    }

    public static function form()
    {
        return [];
    }

    public static function detail()
    {
        return [];
    }
}