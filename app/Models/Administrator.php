<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    // カラム定数の定義
    public const TABLE   = 'administrators';
    public const USER_ID = 'user_id';
    public const ROLE    = 'role';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    // ロール一覧
    public const ROLE_NULL = null;  //全ての管理権限 指定なし
    public const ROLE_NONE = 0;     //全ての管理権限 なし
    public const ROLE_FULL = 1;     //全ての管理権限 あり
}
