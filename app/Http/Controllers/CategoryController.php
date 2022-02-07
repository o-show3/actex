<?php

namespace App\Http\Controllers;

use App\Models\CategoryUser;
use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;

class CategoryController extends Controller
{
    protected $pairService;

    /*
     * コンストラクタ
     */
    public function __construct(PairingService $pairService)
    {
        $this->pairService = $pairService;
    }

    /**
     * アクション
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        $categories = $this->pairService->getAllCategory();
        $userCategories = $this->pairService->getUserCategory();
        $userCategoriesId = $userCategories->pluck(CategoryUser::CATEGORY_ID);
        $newCategories = $categories->reject(function ($value, $key) use ($userCategoriesId){
            return in_array($value->id,$userCategoriesId->toArray());
        });

        return view('category.index', compact(['categories', 'userCategories','newCategories']));
    }
}
