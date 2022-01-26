<?php

namespace App\Http\Controllers;

use App\ValueObjects\NewsCollection;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class TopicController extends Controller
{
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
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

        return view('topics.index', compact('newsCollection'));
    }
}
