<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Item;
use App\Modules\Inventory\Models\ItemConversion;

class ConversionResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Conversion';
    protected static ?string $navigationIcon = 'bx bx-edit';
    protected static ?string $slug = 'inventory/conversions';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = ItemConversion::class;

    public static function table()
    {
        return [
            'item.completeName' => [
                'label' => 'Item',
                '_searchable' => 'item.name'
            ],
            'unit' => [
                'label' => 'Unit',
                '_searchable' => true
            ],
            'value' => [
                'label' => 'Value',
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
        $items = Item::get();
        $selectedItems = [];
        foreach ($items as $item) {
            $selectedItems[$item->id] = $item->completeName;
        }

        return [
            'Basic Information' => [
                'item_id' => [
                    'label' => 'Item',
                    'type' => 'select',
                    'options' => $selectedItems,
                    'placeholder' => 'Choose Item',
                    'required' => true,
                ],
                'unit' => [
                    'label' => 'Unit',
                    'type' => 'text',
                    'placeholder' => 'Enter unit'
                ],
                'value' => [
                    'label' => 'Value',
                    'type' => 'tel',
                    'placeholder' => 'Enter value'
                ],
            ],
        ];
    }

    public static function detail()
    {
        return [];
    }
}
