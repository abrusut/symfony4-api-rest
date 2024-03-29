<?php
namespace App\Repository;

use App\Entity\User;

class UserRepository extends BaseRepository{

    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByEmail( string $email ):?User{
        /** @var User $user  */
        $user = $this->objectRepository->findOneBy(['email' => $email]);

        return $user;
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}



