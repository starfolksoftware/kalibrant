<?php

namespace StarfolkSoftware\Kalibrant\Tests\Mocks;

use Illuminate\Foundation\Auth\User;
use StarfolkSoftware\Kalibrant\HasSettings;

class TestUser extends User
{
    use HasSettings;

    protected $table = 'users';
}