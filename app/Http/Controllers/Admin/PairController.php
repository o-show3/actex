<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;
use App\Http\Controllers\Controller;

class PairController extends Controller
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
        $pairs = $this->pairService->getPair(1);

        return view('admin.users.pair.index', compact('pairs'));
    }
}
