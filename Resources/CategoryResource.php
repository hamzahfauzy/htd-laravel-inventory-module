<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Category;

class CategoryResource extends Resource {

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Category';
    protected static ?string $navigationIcon = 'bx bx-category';
    protected static ?string $slug = 'inv-categories';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = Category::class;

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