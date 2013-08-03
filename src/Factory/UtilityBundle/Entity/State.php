<?php

namespace Factory\UtilityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="state")
 */
class State
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="states")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\UserBundle\Entity\User", mappedBy="state")
     */
    protected $users;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}