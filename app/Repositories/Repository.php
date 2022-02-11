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

    const WHERE_KEY         = 'where_key';
    const WHERE_SEPARATOR   = 'where_separator';
    const WHERE_VALUE       = 'where_value';

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

    /**
     * 条件を満たすデータを取得します
     *
     * @param array $whereParameters
     * @throws \Exception
     */
    public function where(array $whereParameters)
    {
        if($this->model == null)
            throw new \Exception('データ取得エラー');

        $entity = $this->model::query();
        foreach ($whereParameters as $parameter)
        {
            $entity->where($parameter[self::WHERE_KEY], $parameter[self::WHERE_SEPARATOR], $parameter[self::WHERE_VALUE]);
        }

        // エンティティを取得する
        return
            $entity->get();
    }

    /**
     * 条件を満たすデータを取得します
     *
     * @param $key
     * @param array $primaryKeys
     * @throws \Exception
     */
    public function whereInKeys($key, array $primaryKeys)
    {
        if($this->model == null)
            throw new \Exception('データ取得エラー');

        // エンティティを取得する
        return
            $this->model::whereIn($key, $primaryKeys)->get();
    }

    /**
     * 全てのデータを取得します
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model::all();
    }
}