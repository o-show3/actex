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

    /**
     * 全てのカテゴリを取得します
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategory()
    {
        return Category::all();
    }


    /**
     * カテゴリーをIDから取得します
     *
     * @param $categoryIdList
     * @return mixed
     */
    public function getCategoriesById($categoryIdList)
    {
        return
            Category::whereIn(Category::ID, $categoryIdList)->get();
    }
}
