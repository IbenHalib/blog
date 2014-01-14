<?php

namespace Vadim\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @var string
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}