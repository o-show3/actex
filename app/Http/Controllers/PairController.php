<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;
use Illuminate\Support\Facades\Auth;

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
        $pairs = $this->pairService->getPair(Auth::id());
        $candidates = $this->pairService->getCandidates(Auth::id());

        return view('users.pair.index', compact(['pairs','candidates']));
    }
}
