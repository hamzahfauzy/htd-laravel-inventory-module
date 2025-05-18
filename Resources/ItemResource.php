<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Item;
use App\Modules\Inventory\Models\Location;

class ItemResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Items';
    protected static ?string $navigationIcon = 'bx bx-box';
    protected static ?string $slug = 'inventory/items';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = Item::class;

    public static function table()
    {
        return [
            'sku' => [
                'label' => 'SKU',
                '_searchable' => true
            ],
            'code' => [
                'label' => 'Code',
                '_searchable' => true
            ],
            'name' => [
                'label' => 'Name',
                '_searchable' => true
            ],
            'stock' => [
                'label' => 'Stock',
                '_searchable' => true
            ],
            'location.name' => [
                'label' => 'Location',
                '_searchable' => true
            ],
            'creator.name' => [
                'label' => 'Created By',
                '_searchable' => true
            ],
            'created_at' => [
                'label' => 'Date'
            ],
            '_action'
        ];
    }

    public static function form()
    {
        $locations = Location::get();
        $selectedLocations = [];
        foreach ($locations as $location) {
            $selectedLocations[$location->id] = $location->name;
        }

        return [
            'Basic Information' => [
                'sku' => [
                    'label' => 'SKU',
                    'type' => 'text',
                    'placeholder' => 'Enter SKU'
                ],
                'code' => [
                    'label' => 'Code',
                    'type' => 'text',
                    'placeholder' => 'Enter code'
                ],
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'placeholder' => 'Enter name',
                    'required' => true,
                ],
                'unit' => [
                    'label' => 'Unit',
                    'type' => 'tel',
                    'placeholder' => 'Enter unit',
                    'required' => true,
                ],
                'description' => [
                    'label' => 'Description',
                    'type' => 'text',
                    'placeholder' => 'Enter description'
                ],
                'location_id' => [
                    'label' => 'Location',
                    'type' => 'select',
                    'options' => $selectedLocations,
                    'required' => true,
                ],

            ],
        ];
    }

    public static function detail()
    {
        return [
            'Basic Information' => [
                'sku' => 'SKU',
                'code' => 'Code',
                'name' => 'Name',
                'unit' => 'Unit',
                'description' => 'Description',
                'location.name' => 'Location',
            ],
        ];
    }
}
