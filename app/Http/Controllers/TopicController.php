<?php

namespace App\Http\Controllers;

use App\Tasks\CollectiveTopicTask;
use App\Services\TopicService\TopicService;

class TopicController extends Controller
{

    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $topicCollection = $this->topicService->getTopicList();

        return view('topics.index', compact('topicCollection'));
    }
}
