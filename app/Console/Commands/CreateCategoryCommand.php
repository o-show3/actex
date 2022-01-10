<?php

namespace App\Console\Commands;

use App\Services\CategoryService\CategoryService;
use Illuminate\Console\Command;

class CreateCategoryCommand extends Command
{

    private $categoryService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new category.';

    /**
     * Create a new command instance.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();

        $this->categoryService = $categoryService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 入力
        $name = $this->ask('英語名（キー）を入力してください');
        $description = $this->ask('カテゴリ名（表示）を入力してください');
        // 確認
        $this->info("英語名（キー）: $name");
        $this->info("カテゴリ名（表示） : $description");
        if ($this->confirm('この内容で実行してよろしいですか?')) {
            // 作成処理
            $this->categoryService->createCategory($name, $description);
        } else {
            $this->info('カテゴリの作成をキャンセルしました');
        }

        return Command::SUCCESS;
    }
}
