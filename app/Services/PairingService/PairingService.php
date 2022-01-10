<?php

namespace App\Services\PairingService;

use App\Models\Pair;
use App\Services\PairingService\PairingServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\PairRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class PairingService implements PairingServiceInterface
{
    protected $pairRepository;
    protected $userRepository;
    protected $categoryRepository;

    /**
     * PairingService constructor.
     * @param PairRepository $pairRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(PairRepository $pairRepository, UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $this->pairRepository = $pairRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
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
            // 管理者を候補から取り除く
            $candidates = $candidates->filter(function($value, $key){
                return !in_array($value->id, [1]); // 管理者に含まれていない候補のみ返す
            })->all();

        }

        return
            $candidates;
    }

    public function getAllCategory()
    {
        $categories = new Collection();

        // カテゴリをすベて取得します
        $categories = $this->categoryRepository->getAllCategory();

        return $categories;

    }

    /**
     * ペアリングを行う
     *
     * @param $user_id
     * @param $user_id_pairing
     * @param null $status
     * @return mixed
     */
    public function pairing($user_id, $user_id_pairing, $status=null)
    {
        return
            $this->pairRepository->addPairing($user_id, $user_id_pairing, $status);
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
