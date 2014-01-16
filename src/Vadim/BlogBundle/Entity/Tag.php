<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="Vadim\BlogBundle\Entity\TagRepository")
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="times_used", type="integer")
     */
    protected $timesUsed = 0;

    /**
     * @ORM\Column(name="font_size", type="integer")
     */
     protected $fontSize = 30;
    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="tags")
     */
    protected $articles;

    public function __construct(){
        $this->articles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTimesUsed()
    {
        return $this->timesUsed;
    }

    /**
     * @return mixed
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }


    /**
     * @param mixed $articles
     */
    public function setArticles(ArrayCollection $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $timesUsed
     */
    public function setTimesUsed($timesUsed)
    {
        $this->timesUsed = $timesUsed;
    }

    /**
     * @param mixed $fontSize
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }


}