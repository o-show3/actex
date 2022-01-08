<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;

class CategoryPostController extends Controller
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
        return view('category.index', compact(['categories']));
    }
}
