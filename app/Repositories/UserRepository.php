<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\traits\GetByIdGettable;
use Illuminate\Support\Collection;

class UserRepository
{
    use GetByIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = User::class;
    }

    /**
     * 指定したIDを除くユーザを取得する
     * @param array $excludesIdList
     * @return Collection
     */
    public function getExcludeSpecifiedUser(array $excludesIdList)
    {
        if($this->model == null)
            return new Collection();

        return
            $this->model::whereNotIn($this->model::ID, $excludesIdList)
                ->get();
    }
}
