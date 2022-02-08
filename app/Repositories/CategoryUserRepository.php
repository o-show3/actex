<?php

namespace App\Repositories;

use App\Models\CategoryUser;
use Illuminate\Support\Facades\DB;

class CategoryUserRepository
{

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = CategoryUser::class;
    }

    public function create(array $parameters)
    {
        $categoryUser = new ($this->model);
        $categoryUser->create([
            CategoryUser::USER_ID     => $parameters[CategoryUser::USER_ID],
            CategoryUser::CATEGORY_ID => $parameters[CategoryUser::CATEGORY_ID],
        ]);

        return $categoryUser;
    }

    public function delete(int $userId, string $categoryId)
    {
        $categoryUser = CategoryUser::where([
            [CategoryUser::USER_ID, "=", $userId],
            [CategoryUser::CATEGORY_ID, "=", $categoryId]
        ])->forceDelete();
        return $categoryUser;
    }

    /**
     * ユーザIDとカテゴリIDから、既にデータが存在しているかどうかを返します
     *
     * @param int $userId
     * @param string $categoryId
     * @return bool
     */
    public function isExist(int $userId, string $categoryId)
    {
        $categoryUser = new ($this->model);
        $count = $categoryUser->countOfUsersCategory($userId, $categoryId);

        if($count > 0)
            return true;

        return false;
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
            ->groupBy(CategoryUser::CATEGORY_ID)
            ->orderBy('category_id_count', 'desc')
            ->get();
    }

}
