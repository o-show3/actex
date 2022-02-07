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
    protected $signature = 'create:category {key} {category} ';


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
        $this->categoryService->createCategory($this->argument('key'), $this->argument('category'));

        return Command::SUCCESS;
    }
}
