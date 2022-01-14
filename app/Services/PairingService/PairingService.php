<?php

namespace App\Services\PairingService;

use App\Models\CategoryUser;
use App\Models\Pair;
use App\Services\PairingService\PairingServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\PairRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryUserRepository;
use Illuminate\Support\Collection;
use App\ValueObjects\PartnerCollection;
use Illuminate\Support\Facades\DB;
use App\ValueObjects\Partner;

class PairingService implements PairingServiceInterface
{
    protected $pairRepository;
    protected $userRepository;
    protected $categoryRepository;
    protected $categoryUserRepository;

    /**
     * PairingService constructor.
     * @param PairRepository $pairRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     * @param CategoryUserRepository $categoryUserRepository
     */
    public function __construct(PairRepository $pairRepository, UserRepository $userRepository, CategoryRepository $categoryRepository, CategoryUserRepository $categoryUserRepository)
    {
        $this->pairRepository = $pairRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryUserRepository = $categoryUserRepository;
    }

    /**
     * LIKEのリストを取得する
     *
     * @param $user_id
     * @return mixed
     */
    public function getLikes($user_id)
    {
        $allPairUsers = $this->pairRepository->getByUserId($user_id);
        return
            $allPairUsers->where(Pair::STATUS, '=', Pair::STATUS_LIKE);
    }

    /**
     * ペアのリストを取得する
     *
     * @param $user_id
     * @return mixed
     */
    public function getPair($user_id)
    {
        // 自分がLikeしたユーザを取得する
        $allPairUsers = $this->getLikes($user_id);
        // 自分がLikeされたユーザを取得する
        $allPairedUsers = $this->pairRepository->getPaired($user_id);

        // 重複したID:相互マッチングしたIDを取得する
        $pairingUserIds = array_intersect(
            $allPairUsers->pluck(Pair::USER_ID_PAIRING)->toArray(),
            $allPairedUsers->pluck(Pair::USER_ID)->toArray()
        );

        return
            $this->userRepository->getUsers($pairingUserIds);
    }

    /**
     * ペア候補のリストを取得する
     *
     * @param $user_id
     * @return mixed
     */
    public function getCandidates($user_id)
    {

        // マッチずみのユーザを取得する
        $matchedUsers = DB::table(Pair::TABLE)
            ->select([Pair::TABLE.".".Pair::USER_ID_PAIRING])
            ->where(Pair::TABLE.".".Pair:: USER_ID, '=', $user_id)
            ->whereIn(Pair::TABLE.".".Pair:: STATUS, [Pair::STATUS_NONE, Pair::STATUS_LIKE])
            ->get();

        // 同じカテゴリを持つユーザを取得する
        $sameCategories = DB::table(CategoryUser::TABLE)
            ->select([CategoryUser::TABLE.".".CategoryUser::USER_ID, CategoryUser::TABLE.".".CategoryUser::CATEGORY_ID])
            // 同じカテゴリを持つユーザを絞る
            ->whereIn(CategoryUser::TABLE.".".CategoryUser::CATEGORY_ID,function ($query) use ($user_id){
                $query->select(CategoryUser::TABLE.".".CategoryUser::CATEGORY_ID)
                    ->from(CategoryUser::TABLE)
                    ->where(CategoryUser::TABLE.".".CategoryUser::USER_ID, $user_id);
            })->where(CategoryUser::TABLE.".".CategoryUser:: USER_ID, '<>', $user_id)
            // 管理者を除く
            ->whereNotIn(CategoryUser::TABLE.".".CategoryUser:: USER_ID, [1])
            // 既にマッチ済みのユーザを除く
            ->whereNotIn(CategoryUser::TABLE.".".CategoryUser:: USER_ID, $matchedUsers->pluck(Pair::USER_ID_PAIRING))
            ->get();

        // 同じカテゴリを持つユーザIDの集計
        $sameCategoryGroupSorted = $sameCategories->countBy(function ($v) {
            // ユーザIDでグループ化する
            return $v->user_id;
        })->sortBy(function ($userId, $count) {
            // マッチ数でソートする
            return $count;
        });
        // ユーザ情報を取得する
        $sameCategoryUsers = $this->userRepository->getUsers($sameCategoryGroupSorted->keys()->all());

        // パートナー候補のリストを作成する
        $candidates = new PartnerCollection();
        $sameCategoryGroupSorted->each(function ($count, $userId) use ($candidates, $sameCategoryUsers) {
            $partner = new Partner();
            $partner->setUserId($userId);
            $partner->setUser($sameCategoryUsers->firstWhere('id',$userId ));
            $partner->setCounter($count);

            $candidates->add($partner);
        });

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
