<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    use HasFactory;

    // カラム定数の定義
    public const TABLE   = 'pairs';
    public const USER_ID = 'user_id';
    public const USER_ID_PAIRING = 'user_id_pairing';
    public const INVALID = 'invalid';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    /**
     * リレーション：USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーション：Pairing-USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pairingUser()
    {
        return $this->belongsTo(User::class, self::USER_ID_PAIRING,User::ID );
    }
}
