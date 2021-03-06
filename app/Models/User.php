<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // カラム定数の定義
    public const TABLE   = 'users';
    public const ID      = 'id';
    public const NAME    = 'name';
    public const EMAIL   = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * リレーション：Administrator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function administrator()
    {
        return $this->hasOne(Administrator::class, Administrator::USER_ID, self::ID)
            ->withDefault([
                Administrator::ROLE => Administrator::ROLE_NULL,
            ]);
    }

    /**
     * リレーション：Category(経由：CategoryUser)
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function category()
    {
        return $this->hasManyThrough(
            Category::class,
            CategoryUser::class,
            CategoryUser::USER_ID,
            Category::ID,
            self::ID,
        CategoryUser::CATEGORY_ID
        );
    }

    /**
     * 暗号化したIDの取得
     *
     * @return string
     */
    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }
}
