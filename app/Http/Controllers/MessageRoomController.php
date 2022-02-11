<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\MessageService\MessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MessageRoomController extends Controller
{
    protected $messageService;
    protected $userRepository;

    public function __construct(MessageService $messageService, UserRepository $userRepository)
    {
        $this->messageService = $messageService;
        $this->userRepository = $userRepository;
    }

    /**
     * アクション
     *
     * @param $pairing_user_id
     * @return void
     */
    public function __invoke(string $pairing_user_id)
    {
        $user_id = Auth::id();
        $pairing_user_id = Crypt::decrypt($pairing_user_id);
        $pairing_user = $this->userRepository->getById($pairing_user_id);

        // チャットルームのメッセージを取得する
        $messageRoom = $this->messageService->getMessageRoom($user_id, $pairing_user_id);

        // 相手から既読になっている自分のメッセージのIDを取得する
        $kidokuList = $this->messageService->getKidoku($user_id,$pairing_user_id);

        // 相手の新しいメッセージを全て既読にする
        $this->messageService->setKidoku($user_id,$pairing_user_id);

        return
            view('message.room', compact(['messageRoom', 'pairing_user', 'kidokuList']));
    }
}
