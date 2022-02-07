<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\TopicUser;
use App\Services\TopicService\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordController extends Controller
{

    protected $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function __invoke()
    {
        $topics = $this->topicService->getTopicListWithOption([
            ['key' => Topic::COUNTER, 'order' => 'desc'],
            ['key' => Topic::PUBLISHED_AT, 'order' => 'asc'],
        ]);
        $topicCollection = $topics->take(15);
        $userTopics = $this->topicService->getUserLikesTopics(Auth::id());
        $userTopicsList = $userTopics->pluck(TopicUser::TOPIC_ID)->toArray();

        return view('dashboard', compact(['topicCollection', 'userTopicsList']));
    }
}
