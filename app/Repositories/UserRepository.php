<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\traits\FindByIdGettable;

class UserRepository
{
    use FindByIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = User::class;
    }
}
