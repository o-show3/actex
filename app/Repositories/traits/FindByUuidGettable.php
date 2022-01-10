<?php

namespace App\Repositories\traits;

use Illuminate\Support\Collection;

/**
 * Trait FindByUserIdGettable
 * @package App\Repositories\traits
 */
trait FindByUuidGettable
{
    protected $model = null;

    /**
     * UUIDからデータを取得する
     *
     * @param string $uuid
     * @return mixed
     */
    public function getByUuid(string $uuid)
    {
        if($this->model == null)
            return new Collection();

        return
            $this->model::where($this->model::UUID, $uuid)
                 ->first();
    }
}
