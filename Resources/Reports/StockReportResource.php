<?php

namespace App\Modules\Inventory\Resources\Reports;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Item;
use Illuminate\Support\Facades\DB;

class StockReportResource extends Resource {

    protected static ?string $navigationGroup = 'Reports';
    protected static ?string $navigationLabel = 'Stock';
    protected static ?string $navigationIcon = 'bx bxs-layer';
    protected static ?string $slug = 'reports/stocks';
    protected static ?string $routeGroup = 'reports';
    protected static $deleteRoute = false;
    public static $dataTableClass = 'stock-datatable';

    protected static $model = Item::class;

    public static function mount()
    {
        static::addScripts([
            asset('modules/inventory/js/stock-report-resource.js')
        ]);
    }

    public static function getModel()
    {
        $date = request('filter.date', date('Y-m-d'));
        $model = static::$model::select(
                            'inv_items.*', 
                            DB::raw("COALESCE(SUM(CASE 
                                        WHEN inv_item_logs.created_at < '$date' AND inv_item_logs.record_type = 'IN' THEN inv_item_logs.amount
                                        WHEN inv_item_logs.created_at < '$date' AND inv_item_logs.record_type = 'OUT' THEN -inv_item_logs.amount
                                        ELSE 0 END), 0) AS initial_stock"),
                            DB::raw("COALESCE(SUM(CASE 
                                        WHEN DATE_FORMAT(inv_item_logs.created_at, '%Y-%m-%d') = '$date' AND inv_item_logs.record_type = 'IN' THEN inv_item_logs.amount 
                                        ELSE 0 END), 0) AS in_stock"),
                            DB::raw("COALESCE(SUM(CASE 
                                        WHEN DATE_FORMAT(inv_item_logs.created_at, '%Y-%m-%d') = '$date' AND inv_item_logs.record_type = 'OUT' THEN inv_item_logs.amount 
                                        ELSE 0 END), 0) AS out_stock"),
                            DB::raw("COALESCE(SUM(CASE 
                                        WHEN inv_item_logs.created_at < '$date' AND inv_item_logs.record_type = 'IN' THEN inv_item_logs.amount
                                        WHEN inv_item_logs.created_at < '$date' AND inv_item_logs.record_type = 'OUT' THEN -inv_item_logs.amount
                                        ELSE 0 END), 0) + COALESCE(SUM(CASE 
                                        WHEN DATE_FORMAT(inv_item_logs.created_at, '%Y-%m-%d') = '$date' AND inv_item_logs.record_type = 'IN' THEN inv_item_logs.amount 
                                        ELSE 0 END), 0) - COALESCE(SUM(CASE 
                                        WHEN DATE_FORMAT(inv_item_logs.created_at, '%Y-%m-%d') = '$date' AND inv_item_logs.record_type = 'OUT' THEN inv_item_logs.amount 
                                        ELSE 0 END), 0) AS final_stock"),
                        )
                        ->join('inv_item_logs','inv_items.id','=','inv_item_logs.item_id')
                        ->groupBy('inv_items.id');

        if(isset($_GET['date']))
        {
            $model = $model->where('inv_item_logs.created_at', '<=', $_GET['date'].' 23:59:59');
        }

        return $model;
    }

    public static function getPages()
    {
        $resource = static::class;
        return [
            'index' => new \App\Libraries\Abstract\Pages\ListPage($resource),
        ];
    }

    public static function table()
    {
        return [
            'completeName' => [
                'label' => 'Name',
                '_searchable' => [
                    'name',
                ],
                '_order' => 'name'
            ],
            'unit' => [
                'label' => 'Unit',
                '_searchable' => false,
            ],
            'initial_stock' => [
                'label' => 'Inital Stock',
                '_searchable' => false,
                '_order' => false
            ],
            'in_stock' => [
                'label' => 'In Stock',
                '_searchable' => false,
                '_order' => false
            ],
            'out_stock' => [
                'label' => 'Out Stock',
                '_searchable' => false,
                '_order' => false
            ],
            'final_stock' => [
                'label' => 'Final Stock',
                '_searchable' => false,
                '_order' => false
            ],
        ];
    }

    public static function listHeader()
    {
        return [
            'title' => 'Stock Report',
            'button' => [
                '<button class="btn btn-primary btn-sm filter-btn" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                <!-- Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="filterModalLabel">Filter</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="'.date('Y-m-d').'">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-filter">Submit</button>
                        </div>
                    </div>
                </div>
                </div>'
            ]
        ];
    }
}