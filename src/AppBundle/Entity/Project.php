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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="project")
     * @ORM\JoinColumn(name="user_login", referencedColumnName="login")
     */
    private $teamLeader;

    /**
     * @ORM\OneToMany(targetEntity="Screen", mappedBy="project")
     */
    private $screens;

    /**
     * @ORM\OneToOne(targetEntity="Bin", mappedBy="project")
     */
    protected $bin;

    /**
     * @ORM\OneToOne(targetEntity="Sources", mappedBy="project")
     */
    protected $sources;

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
     * Constructor
     */
    public function __construct()
    {
        $this->screens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set teamLeader
     *
     * @param \AppBundle\Entity\User $teamLeader
     *
     * @return Project
     */
    public function setTeamLeader(\AppBundle\Entity\User $teamLeader = null)
    {
        $this->teamLeader = $teamLeader;

        return $this;
    }

    /**
     * Get teamLeader
     *
     * @return \AppBundle\Entity\User
     */
    public function getTeamLeader()
    {
        return $this->teamLeader;
    }

    /**
     * Add screen
     *
     * @param \AppBundle\Entity\Screen $screen
     *
     * @return Project
     */
    public function addScreen(\AppBundle\Entity\Screen $screen)
    {
        $this->screens[] = $screen;

        return $this;
    }

    /**
     * Remove screen
     *
     * @param \AppBundle\Entity\Screen $screen
     */
    public function removeScreen(\AppBundle\Entity\Screen $screen)
    {
        $this->screens->removeElement($screen);
    }

    /**
     * Get screens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScreens()
    {
        return $this->screens;
    }

    /**
     * Set bin
     *
     * @param \AppBundle\Entity\Bin $bin
     *
     * @return Project
     */
    public function setBin(\AppBundle\Entity\Bin $bin = null)
    {
        $this->bin = $bin;

        return $this;
    }

    /**
     * Get bin
     *
     * @return \AppBundle\Entity\Bin
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Set sources
     *
     * @param \AppBundle\Entity\Sources $sources
     *
     * @return Project
     */
    public function setSources(\AppBundle\Entity\Sources $sources = null)
    {
        $this->sources = $sources;

        return $this;
    }

    /**
     * Get sources
     *
     * @return \AppBundle\Entity\Sources
     */
    public function getSources()
    {
        return $this->sources;
    }
}