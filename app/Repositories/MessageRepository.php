<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\traits\GetByIdGettable;

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
}
