<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

    public function create(string $name, string $description)
    {
        $category = new ($this->model);
        $category::create([
            Category::UUID => Str::uuid(),
            Category::NAME => $name,
            Category::DESCRIPTION => $description,
        ]);
        return $category;
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
