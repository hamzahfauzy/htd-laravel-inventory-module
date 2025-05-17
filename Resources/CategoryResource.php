<?php

namespace App\Modules\Inventory\Resources;

use App\Libraries\Abstract\Resource;
use App\Modules\Inventory\Models\Category;

class CategoryResource extends Resource
{

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Category';
    protected static ?string $navigationIcon = 'bx bx-category';
    protected static ?string $slug = 'inventory/categories';
    protected static ?string $routeGroup = 'inventory';

    protected static $model = Category::class;

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

            ]
        ];
    }

    public static function detail()
    {
        return [
            'Basic Information' => [
                'code' => 'Code',
                'name' => 'Name',
            ],
        ];
    }
}
