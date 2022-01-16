<?php

namespace App\Services\MessageService;

use App\Models\MessageUser;
use App\Repositories\MessageRepository;
use App\Repositories\MessageUserRepository;
use App\Repositories\PairRepository;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class MessageService implements MessageServiceInterface
{
    protected $pairRepository;
    protected $messageRepository;
    protected $messageUserRepository;

    /**
     * MessageService constructor.
     * @param MessageRepository $messageRepository
     * @param PairRepository $pairRepository
     */
    public function __construct(PairRepository $pairRepository,MessageRepository $messageRepository, MessageUserRepository $messageUserRepository)
    {
        $this->pairRepository    = $pairRepository;
        $this->messageRepository = $messageRepository;
        $this->messageUserRepository = $messageUserRepository;
    }

    /**
     * メッセージを行えるリストを取得する
     * @param int $userId
     * @return PairRepository
     */
    public function getMessageList(int $userId)
    {
        return
            $this->pairRepository->getByUserId($userId);
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
        return
            $this->messageUserRepository->getMessageRoom($userId, $pairingUserId);
    }

    /**
     * メッセージを送信する
     *
     * @param int $userId
     * @param int $pairingUserId
     * @param array $parameters
     * @return mixed|null
     */
    public function sendMessage(int $userId, int $pairingUserId, array $parameters)
    {
        $messageUser = DB::transaction(function () use($userId, $pairingUserId, $parameters) {
            // メッセージを先に登録する
            $message = $this->messageRepository->create($parameters);

            // メッセージと利用者の紐付けを行う
            $messageUser = $this->messageUserRepository->create([
                MessageUser::USER_ID    => $userId,
                MessageUser::TO_USER_ID => $pairingUserId,
                MessageUser::MESSAGE_ID => $message->id,
            ]);

            return $messageUser;
        });

        if($messageUser)
            return $messageUser;

        return null;
    }

}
