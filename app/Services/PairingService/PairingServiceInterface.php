<?php


namespace App\Services\PairingService;


interface PairingServiceInterface
{
    /**
     * ペアリングを行う
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function pairing($user_id, $user_id_pairing);

    /**
     * ペアリングを解除する
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function unpairing($user_id, $user_id_pairing);

    /**
     * ペアリングを無効にする
     *
     * @param $user_id
     * @param $user_id_pairing
     * @return mixed
     */
    public function invalidPairing($user_id, $user_id_pairing);
}
