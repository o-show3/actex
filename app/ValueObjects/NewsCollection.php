<?php

namespace App\ValueObjects;

use App\Models\Topic;
use Illuminate\Support\Collection;
use App\ValueObjects\News;
use Illuminate\Support\Str;

class NewsCollection extends Collection
{
    /**
     * NewsCollection constructor.
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item){
            $this->add(new News($item));
        }
    }

    /**
     * トピックデータを作成します
     */
    public function createTopics()
    {
        // トピックを保存する
        $this->each(function ($news, $key){
            $topic = $news->toTopic();
            $topic->uuid = Str::uuid();
            // 同一URLの重複登録を防ぐ
            $sameUrlRecordCount = Topic::where(Topic::URL, $topic->url)->count();
            if($sameUrlRecordCount==0){
                $topic->save();
            }
        });
    }

}
