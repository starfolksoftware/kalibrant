<?php

namespace StarfolkSoftware\Setting\Tests\Mocks;

use Illuminate\Foundation\Auth\User;
use StarfolkSoftware\Setting\HasSettings;

class TestUser extends User
{
    use HasSettings;

    protected $table = 'users';
}