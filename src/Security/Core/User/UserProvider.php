<?php
namespace App\Security\Core\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface {

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($username): UserInterface
    {
        return $this->findUser($username);
    }

    public function refreshUser(\Symfony\Component\Security\Core\User\UserInterface $user): UserInterface    
    {
        if( !$user instanceof User){
            throw new UnsupportedUserException(
                sprintf('Instance of [%s] are not supported', get_class($user))
            );
        }

        return $this->findUser($user->getUsername());
    }
    
    public function findUser(string $username): User
    {
        $user = $this->userRepository->findOneByEmail($username);
        if(!$user){
            throw new UsernameNotFoundException(
                printf('User with email [%s] not found or not active', $username)
            );
        }
        return $user;
    }
}

