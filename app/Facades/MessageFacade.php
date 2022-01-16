<?php

namespace App\Facades;

use App\Repositories\MessageUserRepository;

class MessageFacade
{
    /**
     *
     * @param int $userId
     * @param int $pairingUserId
     * @return mixed
     */
    static public function getLastMessage(int $userId,int $pairingUserId)
    {
        $messageUserRepository = new MessageUserRepository();

        return $messageUserRepository->getLastMessage($userId, $pairingUserId);
    }
}
