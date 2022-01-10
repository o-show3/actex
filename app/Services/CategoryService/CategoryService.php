<?php

namespace App\Services\CategoryService;

use App\Services\CategoryService\CategoryServiceInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryUserRepository;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;
    protected $categoryUserRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryUserRepository $categoryUserRepository
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryUserRepository $categoryUserRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryUserRepository = $categoryUserRepository;
    }

    /**
     * カテゴリを新規作成する
     *
     * @param string $name
     * @param string $description
     * @return mixed
     */
    public function createCategory(string $name, string $description)
    {
        return
            $this->categoryRepository->create($name, $description);
    }

    /**
     * カテゴリを追加する
     *
     * @param int $userId
     * @param string $categoryUuid
     * @return mixed
     */
    public function addCategory(int $userId, string $categoryUuid)
    {
        $categoryUser = DB::transaction(function ()use($userId, $categoryUuid) {
            // カテゴリが存在しているかを確認する
            $category = $this->categoryRepository->getByUuid($categoryUuid);
            if(is_null($category))
                return null;
            // 既に存在しているか
            $isExist = $this->categoryUserRepository->isExist($userId, $category->id);
            if($isExist === true)
                return null;// 存在している場合

            // カテゴリをユーザに紐づける
            return
                $this->categoryUserRepository->add($userId, $category->id);
        });

        return $categoryUser;
    }

}
