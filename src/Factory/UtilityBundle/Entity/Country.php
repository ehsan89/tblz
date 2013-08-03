<?php

namespace Factory\UtilityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
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
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="country")
     */
    protected $states;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\UserBundle\Entity\User", mappedBy="country")
     */
    protected $users;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}