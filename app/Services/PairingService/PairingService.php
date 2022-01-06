<?php

namespace App\Services\PairingService;

use App\Models\Pair;
use App\Services\PairingService\PairingServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\PairRepository;
use Illuminate\Support\Collection;

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
     * ペア候補のリストを取得する
     *
     * @param $user_id
     * @return mixed
     */
    public function getCandidates($user_id)
    {
        $candidates = new Collection();

        // 既にマッチしているユーザを取得する
        $matched = $this->pairRepository->getByUserId($user_id);
        if($matched->isNotEmpty()){
            // 除外するIDのリスト
            $matchedIdList = $matched->pluck(Pair::USER_ID_PAIRING);
            // 配列化
            $matchedIdList = $matchedIdList->toArray();
            // 本人のIDを除外するリストに追加する
            $matchedIdList[] = $user_id;
            // 除外した候補を取得する
            $candidates = $this->userRepository->getExcludeSpecifiedUser(array_unique($matchedIdList));
        }

        return
            $candidates;
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
