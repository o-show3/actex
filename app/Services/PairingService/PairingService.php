<?php

namespace App\Services\PairingService;

use App\Services\PairingService\PairingServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\PairRepository;

class PairingService implements PairingServiceInterface
{
    protected $pairRepository;
    protected $userRepository;

    /**
     * PairingService constructor.
     * @param PairRepository $pairRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PairRepository $pairRepository, UserRepository $userRepository)
    {
        $this->pairRepository = $pairRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * ペアのリストを取得する
     *
     * @param $user_id
     * @return mixed
     */
    public function getPair($user_id)
    {
        return
            $this->pairRepository->getByUserId($user_id);
    }

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
