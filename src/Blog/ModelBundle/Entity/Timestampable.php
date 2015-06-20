<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * Timestampable
 * @ORM\MappedSuperclass
 */

abstract class Timestampable
{

	/**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Assert\NotBlank
     */
    private $createdAt;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Author
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


}