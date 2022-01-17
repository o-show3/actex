<?php

namespace App\Repositories;

use App\Models\Message;
use App\Facades\Message as MessageFacade;
use App\Repositories\traits\GetByIdGettable;
use Illuminate\Support\Facades\Crypt;

class MessageRepository
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
     * メッセージを作る
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters)
    {
        $message = new ($this->model);
        $message->message = MessageFacade::encryptMessage($parameters['message']);
        $message->type    = Message::TYPE_TEXT;
        $message->save();

        return $message;
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
}
