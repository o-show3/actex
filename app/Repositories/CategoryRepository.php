<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Category::class;
    }

    /**
     * 全てのカテゴリを取得します
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategory()
    {
        return Category::all();
    }
}
