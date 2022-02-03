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
}
