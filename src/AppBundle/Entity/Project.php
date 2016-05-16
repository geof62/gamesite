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
     * @ORM\OneToOne(targetEntity="User", mappedBy="project", cascade={"persist"})
     * @ORM\JoinColumn(name="user_login", referencedColumnName="login")
     */
    private $teamLeader;

    /**
     * @ORM\OneToMany(targetEntity="Screen", mappedBy="project", cascade={"persist", "remove"})
     */
    private $screens;

    /**
     * @ORM\OneToOne(targetEntity="Bin", mappedBy="project", cascade={"persist", "remove"})
     */
    protected $bin;

    /**
     * @ORM\OneToOne(targetEntity="Sources", mappedBy="project", cascade={"persist", "remove"})
     */
    protected $sources;

    /**
     * @var boolean
     *
     * @ORM\Column(name="win", type="boolean")
     */
    private $windows;

    /**
     * @var boolean
     *
     * @ORM\Column(name="linux", type="boolean")
     */
    private $linux;

    /**
     * @var boolean
     *
     * @ORM\Column(name="max", type="boolean")
     */
    private $mac;

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

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return Project
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set windows
     *
     * @param boolean $windows
     *
     * @return Project
     */
    public function setWindows($windows)
    {
        $this->windows = $windows;

        return $this;
    }

    /**
     * Get windows
     *
     * @return boolean
     */
    public function getWindows()
    {
        return $this->windows;
    }

    /**
     * Set linux
     *
     * @param boolean $linux
     *
     * @return Project
     */
    public function setLinux($linux)
    {
        $this->linux = $linux;

        return $this;
    }

    /**
     * Get linux
     *
     * @return boolean
     */
    public function getLinux()
    {
        return $this->linux;
    }

    /**
     * Set mac
     *
     * @param boolean $mac
     *
     * @return Project
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return boolean
     */
    public function getMac()
    {
        return $this->mac;
    }
}
