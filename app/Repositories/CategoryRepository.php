<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\traits\GetByUuidGettable;
use Illuminate\Support\Str;

class CategoryRepository extends Repository
{
    use GetByUuidGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Category::class;
    }

}
