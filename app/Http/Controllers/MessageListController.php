<?php

namespace App\Http\Controllers;

use App\Services\MessageService\MessageService;
use Illuminate\Support\Facades\Auth;

class MessageListController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * アクション
     *
     * @return void
     */
    public function __invoke()
    {
        $messageList = $this->messageService->getMessageList(Auth::id());

        return
            view('message.index', compact('messageList'));
    }
}
