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
 * @ORM\Table(name="Skate_Shop")
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

    /**
     * @var = string
     *
     * @ORM\Column(name="random_string", type="string",length=255,nullable=true)
     */

    private $randomString;


//-------------------------------------------------------------
    /**
     * @var int
     *
     * @ORM\Column(name="price", type="decimal", precision=7, scale=2)
     */

    private $price = 0;
//-------------------------------------------------------------

    /**
     *
     * @var = string
     * @ORM\Column(name="description", type="string",length=400,nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Photos", mappedBy="skateboard")
     */
    private $photos;

    


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
     * @param decimal $price
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
     * @return float
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

   

    /**
     * Set url
     *
     * @param \AppBundle\Entity\Photos $url
     *
     * @return Skateboard
     */
    public function setUrl(\AppBundle\Entity\Photos $url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return \AppBundle\Entity\Photos
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return Skateboard
     */
    public function addPhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photos $photo
     */
    public function removePhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set randomString
     *
     * @param string $randomString
     *
     * @return Skateboard
     */
    public function setRandomString($randomString)
    {
        $this->randomString = $randomString;

        return $this;
    }

    /**
     * Get randomString
     *
     * @return string
     */
    public function getRandomString()
    {
        return $this->randomString;
    }
}
