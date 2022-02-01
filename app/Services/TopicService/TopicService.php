<?php

namespace App\Services\TopicService;

use App\ValueObjects\News;
use App\ValueObjects\NewsCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Topic;

class TopicService
{
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * @return Topic[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewsList()
    {
        /* todo : リポジトリへの分離 */
        return Topic::orderBy(Topic::PUBLISHED_AT)->get();
    }

    /**
     * APIからオンライン上のニュースを取得する
     *
     * @return NewsCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOnlineNews()
    {
        $newsCollection = new NewsCollection();
        try {
            $num = 25;
            $url = config('newsapi.news_api_url') . "top-headlines?country=jp&category=general&pageSize=".$num."&apiKey=" . config('newsapi.news_api_key');

            $response =  $this->guzzle->request('get', $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);
            $newsCollection = new NewsCollection($articles['articles']);

        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }

        return $newsCollection;
    }

    /**
     * オンラインニュースからトピックを作る
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createTopicsFromOnlineNews()
    {
        // ニュースを取得する
        $newsCollection = $this->getOnlineNews();
        // トピックのコレクションに変換して保存する
        $newsCollection->createTopics();
    }
}
