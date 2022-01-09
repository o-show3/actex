<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService\CategoryService;

class CategoryPostController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        return view('category.index', compact(['categories']));
    }
}
