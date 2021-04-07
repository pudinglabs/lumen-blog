<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /*
     * Constructor
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
