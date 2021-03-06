<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicUser extends Model
{
    use HasFactory;

    protected $fillable = [self::USER_ID, self::TOPIC_ID, self::STATUS];

    // カラム定数の定義
    public const TABLE   = 'topic_users';
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TOPIC_ID = 'topic_id';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    // 定数
    public const STATUS_LIKE  = 1;
    public const STATUS_NONE  = 0;

    /**
     * リレーション：USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, self::USER_ID, User::ID );
    }
}
