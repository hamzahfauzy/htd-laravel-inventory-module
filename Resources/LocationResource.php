<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Location;

class LocationResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Location';
    protected static ?string $navigationIcon = 'bx bx-current-location';
    protected static ?string $slug = 'inventory/locations';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = Location::class;

    public static function table()
    {
        return [
            'code' => [
                'label' => 'Code',
                '_searchable' => true
            ],
            'name' => [
                'label' => 'Name',
                '_searchable' => true
            ],
            'description' => [
                'label' => 'Description',
                '_searchable' => true
            ],
            '_action'
        ];
    }

    public static function form()
    {
        return [
            'Basic Information' => [
                'code' => [
                    'label' => 'Code',
                    'type' => 'text',
                    'placeholder' => 'Enter your code'
                ],
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'placeholder' => 'Enter your name',
                    'required' => true,
                ],
                'description' => [
                    'label' => 'Description',
                    'type' => 'text',
                    'placeholder' => 'Enter your description'
                ],

            ]
        ];
    }

    public static function detail()
    {
        return [
            'Basic Information' => [
                'code' => 'Code',
                'name' => 'Name',
                'description' => 'Description',
            ],
        ];
    }
}
