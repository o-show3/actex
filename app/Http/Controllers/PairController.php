<?php

namespace App\Http\Controllers;

use App\Models\Pair;
use App\Models\User;
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
        $userId = Auth::id();

        // ペアリング
        $pairs = $this->pairService->getPair($userId);
        $pairUserIds = $pairs->pluck(User::ID)->toArray();

        // Like
        $likesBase = $this->pairService->getLikes($userId);
        $likes = $likesBase->filter(function ($value, $key) use ($pairUserIds){
            // マッチングしていないLIKEユーザを取得する
            return !in_array($value->user_id_pairing, $pairUserIds);
        })->all();

        // 候補
        $candidates = $this->pairService->getCandidates($userId);

        return view('users.pair.index', compact(['likes', 'pairs','candidates']));
    }
}
