<?php

namespace AppBundle\Entity;

class Member
{
    /**
     * @Assert\NotBlank
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


}
