<?php

namespace App\Tasks;

use App\Services\TopicService\TopicService;
use Illuminate\Support\Facades\Log;

class CollectiveTopicTask
{
    public function __invoke()
    {
        Log::info('Start:CollectiveTopicTask');
        $topicService = new TopicService();
        $topicService->createTopicsFromOnlineNews();
        Log::info('Finish:CollectiveTopicTask');
    }
}
