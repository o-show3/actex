<?php

namespace App\Http\Controllers;

use App\Services\MessageService\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MessageRoomPostMessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * アクション
     *
     * @param Request $request
     * @param string $pairing_user_id
     * @return void
     */
    public function __invoke(Request $request, string $pairing_user_id)
    {
        $p_pairing_user_id = Crypt::decrypt($pairing_user_id);

        // メッセージを投稿する
        $this->messageService->sendMessage(Auth::id(), $p_pairing_user_id, $request->all());

        return
            redirect(route('message.room', ['pairing_user_id' => $pairing_user_id]));
    }
}
