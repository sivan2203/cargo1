<?php


namespace app\models\admin;


use app\models\AppModel;

class Menu extends AppModel
{
    public $attributes = [
        'title' => '',
        'slug' => '',
        'sort' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
            ['slug'],
        ],
        'integer' => [
            ['sort'],
        ],
    ];

}