<?php
namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use App\Security\Roles;

class User implements UserInterface {

    /**
     * @var UuidInterface
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string[]
     */
    protected $roles;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @throws \Exception
     */
    public function __construct(string $name, string $password, UuidInterface $id = null, string $email = null)
    {
        $this->name = $name;
        $this->setPassword($password);
        $this->id = $id ?? Uuid::uuid4();
        $this->email = $email;        
        $this->roles = (Roles::ROLE_USER);
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    /**
     * @return string[]
     */
    public function getRoles(): array {
        return $this->roles;
    }

    /**
     * @return string password
     */
    public function getPassword():string {
        return $this->password;
    }

    
    public function getSalt(): void{

    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string username
     */
    public function getUsername():?string {
        return $this->email;
    }
   
    public function eraseCredentials():void{

    }

    /**     
     * @return  string
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */ 
    public function setName(string $name):void
    {
        $this->name = $name;        
    }

    /**
     * @return  string
     */ 
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @param  string  $password     
     */ 
    public function setPassword(string $password):void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT) ;        
    }

    /**
     * @return  \DateTime
     */ 
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**          
     * @return  \DateTime
     */ 
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @throws \Exception
     */
    public function markAsUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}

