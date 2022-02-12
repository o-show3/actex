<?php

namespace App\Repositories;

use App\Models\CategoryUser;
use Illuminate\Support\Facades\DB;

class CategoryUserRepository extends Repository
{

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = CategoryUser::class;
    }

    /**
     * ユーザが登録ずみのカテゴリを取得します
     *
     * @param int $userId
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserCategory(int $userId)
    {
        return CategoryUser::where(CategoryUser::USER_ID, $userId)
            ->with(['category'])
            ->get();
    }

    /**
     * 登録者数の多いカテゴリを数ごとに集計して返します
     *
     * @return mixed
     */
    public function getTrendCategory()
    {
        return CategoryUser::select(DB::raw('category_id, COUNT(category_id) AS category_id_count'))
            ->groupBy('category_id')
            ->orderBy('category_id_count', 'desc')
            ->get();
    }

}
