<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Fruit extends Model
{
    use Sushi;

    protected $rows = [
        [
            'name' => 'mango',
            'price' => 10,
        ],
        [
            'name' => 'apple',
            'price' => 15,
        ],
        [
            'name' => 'banana',
            'price' => 10,
        ],
        [
            'name' => 'orange',
            'price' => 5,
        ]
    ];
}
