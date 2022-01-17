<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\MessageUser;
use App\Repositories\traits\GetByIdGettable;
use Illuminate\Support\Str;

class MessageUserRepository
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
            $roomMessages->sortByDesc('message.created_at')->all();
    }

    /**
     * メッセージをユーザに紐づける
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters)
    {
        $messageUser = new ($this->model);
        $messageUser->user_id    = $parameters[MessageUser::USER_ID];
        $messageUser->to_user_id = $parameters[MessageUser::TO_USER_ID];
        $messageUser->message_id = $parameters[MessageUser::MESSAGE_ID];

        $messageUser->save();

        return $messageUser;
    }
}
