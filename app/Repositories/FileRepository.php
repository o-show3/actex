<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\traits\GetByIdGettable;

class FileRepository extends Repository
{
    use GetByIdGettable;

    protected $model;

    /**
     * PairRepository constructor.
     */
    public function __construct()
    {
        $this->model = File::class;
    }
}
