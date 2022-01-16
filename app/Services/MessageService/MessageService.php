<?php

namespace App\Services\MessageService;

use App\Repositories\MessageRepository;
use App\Repositories\MessageUserRepository;
use App\Repositories\PairRepository;

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

}
