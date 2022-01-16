<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [self::USER_ID, self::TO_USER_ID, self::MESSAGE_ID];

    // カラム定数の定義
    public const TABLE   = 'message_users';
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TO_USER_ID = 'to_user_id';
    public const MESSAGE_ID = 'message_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function message()
    {
        return $this->hasOne(Message::class, Message::ID, self::MESSAGE_ID);
    }

    /**
     * リレーション：USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, self::USER_ID, User::ID );
    }

    /**
     * リレーション：TO_USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user()
    {
        return $this->belongsTo(User::class, self::TO_USER_ID, User::ID );
    }

}
