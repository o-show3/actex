<?php

namespace App\Http\Controllers;

use App\Services\MessageService\MessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MessageRoomController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * アクション
     *
     * @param $pairing_user_id
     * @return void
     */
    public function __invoke(string $pairing_user_id)
    {
        $pairing_user_id = Crypt::decrypt($pairing_user_id);
        $messageRoom = $this->messageService->getMessageRoom(Auth::id(), $pairing_user_id);

        return
            view('message.room', compact('messageRoom'));
    }
}
