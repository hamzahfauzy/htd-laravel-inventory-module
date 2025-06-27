<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Item;
use App\Modules\Inventory\Models\ItemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Stock';
    protected static ?string $navigationIcon = 'bx bxs-layer';
    protected static ?string $slug = 'inventory/stocks';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = ItemLog::class;

    public static function getModel()
    {
        return static::$model::select('inv_item_logs.*', 
                                    'inv_items.name as item_name', 
                                    'inv_items.name as item_unit', 
                                    DB::raw('CASE WHEN inv_item_logs.record_type = "IN" THEN inv_item_logs.amount ELSE inv_item_logs.amount*-1 END stock_amount'))
                    ->join('inv_items','inv_items.id','=','inv_item_logs.item_id');
    }

    public static function table()
    {
        return [
            'item.completeName' => [
                'label' => 'Item',
                '_searchable' => [
                    'item.name',
                    'item.code',
                    'item.sku'
                ],
                '_order' => 'item_name'
            ],
            'item.unit' => [
                'label' => 'Unit',
                '_searchable' => true,
                '_order' => 'item_unit'
            ],
            'stock_amount' => [
                'label' => 'Amount',
                '_searchable' => 'amount',
                '_order' => 'stock_amount'
            ],
            'description' => [
                'label' => 'Description',
                '_searchable' => [
                    'inv_item_logs.description',
                ]
            ],
            'creator.name' => [
                'label' => 'Created By',
                '_searchable' => true
            ],
            'created_at' => [
                'label' => 'Date',
            ],
            '_action'
        ];
    }

    public static function form()
    {
        $items = Item::orderBy('name','asc')->get();
        $selectedItems = [];
        foreach ($items as $item) {
            $selectedItems[$item->id] = $item->completeName;
        }

        return [
            'Basic Information' => [
                'item_id' => [
                    'label' => 'Item',
                    'type' => 'select2',
                    'options' => $selectedItems,
                    'placeholder' => 'Choose Item',
                    'required' => true,
                ],
                // 'unit' => [
                //     'label' => 'Unit',
                //     'type' => 'text',
                //     'placeholder' => 'Enter your unit'
                // ],
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
                'item.unit' => 'Unit',
                'amount' => 'Amount',
                'record_type' => 'Record Type',
                'description' => 'Description',
                'creator.name' => 'Created By',
                'created_at' => 'Date',
            ],
        ];
    }
}
