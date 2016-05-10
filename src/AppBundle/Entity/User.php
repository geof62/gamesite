<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends \Raphy\Epitech\UserBundle\Entity\User
{
    /**
     * @ORM\OneToOne(targetEntity="Project", inversedBy="teamLeader")
     */
    protected $project;

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return User
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
