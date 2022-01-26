<?php

namespace App\ValueObjects;

use Illuminate\Support\Collection;
use App\ValueObjects\News;

class NewsCollection extends Collection
{
    /**
     * NewsCollection constructor.
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $item){
            $this->add(new News($item));
        }
    }
}
