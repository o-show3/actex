<?php

namespace App\Services\CategoryService;

use App\Models\Category;
use App\Services\CategoryService\CategoryServiceInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryUserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryUser;
use Illuminate\Support\Str;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;
    protected $categoryUserRepository;

    /**
     * CategoryService constructor.
     */
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->categoryUserRepository = new CategoryUserRepository;
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
            $this->categoryRepository->create([
                Category::UUID => Str::uuid(),
                Category::NAME => $name,
                Category::DESCRIPTION => $description,
            ]);
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

            // カテゴリをユーザに紐付ける
            return
                $this->categoryUserRepository->create([
                    CategoryUser::USER_ID     => $userId,
                    CategoryUser::CATEGORY_ID => $category->id,
                ]);
        });

        return $categoryUser;
    }

    /**
     * カテゴリをユーザから削除する
     *
     * @param int $userId
     * @param string $categoryUuid
     * @return mixed
     */
    public function deleteCategory(int $userId, string $categoryUuid)
    {
        $categoryUser = DB::transaction(function ()use($userId, $categoryUuid) {
            // カテゴリが存在しているかを確認する
            $category = $this->categoryRepository->getByUuid($categoryUuid);
            if(is_null($category))
                return null;

            // カテゴリの紐付けを削除します
            return
                $this->categoryUserRepository->delete([
                    [CategoryUser::USER_ID, "=", $userId],
                    [CategoryUser::CATEGORY_ID, "=", $category->id]
                ]);
        });

        return $categoryUser;
    }

    /**
     * トレンド（登録者の多い）になっているカテゴリを返します
     *
     * @return mixed
     */
    public function getTrendCategory()
    {
        $trendCategory = $this->categoryUserRepository->getTrendCategory();
        $trendCategoryId = $trendCategory->pluck('category_id');
        $trendCategoryData = $this->categoryRepository->getCategoriesById($trendCategoryId);

        $trendCategoryCollection = new Collection();
        foreach ($trendCategory as $item){
            $trendCategoryCollection->add($trendCategoryData->find($item->category_id));
        }

        return
            $trendCategoryCollection;
    }

}
