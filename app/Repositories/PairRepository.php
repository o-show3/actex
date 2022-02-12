<?php

namespace App\Repositories;

use App\Models\Pair;
use App\Repositories\traits\GetByUserIdGettable;

class PairRepository extends Repository
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

    /**
     * ペアリングを追加する
     *
     * @param $user_id
     * @param $user_id_pairing
     * @param $status
     * @return mixed
     */
    public function addPairing($user_id, $user_id_pairing, $status)
    {
        $pair = new ($this->model);
        $pair->updateOrCreate(
            [Pair::USER_ID => $user_id, Pair::USER_ID_PAIRING => $user_id_pairing],
            [Pair::STATUS => $status]
        );
        return $pair;
    }

    /**
     * ペアに追加されているユーザを返す
     *
     * @param $user_id
     * @return mixed
     * @throws \Exception
     */
    public function getPaired($user_id)
    {
        return
            $this->where([
                [parent::WHERE_KEY => Pair::USER_ID_PAIRING , parent::WHERE_SEPARATOR => '=', parent::WHERE_VALUE => $user_id],
            ]);
    }
}
