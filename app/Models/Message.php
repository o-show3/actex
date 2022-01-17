<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [self::TYPE, self::MESSAGE, self::FILE_ID];

    // カラム定数の定義
    public const TABLE   = 'messages';
    public const ID      = 'id';
    public const TYPE    = 'type';
    public const MESSAGE   = 'message';
    public const FILE_ID = 'file_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    // メッセージタイプ
    public const TYPE_TEXT  = 1;     //メッセージタイプ テキスト
    public const TYPE_IMAGE = 2;     //メッセージタイプ 画像

    public function file()
    {
        return $this->belongsTo(File::class);
    }

}
