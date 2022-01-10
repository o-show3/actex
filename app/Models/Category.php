<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [self::UUID ,self::NAME, self::DESCRIPTION];

    // カラム定数の定義
    public const TABLE   = 'categories';
    public const ID = 'id';
    public const UUID = 'uuid';
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    /**
     * 最大長
     */
    public const MAX_LENGTH = [
        self::NAME        => 30,
        self::DESCRIPTION => 120,
    ];
}
