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
     * @param string $message
     * @param int|null $fileId
     * @return mixed
     * @throws \Exception
     */
    public function createFile(string $message, int $fileId = null)
    {
        $entity = parent::create([
            Message::MESSAGE => $message,
            Message::TYPE    => Message::TYPE_IMAGE,
            Message::FILE_ID => $fileId,
        ]);

        return $entity;
    }
}
