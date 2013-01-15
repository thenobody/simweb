<?php

namespace Sim\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="Sim\CoreBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\Column(name="title", type="string", length=255)
     * 
     * @var string
     */
    private $title;
    
    /**
     * @ORM\Column(name="slug", type="string", length=255)
     * 
     * @var string
     */
    private $slug;
    
    /**
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     * 
     * @var string
     */
    private $subtitle = NULL;
    
    /**
     * @ORM\Column(name="content", type="text")
     * 
     * @var string
     */
    private $content;
    
    /**
     * @ORM\Column(name="theme_name", type="string", length=255, nullable=true)
     * 
     * @var string
     */
    private $themeName = NULL;
    
    /**
     * @ORM\OneToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="main_image_id", referencedColumnName="id")
     * 
     * @var Image
     */
    private $mainImage = NULL;
    
    /**
     * @ORM\Column(name="order_num", type="integer", nullable=true)
     * 
     * @var int
     */
    private $orderNum = NULL;
    
    /**
     * @ORM\Column(name="visible", type="boolean")
     * 
     * @var boolean
     */
    private $visible = TRUE;
    
    /* Collections */
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="article")

     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $images;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="articles")
     * @ORM\JoinTable(name="articles_tags",
     *     joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $tags;
    
    function __construct() {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

        /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getThemeName() {
        return $this->themeName;
    }

    /**
     * @param string $themeName
     */
    public function setThemeName($themeName) {
        $this->themeName = $themeName;
    }

    /**
     * @return Image
     */
    public function getMainImage() {
        return $this->mainImage;
    }

    /**
     * @param Image $mainImage
     */
    public function setMainImage($mainImage) {
        $this->mainImage = $mainImage;
    }

    /**
     * @return int
     */
    public function getOrderNum() {
        return $this->orderNum;
    }

    /**
     * @param int $orderNum
     */
    public function setOrderNum($orderNum) {
        $this->orderNum = $orderNum;
    }

    /**
     * @return boolean
     */
    public function getVisible() {
        return $this->visible;
    }

    /**
     * @param boolean $visible
     */
    public function setVisible($visible) {
        $this->visible = $visible;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection of Image
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $images Image
     */
    public function setImages($images) {
        $this->images = $images;
    }
    
    /**
     * @param Image $image
     */
    public function addImage($image) {
        $this->getImages()->add($image);
        $image->setArticle($this);
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection of Tag
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $tags Tag
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }
    
    /**
     * @param Tag $tag
     */
    public function addTag($tag) {
        $this->getTags()->add($tag);
        $tag->addArticle($this);
    }

}
