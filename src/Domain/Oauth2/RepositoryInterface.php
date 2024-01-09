<?php

namespace App\Domain\Oauth2;

use App\Domain\Entity\User;

interface RepositoryInterface {
    function addUser(User $user):User;
}