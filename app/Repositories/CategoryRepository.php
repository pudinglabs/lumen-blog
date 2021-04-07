<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    /*
     * Constructor
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
