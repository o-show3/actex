<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\MessageUser;
use App\Repositories\traits\GetByIdGettable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MessageUserRepository extends Repository
{
    use GetByIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = MessageUser::class;
    }

    /**
     *
     * @param int $userId
     * @param int $pairingUserId
     * @return mixed
     */
    public function getLastMessage(int $userId,int $pairingUserId)
    {
        $messageUser = new ($this->model);
        // メッセージの一覧を返します
        $roomMessages = $messageUser::where(function ($query) use ($userId,$pairingUserId){
            $query->where(MessageUser::USER_ID, "=", $userId)
                  ->Where(MessageUser::TO_USER_ID, "=", $pairingUserId);
        })->orWhere(function ($query) use ($userId,$pairingUserId){
            $query->where(MessageUser::USER_ID, "=", $pairingUserId)
                  ->Where(MessageUser::TO_USER_ID, "=", $userId);
        })->with(Str::singular(Message::TABLE))->get();

        // 最新のメッセージを返します
        $latestMessage =  $roomMessages->sortByDesc('message.created_at')
            ->first();

        // やりとりを行なっていない場合
        if ($latestMessage == null)
            return null;

        return
            $latestMessage->message;
    }

    /**
     * 個別チャットのメッセージを取得します
     *
     * @param int $userId
     * @param int $pairingUserId
     * @return mixed
     */
    public function getMessageRoom(int $userId, int $pairingUserId)
    {
        $messageUser = new ($this->model);

        // メッセージの一覧を返します
        $roomMessages = $messageUser::where(function ($query) use ($userId,$pairingUserId){
            $query->where(MessageUser::USER_ID, "=", $userId)
                ->Where(MessageUser::TO_USER_ID, "=", $pairingUserId);
        })->orWhere(function ($query) use ($userId,$pairingUserId){
            $query->where(MessageUser::USER_ID, "=", $pairingUserId)
                ->Where(MessageUser::TO_USER_ID, "=", $userId);
        })->with(Str::singular(Message::TABLE))->get();

        return
            $roomMessages->sortBy('message.created_at')->all();
    }

    /**
     * 未読メッセージを取得します
     *
     * @param int $userId
     * @param int $pairingUserId
     * @return \Illuminate\Support\Collection
     */
    public function getNewMessages(int $userId, int $pairingUserId)
    {
        $messageUser = DB::table(MessageUser::TABLE)
            ->join(Message::TABLE, (MessageUser::TABLE.".".MessageUser::MESSAGE_ID), (Message::TABLE.".".Message::ID))
            ->select((Message::TABLE.".".Message::ID), (Message::TABLE.".".Message::READ_ICON), (MessageUser::TABLE.".".MessageUser::USER_ID))
            ->where(Message::READ_ICON, "=", 0)
            ->whereIn(MessageUser::USER_ID,[$userId, $pairingUserId])
            ->get();

        return
            $messageUser;
    }

}
