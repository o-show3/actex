<?php

namespace App\Services\MessageService;

use App\Facades\Message as MessageFacade;
use App\Models\File;
use App\Models\Message;
use App\Models\MessageUser;
use App\Repositories\MessageRepository;
use App\Repositories\MessageUserRepository;
use App\Repositories\FileRepository;
use App\Repositories\PairRepository;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class MessageService extends Repository implements MessageServiceInterface
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
            $message = $this->messageRepository->create([
                Message::MESSAGE => MessageFacade::encryptMessage($parameters['message']),
                Message::TYPE => Message::TYPE_TEXT,
            ]);

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
                'message' => MessageFacade::encryptMessage('no-message.') // todo:メーセージ付きのファイル送付機能
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

    /**
     * 相手の未読メッセージを既読にします
     *
     * @param int $userId
     * @param int $pairing_user_id
     * @return mixed
     */
    public function setReadIcon(int $userId, int $pairing_user_id)
    {
        $newMessageIdList = $this->messageUserRepository->getNewMessages($userId, $pairing_user_id);
        $setList = $newMessageIdList->where(MessageUser::USER_ID , '=', $pairing_user_id)
            ->pluck('id')
            ->toArray();

        return
            $this->messageRepository->addReadIcon($setList, 1);
    }

    /**
     * 対話相手の既読メッセージを取得します
     *
     * @param int $userId
     * @param int $pairing_user_id
     * @return array
     */
    public function getKidoku(int $userId, int $pairing_user_id)
    {
        $newMessageIdList = $this->messageUserRepository->getNewMessages($userId, $pairing_user_id);
        $kidokuList = $newMessageIdList->where(MessageUser::USER_ID , '=', $userId)
            ->pluck('id')
            ->toArray();

        return
            $kidokuList;
    }

}
