<?php


namespace App\Repositories;

class Repository
{
    /**
     * モデル
     *
     * @var null
     */
    protected $model = null;

    /**
     * データを新規作成する
     *
     * @param array $parameters
     * @return mixed
     * @throws \Exception
     */
    public function create(array $parameters)
    {
        if($this->model == null)
            throw new \Exception('データ作成エラー');

        return
            $this->model::create($parameters);
    }

}
