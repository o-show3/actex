<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [self::EXTENSION, self::PATH];

    // カラム定数の定義
    public const TABLE = 'files';
    public const ID  = 'id';
    public const PATH = 'path';
    public const EXTENSION = 'extension';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

}
