<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService\CategoryService;
use Illuminate\Support\Facades\Auth;

class CategoryDeleteController extends Controller
{
    protected $categoryService;

    /*
     * コンストラクタ
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * アクション
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // カテゴリを削除する
        $this->categoryService->deleteCategory(Auth::id(), $request->category_key);

        return
            redirect()->route('category.top');
    }
}
