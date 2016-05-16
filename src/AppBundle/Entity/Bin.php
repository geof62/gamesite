<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Bin
 *
 * @ORM\Table(name="bin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BinRepository")
 */
class Bin
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
     * @ORM\OneToOne(targetEntity="Project", inversedBy="bin", cascade={"persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

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
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Bin
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

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/bin';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Screen
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function upload()
    {
        if (null === $this->getFile() || $this->getFile()->getError() != 0) {
            $this->file = null;
            $session = new Session();
            $session->getFlashBag()->add(
                'danger',
                'Unable to save binnary : '.($this->getFile() === null ? "File not uploaded" : $this->getFile()->getErrorMessage())
            );
            return;
        }
        $file_name = $this->project->getTitle()."_".uniqid();
        if ($this->getFile()->guessExtension() != "")
            $file_name .= ".".$this->getFile()->guessExtension();
        if ($this->path != "")
            unlink($this->getUploadRootDir(). '/' .$this->path);
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $file_name
        );
        $this->path = $file_name;
        $this->file = null;
    }
}
