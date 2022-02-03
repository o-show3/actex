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
}
