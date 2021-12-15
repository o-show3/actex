<?php

namespace App\Repositories\traits;

/**
 * Trait FindByUserIdGettable
 * @package App\Repositories\traits
 */
trait FindByUserIdGettable
{
    protected $model = null;

    /**
     * ユーザIDからデータを取得する
     *
     * @param int $user_id
     * @return mixed
     */
    public function getByUserId(int $user_id)
    {
        if($this->model == null)
            return null;

        return
            $this->model::where($this->model::USER_ID, $user_id)
                 ->get();
    }
}
