<?php

namespace App\Services\MessageService;

use App\Facades\Message;
use App\Models\File;
use App\Models\MessageUser;
use App\Repositories\MessageRepository;
use App\Repositories\MessageUserRepository;
use App\Repositories\FileRepository;
use App\Repositories\PairRepository;
use Illuminate\Support\Facades\DB;

class MessageService implements MessageServiceInterface
{
    protected $pairRepository;
    protected $messageRepository;
    protected $messageUserRepository;
    protected $fileRepository;

    /**
     * MessageService constructor.
     */
    public function __construct()
    {
        $this->pairRepository    = new PairRepository();
        $this->messageRepository = new MessageRepository();
        $this->messageUserRepository = new MessageUserRepository();
        $this->fileRepository = new FileRepository();
    }

    /**
     * メッセージを行えるリストを取得する
     * @param int $userId
     * @return PairRepository
     */
    public function getMessageList(int $userId)
    {
        return
            $this->pairRepository->getByUserId($userId);
    }

    /**
     * 個別チャットのメッセージを取得します
     *
     * @param int $userId
     * @param int $pairingUserId
     * @return mixed
     */
    public function getMessageRoom(int $userId, int $pairingUserId)
    {
        return
            $this->messageUserRepository->getMessageRoom($userId, $pairingUserId);
    }

    /**
     * メッセージを送信する
     *
     * @param int $userId
     * @param int $pairingUserId
     * @param array $parameters
     * @return mixed|null
     */
    public function sendMessage(int $userId, int $pairingUserId, array $parameters)
    {
        $messageUser = DB::transaction(function () use($userId, $pairingUserId, $parameters) {
            // メッセージを先に登録する
            $message = $this->messageRepository->create($parameters);

            // メッセージと利用者の紐付けを行う
            $messageUser = $this->messageUserRepository->create([
                MessageUser::USER_ID    => $userId,
                MessageUser::TO_USER_ID => $pairingUserId,
                MessageUser::MESSAGE_ID => $message->id,
            ]);

            return $messageUser;
        });

        if($messageUser)
            return $messageUser;

        return null;
    }

    /**
     * ファイルを送信する
     *
     * @param int $userId
     * @param int $pairingUserId
     * @param $request
     * @return mixed|null
     */
    public function sendFile(int $userId, int $pairingUserId, $request)
    {
        $messageUser = DB::transaction(function () use($userId, $pairingUserId, $request) {
             // ファイルを保存する
             // 保存先："message/{user_id}/file_name"
             $uploadFilePath = $request->file->store('public/message/'.$userId);
             $uploadFileExtension = $request->file->getClientOriginalExtension();

             // ファイルの情報をデータベースに保存
             $file = $this->fileRepository->create([
                 File::PATH => $uploadFilePath,
                 File::EXTENSION => $uploadFileExtension
             ]);

            // メッセージを先に登録する
            $message = $this->messageRepository->createFile([
                'message' => Message::encryptMessage('no-message.') // todo:メーセージ付きのファイル送付機能
            ], $file->id);

            // メッセージと利用者の紐付けを行う
            $messageUser = $this->messageUserRepository->create([
                MessageUser::USER_ID    => $userId,
                MessageUser::TO_USER_ID => $pairingUserId,
                MessageUser::MESSAGE_ID => $message->id,
            ]);

            return $messageUser;
        });

        if($messageUser)
            return $messageUser;

        return null;
    }

}
