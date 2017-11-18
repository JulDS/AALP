<?php
// src/AALP/BookingBundle/Entity/Image

namespace AALP\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AALP\BookingBundle\Entity\ImageRepository")
 */
class Image
{
  /**
   * @ORM\ManyToOne(targetEntity="AALP\BookingBundle\Entity\Accommodation", inversedBy="images", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $accommodation;

  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt;

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
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

   /**
   * @param Accommodation $accommodation
   */
  public function setAccommodation(Accommodation $accommodation)
  {
    $this->accommodation = $accommodation;
  }
  
  /**
   * @return Accommodation
   */
  public function getAccommodation()
  {
    return $this->accommodation;
  }
}
