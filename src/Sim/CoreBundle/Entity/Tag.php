<?php

namespace Sim\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="Sim\CoreBundle\Entity\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="label", type="string", length=255)
     * 
     * @var string
     */
    private $label;

    /**
     * @ORM\Column(name="visible", type="boolean")
     * 
     * @var boolean
     */
    private $visible = TRUE;
    
    /* Collections */
    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="tags")
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $articles;

    public function __construct() {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles($articles) {
        $this->articles = $articles;
    }

    /**
     * @param Article $article
     */
    public function addArticle($article) {
        $this->getArticles()->add($article);
    }
}
