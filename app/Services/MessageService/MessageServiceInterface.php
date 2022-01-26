<?php

namespace App\Services\MessageService;

interface MessageServiceInterface
{
    /**
     * メッセージを行えるリストを取得する
     * @param int $userId
     * @return PairRepository
     */
    public function getMessageList(int $userId);
}
