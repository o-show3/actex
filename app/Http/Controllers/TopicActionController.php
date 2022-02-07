<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\TopicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TopicService\TopicService;

class TopicActionController extends Controller
{

    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    /**
     * LIKEアクション
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function like(Request $request)
    {
        // トピックにライクをつけます
        $this->topicService->like(Auth::id(), $request->uuid, TopicUser::STATUS_LIKE);
        // リダイレクト
        return
            redirect()->route('topics.top')->with('flash', "登録が完了しました。");
    }
}
