<?php

namespace App\ValueObjects;

use App\Models\Topic;
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


    /**
     * トピックに変換します
     *
     * @return Topic
     */
    public function toTopic()
    {
        $topic = new Topic();
        $topic->fill([
            Topic::SOURCE => json_encode($this->source),
            Topic::AUTHOR => $this->author,
            Topic::TITLE  => $this->title,
            Topic::DESCRIPTION => $this->description,
            Topic::URL => $this->url,
            Topic::URL_TO_IMAGE => $this->urlToImage,
            Topic::PUBLISHED_AT => $this->publishedAt,
            Topic::CONTENT => $this->content,
        ]);

        return
            $topic;
    }
}
