<?php

namespace App\Facades;

use App\Repositories\MessageUserRepository;
use Illuminate\Support\Facades\Crypt;

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

    /**
     * メッセージの暗号化
     *
     * @param $message
     * @return string
     */
    static public function encryptMessage($message)
    {
        return Crypt::encryptString($message);
    }

    /**
     * メッセージの復号化
     *
     * @param $encryptedMessage
     * @return string
     */
    static public function decryptMessage($encryptedMessage)
    {
        return Crypt::decryptString($encryptedMessage);
    }
}
