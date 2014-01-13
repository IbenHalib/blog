<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Article
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="Vadim\BlogBundle\Entity\ArticleRepository")
 */
class Article
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
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     */
    protected $category;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="img", type="string", length=255)
//     */
//    protected $img;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="articles")
     * @ORM\JoinTable(name="tag_article")
     */
    protected $tags;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfViews", type="integer")
     */
    protected $numberOfViews;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
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
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return int
     */
    public function getNumberOfViews()
    {
        return $this->numberOfViews;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @param int $numberOfViews
     */
    public function setNumberOfViews($numberOfViews)
    {
        $this->numberOfViews = $numberOfViews;
    }

    /**
     * @param mixed $tags
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


}