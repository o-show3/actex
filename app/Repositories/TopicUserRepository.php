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
