<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
* @ORM\Entity()
*/
class User {
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\genre()
    * @ORM\Column(type="string", length=5)
    */
    private $genre;

    /**
    * @ORM\prenom()
    * @ORM\Column(type="string", length=20)
    */
    private $prenom;

    /**
    * @ORM\nom()
    * @ORM\Column(type="string", length=200)
    */
    private $nom;

    /**
    * @ORM\email()
    * @ORM\Column(type="string", length=50)
    */
    private $email;

    /**
    * @ORM\password()
    * @ORM\Column(type="string", length=50)
    */
    private $password;

    /**
    * @ORM\defaut_nbpers()
    * @ORM\Column(type="integer")
    */
    private $defaut_nbpers;

    /**
    * @ORM\allergies()
    * @ORM\Column(type="string", length=180)
    */
    private $Allergies;
}