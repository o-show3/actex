<?php

namespace App\Repositories;

use App\Models\CategoryUser;

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

    public function add(int $userId, string $categoryId)
    {
        $categoryUser = new ($this->model);
        $categoryUser->create([
            CategoryUser::USER_ID     => $userId,
            CategoryUser::CATEGORY_ID => $categoryId,
        ]);

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
}