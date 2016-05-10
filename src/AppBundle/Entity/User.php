<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Raphy\Epitech\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
    }

}