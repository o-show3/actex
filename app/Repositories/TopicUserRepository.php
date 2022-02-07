<?php

namespace App\Repositories;

use App\Models\TopicUser;
use App\Repositories\traits\GetByUuidGettable;

class TopicUserRepository
{
    use GetByUuidGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = TopicUser::class;
    }

    public function create(string $userId, string $topicId, int $status)
    {
        $topicUser = new ($this->model);
        $topicUser::create([
            TopicUser::USER_ID => $userId,
            TopicUser::TOPIC_ID => $topicId,
            TopicUser::STATUS => $status,
        ]);
        return $topicUser;
    }

    /**
     * ユーザが気になる済みのトピックを取得します
     *
     * @param string $userId
     * @return mixed
     */
    public function getUserLikesTopics(string $userId)
    {
        return $this->model::where([TopicUser::USER_ID => $userId])
            ->get();
    }
}
