<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper
{
    protected mixed $userEmail;

    public function __construct($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function checkUser()
    {
        $user = User::where('email', $this->userEmail)->get();

        if (!is_null($user)){

        }

    }
}
