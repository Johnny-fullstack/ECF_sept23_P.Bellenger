<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
* @ORM\Entity()
*/
class Admin {

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

}