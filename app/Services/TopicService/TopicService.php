<?php

namespace App\Services\TopicService;

use App\Models\TopicUser;
use App\Repositories\TopicRepository;
use App\Repositories\TopicUserRepository;
use App\ValueObjects\News;
use App\ValueObjects\NewsCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Topic;

class TopicService
{
    private $guzzle;
    protected $topicRepository;
    protected $topicUserRepository;

    public function __construct(TopicRepository $topicRepository, TopicUserRepository $topicUserRepository)
    {
        $this->guzzle = new Client();
        $this->topicRepository = $topicRepository;
        $this->topicUserRepository = $topicUserRepository;
    }

    /**
     * @return Topic[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewsList()
    {
        /* todo : リポジトリへの分離 */
        return Topic::orderByDesc(Topic::PUBLISHED_AT)->get();
    }

    /**
     * APIからオンライン上のニュースを取得する
     *
     * @return NewsCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOnlineNewsFromApi()
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
        $newsCollection = $this->getOnlineNewsFromApi();
        // トピックのコレクションに変換して保存する
        $newsCollection->createTopics();
    }

    /**
     * トピックにライクをしたユーザを紐付けます
     * @param $userId
     * @param $topicUuid
     */
    public function like(string $userId, string $topicUuid)
    {
        // トピックを取得する
        $topic = $this->topicRepository->getByUuid($topicUuid);

        // トピックを登録する
        $this->addTopicUser($userId, $topic->id, TopicUser::STATUS_LIKE);
    }

    /**
     * トピックに紐付けたユーザを追加します
     *
     * @param string $userId
     * @param string $topicId
     * @param int $status
     * @return mixed
     */
    public function addTopicUser(string $userId, string $topicId, int $status)
    {
        return
            $this->topicUserRepository->create($userId, $topicId, $status);
    }
}
