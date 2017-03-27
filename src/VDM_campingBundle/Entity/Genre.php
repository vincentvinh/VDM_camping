<?php

namespace VDM_campingBundle\Entity;

/**
 * Genre
 */
class Genre
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $genre;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vdm;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vdm = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vdm
     *
     * @param \VDM_campingBundle\Entity\Vdm $vdm
     *
     * @return Genre
     */
    public function addVdm(\VDM_campingBundle\Entity\Vdm $vdm)
    {
        $this->vdm[] = $vdm;

        return $this;
    }

    /**
     * Remove vdm
     *
     * @param \VDM_campingBundle\Entity\Vdm $vdm
     */
    public function removeVdm(\VDM_campingBundle\Entity\Vdm $vdm)
    {
        $this->vdm->removeElement($vdm);
    }

    /**
     * Get vdm
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVdm()
    {
        return $this->vdm;
    }
}
