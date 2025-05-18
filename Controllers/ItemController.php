<?php

namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\Item;

class ItemController {

    function index()
    {
        return response()->json([
            'data' => Item::get(),
            'message' => 'data retrieved'
        ]);
    }

    function show($id)
    {
        $item = Item::find($id);
        return response()->json([
            'data' => $item,
            'message' => 'data retrieved'
        ]);
    }

    function getUnit($id)
    {
        $item = Item::find($id);
        $units = [$item->unit];
        foreach($item->conversions as $conversion)
        {
            $units[] = $conversion->unit;
        }

        return response()->json([
            'data' => $units,
            'message' => 'data retrieved'
        ]);
    }
}