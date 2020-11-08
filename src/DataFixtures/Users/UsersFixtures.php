<?php
namespace App\DataFixtures\Users;

use App\DataFixtures\Fixtures;
use App\Entity\Entities\Users\Users;

class UsersFixtures extends Fixtures
{

    public function load()
    {

        $user = new Users();
        $user->setActive(1);
        $user->setEmail('michal.materniak@commit-m.pl');
        $user->setPassword(password_hash('q', PASSWORD_BCRYPT));
        $user->setFirstName('Michał');
        $user->setLastName('Materniak');
        static::addFixture($user, 'user');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
