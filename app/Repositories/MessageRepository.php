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
        $message->file_id = null;
        $message->save();

        return $message;
    }
}
