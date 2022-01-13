<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryUser extends Model
{
    use HasFactory;

    protected $fillable = [self::USER_ID, self::CATEGORY_ID];

    // カラム定数の定義
    public const TABLE   = 'category_users';
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const CATEGORY_ID = 'category_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    /**
     * ユーザIDとカテゴリIDを満たすデータの個数を数える
     *
     * @param string $userId
     * @param string $category_id
     * @return mixed
     */
    public function countOfUsersCategory(string $userId, string $category_id)
    {
        return CategoryUser::where([
            self::USER_ID => $userId,
            self::CATEGORY_ID => $category_id
        ])->count();
    }

    /**
     * リレーション：USER
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(){
        return $this->hasMany(Category::class);
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

}
