<?php

namespace App\Services\CategoryService;

interface CategoryServiceInterface
{
    /**
     * カテゴリを新規作成する
     *
     * @param string $name
     * @param string $description
     * @return mixed
     */
    public function createCategory(string $name, string $description);
}
