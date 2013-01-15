<?php

namespace Sim\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="Sim\PortfolioBundle\Entity\PageRepository")
 */
class Page
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
     * @ORM\Column(name="title", type="string")
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
     * @ORM\Column(name="content", type="text")
     * 
     * @var string
     */
    private $content;
    
    /**
     * @ORM\Column(name="visible", type="boolean")
     * 
     * @var boolean
     */
    private $visible = TRUE;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }
}
