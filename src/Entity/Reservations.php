<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
* @ORM\Entity()
*/
class Reservations {
    
    /**
    * @ORM\nbpers()
    * @ORM\Column(type="integer")
    */
    private $nbpers;

    /**
    * @ORM\date()
    * @ORM\Column(type="date")
    */
    private $Jour;

    /**
    * @ORM\heure_dej()
    * @ORM\Column(type="time")
    */
    private $Heure_dej;

    /**
    * @ORM\heure_dîner()
    * @ORM\Column(type="time")
    */
    private $Heure_dîner;

    /**
    * @ORM\allergies()
    * @ORM\Column(type="string", length=180)
    */
    private $Allergies;
}
