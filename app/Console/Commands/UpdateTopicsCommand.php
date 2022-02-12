<?php

namespace App\Console\Commands;

use App\Services\TopicService\TopicService;
use Illuminate\Console\Command;

class UpdateTopicsCommand extends Command
{

    private $topicService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:topic';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update topics.';

    /**
     * Create a new command instance.
     *
     * @param TopicService $topicService
     */
    public function __construct(TopicService $topicService)
    {
        parent::__construct();

        $this->topicService = $topicService;
    }

    /**
     *
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $this->topicService->createTopicsFromOnlineNews();

        return Command::SUCCESS;
    }
}
