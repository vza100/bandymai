<?php
/**
 * Created by PhpStorm.
 * User: viktoras
 * Date: 17.1.13
 * Time: 17.14
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="skateboard")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 */
class Skateboard
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
     * @var = string
     *
     * @ORM\Column(name="title", type="string",length=255,nullable=true)
     */

    private $title;

    /**
     * @var = string
     *
     * @ORM\Column(name="category", type="string",length=255,nullable=true)
     */

    private $category;


//-------------------------------------------------------------
    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer",length=255)
     */

    private $price;
//-------------------------------------------------------------

    /**
     *
     * @var = string
     * @ORM\Column(name="description", type="string",length=400,nullable=true)
     */
    private $description;


    


    /**
     * Get id
     *
     * @return integer
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
     * @return Skateboard
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
     * Set price
     *
     * @param integer $price
     *
     * @return Skateboard
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Skateboard
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
     * Set category
     *
     * @param string $category
     *
     * @return Skateboard
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
}