<?php

namespace App\Http\Controllers;

use App\Models\Pair;
use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PairActionController extends Controller
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
     * LIKEアクション
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function like(Request $request)
    {
        // ユーザIDの取得
        $userId = decrypt($request->user);
        // ペアリング
        $this->pairService->pairing(Auth::id(), $userId, Pair::STATUS_LIKE);
        // リダイレクト
        return
            redirect()->route('users.pair');
    }

    /**
     * NONEアクション
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function none(Request $request)
    {
        // ユーザIDの取得
        $userId = decrypt($request->user);
        // ペアリング
        $this->pairService->pairing(Auth::id(), $userId, Pair::STATUS_NONE);
        // リダイレクト
        return
            redirect()->route('users.pair');
    }
}
