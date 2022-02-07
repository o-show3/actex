<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TABLE   = 'topics';
    public const ID  = 'id';
    public const UUID = 'uuid';
    public const SOURCE = 'source';
    public const AUTHOR = 'author';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const URL = 'url';
    public const URL_TO_IMAGE = 'url_to_image';
    public const PUBLISHED_AT = 'published_at';
    public const CONTENT = 'content';
    public const IS_PUBLISH = 'is_publish';
    public const COUNTER = 'counter';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::UUID,
        self::SOURCE,
        self::AUTHOR,
        self::TITLE,
        self::DESCRIPTION,
        self::URL,
        self::URL_TO_IMAGE,
        self::PUBLISHED_AT,
        self::CONTENT,
    ];

}
