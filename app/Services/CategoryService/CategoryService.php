<?php

namespace App\Services\CategoryService;

use App\Services\CategoryService\CategoryServiceInterface;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * カテゴリを新規作成する
     *
     * @param string $name
     * @param string $description
     * @return mixed
     */
    public function createCategory(string $name, string $description)
    {
        return
            $this->categoryRepository->create($name, $description);
    }

}
