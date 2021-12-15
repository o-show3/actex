<?php

namespace App\Repositories;

use App\Models\Pair;
use App\Repositories\traits\FindByUserIdGettable;

class PairRepository
{
    use FindByUserIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Pair::class;
    }
}
