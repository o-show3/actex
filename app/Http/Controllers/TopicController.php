<?php

namespace App\Http\Controllers;

use App\Models\TopicUser;
use App\Tasks\CollectiveTopicTask;
use App\Services\TopicService\TopicService;
use Illuminate\Support\Facades\Auth;

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
        $userTopics = $this->topicService->getUserLikesTopics(Auth::id());
        $userTopicsList = $userTopics->pluck(TopicUser::TOPIC_ID)->toArray();

        return view('topics.index', compact(['topicCollection', 'userTopicsList']));
    }
}
