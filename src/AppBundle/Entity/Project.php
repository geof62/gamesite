<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="screen1", type="string", length=255, nullable=true)
     */
    private $screen1;

    /**
     * @var string
     *
     * @ORM\Column(name="screen2", type="string", length=255, nullable=true)
     */
    private $screen2;

    /**
     * @var string
     *
     * @ORM\Column(name="screen3", type="string", length=255, nullable=true)
     */
    private $screen3;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="sources", type="string", length=255, nullable=true)
     */
    private $sources;

    /**
     * @var string
     *
     * @ORM\Column(name="bin", type="string", length=255, nullable=true)
     */
    private $bin;

    /**
     * @var string
     *
     * @ORM\Column(name="members", type="simple_array", nullable=true)
     */
    private $members;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="leader_login", referencedColumnName="login")
     */
    private $teamLeader;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set screen1
     *
     * @param string $screen1
     *
     * @return Project
     */
    public function setScreen1($screen1)
    {
        $this->screen1 = $screen1;

        return $this;
    }

    /**
     * Get screen1
     *
     * @return string
     */
    public function getScreen1()
    {
        return $this->screen1;
    }

    /**
     * Set screen2
     *
     * @param string $screen2
     *
     * @return Project
     */
    public function setScreen2($screen2)
    {
        $this->screen2 = $screen2;

        return $this;
    }

    /**
     * Get screen2
     *
     * @return string
     */
    public function getScreen2()
    {
        return $this->screen2;
    }

    /**
     * Set screen3
     *
     * @param string $screen3
     *
     * @return Project
     */
    public function setScreen3($screen3)
    {
        $this->screen3 = $screen3;

        return $this;
    }

    /**
     * Get screen3
     *
     * @return string
     */
    public function getScreen3()
    {
        return $this->screen3;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sources
     *
     * @param string $sources
     *
     * @return Project
     */
    public function setSources($sources)
    {
        $this->sources = $sources;

        return $this;
    }

    /**
     * Get sources
     *
     * @return string
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * Set bin
     *
     * @param string $bin
     *
     * @return Project
     */
    public function setBin($bin)
    {
        $this->bin = $bin;

        return $this;
    }

    /**
     * Get members
     *
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set members
     *
     * @param array $members
     *
     * @return Project
     */
    public function setMembers($members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get Bin
     *
     * @return string
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Set team Leader
     *
     * @param User $user
     *
     * @return Project
     */
    public function setTeamLeader(User $user)
    {
        $this->teamLeader = $user;

        return $this;
    }

    /**
     * Get sources
     *
     * @return User
     */
    public function getTeamLeader()
    {
        return $this->teamLeader;
    }
}