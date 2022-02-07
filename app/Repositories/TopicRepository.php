<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\traits\GetByUuidGettable;

class TopicRepository
{
    use GetByUuidGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Topic::class;
    }

    /**
     * トピックの一覧を公開日降順で取得します
     *
     * @return mixed
     */
    public function getTopicList()
    {
        return
            Topic::orderByDesc(Topic::PUBLISHED_AT)->get();
    }

    /**
     * カウンターに値を加算して更新します
     *
     * @param int $topic_id
     * @param int $increment
     * @return mixed
     */
    public function addCounter(int $topic_id, int $increment)
    {
        return
            Topic::where(Topic::ID,$topic_id)
                ->increment(Topic::COUNTER, $increment);
    }
}
