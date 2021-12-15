<?php

namespace App\Services\PairingService;

use App\Services\PairingService\PairingServiceInterface;
use App\Models\User;
use App\Models\Pair;

class PairingService implements PairingServiceInterface
{

    /**
     * ペアリングを行う
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function pairing($user_id, $user_id_pairing)
    {
        return __FUNCTION__;
    }

    /**
     * ペアリングを解除する
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function unpairing($user_id, $user_id_pairing)
    {
        return __FUNCTION__;
    }

    /**
     * ペアリングを無効にする
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function invalidPairing($user_id, $user_id_pairing)
    {
        return __FUNCTION__;
    }
}
