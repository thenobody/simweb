<?php

namespace Sim\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="Sim\PortfolioBundle\Entity\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @var string
     */
    private $name;
    
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
    
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="images")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * 
     * @var Article
     */
    private $article;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getOrderNum() {
        return $this->orderNum;
    }

    public function setOrderNum($orderNum) {
        $this->orderNum = $orderNum;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }
    
    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article) {
        $this->article = $article;
    }

}
