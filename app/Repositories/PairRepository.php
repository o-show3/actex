<?php

namespace App\Repositories;

use App\Models\Pair;
use App\Repositories\traits\GetByUserIdGettable;

class PairRepository
{
    use GetByUserIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Pair::class;
    }
}
