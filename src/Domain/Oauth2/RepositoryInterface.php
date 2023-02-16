<?php

namespace App\Domain\Oauth2;

use App\Entity\User;

interface RepositoryInterface {
    function addUser(User $user):User;
}