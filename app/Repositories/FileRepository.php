<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\traits\GetByIdGettable;

class FileRepository
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

    /**
     * メッセージを作る
     *
     * @param array $parameters
     * @return mixed
     */
    public function create(array $parameters)
    {
        $file = new ($this->model);
        $file->path = $parameters[File::PATH];
        $file->extension = $parameters[File::EXTENSION];
        $file->save();

        return $file;
    }
}
