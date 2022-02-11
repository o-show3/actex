<?php

namespace App\Repositories;

use App\Models\TopicUser;
use App\Repositories\traits\GetByUuidGettable;

class TopicUserRepository extends Repository
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
     * @throws \Exception
     */
    public function getUserLikesTopics(string $userId)
    {
        return $this->where([
            [parent::WHERE_KEY => TopicUser::USER_ID, parent::WHERE_SEPARATOR => '=', parent::WHERE_VALUE => $userId]
        ]);
    }
}
