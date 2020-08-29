<?php


namespace app\models\admin;

use app\models\AppModel;

class Page extends AppModel
{
    public $attributes = [
        'title' => '',
        'keyw' => '',
        'description' => '',
        'alias' => '',
        'text' => '',
        'sort'=> '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ],
        'integer' => [
            ['sort'],
        ],
    ];

}