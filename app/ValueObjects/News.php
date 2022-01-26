<?php

namespace App\ValueObjects;

use Illuminate\Support\Carbon;

class News
{
    protected $source;
    protected $author;
    protected $title;
    protected $description;
    protected $url;
    protected $urlToImage;
    protected $publishedAt;
    protected $content;

    /**
     * News constructor.
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->source = $item['source'];
        $this->author = $item['author'];
        $this->title  = $item['title'];
        $this->description
                      = $item['description'];
        $this->url    = $item['url'];
        $this->urlToImage
                      = $item['urlToImage'];
        $this->publishedAt
                      = $item['publishedAt'];
        $this->content= $item['content'];
    }

    /**
     * 公開日
     * @return Carbon
     */
    public function publishedAt()
    {
        $datetime = Carbon::createFromTimeString($this->publishedAt);
        $datetime->timezone('Asia/Tokyo');
        return $datetime;
    }

    /**
     * タイトル
     * @return mixed
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * 画像までのイメージ
     *
     * @return mixed
     */
    public function urlToImage()
    {
        return $this->urlToImage;
    }
}
