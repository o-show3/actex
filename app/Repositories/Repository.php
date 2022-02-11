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

    /**
     * 条件を満たすデータを削除します
     *
     * @param array $parameters
     * @param bool $forceDelete
     * @throws \Exception
     */
    public function delete(array $parameters, bool $forceDelete=false)
    {
        if($this->model == null)
            throw new \Exception('データ削除エラー');

        // エンティティを取得する
        $entity = $this->model::where($parameters);

            ($forceDelete)
                ? $entity->forceDelete() // 強制削除
                : $entity->delete();     // 削除

        return
            $entity;
    }

    /**
     * 条件を満たすデータを集計します
     *
     * @param array $parameters
     * @throws \Exception
     */
    public function count(array $parameters)
    {
        if($this->model == null)
            throw new \Exception('データ削除エラー');

        // エンティティを取得する
        return
            $this->model::where($parameters)->count();

    }
}
