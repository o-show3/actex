<?php

namespace App\Repositories;

use App\Models\Message;
use App\Facades\Message as MessageFacade;
use App\Repositories\traits\GetByIdGettable;
use Illuminate\Support\Facades\Crypt;

class MessageRepository extends Repository
{
    use GetByIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = Message::class;
    }

    /**
     * ファイルメッセージを作る
     *
     * @param array $parameters
     * @param int|null $fileId
     * @return mixed
     */
    public function createFile(array $parameters, int $fileId = null)
    {
        $message = new ($this->model);
        $message->message = $parameters['message'];
        $message->type    = Message::TYPE_IMAGE;
        $message->file_id = $fileId;
        $message->save();

        return $message;
    }

    /**
     * 既読カウンターに値を加算して更新します
     *
     * @param array $messageList
     * @param int $increment
     * @return mixed
     */
    public function addReadIcon(array $messageList, int $increment)
    {
        return
            Message::whereIn(Message::ID, $messageList)
                ->where(Message::READ_ICON, "=", 0)
                ->increment(Message::READ_ICON, $increment);
    }
}
