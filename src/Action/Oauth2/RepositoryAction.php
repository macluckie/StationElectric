<?php

namespace App\Action\Oauth2;

use App\Domain\Oauth2\RepositoryInterface;
use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryAction implements RepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addUser(User $user): User
    {
        $userExist =  $this->checkUserExist($user);
        if ($userExist == null) {
            $this->em->persist($user);
            $this->em->flush();
            $userAdded =  $this->checkUserExist($user);
            return $userAdded;
        }
        return $userExist;
    }

    public function checkUserExist(User $user): ?User
    {
        $userExist =  $this->em->getRepository(User::class)->findBy(['email' => $user->getEmail()]);
        return count($userExist) > 0 ? $userExist[0] : null;
    }
}
