<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PairingService\PairingService;

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
     * インデックスページ
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.users.pair.index');
    }
}
