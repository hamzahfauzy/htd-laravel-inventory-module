<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Item;
use App\Modules\Inventory\Models\ItemLog;

class StockResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Stock';
    protected static ?string $navigationIcon = 'bx bxs-layer';
    protected static ?string $slug = 'inventory/stocks';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = ItemLog::class;

    public static function table()
    {
        return [
            'item.completeName' => [
                'label' => 'Item',
                '_searchable' => [
                    'item.name'
                ]
            ],
            'unit' => [
                'label' => 'Unit',
                '_searchable' => true
            ],
            'amount' => [
                'label' => 'Amount',
                '_searchable' => true
            ],
            'record_type' => [
                'label' => 'Type',
                '_searchable' => true
            ],
            'description' => [
                'label' => 'Description',
                '_searchable' => true
            ],
            'creator.name' => [
                'label' => 'Created By',
                '_searchable' => true
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
                    'placeholder' => 'Enter your unit'
                ],
                'amount' => [
                    'label' => 'Amount',
                    'type' => 'text',
                    'placeholder' => 'Enter your amount'
                ],
                'record_type' => [
                    'label' => 'Record Type',
                    'type' => 'select',
                    'options' => ['IN' => 'IN', 'OUT' => 'OUT'],
                    'required' => true
                ],
                'description' => [
                    'label' => 'Description',
                    'type' => 'textarea',
                    'placeholder' => 'Enter your description'
                ],


            ],
        ];
    }

    public static function detail()
    {
        return [
            'Basic Information' => [
                'item.name' => 'Item',
                'unit' => 'Unit',
                'amount' => 'Amount',
                'record_type' => 'Record Type',
                'description' => 'Description',
            ],
        ];
    }
}
