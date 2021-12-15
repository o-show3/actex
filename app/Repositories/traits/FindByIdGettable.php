<?php

namespace App\Repositories\traits;

/**
 * Trait FindByIdGettable
 * @package App\Repositories\traits
 */
trait FindByIdGettable
{
    protected $model = null;

    /**
     * IDからデータを取得する
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        if($this->model == null)
            return null;

        return
            $this->model::find($id);
    }
}
